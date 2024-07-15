<?php

namespace Database\Seeders;

use App\Models\DocumentCategory as ModelsDocumentCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentCategory extends Seeder
{
    /**
     * Run the database seeds.
     */

        public function run(): void
        {
            ModelsDocumentCategory::insert([
                [
                'category' => 'Big Data',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'category' => 'Internet Of Thing',
                'created_at' => now(),
                'updated_at' => now()
                ],
                [
                'category' => 'Business Inteligence',
                'created_at' => now(),
                'updated_at' => now()
                ],
            ]);
    }
}
