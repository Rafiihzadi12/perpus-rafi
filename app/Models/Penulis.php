<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Penulis extends Model
{
   
    protected $table = "penulis";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama', 'alamat', 'telepon', 'email'
    ];

    public function book()
    {
        return $this->hasMany('book::class');
    }

    public function getJumlahBuku()
    {
        $query = Buku::query();

        $query->where('id_penulis', '=', $this->id);

        return $query->count();
    }

    public function getListBuku()
    {
        $buku = Buku::where('id_penulis', '=', $this->id)->get();

        return $buku;
    
    }
}