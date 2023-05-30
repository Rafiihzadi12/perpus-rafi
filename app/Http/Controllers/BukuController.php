<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Penerbit;
use App\Models\Penulis;
use App\Models\Kategori;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Exports\BukuExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::all();

        $book = Buku::with('penulis', 'penerbit', 'kategori')->paginate(10);

        return view ('buku.index',['buku'=>$buku]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $penulis = Penulis::all();

        $penerbit = Penerbit::all();

        $kategori = Kategori::all();

        return view('buku.create', compact('penulis', 'penerbit', 'kategori'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'tahun_terbit' => 'required',
            'id_penulis' => 'required',
            'id_penerbit' => 'required',
            'id_kategori' => 'required',
            'sinopsis' => 'required',
            'sampul' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);

        $input = $request->all();

        if($sampul = $request->file('sampul')){
            $destinationPath = 'image/';
            $profileImage = date('YmdHis') . "." . $sampul->getClientOriginalExtension();
            $sampul->move($destinationPath, $profileImage);
            $input['sampul'] = "$profileImage";
        }
        
        Buku::create($input);

        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $buku = Buku::findOrFail($id);

        return view('buku.show', ['buku' => $buku]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::find($id);
        $penulis = Penulis::all();
        $penerbit = Penerbit::all();
        $kategori = Kategori::all();

        return view('buku.edit', compact('penulis', 'buku', 'penerbit', 'kategori'));
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
        Buku::find($id)->update([
            'nama' => $request->nama,
            'tahun_terbit' => $request->tahun_terbit,
            'id_penulis' => $request->id_penulis,
            'id_penerbit' => $request->id_penerbit,
            'id_kategori' => $request->id_kategori,
            'sinopsis' => $request->sinopsis,
            'sampul' => $request->sampul,
        ]);

        
    return redirect()->route('buku.index')->with('success', 'Data berhasil dubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus!');
    }

    public function pdf()
    {
        $buku = Buku::get();
 
        $pdf = PDF::loadview('buku.buku-pdf',['buku'=>$buku]);

        return $pdf->stream();
    }

    public function exportExcel()
    {
		return Excel::download(new BukuExport, 'buku.xlsx');
	

        $data = Buku::all();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Data Buku');

        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Judul Buku');
        $sheet->setCellValue('C3', 'Tahun Terbit');
        $sheet->setCellValue('D3', 'Penulis');
        $sheet->setCellValue('E3', 'Penerbit');
        $sheet->setCellValue('F3', 'Kategori');
        $sheet->setCellValue('G3', 'sinopsis');
        $sheet->setCellValue('H3', 'sampul');


        $row = 2;
        $i = 1;
        foreach($data as $buku){
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $buku->nama);
            $sheet->setCellValue('B' . $row, $buku->tahun_terbit);
        }

        $path = '../files/';
        $filename = time() . '_Export_Data_Buku.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($path . $filename);
        return $writer;
	}
}

