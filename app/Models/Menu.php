<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'nama_menu',
        'jenis_menu',
        'url_menu',
        'target_menu',
        'urutan_menu',
        'parent_menu',
        'status_menu'
    ];

    /**
     * Relasi untuk mengambil submenu (anak menu)
     * Ini pakai HasMany karena satu menu bisa punya banyak submenu
     */
    public function submenu()
    {
        return $this->hasMany(Menu::class, 'parent_menu', 'id_menu');
    }
}