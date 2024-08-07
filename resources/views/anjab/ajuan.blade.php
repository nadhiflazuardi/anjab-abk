@extends('layouts.main')

@section('container')
    <div class="mb-3">
        {{ Breadcrumbs::render('lihat-ajuan-anjab',$ajuan) }}
    </div>
    <div class="card-head mb-3">
        <h1 class="fw-light fs-4 ">Ajuan Analisis Jabatan Periode {{ $ajuan->tahun }}</h1>
    </div>
    <div class="card dropdown-divider mb-4"></div>
    {{-- <div class="mb-3">
        <label for="unit_kerja" class="form-label">Unit Kerja</label>
        <select class="form-select" id="unit_kerja" name="unit_kerja">
            
            <option value="Bidang Kepegawaian">Bidang Kepegawaian</option>
            <option value="Bidang Keuangan">Bidang Keuangan</option>
            <option value="Bidang Teknologi Informasi">Bidang Teknologi Informasi</option>
            <option value="Bidang Pengembangan Sumber Daya Manusia">Bidang Pengembangan Sumber Daya Manusia</option>
        </select>
    </div> --}}

    {{-- <table class="table table-striped table-bordered col-8">
        <thead>
            <th class="fw-semibold text-muted">No</th>
            <th class="fw-semibold text-muted">Unit Kerja/Lembaga/Sekolah</th>
            <th class="fw-semibold text-muted">Status</th>
            <th class="fw-semibold text-muted">Catatan Perbaikan</th>
        </thead>
        <tbody>
            @foreach ($unit_kerjas as $unit_kerja)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="">
                        <div class="d-flex justify-content-between">
                            <p>{{ $unit_kerja->nama }}</p>
                            <a href="{{ route('anjab.unitkerja.show', ['id' => request()->periode, 'unitkerja' => $unit_kerja->id]) }}"
                                class="btn btn-outline-primary">Lihat</a>
                        </div>
                    </td>
                    <td class="w-25">
                        <div class="alert alert-success w-100">
                            <div class="alert-heading d-flex">
                                <img width="20px" data-feather="check-circle" class="m-0 p-0 me-2"></img>
                                <p class="m-0 p-0">Disetujui</p>
                            </div>
                            <hr>
                            <p class="m-0 p-0">Manajer Kepegawaian</p>
                        </div>
                        <div class="alert alert-info w-100">
                            <div class="alert-heading d-flex">
                                <img width="20px" data-feather="clock" class="m-0 p-0 me-2"></img>
                                <p class="m-0 p-0">Menunggu Diperiksa</p>
                            </div>
                            <hr>
                            <p class="m-0 p-0">Kepala Biro</p>
                        </div>
                        <div class="alert alert-warning w-100">
                            <div class="alert-heading d-flex">
                                <img width="20px" data-feather="alert-triangle" class="m-0 p-0 me-2"></img>
                                <p class="m-0 p-0">Perlu Perbaikan</p>
                            </div>
                            <hr>
                            <p class="m-0 p-0">Kepala Biro</p>
                        </div>
                    </td>
                    <td>
                        <ul>
                            <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos, nisi.</li>
                            <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos, nisi.</li>
                            <li>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quos, nisi.</li>
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
    <table class="table table-striped table-bordered">
            <thead >
                <th class="fw-semibold text-muted">Kode</th>
                <th class="fw-semibold text-muted">Jabatan</th>
            </thead>
            <tbody>
                @foreach ($jabatans as $jabatan)
                    <tr>
                        <td>K - 123</td>
                        <td class="d-flex justify-content-between">
                            <p class="" href="/anjab/analisis-jabatan/create" style="">{{ $jabatan->nama }}</p>
                            <div class="div">
                                <a href="{{ route('anjab.ajuan.jabatan.show', ['ajuan' => $ajuan,'jabatan'=> $jabatan->id]) }}" class="btn btn-sm btn-primary ms-auto add-button"><img width="20px" data-feather="eye"></img> Lihat Informasi Jabatan</a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                    
            </tbody>
    </table>
    <a href="{{ route('anjab.ajuan.index') }}" class="btn btn-primary header1"><i data-feather="arrow-left"></i> Kembali</a>
@endsection
