<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penerbit;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Exports\PenerbitExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;


class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penerbit = Penerbit::all();

        return view('penerbit.index',['penerbit'=>$penerbit]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penerbit.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $penerbit = new Penerbit;
        $penerbit->nama = $request->nama;
        $penerbit->alamat = $request->alamat;
        $penerbit->telepon = $request->telepon;
        $penerbit->email = $request->email;
        $penerbit->save();

        
        return redirect()->route('penerbit.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        
        return view('penerbit.show', ['penerbit' => $penerbit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $penerbit = Penerbit::find($id);
        return view('penerbit.edit', compact('penerbit'));
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

        Penerbit::find($id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
            'email' => $request->email,
        ]);
        

        return redirect()->route('penerbit.index')->with('success', 'Data berhasil diubah.');   
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penerbit = Penerbit::find($id);
        $penerbit->delete();

        return redirect()->route('penerbit.index')->with('success','Penerbit berhasil dihapus');
    }
    
    public function pdf()
    {
        $penerbit = Penerbit::get();
 
        $pdf = PDF::loadview('penerbit.penerbit-pdf',['penerbit'=>$penerbit]);

        return $pdf->stream();
    }
    public function exportExcel()
    {
        return Excel::download(new PenerbitExport,'penerbit.xlsx');

        $data = Penerbit::all();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellvalue('Al', 'Data Penerbit');

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
