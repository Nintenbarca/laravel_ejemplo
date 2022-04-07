<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(ExamenSeeder::class);
        $this->call(PreguntaSeeder::class);
    }
}
