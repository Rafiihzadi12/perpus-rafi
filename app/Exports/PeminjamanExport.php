<?php
 
namespace App\Exports;
 
use App\Models\Peminjaman;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PHPExcel_Cell;
 
class PeminjamanExport implements FromCollection, WithHeadings, ShouldAutoSize,  WithMapping, WithEvents, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Peminjaman::all();
    }

    public function map($peminjaman):array
    {
        return [
            $peminjaman->buku->nama,
            $peminjaman->anggota->nama,
            $peminjaman->tanggal_pinjam,
            $peminjaman->tanggal_kembali,
            $peminjaman->denda,
            $peminjaman->id_sinopsis,
            $peminjaman->status,
        ];
    }

    public function headings(): array
    {
       return [ 
         'Nama Buku',
         'Nama Anggota',
         'Tanggal Pinjam',
         'Tanggal Kembali',
         'Denda',
         'Sinopsis',
         'Status',
       ];
    }

    public function styles(Worksheet $sheet)    
    {
        return [
           // Style the first row as bold text.
           1    => ['font' => ['bold' => true]],


        ];  
    }

    public function model(array $row)
    {
        return[
            'nama buku',
            'nama anggota',
            'tanggal pinjam',
            'tanggal kembali',
            'Denda',
            'id sinopsis',
            'status',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event)
            {
                $event->sheet->getStyle('A1:G7')->ApplyFromArray([
                    'borders' => [ 
                        'allBorders' =>[
                            'borderStyle' => 
                                \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb'=>'800000'],
                        ],
                    ],
                ]);
            }
        ];
    }
}