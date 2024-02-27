<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends BaseController
{
    public function index()
    {
        $data = [
            'judul' => 'Homepage'
        ];

        return view('templates/v_header', $data) .
            view('templates/v_sidebar') .
            view('templates/v_topbar') .
            view('Home/index', $data) . // Mengirimkan data ke view Home/index
            view('templates/v_footer');
    }
}
