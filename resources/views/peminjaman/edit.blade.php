@extends('layouts.main')

@section('content')
   <div class="card card-primary">
    <div class="card-header">
        <h2 class="card-title">Edit Data Peminjaman</h2>
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
<form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')

    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Peminjaman:</strong>
                
            </div>
            <div class="form-group">
            <select class="js-example-basic-single" style="width: 100%;" name="id_buku" id="id_buku">
            <option disabled value>Pilih Nama_Peminjaman</option>
                @foreach($buku as $item)
                    <option value="{{ @$item->id }}" @if(old('id_buku') == @$item->id) selected @endif>{{@$item->nama}}</option>
                @endforeach 
                </select>          
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama Anggota:</strong>
                
            </div>
            <div class="form-group">
            <select class="js-example-basic-single" style="width: 100%;" name="id_anggota" id="id_anggota">
            <option disabled value>Pilih Anggota</option>
                @foreach($anggota as $item)
                    <option value="{{ @$item->id }}" @if(old('id_anggota') == @$item->id) selected @endif>{{@$item->nama}}</option>
                @endforeach 
                </select>          
            </div>
        </div>
    </div>
</div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Pinjam:</strong>
                <input type="date" name="tanggal pinjam" class="form-control" value="{{ $peminjaman->tanggal_pinjam }}">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Tanggal Kembali:</strong>
                <input type="date" name="tanggal kembali" class="form-control" value="{{ $peminjaman->tanggal_kembali }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Denda:</strong>
                <input type="text" name="denda" class="form-control" value="{{ $peminjaman->denda }}">
            </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="js-example-basic-single" style="width: 100%;" name="id_status_peminjaman">
                    @foreach($status_peminjaman as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                    </select>
                </div>
          </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('peminjaman.index') }}" class="btn btn-warning">Kembali</a>
    </div>
    <script>

          $(document).ready(function() {            

            $('#date').datepicker({                      

                format: 'yyyy-mm-dd',

                autoclose: true,

            }); 

          });

        </script>
        </div>

</form>
@endsection