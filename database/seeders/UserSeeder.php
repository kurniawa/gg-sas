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
            ["nama"=>"Adi Kurniawan","username"=>"kuruniawa","password"=>"ddloveakunsomuch","role"=>'developer'],
            ["nama"=>"andin","username"=>"andin","password"=>"andin","role"=>'admin'],
            ["nama"=>"aldebaran","username"=>"aldebaran","password"=>"aldebaran","role"=>'admin'],
            ["nama"=>"Guest","username"=>"guest","password"=>"guest","role"=>'guest'],
            ["nama"=>"Dummy","username"=>"dummy","password"=>"dummy","role"=>'customer'],
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
                'role' => $users[$i]['role'],
                'phone' => "0000$i"
            ]);
        }
    }
}
