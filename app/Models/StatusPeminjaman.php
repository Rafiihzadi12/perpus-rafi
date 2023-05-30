<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Buku;

class StatusPeminjaman extends Model
{
   
    protected $table = "status_peminjaman";
    protected $primaryKey = "id";
    protected $fillable = [
        'id', 'nama',
    ];
}