<?php

class hello
{
    public function get()
    {
        echo "getto";
    }
    public function put()
    {
        echo "put";
    }
}

    $hh = "hello";
    $x = new $hh();
    $j = "put";
    $x->$j();
