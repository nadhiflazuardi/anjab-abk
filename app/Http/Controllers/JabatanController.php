<?php

namespace App\Http\Controllers;

use App\Models\BakatKerja;
use App\Models\Jabatan;
use App\Models\KondisiLingkunganKerja;
use App\Models\MinatKerja;
use App\Models\SyaratBakat;
use App\Models\SyaratFungsi;
use App\Models\SyaratJabatan;
use App\Models\SyaratMinat;
use App\Models\SyaratTemperamen;
use App\Models\SyaratUpaya;
use App\Models\UnitKerja;
use App\Models\UpayaFisik;
use App\Models\JenisJabatan;
use Illuminate\Http\Request;
use App\Models\FungsiPekerjaan;
use App\Models\TemperamenKerja;
use App\Http\Requests\CreateJabatanRequest;
use App\Models\Ajuan;
use App\Models\JabatanDiajukan;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\Support\Facades\Route;

class JabatanController extends Controller
{
  public function index()
  {
    $title = 'Data Jabatan';
    $jabatans = Jabatan::all();
    $jenisJabatan = JenisJabatan::all();
    $unitKerjas = UnitKerja::all();
    $buttons = ['tambah-jabatan-bawahan', 'ubah-informasi-jabatan'];

    return view('anjab.jabatan', compact('title', 'jabatans', 'jenisJabatan', 'unitKerjas', 'buttons'));
  }

  public function show(Ajuan $ajuan, Jabatan $jabatan)
  { {
      return view('anjab.jabatan.show', [
        'title' => 'Form Informasi Jabatan',
        'ajuan' => $ajuan,
        'jabatan' => $jabatan,
        'bakat_kerjas' => BakatKerja::all(),
        'unit_kerjas' => UnitKerja::all(),
        'jenis_jabatan' => JenisJabatan::all(),
        'temperamens' => TemperamenKerja::all(),
        'upaya_fisiks' => UpayaFisik::all(),
        'fungsi_pekerjaans' => FungsiPekerjaan::all()
      ]);
    }
  }

  public function store(CreateJabatanRequest $request)
  {
    $validatedData = $request->validated();

    Jabatan::create($validatedData);


    return back()->with('success', 'Data Jabatan berhasil Ditambahkan');
  }

  public function edit(JabatanDiajukan $jabatan)
  {
    $title = 'Form Informasi Jabatan';
    $bakat_kerjas = BakatKerja::all();
    $unit_kerjas = UnitKerja::all();
    $jenis_jabatan = JenisJabatan::all();
    $temperamens = TemperamenKerja::all();
    $upaya_fisiks = UpayaFisik::all();
    $fungsi_pekerjaans = FungsiPekerjaan::all();

    return view('anjab.jabatan.edit', compact(
      'title',
      'jabatan',
      'bakat_kerjas',
      'unit_kerjas',
      'jenis_jabatan',
      'temperamens',
      'upaya_fisiks',
      'fungsi_pekerjaans'
    ));
  }

  public function edit1(JabatanDiajukan $jabatan)
  {
    $title = 'Form Informasi Jabatan';
    $bakat_kerjas = BakatKerja::all();
    $unit_kerjas = UnitKerja::all();
    $jenis_jabatan = JenisJabatan::all();
    $temperamens = TemperamenKerja::all();
    $upaya_fisiks = UpayaFisik::all();
    $fungsi_pekerjaans = FungsiPekerjaan::all();

    return view('anjab.jabatan.edit.step-1', compact(
      'title',
      'jabatan',
      'bakat_kerjas',
      'unit_kerjas',
      'jenis_jabatan',
      'temperamens',
      'upaya_fisiks',
      'fungsi_pekerjaans'
    ));
  }

  public function update1(Request $request, JabatanDiajukan $jabatan)
  {
    $jabatan->update($request->all());

    return redirect()->route('anjab.jabatan.edit.2', ['jabatan' => $jabatan])->with('success', 'Data Jabatan berhasil Diubah');
  }

