@extends('layouts.main')

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h2 class="card-title">Data Anggota</h2>
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
            <a href="{{ route('anggota.create')}}" class="btn btn-primary btn-flat">
                <i class="fa fa-plus-circle"></i> Tambah Data
            </a>
            <a href="{{ url('pdf-anggota') }}" class="btn btn-danger btn-flat" target="_blank">
                <i class="fa fa-file-pdf"></i> Export PDF
            </a>
            <a href="{{ url('export-anggota') }}" class="btn btn-success btn-flat" target="_blank">
                <i class="fa fa-file-excel"></i> Export Excel
            </a>
        </div>
        <div style="overflow: auto">
            <table class="table table-bordered table-condensed">
                <tr>
                    <th style="text-align:center;">No</th>
                    <th style="text-align:center;">Nama Anggota</th>
                    <th style="text-align:center;">Alamat</th>
                    <th style="text-align:center;">No.Telepon</th>
                    <th style="text-align:center;">Email</th>
                    <th style="text-align:center">Opsi</th>
                    
                </tr>
                @foreach($anggota as $data)
                <tr>
                    <td style="text-align:center">{{ $loop->iteration }}</td>
                    <td style="text-align:center">{{ @$data->nama }}</td>
                    <td style="text-align:center">{{ $data->alamat }}</td>
                    <td style="text-align:center" style="text-align:center">{{ $data->telepon }}</td>
                    <td style="text-align:center">{{ $data->email }}</td>
                    <td style="text-align:center">
                   
                        
                    <form action="{{ route('anggota.destroy', $data->id) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                             <a class="btn btn-info" href="{{ route('anggota.show',$data->id) }}">Show</a>
                             <a class="btn btn-primary" href="{{ route('anggota.edit',$data->id) }}">Edit</a>
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