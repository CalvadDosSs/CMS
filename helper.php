<?php

function array_get($array, $key, $default = null) {

    $keys = explode('.', $key);

    for ($i = 0; $i < count($keys); $i++) {

        $array_key = $keys[$i];
        $array = $array[$array_key];
    }

    if ($array == null) {

        return $default;
    }

    return $array;
}
