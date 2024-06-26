<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class AbkController extends Controller
{
    public function index()
    {
        return view('abk.ajuans', [
            'title' => 'Daftar Ajuan ABK    '
        ]);
    }

    public function createAjuan()
    {
        return view('abk.buat-ajuan', [
            'title' => '',
            'jabatans' => Jabatan::tree()->get()->toTree()
        ]);
    }
}
