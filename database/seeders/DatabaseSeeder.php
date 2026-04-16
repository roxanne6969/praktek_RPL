<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('12345678'),
        ]);

        DB::table('kategori')->insert([  //jangan lupa import class
            'nama_kategori' => 'Nasional',
        ]);

        DB::table('berita')->insert([
            'judul_berita' => 'lorem ipsum',
            'isi_berita' => 'lorem ipsum',
            'gambar_berita' => 'berita/lorem.jpeg',
            'id_kategori' => 1,
        ]);
    }
}
