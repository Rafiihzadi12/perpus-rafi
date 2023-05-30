<?php
 
namespace App\Exports;
 
use App\Models\Buku;
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
 
class BukuExport implements FromCollection, WithHeadings, ShouldAutoSize,  WithMapping, WithEvents, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Buku::all();
    }

    public function map($buku):array
    {
        return [
            $buku->nama,
            $buku->tahun_terbit,
            $buku->penulis,
            $buku->penerbit->nama,
            $buku->kategori->nama,
            $buku->sinopsis,
        ];
    }

    public function headings(): array
    {
       return [
         'Judul Buku',
         'Tahun Terbit',
         'Penulis',
         'Penerbit',
         'Kategori',
         'Sinopsis',
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
            'judul buku',
            'tahun terbit',
            'penulis',
            'penerbit',
            'kategori',
            'sinopsis',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event)
            {
                $event->sheet->getStyle('A1:F3')->ApplyFromArray([
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