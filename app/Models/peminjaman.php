<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\StatusPeminjaman;

class Peminjaman extends Model
{
   
    protected $table = "peminjaman";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_buku ', 'id_anggota ', 'tanggal_pinjam', 'tanggal_kembali',"denda","id_status_peminjaman","id_updated","id_created","delete_at"
    ];
    
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku', 'id');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class,'id_anggota','id');
    }

    public function statuspeminjaman()
    {
        return $this->belongsTo(StatusPeminjaman::class,'id_status_peminjaman','id');
    }


}