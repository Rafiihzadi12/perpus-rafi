<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penulis;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Exports\PenulisExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class PenulisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penulis = Penulis::all();

        return view('penulis.index',['penulis'=>$penulis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penulis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $penulis = new Penulis;
        $penulis->nama = $request->nama;
        $penulis->alamat = $request->alamat;
        $penulis->telepon = $request->telepon;
        $penulis->email = $request->email;
        $penulis->save();

        
        return redirect()->route('penulis.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penulis = Penulis::findOrFail($id);
        
        return view('penulis.show', ['penulis' => $penulis]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $penulis = Penulis::find($id);
        return view('penulis.edit', compact('penulis'));
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

        Penulis::find($id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email
        ]);

         return redirect()->route('penulis.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penulis = Penulis::find($id);
        $penulis->delete();

        return redirect()->route('penulis.index')->with('success', 'Penulis berhasil dihapus!');
    }
    public function pdf()
    {
        $penulis = Penulis::get();
 
        $pdf = PDF::loadview('penulis.penulis-pdf',['penulis'=>$penulis]);

        return $pdf->stream();
    }
 
	public function exportExcel()
	{
		return Excel::download(new PenulisExport, 'penulis.xlsx');

        
        $data = Penulis::all();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Data Penulis');

        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Nama');
        $sheet->setCellValue('C3', 'Alamat');
        $sheet->setCellValue('D3', 'No.Telepon');
        $sheet->setCellValue('E3', 'Email');
        $sheet->setCellValue('F3', 'Jumlah Buku');
        $sheet->setCellValue('G3', 'Opsi');

        $row = 2;
        $i = 1;
        foreach($data as $penulis){
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $penulis->nama);
            $sheet->setCellValue('B' . $row, $penulis->Alamat);
        }

        $path = '../files/';
        $filename = time() . '_Export_Data_Penulis.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($path . $filename);
        return $writer;
	
    }
}
