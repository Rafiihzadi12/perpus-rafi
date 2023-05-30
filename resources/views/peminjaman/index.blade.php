@extends('layouts.main')

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h2 class="card-title">Data Peminjaman</h2>
</div>

    <div class="row" style="margin-top: 1rem;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card-body">
        <div style="margin-bottom: 20px">
            <a href="{{ url('create-peminjaman') }}" class="btn btn-primary btn-flat">
                <i class="fa fa-plus-circle"></i> Tambah Data
            </a>
            <a href="{{ url('pdf-peminjaman') }}" class="btn btn-danger btn-flat" target="_blank">
                <i class="fa fa-file-pdf"></i> Export PDF
            </a>
            <a href="{{ url('export-peminjaman') }}" class="btn btn-success btn-flat" target="_blank">
                <i class="fa fa-file-excel"></i> Export Excel
            </a>
        </div>
        <div style="overflow: auto">
            <table class="table table-bordered table-condensed">
                <tr>
                    <th style="text-align:center;">No</th>
                    <th style="text-align:center;">Nama Buku</th>
                    <th style="text-align:center;">Nama Anggota</th>
                    <th style="text-align:center;">Tanggal Pinjam</th>
                    <th style="text-align:center;">Tanggal Kembali</th>
                    <th style="text-align:center">Denda</th>
                    <th style="text-align:center">Status</th>
                    <th width="250px" style="text-align: center;">Opsi</th>
                </tr>
                @foreach($peminjaman as $data)
                <tr>
                <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td style="text-align:center">{{ @$data->buku->nama}}</td>
                    <td style="text-align:center">{{ @$data->anggota->nama}}</td>
                    <td style="text-align:center" style="text_align:center">{{ $data->tanggal_pinjam }}</td>
                    <td style="text-align:center">{{ $data->tanggal_kembali }}</td>
                    <td style="text-align:center">{{ $data->denda }}</td>
                    <td style="text-align:center">{{ @$data->statuspeminjaman->nama }}</td>
                    <td style="text-align:center">

                    <form action="{{ route('peminjaman.destroy', $data->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                             <a class="btn btn-info" href="{{ route('peminjaman.show',$data->id) }}">Show</a>
                             <a class="btn btn-primary" href="{{ route('peminjaman.edit',$data->id) }}">Edit</a>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection