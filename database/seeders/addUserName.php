<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class addUserName extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "username" => "sumead007",
                "password" => bcrypt(12345678),
                "name" => "สุเมธ ดวงมาลัย",
            ]
        ];
        foreach ($users as $key => $value) {

            User::create($value);
        }
    }
}
