@extends('layouts.main')

@section('content')

<div class="card card-primary">
    <div class="card-header">
        <h2 class="card-title">Create Data Kategori</h2>
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

    <form action="{{ url('/store-kategori') }}" method="post" enctype="multipart/form-data">

        @csrf

     <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nama </strong>
                <input type="text" name="nama" class="form-control" placeholder="" autofocus>
            </div>
        </div>
        </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
              <button type="submit" class="btn btn-primary">Simpan</button>

              <a href="{{ url('/index') }}" class="btn btn-warning">Kembali</a>
          </div>

</form>
</div>
@endsection