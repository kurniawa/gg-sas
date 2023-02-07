<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ["nama"=>"Adi Kurniawan","username"=>"kuruniawa","password"=>"ddloveakunsomuch","is_admin"=>true],
            ["nama"=>"Guest","username"=>"guest","password"=>"guest","is_admin"=>false],
        ];
        for ($i = 0; $i < count($users); $i++) {
            // dump('seeding user');
            $password=$users[$i]['password'];
            if ($users[$i]['username']!=='Dian' || $users[$i]['username']!=='Albert21') {
                $password=bcrypt($password);
            }
            User::create([
                'nama' => $users[$i]['nama'],
                'username' => $users[$i]['username'],
                'password' => $password,
                'is_admin' => $users[$i]['is_admin'],
            ]);
        }
    }
}
