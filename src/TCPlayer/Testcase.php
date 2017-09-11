<?php

namespace TencentTH\TCPlayer;

class Testcase {
  public $file;
  public $title;
  public $expected;
  public $actual;
  public $pass;

  public function __construct($file, $title, $expected, $actual, $pass) {
    $this->file = $file;
    $this->title = $title;
    $this->expected = $expected;
    $this->actual = $actual;
    $this->pass = $pass;
  }
}
