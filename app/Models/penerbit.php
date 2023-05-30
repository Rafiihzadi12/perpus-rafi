<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class Penerbit extends Model
{
   
    protected $table = "penerbit";
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

        $query->where('id_penerbit', '=', $this->id);

        return $query->count();
    }
     public function getListBuku()
    {
        $buku = Buku::where('id_penerbit', '=', $this->id)->get();

        return $buku;
    
    }
}
