<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Kategori extends Model
{
   
    protected $table = "kategori";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama',
    ];

    public function book()
    {
        return $this->hasMany('book::class');
    }
    
    public function getJumlahBuku()
    {
        $query = Buku::query();

        $query->where('id_kategori', '=', $this->id);

        return $query->count();
    }
    public function getListBuku()
    {
        $buku = Buku::where('id_kategori', '=', $this->id)->get();

        return $buku;
    
    }


}