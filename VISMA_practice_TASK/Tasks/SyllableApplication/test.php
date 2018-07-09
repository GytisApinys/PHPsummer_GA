<?php


class hello
{
   public static function mine()
  {
    hello::you();
  }
  public static function you()
  {
    echo "Does this work?\n";
  }
}

hello::mine();

