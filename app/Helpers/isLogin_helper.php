<?php

if (!function_exists('isLogin')) {
    function isLogin()
    {
        $isLogin = session()->get('isLogin');
        if ($isLogin) {
            return true;
        } else {
            return false;
        }
    }
}
