<?php

use Illuminate\Database\Seeder;
use App\Entities\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'cpf'           => '11122233344',
            'name'          => 'Rafael',
            'phone'         => '99999999999',
            'birth'         => '1990-01-01',
            'gender'        => 'M',
            'email'         => 'rafa@email.com',
            'password'      => env('PASSWORD_HASH') ? bcrypt('123456') : '123456',
        ]);

        // $this->call(UsersTableSeeder::class);
    }
}
