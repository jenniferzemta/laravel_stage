<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = User::all();

        foreach ($employees as $employee) {
        
          $pin = rand(1000,9999);
        
          $employee->pin = $pin;
        
          $employee->save();}
    }
}
