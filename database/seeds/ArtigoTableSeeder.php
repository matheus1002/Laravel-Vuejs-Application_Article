<?php

use Illuminate\Database\Seeder;

class ArtigoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Artigo::class, 30)->create();
    }
}
