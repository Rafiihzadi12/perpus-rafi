<?php
 
namespace App\Exports;
 
use App\Models\Penerbit;
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
 
class PenerbitExport implements FromCollection, WithHeadings, ShouldAutoSize,  WithMapping, WithEvents, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Penerbit::all();
    }

    public function map($penerbit):array
    {
        return [
            $penerbit->nama,
            $penerbit->alamat,
            $penerbit->telepon,
            $penerbit->email,
        ];
    }

    public function headings(): array
    {
       return [
         'Nama',
         'Alamat',
         'telepon',
         'email',
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
           'nama',
           'alamat',
           'telepon',
           'email', 
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event)
            {
                $event->sheet->getStyle('A1:D3')->ApplyFromArray([
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