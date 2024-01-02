<?php
/**
 * ANA RITA VIEIRA DE ALMEIDA 35456
 */
namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * @return void
     */
    public function run() 
    {
        $types = array(
            ['name' => 'Museu', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Restaurante', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Trilho', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Alojamento', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Miradouro', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Feira', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Monumento', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Passadiço', 'created_at' => now(), 'updated_at' => now(),],
            ['name' => 'Atividade Radical', 'created_at' => now(), 'updated_at' => now(),],
        );

        Type::insert($types);
    }
}


