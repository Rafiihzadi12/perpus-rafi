<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Penulis;
use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $query =  Buku::query();
        $buku =  $query->count();
        
        return view('dashboard.index', [
            'title' => 'Form login',
            'buku' => $buku,
       ]);
    }

    public function getChartPenerbit()
    {
        $chartData = Penerbit::all();   
        $formattedData = [];
        foreach ($chartData as $data) {
           $bukuCount = Buku::where('id_penerbit', $data->id)->count();
           $formattedData[] = [
               'name' => $data->nama,
               'y' => $bukuCount,
           ];
       }
        return response()->json($formattedData);
    }
    
    public function getChartPenulis()
    {
        $chartData = Penulis::all();   
        $formattedData = [];
        foreach ($chartData as $data) {
           $bukuCount = Buku::where('id_penulis', $data->id)->count();
           $formattedData[] = [
               'name' => $data->nama,
               'y' => $bukuCount,
           ];
       }
        return response()->json($formattedData);
    }


    public function getChartKategori()
    {
        $chartData = Kategori::all();   
        $formattedData = [];
        foreach ($chartData as $data) {
           $bukuCount = Buku::where('id_kategori', $data->id)->count();
           $formattedData[] = [
               'name' => $data->nama,
               'y' => $bukuCount,
           ];
       }
        return response()->json($formattedData);
    }
}