  public function edit2(JabatanDiajukan $jabatan)
  {
    $title = 'Form Informasi Jabatan';
    $jabatans = JabatanDiajukan::orderBy('nama')->get();
    $bakatKerja = BakatKerja::all();
    $unitKerja = UnitKerja::all();
    $jenisJabatan = JenisJabatan::all();
    $temperamen = TemperamenKerja::all();
    $upayaFisik = UpayaFisik::all();
    $fungsiPekerjaan = FungsiPekerjaan::all();
    $minatKerja = MinatKerja::all();


    // get necessary data for checkboxes
    // checkboxes are checked if the data is found in the database
    $checkedBakatKerja = SyaratBakat::where('syarat_jabatan_id', $jabatan->syaratJabatan->id)->get()->pluck('bakat_kerja_id')->toArray();
    $checkedTemperamenKerja = SyaratTemperamen::where('syarat_jabatan_id', $jabatan->syaratJabatan->id)->get()->pluck('temperamen_kerja_id')->toArray();
    $checkedMinatKerja = SyaratMinat::where('syarat_jabatan_id', $jabatan->syaratJabatan->id)->get()->pluck('minat_kerja_id')->toArray();
    $checkedUpayaFisik = SyaratUpaya::where('syarat_jabatan_id', $jabatan->syaratJabatan->id)->get()->pluck('upaya_fisik_id')->toArray();
    $checkedFungsiPekerjaan = SyaratFungsi::where('syarat_jabatan_id', $jabatan->syaratJabatan->id)->get()->pluck('fungsi_pekerjaan_id')->toArray();

    return view('anjab/jabatan/edit/step-2', compact(
      'title',
      'jabatans',
      'jabatan',
      'bakatKerja',
      'unitKerja',
      'jenisJabatan',
      'temperamen',
      'upayaFisik',
      'fungsiPekerjaan',
      'minatKerja',
      'checkedBakatKerja',
      'checkedTemperamenKerja',
      'checkedMinatKerja',
      'checkedUpayaFisik',
      'checkedFungsiPekerjaan'
    ));
  }

  public function update2(Request $request, JabatanDiajukan $jabatan)
  {
    // loop through $request->input('kondisiLingkunganKerja') and put them all inside $kondisi
    $kondisi = [];
    foreach ($request->input('kondisiLingkunganKerja') as $key => $value) {
      $kondisi[$key] = $value;
    }
    $kondisiLingkunganKerja = KondisiLingkunganKerja::where('jabatan_id', $jabatan->id)->first();
    $kondisiLingkunganKerja->update($kondisi);

    $syaratJabatan = SyaratJabatan::where('jabatan_id', $jabatan->id)->first();
    $syaratJabatan->update($request->all());

    // UPDATING SYARAT BAKAT
    // delete SyaratBakat instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('bakatKerja') and create new SyaratBakat instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    SyaratBakat::where('syarat_jabatan_id', $syaratJabatan->id)->delete();
    $bakatKerja = $request->input('bakatKerja');
    if ($bakatKerja) {
      foreach ($bakatKerja as $bakatKerjaId) {
        SyaratBakat::create([
          'syarat_jabatan_id' => $syaratJabatan->id,
          'bakat_kerja_id' => $bakatKerjaId
        ]);
      }
    }

    // UPDATING SYARAT TEMPERAMEN
    // delete SyaratTemperamen instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('temperamenKerja') and create new SyaratTemperamen instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    SyaratTemperamen::where('syarat_jabatan_id', $syaratJabatan->id)->delete();
    $temperamenKerja = $request->input('temperamenKerja');
    if ($temperamenKerja) {
      foreach ($temperamenKerja as $temperamenKerjaId) {
        SyaratTemperamen::create([
          'syarat_jabatan_id' => $syaratJabatan->id,
          'temperamen_kerja_id' => $temperamenKerjaId
        ]);
      }
    }

    // UPDATING SYARAT MINAT
    // delete MinatKerja instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('minatKerja') and create new MinatKerja instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    SyaratMinat::where('syarat_jabatan_id', $syaratJabatan->id)->delete();
    $minatKerja = $request->input('minatKerja');
    if ($minatKerja) {
      foreach ($minatKerja as $minatKerjaId) {
        SyaratMinat::create([
          'syarat_jabatan_id' => $syaratJabatan->id,
          'minat_kerja_id' => $minatKerjaId
        ]);
      }
    }

    // UPDATING SYARAT UPAYA
    // delete UpayaFisik instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('upayaFisik') and create new UpayaFisik instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    SyaratUpaya::where('syarat_jabatan_id', $syaratJabatan->id)->delete();
    $upayaFisik = $request->input('upayaFisik');
    if ($upayaFisik) {
      foreach ($upayaFisik as $upayaFisikId) {
        SyaratUpaya::create([
          'syarat_jabatan_id' => $syaratJabatan->id,
          'upaya_fisik_id' => $upayaFisikId
        ]);
      }
    }

    // UPDATING SYARAT FUNGSI
    // delete FungsiPekerjaan instances with syarat_jabatan_id = $syaratJabatan->id
    // loop through $request->input('fungsiPekerjaan') and create new FungsiPekerjaan instances
    // this is done so that when user uncheck an input, the data is deleted from the database
    SyaratFungsi::where('syarat_jabatan_id', $syaratJabatan->id)->delete();
    $fungsiPekerjaan = $request->input('fungsiPekerjaan');
    if ($fungsiPekerjaan) {
      foreach ($fungsiPekerjaan as $fungsiPekerjaanId) {
        SyaratFungsi::create([
          'syarat_jabatan_id' => $syaratJabatan->id,
          'fungsi_pekerjaan_id' => $fungsiPekerjaanId
        ]);
      }
    }

    // return redirect()->route('anjab.ajuan.create')->with('success', 'Data Jabatan berhasil Diubah');
    return redirect(route('anjab.ajuan.create'))->with('success', 'Data Jabatan '. $jabatan->nama .' berhasil Diubah');
  }
}
