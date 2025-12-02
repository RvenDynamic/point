<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (isLogin()) {
            if (user('role') == 'superadmin') {
                return redirect('superadmin');
            } else {
                return redirect('admin');
            }
        }
        return view('guest/login');
    }

    public function lupaPassword()
    {
        return view('guest/lupa_password');
    }

    public function resetPassword()
    {
        return view('guest/password_baru');
    }
}
