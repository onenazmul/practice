<?php

class car 
{
  public $name;
}

class bmw extends car
{
  public function size()
  {
    return 'this is size method in bmw class';
  }

  public function color()
  {
    return 'this is color method bmw class';
  }
}

class toyta extends car
{
  public function getSize()
  {
    return self::size();
  }
}

$result = new toyta();
$result->getSize();