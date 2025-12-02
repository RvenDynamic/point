<?php

if (!function_exists('user')) {
    function user($params)
    {
        return session()->get($params);
    }
}
