<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\PendidikanFormal;
use App\Models\PendidikanPelatihan;
use App\Models\Pengalaman;
use Illuminate\Http\Request;

class KualifikasiController extends Controller
{
    public function storePendidikan(Jabatan $jabatan, Request $request) {
        PendidikanFormal::create($request->all());

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit/2#pendidikan_formal")->with('success', 'Data Pendidikan Formal berhasil ditambahkan');
    }
    public function deletePendidikan(Jabatan $jabatan, PendidikanFormal $pendidikan) {
        $pendidikan->delete();

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit/2#pendidikan_formal")->with('success', 'Data Pendidikan Formal berhasil dihapus');
    }
    
    public function storePengalaman(Jabatan $jabatan, Request $request) {
        Pengalaman::create($request->all());

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit/2#pengalaman")->with('success', 'Data Pengalaman berhasil ditambahkan');
    }
    public function deletepengalaman(Jabatan $jabatan, Pengalaman $pengalaman) {
        $pengalaman->delete();

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit/2#pengalaman")->with('success', 'Data Pengalaman berhasil dihapus');
    }
    
    public function storePelatihan(Jabatan $jabatan, Request $request) {
        PendidikanPelatihan::create($request->all());

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit/2#pelatihan")->with('success', 'Data Pelatihan berhasil ditambahkan');
    }
    public function deletePelatihan(Jabatan $jabatan, PendidikanPelatihan $pelatihan) {
        $pelatihan->delete();

        return redirect()->to("/anjab/jabatan/$jabatan->id/edit/2#pelatihan")->with('success', 'Data Pelatihan berhasil dihapus');
    }
}
