<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\StatusPeminjaman;
use PDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Exports\PeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peminjaman = Peminjaman::all();
        
        $book = Peminjaman::with('buku')->paginate(10);
        
        return view ('peminjaman.index',['peminjaman'=>$peminjaman]);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $buku = Buku::all();

        $status_peminjaman = StatusPeminjaman::all();

        $anggota = Anggota::all();

        return view('peminjaman.create',compact('buku','anggota','status_peminjaman'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $peminjaman = new Peminjaman;
        $peminjaman->id_buku = $request->id_buku;
        $peminjaman->id_anggota = $request->id_anggota;
        $peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
        $peminjaman->tanggal_kembali = $request->tanggal_kembali;
        $peminjaman->denda = $request->denda;
        $peminjaman->id_status_peminjaman = $request->id_status_peminjaman;
        $peminjaman->save();

        return redirect()->route('peminjaman.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        return view('peminjaman.show', ['peminjaman' => $peminjaman]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $peminjaman = Peminjaman::find($id);
        $buku = Buku::all();
        $anggota = Anggota::all();
        $status_peminjaman = StatusPeminjaman::all();

        return view('peminjaman.edit', compact('peminjaman', 'buku', 'anggota','status_peminjaman'));

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
        Peminjaman::find($id)->update([
            'nama buku' => $request->id_buku,
            'nama anggota' => $request->id_anggota,
            'tanggal pinjam' => $request->tanggal_pinjam,
            'tanggal kembali' => $request->tanggal_kembali,
            'denda' => $request->denda,
            'id_status_peminjaman' => $request->id_status_peminjaman,
        ]);
        

        return redirect()->route('peminjaman.index')->with('success', 'Data berhasil diubah.');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $peminjaman = Peminjaman::find($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus!');
    }

    public function pdf()
    {
        $peminjaman = Peminjaman::get();
 
        $pdf = PDF::loadview('peminjaman.peminjaman-pdf',['peminjaman'=>$peminjaman]);

        return $pdf->stream();
    

    }
    public function exportExcel()
    {
        return Excel::download(new PeminjamanExport,'peminjaman.xlsx');

        $data = Peminjaman::all();

        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellvalue('Al', 'Data Peminjaman');

        $sheet->setCellvalue('A3', 'No');
        $sheet->setCellvalue('B3', 'Nama Buku');
        $sheet->setCellvalue('C3', 'Nama Anggota');
        $sheet->setCellvalue('D3', 'Tanggal Pinjam');
        $sheet->setCellvalue('F3', 'Tanggal Kembali');
        $sheet->setCellvalue('G3', 'Denda');
        $sheet->setCellvalue('H3', 'Status');
        $sheet->setCellvalue('I3', 'Opsi');

        $row = 2;
        $i = 1;
        foreach($data as $peminjaman){
            $sheet->setCellValue('A' . $row, $i++);
            $sheet->setCellValue('B' . $row, $penerbit->nama);
            $sheet->setCellValue('B' . $row, $penerbit->nama_anggota);
        }

        $path = '../files/';
        $filename = time() . '_Export_Data_Peminjaman.xlsx';
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($path . $filename);
        return $writer;

}
}
