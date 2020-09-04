<?php

function connect($host, $password, $name, $dbname, $driver)
{
    return $connect = [

        'host' => $host,
        'password' => $password,
        'name' => $name,
        'dbname' => $dbname,
        'driver' => $driver,
    ];
}
