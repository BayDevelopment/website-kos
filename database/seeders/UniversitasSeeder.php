<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UniversitasSeeder extends Seeder
{
    use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universitas = [

            [
                'nama_universitas' => 'Universitas Sultan Ageng Tirtayasa',
                'jenis' => 'negeri',
                'kota' => 'Kota Serang',
                'alamat' => 'Jl. Raya Jakarta KM 4, Pakupatan, Kota Serang, Banten',
                'website' => 'https://untirta.ac.id',
            ],

            [
                'nama_universitas' => 'Universitas Bina Bangsa',
                'jenis' => 'swasta',
                'kota' => 'Kota Serang',
                'alamat' => 'Jl. Raya Serang - Jakarta KM 3, Kota Serang',
                'website' => 'https://binabangsa.ac.id',
            ],

            [
                'nama_universitas' => 'Universitas Serang Raya',
                'jenis' => 'swasta',
                'kota' => 'Kota Serang',
                'alamat' => 'Jl. Raya Cilegon No. Km 5, Kota Serang',
                'website' => 'https://unsera.ac.id',
            ],

            [
                'nama_universitas' => 'STMIK Banten Jaya',
                'jenis' => 'swasta',
                'kota' => 'Kota Serang',
                'alamat' => 'Jl. Ciwaru Raya No.73, Kota Serang',
                'website' => null,
            ],

            [
                'nama_universitas' => 'STIKes Faletehan',
                'jenis' => 'swasta',
                'kota' => 'Kota Serang',
                'alamat' => 'Jl. Raya Serang - Pandeglang KM 6, Kota Serang',
                'website' => 'https://faletehan.ac.id',
            ],

            [
                'nama_universitas' => 'Politeknik Krakatau',
                'jenis' => 'swasta',
                'kota' => 'Kota Cilegon',
                'alamat' => 'Jl. Industri No.1, Kota Cilegon',
                'website' => 'https://politeknikkrakatau.ac.id',
            ],

            [
                'nama_universitas' => 'STIE Al-Khairiyah',
                'jenis' => 'swasta',
                'kota' => 'Kota Cilegon',
                'alamat' => 'Jl. KH. Wasyid No.10, Kota Cilegon',
                'website' => null,
            ],

        ];

        foreach ($universitas as $item) {

            DB::table('universitas')->insert([
                'nama_universitas' => $item['nama_universitas'],
                'slug' => Str::slug($item['nama_universitas']),
                'jenis' => $item['jenis'],
                'kota' => $item['kota'],
                'alamat' => $item['alamat'],
                'website' => $item['website'],
                'logo' => null,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
