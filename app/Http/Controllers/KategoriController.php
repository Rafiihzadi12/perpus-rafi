<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Exports\KategoriExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();

        return view('kategori.index',['kategori'=>$kategori]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $kategori = new Kategori;
        $kategori->nama = $request->nama;
        $kategori->save();

        
        return redirect()->route('kategori.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kategori = Kategori::findOrFail($id);

        return view('kategori.show',['kategori' => $kategori]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('kategori.edit', compact('kategori'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        Kategori::find($id)->update([
            'nama' => $request->nama,
        ]);
        
        
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success','Kategori berhasil dihapus');
    }
    public function pdf()
    {
        $kategori = Kategori::get();
 
        $pdf = PDF::loadview('kategori.kategori-pdf',['kategori'=>$kategori]);

        return $pdf->stream();
    }
    public function exportExcel()
    {
        return Excel::download(new KategoriExport,'kategori.xlsx');

        $data = Kategori::all();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellvalue('Al', 'Data Kategori');

        $sheet->setCellvalue('A3', 'No');
        $sheet->setCellvalue('B3', 'Nama');
        $sheet->setCellvalue('C3', 'Alamat');
        $sheet->setCellvalue('D3', 'No.Telepon');
        $sheet->setCellvalue('F3', 'Email');
        $sheet->setCellvalue('G3', 'Jumlah Buku');
        $sheet->setCellvalue('H3', 'Opsi');

        $row = 2;
        $i = 1;
        foreach($data as $penerbit){
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $penerbit->nama);
            $sheet->setCellValue('B' . $row, $penerbit->Alamat);
        }

        $path = '../files/';
        $filename = time() . '_Export_Data_Penerbit.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($path . $filename);
              return $writer;
}
}
