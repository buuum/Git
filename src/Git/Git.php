<?php

namespace Buuum;

class Git
{

    /**
     * @var string
     */
    private $repository_path;

    /**
     * Git constructor.
     * @param $repository_path
     */
    public function __construct($repository_path)
    {
        $this->repository_path = $repository_path;
    }

    /**
     * @param boolean $order_asc
     * @return array
     */
    public function getCommits($order_asc = true)
    {
        $list = array();
        $lines = $this->execute("log");
        foreach ($lines as $k => $line) {
            if (substr($line, 0, 7) == 'commit ') {
                $row = array(
                    'commit'  => substr($line, 7),
                    'author'  => substr($lines[$k + 1], 8),
                    'date'    => substr($lines[$k + 2], 8),
                    'message' => substr($lines[$k + 4], 4, 50),
                );
                $list[$row['commit']] = $row;
            }
        }
        return ($order_asc)? array_reverse($list) : $list;
    }

    /**
     * @return string
     */
    public function getCurrentBranch()
    {
        $output = $this->execute('symbolic-ref HEAD');
        $tmp = explode('/', $output[0]);
        return $tmp[2];
    }

    /**
     * @param $from
     * @param $to
     * @return array
     */
    public function getDiffCommits($from, $to)
    {
        $command = "diff --name-status {$from} {$to}";
        return $this->execute($command);
    }

    /**
     * @param int $number
     * @return array
     */
    public function getDiff($number = 1)
    {
        $command = "diff --name-status HEAD~{$number}..HEAD";
        return $this->execute($command);
    }

    /**
     * @return array
     */
    public function getAllFiles()
    {
        $command = "ls-files";
        return $this->execute($command);
    }


    /**
     * @return bool
     */
    public function isWorkingCopyClean()
    {
        $output = $this->execute('status');
        return $output[count($output)-1] == 'nothing to commit, working directory clean';
    }


    /**
     * @param $command
     * @return mixed
     */
    protected function execute($command)
    {
        $command = 'LC_ALL=es_ES.UTF-8 git -C ' . escapeshellarg($this->repository_path) . ' ' . $command;
        exec($command, $output, $returnValue);
        if ($returnValue !== 0) {
            throw new \RuntimeException(implode("\r\n", $output));
        }
        return $output;
    }
}