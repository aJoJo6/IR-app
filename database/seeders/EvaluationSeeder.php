<?php

namespace Database\Seeders;

use App\Models\Evaluation;
use Illuminate\Database\Seeder;

// seed evaluation data
class EvaluationSeeder extends Seeder
{
    public function run(): void
    {
        $criteria = config('evaluation.criteria');
        $ir4 = config('evaluation.ir4');
        $ir5 = config('evaluation.ir5');

        foreach ($criteria as $index => $criterion) {
            Evaluation::create([
                'revolution' => 'ir4',
                'criterion' => $criterion,
                'value' => $ir4[$index] ?? '—',
            ]);

            Evaluation::create([
                'revolution' => 'ir5',
                'criterion' => $criterion,
                'value' => $ir5[$index] ?? '—',
            ]);
        }
    }
}