<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    

    public function run(): void
    {
        //

        DB::table('productos')->insert([
            'name'=> 'Xiaomi 14 pro',
            'descripcion'=> 'Telefono gama premium con excelente camara leica',
            'precio'=> 4595000
        ]);
        DB::table('productos')->insert([
            'name'=> 'Samsung S24+',
            'descripcion'=> 'Telefono gama premium con IA',
            'precio'=> 5595000

        ]);
        DB::table('productos')->insert([
            'name'=> 'Pixel 8 pro',
            'descripcion'=> 'Telefono gama premium con androi puro',
            'precio'=> 3595000

        ]);
    }
}
