<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
use HasFactory;

    // Kasih tahu nama tabelnya
    protected $table = 'page';

    // Karena primary key kamu bukan 'id'
    protected $primaryKey = 'id_page';

    // Kolom yang boleh diisi manual
    protected $fillable = [
        'judul_page',
        'isi_page',
        'status_page'
    ];
}
