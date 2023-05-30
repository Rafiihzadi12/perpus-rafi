<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Exports\AnggotaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = Anggota::all();

        return view('anggota.index',['anggota'=>$anggota]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anggota = Anggota::all();

        return view('anggota.create',compact('anggota'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $anggota = new Anggota;
        $anggota->nama = $request->nama;
        $anggota->alamat = $request->alamat;
        $anggota->telepon = $request->telepon;
        $anggota->email = $request->email;
        $anggota->save();

        return redirect()->route('anggota.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anggota = Anggota::findOrFail($id);
        
        return view('anggota.show', ['anggota' => $anggota]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $anggota = Anggota::find($id);
        return view('anggota.edit', compact('anggota'));
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

        Anggota::find($id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email
        ]);

         return redirect()->route('anggota.index')->with('success', 'Data berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anggota = Anggota::find($id);
        $anggota->delete();

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus!');

    }

    public function pdf()
    {
        $anggota = Anggota::get();
 
        $pdf = PDF::loadview('anggota.anggota-pdf',['anggota'=>$anggota]);

        return $pdf->stream();
    }
    public function exportExcel()
    {
        return Excel::download(new AnggotaExport,'anggota.xlsx');

        $data = Anggota::all();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellvalue('Al', 'Data Anggota');

        $sheet->setCellvalue('A3', 'No');
        $sheet->setCellvalue('B3', 'Nama Anggota');
        $sheet->setCellvalue('C3', 'Alamat');
        $sheet->setCellvalue('D3', 'No.Telepon');
        $sheet->setCellvalue('F3', 'Email');
        $sheet->setCellvalue('G3', 'Opsi');

        $row = 2;
        $i = 1;
        foreach($data as $anggota){
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $anggota->nama);
            $sheet->setCellValue('B' . $row, $anggota->Alamat);
        }

        $path = '../files/';
        $filename = time() . '_Export_Data_Anggota.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($path . $filename);
        return $writer;
    }
}

