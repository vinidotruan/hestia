<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'name' => 'Admin',
            'active' => true
        ]);
        $admin->assignRole(1);
        $a = Address::create([
            'uf' => 'RS',
            'street' => 'Rua teste',
            'zip_code' => '93048132',
            'number' => 'teste',
            'lat' => "-29.781273",
            'lon' => "-51.161694",
            "city" => "teste cidade"
        ]);
        $admin->address()->save($a);


        $locations = [
            ['lat' => -30.0346, 'lon' => -51.2177], // Porto Alegre
            ['lat' => -29.6868, 'lon' => -53.8149], // Santa Maria
            ['lat' => -31.7699, 'lon' => -52.3371], // Pelotas
            ['lat' => -29.6891, 'lon' => -51.1318], // Novo Hamburgo
            ['lat' => -28.2628, 'lon' => -52.4075], // Passo Fundo
            ['lat' => -27.6392, 'lon' => -48.6938], // Torres
            ['lat' => -30.8602, 'lon' => -51.1817], // Tramandaí
            ['lat' => -32.0346, 'lon' => -52.1018], // Rio Grande
            ['lat' => -29.1711, 'lon' => -51.5193], // Caxias do Sul
            ['lat' => -27.3659, 'lon' => -53.3958]  // Frederico Westphalen
        ];

        foreach ($locations as $key => $location) {
            $ong = User::create([
                'email' => "ong" . $key . "@ong.com",
                'password' => Hash::make('password'),
                'name' => 'Ong ' . $key,
                'active' => true
            ]);

            $ong->assignRole(2);

            $a = Address::create([
                'uf' => 'RS',
                'street' => 'Rua Teste Gerada',
                'zip_code' => '93048135',
                'number' => '333',
                'lat' => $location['lat'],
                'lon' => $location['lon'],
                'city' => 'City teste'
            ]);
            $ong->address()->save($a);
        }
    }
}
