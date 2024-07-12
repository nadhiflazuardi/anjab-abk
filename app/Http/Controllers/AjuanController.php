<?php

namespace App\Http\Controllers;

use App\Models\Ajuan;
use App\Models\AjuanJabatan;
use App\Models\Jabatan;
use App\Models\JenisJabatan;
use App\Models\Role;
use App\Models\RoleVerifikasi;
use App\Models\UnitKerja;
use App\Models\Verifikasi;
use Illuminate\Http\Request;

class AjuanController extends Controller
{
    public function anjabIndex()
    {
        $title = 'Ajuan Jabatan';
        $ajuans = Ajuan::where('jenis', 'anjab')->get();

        return view('anjab.ajuans', compact('title', 'ajuans'));
    }

    public function anjabCreate()
    {
        $title = 'Buat Ajuan Baru';
        $jabatans = Jabatan::orderBy('nama')->get();
        $jenisJabatan = JenisJabatan::all();
        $unitKerjas = UnitKerja::all();
        return view('anjab.buat-ajuan', compact('title', 'jabatans', 'jenisJabatan', 'unitKerjas'));
    }

    public function anjabStore(Request $request)
    {
        $ajuan = Ajuan::create([
            'tahun' => now()->year,
            'jenis' => 'anjab'
        ]);

        // After creating an ajuan, roles that can verify the ajuan are created
        RoleVerifikasi::create([
            'ajuan_id' => $ajuan->id,
            'role_id' => '2',
            'is_approved' => false
        ]);

        RoleVerifikasi::create([
            'ajuan_id' => $ajuan->id,
            'role_id' => '6',
            'is_approved' => false
        ]);

        RoleVerifikasi::create([
            'ajuan_id' => $ajuan->id,
            'role_id' => '7',
            'is_approved' => false
        ]);

        $jabatans = $request->input('jabatans');
        foreach ($jabatans as $jabatan_id) {
            AjuanJabatan::create([
                'ajuan_id' => Ajuan::latest()->first()->id,
                'jabatan_id' => $jabatan_id
            ]);
        }

        return redirect()->route('anjab.ajuan.index')->with('success', 'Ajuan Jabatan berhasil diajukan');
    }
}
