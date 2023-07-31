<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function index()
    {
        if (session('id')) {
            return redirect()->to(site_url('Admin/dashboard'));
        }
        return view('pages/index');
    }
}
