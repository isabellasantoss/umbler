<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'usuario' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@benconect.com.br',
            'password' => bcrypt('123'),
            'cpf' => '123456789',
            'cargo' => 'Admin',
            'data_nascimento' => '2022-04-05',
            'sexo' => 'F',
            'identificador' => 'teste'
        ]);
    }
}
