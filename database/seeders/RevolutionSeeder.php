<?php

namespace Database\Seeders;

use App\Models\Revolution;
use Illuminate\Database\Seeder;

// seed revolution content
class RevolutionSeeder extends Seeder
{
    public function run(): void
    {
        $items = config('ir.items'); // source data
        $categories = config('ir.categories'); // section labels

        foreach ($items as $item) {
            $revolution = Revolution::updateOrCreate(
                ['slug' => $item['id']],
                [
                    'label' => $item['label'],
                    'title' => $item['title'],
                    'years' => $item['years'],
                    'summary' => $item['summary'],
                    'hero_image' => null,
                ]
            );

            foreach ($categories as $key => $label) {
                $revolution->sections()->updateOrCreate(
                    ['section_key' => $key],
                    [
                        'section_title' => $label,
                        'body' => $item['content'][$key] ?? 'No information available.',
                        'image_path' => null,
                        'sort_order' => array_search($key, array_keys($categories), true),
                    ]
                );
            }
        }
    }
}