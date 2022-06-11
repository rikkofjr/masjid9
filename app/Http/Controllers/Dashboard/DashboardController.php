<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\MasjidProfileController;
use Illuminate\Http\Request;
use App\Models\MasjidProfile;
use App\Models\DataJamaah;
use App\Models\AlamatJamaah;
use App\Models\User;
use App\Models\KasPenerimaan;
use App\Models\KasPengeluaran;
use App\Models\Kas;

use DB;

class DashboardController extends Controller
{
    public function home(){
        $jumlahDataJamaah = DataJamaah::count();
        $jumlahAlamatJamaah = AlamatJamaah::count();
        $jumlahJamaahDonatur = AlamatJamaah::where('kategori_jamaah', 'Donatur')->count();
        $jumlahJamaahMustahiq = AlamatJamaah::where('kategori_jamaah', 'Mustahiq')->count();
        $jumlahOutsourceHead = User::role('Outsource Head')->select('id','name')->get(); 
        $jumlahOutsourceStaf = User::role('Outsource Staf')->select('id','name')->count(); 
        $masjidProfile = MasjidProfile::first();
        $kasPenerimaan = Kas::select(
            DB::raw('year(created_at) as tahun'), 
            DB::raw('sum(debit) as penerimaan'), 
        )->groupBy('tahun')->orderBy('tahun', 'DESC')->limit(5)->get();
        $kasPengeluaran = Kas::select(
            DB::raw('year(created_at) as tahun'), 
            DB::raw('sum(kredit) as pengeluaran'), 
        )->groupBy('tahun')->orderBy('tahun', 'DESC')->limit(5)->get();
        return view('dashboard.index', compact(
            'masjidProfile',
            'jumlahDataJamaah',
            'jumlahJamaahDonatur',
            'jumlahJamaahMustahiq',
            'jumlahOutsourceHead',
            'jumlahOutsourceStaf',
            'kasPenerimaan',
            'kasPengeluaran',
            'jumlahAlamatJamaah' 

        ));
    }
    public function coba(){
        return view ('dashboard.coba');
    }
    public function updateMasjidProfile(Request $request){
        $messages = [
            'nama_masjid.required' => 'Nama Masjid Wajid Diisi',
            'alamat.required' => 'Alamat Wajib diisi diisi',
            'nomor_telepon.required' => 'Jenis zakat harap diisi',
        ];
        $this->validate($request, [
            'nama_masjid'=>'required', 
            'alamat'=>'required', 
            'nomor_telepon'=>'required', 
        ],$messages);

        $masjid = MasjidProfile::first();
        $masjid->nama_masjid = $request->nama_masjid;
        $masjid->alamat = $request->alamat;
        $masjid->nomor_telepon = $request->nomor_telepon;
        $masjid->nomor_handphone = $request->nomor_handphone;
        $masjid->email = $request->email;
        $masjid->user_update = auth()->user()->id;
        //dd($masjid);
        $masjid->save();
        return redirect()->route('admin.index');
        //$masjid->save();
    }
}
