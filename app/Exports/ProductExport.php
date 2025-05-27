<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductExport implements FromCollection, WithHeadings, WithCustomStartCell, WithStyles, WithColumnWidths
{
    public function collection()
    {
        return Product::join('categories', 'category_id', '=', 'categories.id')
            ->join('suppliers', 'supplier_id', '=', 'suppliers.id')
            ->select(
                'products.name',
                'products.description',
                'products.price',
                DB::raw("CONCAT(suppliers.first_name, ' ', suppliers.last_name) as supplier"),
                'categories.name as category'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'Description',
            'Price',
            'Supplier',
            'Category'
        ];
    }

    public function startCell(): string
    {
        return 'C5';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('C5:G5')->getFont()->setBold(true);
        $sheet->getStyle('C5:G5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFE1F0FF');
        $sheet->getStyle('C5:G5')->getBorders()->getAllBorders()->setBorderStyle(
            \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
        );
    }

    public function columnWidths(): array
    {
        return [
            'C' => 20,
            'D' => 35,
            'E' => 10,
            'F' => 25,
            'G' => 20,
        ];
    }
}
