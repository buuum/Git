<?php

namespace Buuum;

class Git
{

    private $repository_path;

    public function __construct($repository_path)
    {
        $this->repository_path = $repository_path;
    }

    public function getCommits()
    {
        $list = array();
        $lines = $this->execute("--git-dir {$this->repository_path}/.git log");
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
        return array_reverse($list);
    }

    public function getCurrentBranch()
    {
        $output = $this->execute('symbolic-ref HEAD');
        $tmp = explode('/', $output[0]);
        return $tmp[2];
    }

    public function getDiffCommits($from, $to)
    {
        $command = "diff --name-status {$from} {$to}";
        return $this->execute($command);
    }

    public function getDiff($number = 1)
    {
        $command = "diff --name-status HEAD~{$number}..HEAD";
        return $this->execute($command);
    }

    public function getAllFiles()
    {
        $command = "ls-files";
        return $this->execute($command);
    }

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