@extends('layouts.main')

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h2 class="card-title">Data Buku</h2>
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
            <a href="{{ url('/create-buku')}}" class="btn btn-primary btn-flat">
                <i class="fa fa-plus-circle"></i> Tambah Data
            </a>
            <a href="{{ url('pdf-buku') }}" class="btn btn-danger btn-flat" target="_blank">
                <i class="fa fa-file-pdf"></i> Export PDF
            </a>
            <a href="{{ url('export-buku') }}" class="btn btn-success btn-flat" target="_blank">
                <i class="fa fa-file-excel"></i> Export Excel
            </a>
        </div>
        <div style="overflow: auto">
            <table class="table table-bordered table-condensed">
                <tr>
                    <th style="text-align:center;">No</th>
                    <th style="text-align:center;">Judul Buku</th>
                    <th style="text-align:center;">Tahun Terbit</th>
                    <th style="text-align:center;">Penulis</th>
                    <th style="text-align:center;">Penerbit</th>
                    <th style="text-align:center">Kategori</th>
                    <th width="200px" style="text-align: center;">Sinopsis</th>
                    <th style="text-align:center;">Sampul</th>
                    <th width="250px" style="text-align: center;">Action</th>
                </tr>
                @foreach($buku as $data)
                <tr>
                <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td style="text-align:center">{{ $data->nama }}</td>
                    <td style="text-align:center">{{ @$data->tahun_terbit }}</td>
                    <td style="text-align:center">{{ @$data->penulis->nama }}</td>
                    <td style="text-align:center">{{ @$data->penerbit->nama }}</td>
                    <td style="text-align:center">{{ @$data->kategori->nama }}</td>
                    <td style="text-align:center">{{ $data->sinopsis }}</td>
                    <td style="text-align:center"><img src="{{ asset('image/'.$data->sampul) }}" width="89px"></td>
                <td style="text-align:center">

                <form action="{{ route('buku.destroy', $data->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                             <a class="btn btn-info" href="{{ route('buku.show',$data->id) }}">Show</a>
                             <a class="btn btn-primary" href="{{ route('buku.edit',$data->id) }}">Edit</a>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                
                @endforeach
                </tr>
                
            </table>
            
        </div>
    </div>
</div>
@endsection