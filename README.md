Simple wrapper for Git
=========================

[![Packagist](https://img.shields.io/packagist/v/buuum/Git.svg?maxAge=2592000)](https://packagist.org/packages/buuum/git)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg?maxAge=2592000)](#license)

## Install

### System Requirements

You need PHP >= 5.5.0 to use Buuum\Git but the latest stable version of PHP is recommended.

### Composer

Buuum\Git is available on Packagist and can be installed using Composer:

```
composer require buuum/git
```

### Manually

You may use your own autoloader as long as it follows PSR-0 or PSR-4 standards. Just put src directory contents in your vendor directory.

##  INITIALIZE

```php
$repository_path = __DIR__;
$git = new \Buuum\Git($repository_path);
```

## Methods

### getCurrentBranch()
```php
$git->getCurrentBranch();
```
output (string)
```
master
```

### getCommits($order_asc)
```php
$git->getCommits();
```
output (array)
```
array(2) {
  ["f70a8a70c3504257d8ccc79d2c759ee743b9391d"]=>
  array(4) {
    ["commit"]=>
    string(40) "f70a8a70c3504257d8ccc79d2c759ee743b9391d"
    ["author"]=>
    string(27) "buuum <buuumlion@gmail.com>"
    ["date"]=>
    string(29) "Sun May 1 15:51:51 2016 +0200"
    ["message"]=>
    string(14) "Initial commit"
  }
  ["cda360828e92443bfc0c19129794fd7729b7f7c8"]=>
  array(4) {
    ["commit"]=>
    string(40) "cda360828e92443bfc0c19129794fd7729b7f7c8"
    ["author"]=>
    string(47) "buuum <buuumlion@gmail.com>"
    ["date"]=>
    string(30) "Thu May 12 08:15:31 2016 +0200"
    ["message"]=>
    string(14) "initial commit"
  }
}
```

### getAllFiles()
```php
$git->getAllFiles();
```
output (array)
```
array(4) {
  [0]=>
  string(10) ".gitignore"
  [1]=>
  string(9) "README.md"
  [2]=>
  string(13) "composer.json"
  [3]=>
  string(15) "src/Git/Git.php"
}
```


### getDiffCommits($from, $to)
```php
$git->getDiffCommits($from,$to);
```
output (array)
```
array(4) {
  [0]=>
  string(12) "M	.gitignore"
  [1]=>
  string(11) "A	README.md"
  [2]=>
  string(15) "A	composer.json"
  [3]=>
  string(17) "A	src/Git/Git.php"
}
```


### getDiff($number)
```php
$git->getDiff(1);
```
output (array)
```
array(4) {
  [0]=>
  string(12) "M	.gitignore"
  [1]=>
  string(11) "A	README.md"
  [2]=>
  string(15) "A	composer.json"
  [3]=>
  string(17) "A	src/Git/Git.php"
}
```


### isWorkingCopyClean()
```php
$git->isWorkingCopyClean();
```
output (bool)
```
true
```


## LICENSE

The MIT License (MIT)

Copyright (c) 2016

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.