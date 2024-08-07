@extends('layouts.main')

@section('container')
    <div class="">
        @if (Route::currentRouteName() == 'anjab.jabatan.edit.1')
            {{ Breadcrumbs::render('isi-informasi-umum', $jabatan) }}
        @else
            {{ Breadcrumbs::render('edit-ajuan-anjab-jabatan', $ajuan, $jabatan) }}
        @endif
    </div>
    <div class="mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Ubah Informasi Jabatan | {{ $jabatan->nama }}</h1>
    </div>
    <div class="card dropdown-divider mb-4"></div>
    <div class="mb-3">
        {{-- <a href="{{ Route::currentRouteName() == "anjab.ajuan.jabatan.edit" ? route('anjab.ajuan.edit', ['ajuan' => $ajuan]) : route('anjab.ajuan.create') }}"
            class="btn btn-sm btn-secondary align-baseline"><i data-feather="chevron-left"></i>Kembali
        </a> --}}
        <a href="
        @if (Route::currentRouteName() == "anjab.ajuan.jabatan.edit.1")
            {{ route('anjab.ajuan.edit', ['tahun' => $ajuan->tahun, 'id' => $ajuan->id]) }}
        @else
            {{ route('anjab.ajuan.create') }}
        @endif"
            class="btn btn-sm btn-secondary align-baseline"><i data-feather="chevron-left"></i>Kembali
        </a>
    </div>
    <div class="alert alert-info alert-dismissible fade show">
        <div class="alert-heading d-flex justify-content-between">
            <div class="d-flex">
                <img width="20px" data-feather="info" class="m-0 p-0 me-2"></img>
                <p class="m-0 p-0">Perhatian</p>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <hr>
        <p class="m-0 p-0">Silahkan Isi Nama Jabatan, Jenis Jabatan, dan Ikhtisar Jabatan dengan informasi yang benar.</p>
    </div>
    <form {{-- If this page is from edit jabatan inside an ajuan, action should be update inside ajuan --}} {{-- If this page is from edit jabatan before submitting ajuan, action for update should be different --}}
        action="
    @if (Route::currentRouteName() == 'anjab.jabatan.edit.1') {{ route('anjab.jabatan.update.1', ['jabatan' => $jabatan]) }}
    @elseif (Route::currentRouteName() == 'anjab.ajuan.jabatan.edit.1')
        {{ route('anjab.ajuan.jabatan.update.1', ['jabatan' => $jabatan, 'ajuan' => $ajuan]) }} @endif"
        method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" id="nama" class="form-label">Nama Jabatan</label>
            <input type="text" class="form-control" id="nama" value="{{ $jabatan->nama ?? '' }}" disabled>
        </div>
        <div class="mb-3">
            <label for="jenis_jabatan" class="form-label">Jenis Jabatan</label>
            <select class="form-select" name="jenis_jabatan_id" id="jenis_jabatan">
                @foreach ($jenis_jabatan as $jenis)
                    <option value="{{ $jenis->id }}" @selected($jabatan->jenisJabatan->id ?? '' == $jenis->id)>
                        {{ $jenis->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="ikhtisar" class="form-label">Ikhtisar Jabatan</label>
            <textarea name="ikhtisar" class="form-control" placeholder="Masukkan Ikhtisar" id="ikhtisar" style="height:100px">{{ $jabatan->ikhtisar ?? '' }}</textarea>
        </div>
        <div class="mb-3">
            <label for="prestasi" class="form-label text-capitalize">prestasi</label>
            <input name="prestasi" type="text" class="form-control " id="prestasi" value="{{ $jabatan->prestasi }}">
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn header1 btn-primary"><i data-feather="save"></i> Simpan dan Lanjutkan</button>
        </div>
    </form>
@endsection
