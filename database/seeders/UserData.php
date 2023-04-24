<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserData extends Seeder
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
                'name' => 'Administrator',
                'username' => 'admin123',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
                'email' => 'admin@gmail.com'
            ],
            [
                'name' => 'Pimpinan',
                'username' => 'pimpinan123',
                'password' => bcrypt('pimpinan123'),
                'role' => 'pimpinan',
                'email' => 'pimpinan@gmail.com'
            ],
            [
                'name' => 'Customer Service',
                'username' => 'cs123',
                'password' => bcrypt('cs123'),
                'role' => 'customer_service',
                'email' => 'cs@gmail.com'
            ],
            [
                'name' => 'Kepala Divisi Offset',
                'username' => 'kadivoffset123',
                'password' => bcrypt('kadivoffset123'),
                'role' => 'kadiv_offset',
                'email' => 'kadivoffset@gmail.com'
            ],
            [
                'name' => 'Kepala Divisi Produksi',
                'username' => 'kadivproduksi123',
                'password' => bcrypt('kadivproduksi123'),
                'role' => 'kadiv_produksi',
                'email' => 'kadivproduksi@gmail.com'
            ],
            [
                'name' => 'Kepala Divisi Finishing',
                'username' => 'kadivfinishing123',
                'password' => bcrypt('kadivfinishing123'),
                'role' => 'kadiv_finishing',
                'email' => 'kadivfinishing@gmail.com'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
