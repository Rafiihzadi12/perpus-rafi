<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penulis;
use App\Models\Penerbit;
class Buku extends Model
{
   
    protected $table = "buku";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama', 'id_penulis','tahun_terbit','id_penerbit', 'id_kategori', 'sinopsis','sampul','created_at','updated_at','deleted_at',
    ];

    public function penulis()
    {
        return $this->belongsTo(Penulis::class, 'id_penulis', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class, 'id_penerbit', 'id');
    }
}