@extends('templates.main')

@section('container')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    @if (auth()->user()->level == 'operator')
    <li class="breadcrumb-item"><a href="/entryProgress">Entry Progress Studi</a></li>
    @endif
    <li class="breadcrumb-item active text-white" aria-current="page">IRS</li>
  </ol>
</nav>

@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if (auth()->user()->level == 'operator')
<div class="card p-2 ps-3 mb-2 bg-body-tertiary">
  <div>Nama: {{ $mahasiswa->nama }}</div>
  <div>NIM: {{ $mahasiswa->nim }}</div>
</div>
@endif

<div class="card bg-body-tertiary mb-3">
  <div class="row d-flex justify-content-center mt-3">
    <div class="col-auto">
      <h5>Data IRS</h5>
    </div>
  </div>

  <div class="row mx-3">
    <div class="col-auto">
      <p>Semester Aktif : {{ $semester }}</p>
    </div>
    <div class="col-auto  ms-auto">
      <p>SKSk : {{ $SKSk }}</p>
    </div>
  </div>

  @for ($i = 1; $i <= $semester; $i++) <div class="row mx-3 mb-3">
    <div class="col bg-light-subtle rounded border">
      <div class="row ">
        <div class="col-2 border-end py-4 text-center">
          Semester {{ $i }}
        </div>
        <div class="col-3 py-4 text-center ">
          @if (!isset($irs[$i-1]))
          Jumlah SKS: ~
          @else
          Jumlah SKS: {{ $irs[$i-1]->sks }}
          @endif
        </div>

        <div class="col-3 py-4 text-center">

          @if (!isset($irs[$i-1]))
          Scan IRS : <span class="text-danger">belum</span>
          @else
          Scan IRS : <span class="text-success">sudah</span>
          @endif

        </div>

        <div class="col-3 py-4 text-center">

          @if (!isset($irs[$i-1]))
          Validasi : <span class="text-danger">belum</span>
          @else
          @if ($irs[$i-1]->validasi == 0)
          Validasi : <span class="text-danger">belum</span>
          @else
          Validasi : <span class="text-success">sudah</span>
          @endif
          @endif

        </div>

        <div class="col-1 bg-body-secondary text-center py-4">
          @if ($i == 1 || isset($irs[$i-2]))
          @if (!isset($irs[$i-1]))
          <div class="modalIRSButton" type="button" data-bs-toggle="modal" data-bs-target="#modalIRS" data-smt="{{ $i }}">
            <h4 class="m-0">
              <i class="bi bi-pencil-square"></i>
            </h4>
          </div>
          @else
          @if ($irs[$i-1]->validasi == 0)
          <div class="modalIRSButton" type="button" data-bs-toggle="modal" data-bs-target="#modalIRS" data-smt="{{ $i }}" data-scan-irs="{{ $irs[$i-1]->scan_irs }}" data-sks="{{ $irs[$i-1]->sks }}">
            <h4 class="m-0">
              <i class="bi bi-pencil-square"></i>
            </h4>
          </div>
          @else
          <div>
            <h4 class="m-0">
              <i class="bi bi-check-square"></i>
            </h4>
          </div>
          @endif
          @endif
          @else
          <div class="modalAlert" type="button" data-bs-toggle="modal" data-bs-target="#modalAlert">
            <h4 class="m-0">
              <i class="bi bi-pencil-square"></i>
            </h4>
          </div>
          @endif

        </div>
      </div>
    </div>
</div>

@endfor

</div>

@include('mahasiswa.irs.modal_edit_irs')
@include('mahasiswa.irs.modal_alert')
<script src="/js/modal.js"></script>

@endsection