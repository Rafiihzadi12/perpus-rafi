@extends('layouts.main')

@section('content')
   <div class="card card-primary">
    <div class="card-header">
        <h2 class="card-title">Edit Data Anggota</h2>
    </div>

@if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-body">
    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Anggota:</strong>
                <input type="text" name="nama" class="form-control" value="{{ $anggota->nama }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Alamat</strong>
                <input type="text" name="alamat" class="form-control" value="{{ $anggota->alamat }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Telepon:</strong>
                <input type="text" name="telepon" class="form-control" value="{{ $anggota->telepon }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="email" class="form-control" value="{{ $anggota->telepon }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Jumlah Buku:</strong>
                <input type="text" name="jumlah buku" class="form-control" value="{{ $anggota->email }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('anggota.index') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>

</form>
@endsection