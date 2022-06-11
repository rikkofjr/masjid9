<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasjidProfile;
use App\Models\User;

class MasjidInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getFirstUserId = User::pluck('id')->first();
        MasjidProfile::create([
            'nama_masjid'    => 'Nama Masjid Anda',
            'alamat'    => 'Jl. Masjid Anda',
            'nomor_telepon'    => '000',
            'nomor_handphone'    => '000',
            'user_update'    => $getFirstUserId,
        ]);
    }
}
