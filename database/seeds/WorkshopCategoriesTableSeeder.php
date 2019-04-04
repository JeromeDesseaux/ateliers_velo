<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WorkshopCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('workshop_categories')->insert([
            'title' => "Entraide",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('workshop_categories')->insert([
            'title' => "Sensibilisation",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('workshop_categories')->insert([
            'title' => "Rencontres",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('workshop_categories')->insert([
            'title' => "Manifestation",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('workshop_categories')->insert([
            'title' => "Sorties et balades",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('workshop_categories')->insert([
            'title' => "Compétition",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        DB::table('workshop_categories')->insert([
            'title' => "Entraînement",
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
