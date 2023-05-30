@extends('layouts.main')

@section('content')


<div class="card card-primary">
    <div class="card-header">
        <h2 class="card-title">Tambah Buku</h2>
    </div>
    
    <div class="card-body">
      <form action="{{url('/store-buku')}}" method="POST" enctype="multipart/form-data">
        @csrf

       <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Judul Buku:</strong>
                  <input type="text" name="nama" class="form-control" placeholder="" autofocus>
              </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Tahun Terbit:</strong>
                  <input type="text" name="tahun_terbit" class="form-control" placeholder="">
              </div>
          </div>
          <div class="col-xs-12 col-sm-6 col-md-12">
                <div class="form-group">
                  <strong>Penulis:</strong>
                </div>
                <div class="form-group" style="height: auto;">
                    <select class="js-example-basic-single" style="width: 100%;" name="id_penulis" id="id_penulis">
                    @foreach($penulis as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                    </select>
                </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Penerbit:</strong>
                </div>
                <div class="form-group" style="height: auto;">
                    <select class="js-example-basic-single" style="width: 100%;" name="id_penerbit" id="id_penerbit">
                    @foreach($penerbit as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                    </select>
                </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="form-group">
                  <strong>Kategori:</strong>
                </div>
                <div class="form-group" style="height: auto;">
                    <select class="js-example-basic-single" style="width: 100%;" name="id_kategori" id="id_kategori">
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                    @endforeach
                    </select>
                </div>          
            </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Sinopsis:</strong>
              <textarea class="form-control" style="height:150px" name="sinopsis" placeholder=""></textarea>
          </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
              <strong>Sampul:</strong>
              <input type="file" name="sampul" class="form-control" placeholder="image">
          </div>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-12">
              <button type="submit" class="btn btn-primary">Simpan</button>
              <a href="{{url('/index')}}" class="btn btn-warning">Kembali</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


@endsection