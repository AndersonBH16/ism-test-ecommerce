<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Electronica', 'description' => 'Labore dolores ipsam voluptas dolorem itaque.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'Tecnologia', 'description' => 'Ex totam dolores omnis pariatur.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'Deportes', 'description' => 'Laborum cupiditate omnis a repudiandae.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'Jugueteria', 'description' => 'Sunt sint quia aperiam ut laudantium eum enim ut.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'Hogar', 'description' => 'Veritatis voluptatum autem beatae possimus molestias vel et.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 6, 'name' => 'Cocina', 'description' => 'Veritatis et similique dolorum voluptatum reprehenderit maxime eum ut.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 7, 'name' => 'Moda', 'description' => 'Delectus illum molestiae voluptates magnam laborum et quas architecto.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 8, 'name' => 'Accesorios', 'description' => 'Est labore aut a enim omnis reprehenderit est.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 9, 'name' => 'Libreria', 'description' => 'Laborum esse qui consequatur voluptatum nesciunt nam exercitationem.', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 10, 'name' => 'Belleza', 'description' => 'Optio aut laboriosam et aliquid dolor non.', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }
}
