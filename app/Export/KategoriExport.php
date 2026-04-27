<?php

namespace App\Export;

use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KategoriExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Kategori::select(
            'id_kategori',
            'nama_kategori',
            'created_at',
            'updated_at'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID Kategori',
            'Nama Kategori',
            'Created At',
            'Updated At'
        ];
    }
}