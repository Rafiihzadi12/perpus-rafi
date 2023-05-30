@extends('layouts.main')

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h2 class="card-title">Data Peminjaman</h2>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th style="width: 180px">Buku</th>
                <td>{{ $peminjaman->id_buku }}</td>
            </tr>
            <tr>
                <th style="width: 180px">Anggota</th>
                <td>{{ $peminjaman->id_anggota}}</td>
            </tr>
            <tr>
                <th style="width: 180px">Tanggal Pinjam</th>
                <td>{{ $peminjaman->tanggal_pinjam}}</td>
            </tr>
            <tr>
                <th style="width: 180px">Tanggal Kembali</th>
                <td>{{ $peminjaman->tanggal_kembali}}</td>
            </tr>
            <tr>
                <th style="width: 180px">Denda</th>
                <td>{{ $peminjaman->denda}}</td>
            </tr>
            <tr>
                <th style="width: 180px">Status</th>
                <td>{{ $peminjaman->status}}</td>
            </tr>
        </table>
        <footer class="mt-3">
            <a href="{{ route('buku.index') }}" class="btn btn-primary btn-sm">Kembali</a>
        </footer>
    </div>
</div>
</div>
@endsection