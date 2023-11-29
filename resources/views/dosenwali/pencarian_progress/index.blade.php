@extends('templates.main')

@section('container')

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
    <li class="breadcrumb-item active text-white" aria-current="page">Pencarian Progress Studi Mahasiswa Perwalian</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-4">
    <input type="text" class="form-control" id="keyword" onkeyup="updateTableProgressMHSPerwalian()" placeholder="Cari Nama/NIM" autocomplete="off">
  </div>
  <div class="col-md-4">
    <select name="angkatan" class="form-control" id="angkatan" onchange="updateTableProgressMHSPerwalian()">
      <option value="" selected>Angkatan</option>
      @foreach ($data_angkatan as $angkatan)
      <option value="{{ $angkatan }}">{{ $angkatan }}</option>
      @endforeach
    </select>
  </div>
</div>

<div class="row my-4">
  <div class="col">
    <div class="card bg-body-tertiary">
      <div id="tabelMHS">
        <table class="table table-stripped m-0">
          <tr>
            <th>No</th>
            <th>Nama Mahasiswa</th>
            <th>NIM</th>
            <th>Angkatan</th>
            <th>Status</th>
            <th>Action</th>
          </tr>

          @php
          $i = 0;
          @endphp

          @foreach ($data_mhs as $mhs)
          <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $mhs->nama }}</td>
            <td>{{ $mhs->nim }}</td>
            <td>{{ $mhs->angkatan}}</td>
            <td>{{ $mhs->status}}</td>
            <td>
              <a class="btn btn-secondary btn-sm" href="/pencarianProgressStudiPerwalian/{{ $mhs->nim }}">Detail Progress Studi</a>
            </td>
          </tr>
          @endforeach
        </table>
      </div>

    </div>
  </div>
</div>

<script src="/js/ajax.js"></script>

@endsection