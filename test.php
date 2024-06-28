<?php

$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->set(2, 12345);
var_dump($redis->get(2));
var_dump($arr = explode(',', "a,regerg,ge gergerg,ergerge,rgesdfg"));
var_dump(implode(",", []));
