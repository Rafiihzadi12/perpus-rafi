<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
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

        foreach ($chartData as $data){
             $formattedData[] = [
                'name' => $data->name,
                'y' => $data->value,
            ];
        }

        return response()->json($formattedData);
    }
}
