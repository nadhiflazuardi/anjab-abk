@extends('layouts.main')

@section('container')
    <div class="mb-3">
        {{ Breadcrumbs::render('laporan-anjab', $anjab) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 d-inline nav-item">Laporan Hasil Anjab {{ $anjab->tahun }}</h1>                
    </div>
    <hr>
    <div class="">
        <a href="{{ route('laporan.index') }}" class="mb-3 btn btn-primary header1"><i data-feather="arrow-left"></i> Kembali</a>
    </div>
    <div class="mb-3 btn-group">
        <a target="_blank" href="{{ route('laporan.anjab.laporan', ['anjab' => $anjab, 'tahun' => $anjab->tahun]) }}" class="btn btn-outline-primary">Lihat Laporan Lengkap</a>
        {{-- <a target="_blank" href="{{ route('laporan.anjab.download', ['anjab' => $anjab, 'tahun' => $anjab->tahun]) }}" class="btn btn-outline-primary">Unduh Laporan Lengkap</a> --}}
    </div>
    <div class="mb-3">
        {{-- <livewire:laporan-anjab-jabatan :jabatans="$jabatans"/> --}}
        <livewire:laporan-anjab :jabatans="$jabatans"/>
    </div>
@endsection