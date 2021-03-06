<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * Class TaskSeeder
 */
class TaskSeeder extends Seeder
{
    private const ENTRIES_NUMBER_TO_SEED = 20;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(0, self::ENTRIES_NUMBER_TO_SEED) as $number) {
            DB::table('tasks')->insert([
                'task' => Str::random(255),
                'is_done' => collect([0, 1])->random(),
                'is_deleted' => collect([0, 1])->random(),
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
        }
    }
}
