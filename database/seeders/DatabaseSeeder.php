<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    protected $model;
    public function __construct()
    {
        $this->model = new \App\Models\User;
    }
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $this->model->create([
            'nama' => 'Super Admin',
            'email' => 'admin@surfboard.com',
            'username' => 'admin',
            'jabatan' => 'super_admin',
            'jenis_kelamin' => null,
            'password' => bcrypt('admin'),
        ]);
    }
}
