<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Auth;
use App\User;

use Carbon\Carbon;
use DataTables;
use Ramsey\Uuid\Uuid;
use PDF;
use DB;
Use Alert;

use App\Models\Qurban;
use App\Models\MasjidProfile;

class QurbanController extends Controller
{
    public function qurbanDashboard(){
        $nowHijri = \GeniusTS\HijriDate\Date::today()->format('j F, Y');
        $nowMasehi = Carbon::today()->format('j F, Y');
        $year = Qurban::select(DB::raw('YEAR(hijri) as year'))->distinct()->get()->pluck('year');
        $jenisHewan = Qurban::select(DB::raw('jenis_hewan as jenis_hewan'))->distinct()->get()->pluck('jenis_hewan');
        return view('dashboard.qurban.admin-qurban', compact('nowMasehi', 'nowHijri','jenisHewan','year'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nowHijriYear = \GeniusTS\HijriDate\Date::today()->format('Y');
        $nowMasehiDate = Carbon::today()->format('j F, Y'); 
        
        return view('dashboard.qurban.index', compact('nowHijriYear', 'nowMasehiDate'));  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nowHijriYear = \GeniusTS\HijriDate\Date::today()->format('Y');
        $nowMasehiDate = Carbon::today()->format('j F, Y');
        return view('dashboard.qurban.create', compact('nowHijriYear', 'nowMasehiDate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nowHijriYear = \GeniusTS\HijriDate\Date::today()->format('Y');

        $messages = [
            'atas_nama.required' => 'Atas Nama  Wajid Diisi',
            'jenis_hewan.required' => 'Jenis Hewan harap diisi',
            'alamat.required' => 'Alamat pengqurban harap diisi',
            'permintaan.required' => 'Permintaan pengqurban harap  diisi',
            'nomor_handphone.required' => 'Nomor whatsapp/handphone harap diisi',
        ];
        $this->validate($request, [
            'atas_nama'=>'required', 
            'permintaan'=>'required', 
            'jenis_hewan'=>'required', 
            'alamat'=>'required', 
            'nomor_handphone'=>'required', 
        ],$messages);

            $nomorHewan = Helper::qurbanNomorHewan(new Qurban, $nowHijriYear, $request->jenis_hewan);
            
            $qurban = new Qurban;
            $qurban->jenis_hewan = $request->jenis_hewan;
            $qurban->amil = Auth::user()->id;
            $qurban->atas_nama = $request->atas_nama;
            $qurban->nama_lain = $request->nama_lain;
            $qurban->alamat = $request->alamat;
            $qurban->permintaan= $request->permintaan;
            $qurban->nomor_handphone= '62'. str_replace(",", "", $request->nomor_handphone);;
            $qurban->disaksikan= $request->disaksikan;
            $qurban->hijri = \GeniusTS\HijriDate\Date::today();
            $qurban->nomor_hewan = $nomorHewan;
            $qurban->keterangan = $request->keterangan;
            $qurban->save();
            Alert::success('Berhasil Menambah Hewan Kurban', 'a/n '.$qurban->atas_nama.'');
            return redirect()->route('admin.qurban.show', $qurban->id);        
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $masjidProfile = MasjidProfile::first();
        $qurban = Qurban::findOrFail($id);
        $textWhatsapp = 'Assalamualaikum Wr.Wb Bapak/ibu '.$qurban->atas_nama.'%0aPerkenalkan Saya '.Auth::user()->name.' panitia qurban '.$masjidProfile->nama_masjid.' ingin mengabarkan bahwa hewan kurban '.$qurban->jenis_hewan.' dengan permintaan '.$qurban->permintaan.' akan dipotong pada hari raya idul adha, apabila ada pertanyaan silahkan hubungi kami..,%0aWasalamualaikum Wr.Wb%0aTerimakasih%0a'.Auth::user()->name.'';
        return view('dashboard.qurban.show', compact('qurban', 'textWhatsapp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nowHijriYear = \GeniusTS\HijriDate\Date::today()->format('Y');
        $nowMasehiDate = Carbon::today()->format('j F, Y');
        $qurban = Qurban::findOrFail($id);
        return view('dashboard.qurban.edit', compact('nowMasehiDate','nowHijriYear','qurban'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'atas_nama.required' => 'Atas Nama  Wajid Diisi',
            'jenis_hewan.required' => 'Jenis Hewan harap diisi',
            'alamat.required' => 'Alamat pengqurban harap diisi',
            'permintaan.required' => 'Permintaan pengqurban harap  diisi',
            'nomor_handphone.required' => 'Nomor handphone harap diisi',
        ];
        $this->validate($request, [
            'atas_nama'=>'required', 
            'permintaan'=>'required', 
            'jenis_hewan'=>'required', 
            'alamat'=>'required', 
            'nomor_handphone'=>'required', 
        ],$messages);
        $qurban = Qurban::findOrFail($id);
        $qurban->jenis_hewan = $request->jenis_hewan;
        $qurban->amil = Auth::user()->id;
        $qurban->atas_nama = $request->atas_nama;
        $qurban->nama_lain = $request->nama_lain;
        $qurban->alamat = $request->alamat;
        $qurban->permintaan= $request->permintaan;
        $qurban->nomor_handphone= '62'. str_replace(",", "", $request->nomor_handphone);;
        $qurban->disaksikan= $request->disaksikan;
        $qurban->keterangan = $request->keterangan;
        $qurban->save();
        Alert::success('Berhasil Menambah Meruba Data Kurban', 'a/n '.$qurban->atas_nama.'');
        return redirect()->route('admin.qurban.show', $qurban->id);      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function SoftDeleteById($id){
        //softdelte record
        $qurban = qurban::findOrFail($id);
        $qurban->delete();
        Alert::success('Berhasil Menghapus Data Qurban', 'a/n '.$qurban->atas_nama.'');
        return redirect()->route('admin.qurban.index');  
         
    }
    
    //Api
    public function getQurbanKambing(){
        $nowHijriYear = \GeniusTS\HijriDate\Date::today()->format('Y');
        $nowMasehi = Carbon::today()->format('Y');
        $dataQurban = Qurban::orderBy('created_at', 'ASC')->where('jenis_hewan', 'Kambing')->whereYear('hijri', $nowHijriYear)->get();
        return Datatables::of($dataQurban)
            ->editColumn(('id'), function($dataQurban){
                $masjidProfile = MasjidProfile::first();
                $textWhatsapp = 'Assalamualaikum Wr.Wb Bapak/ibu '.$dataQurban->atas_nama.'%0aPerkenalkan Saya '.Auth::user()->name.' panitia qurban '.$masjidProfile->nama_masjid.' ingin mengabarkan bahwa hewan kurban '.$dataQurban->jenis_hewan.' dengan permintaan '.$dataQurban->permintaan.' akan dipotong pada hari raya idul adha, apabila ada pertanyaan silahkan hubungi kami..,%0aWasalamualaikum Wr.Wb%0aTerimakasih%0a'.Auth::user()->name.'';

                $btn = '<a href="'.route('admin.qurban.show', $dataQurban->id).'" class="btn-sm btn-primary">Lihat</a>';
                $btn1 = '&nbsp; <a target="_blank" title="Hubungi Via Whatsapp" href="https://api.whatsapp.com/send?phone='.$dataQurban->nomor_handphone.'&text='.$textWhatsapp.'" class="btn-sm btn-success"><i class="fab fa-whatsapp text-white-50 m-1"></a></a>';
                return $btn . $btn1;
            })
            ->editColumn(('amil'), function($dataQurban){
                return $dataQurban->amil ? with ($dataQurban->data_amil->name): '';
            })
            ->editColumn(('nomor_hewan'), function($dataQurban){
                return $dataQurban->nomor_hewan ? with ((int)filter_var($dataQurban->nomor_hewan, FILTER_SANITIZE_NUMBER_INT)): '';
            })
            ->editColumn(('created_at'), function ($dataQurban){
                return $dataQurban->created_at ? with (new carbon($dataQurban->created_at))->format('d/m/Y | H:i') : '';
             })
            ->addIndexColumn()
            ->removeColumn('updated_at','deleted_at', 'amil')
            ->rawColumns(['id'])
            ->make();
    }
    public function getQurbanSapi(){
        $nowHijriYear = \GeniusTS\HijriDate\Date::today()->format('Y');
        $nowMasehi = Carbon::today()->format('Y');
        $dataQurban = Qurban::orderBy('created_at', 'ASC')->where('jenis_hewan', 'Sapi')->whereYear('hijri', $nowHijriYear)->get();
        return Datatables::of($dataQurban)
            ->editColumn(('id'), function($dataQurban){
                $masjidProfile = MasjidProfile::first();
                $textWhatsapp = 'Assalamualaikum Wr.Wb Bapak/ibu '.$dataQurban->atas_nama.'%0aPerkenalkan Saya '.Auth::user()->name.' panitia qurban '.$masjidProfile->nama_masjid.' ingin mengabarkan bahwa hewan kurban '.$dataQurban->jenis_hewan.' dengan permintaan '.$dataQurban->permintaan.' akan dipotong pada hari raya idul adha, apabila ada pertanyaan silahkan hubungi kami..,%0aWasalamualaikum Wr.Wb%0aTerimakasih%0a'.Auth::user()->name.'';

                $btn = '<a href="'.route('admin.qurban.show', $dataQurban->id).'" class="btn-sm btn-primary">Lihat</a>';
                $btn1 = '&nbsp; <a target="_blank" title="Hubungi Via Whatsapp" href="https://api.whatsapp.com/send?phone='.$dataQurban->nomor_handphone.'&text='.$textWhatsapp.'" class="btn-sm btn-success"><i class="fab fa-whatsapp text-white-50 m-1"></a></a>';
                return $btn . $btn1;
            })
            ->editColumn(('amil'), function($dataQurban){
                return $dataQurban->amil ? with ($dataQurban->data_amil->name): '';
            })
            ->editColumn(('nomor_hewan'), function($dataQurban){
                return $dataQurban->nomor_hewan ? with ((int)filter_var($dataQurban->nomor_hewan, FILTER_SANITIZE_NUMBER_INT)): '';
            })
            ->editColumn(('created_at'), function ($dataQurban){
                return $dataQurban->created_at ? with (new carbon($dataQurban->created_at))->format('d/m/Y | H:i') : '';
             })
            ->editColumn(('permintaan'), function ($dataQurban){
                return $dataQurban->permintaan ? with (nl2br(e($dataQurban->permintaan))): '';
             })
            ->addIndexColumn()
            ->removeColumn('updated_at','deleted_at', 'amil')
            ->rawColumns(['id','permintaan'])
            ->make();
    }
    public function getAllQurbanData(){
        $dataQurban = Qurban::orderBy('created_at', 'ASC')->get();
        return Datatables::of($dataQurban)
            ->editColumn(('amil'), function($dataQurban){
                return $dataQurban->amil ? with ($dataQurban->data_amil->name): '';
            })
            ->editColumn(('nomor_hewan'), function($dataQurban){
                return $dataQurban->nomor_hewan ? with ((int)filter_var($dataQurban->nomor_hewan, FILTER_SANITIZE_NUMBER_INT)): '';
            })
            ->editColumn(('atas_nama'), function($dataQurban){
                $btn = '<a href="'.route('admin.qurban.show', $dataQurban->id).'">'.$dataQurban->atas_nama.'</a>';
                return $btn;
            })
            ->editColumn(('created_at'), function ($dataQurban){
                return $dataQurban->created_at ? with (new carbon($dataQurban->created_at))->format('d/m/Y') : '';
             })
            ->editColumn(('permintaan'), function ($dataQurban){
                return $dataQurban->permintaan ? with (nl2br(e($dataQurban->permintaan))): '';
             })
            ->editColumn(('nama_lain'), function ($dataQurban){
                return $dataQurban->nama_lain ? with (nl2br(e($dataQurban->nama_lain))): '';
             })
             ->editColumn(('hijri'), function ($dataQurban){
                return $dataQurban->hijri ? with (new carbon($dataQurban->hijri))->format('Y') : '';
             })
            ->addIndexColumn()
            ->removeColumn('updated_at','deleted_at', 'amil')
            ->rawColumns(['id','permintaan', 'atas_nama', 'nama_lain'])
            ->make();
    }
    //Print
    public function printQurbanByThisYear($jenis_hewan){
        $nowHijriYear = \GeniusTS\HijriDate\Date::today()->format('Y');
        $dataQurban = Qurban::orderBy('created_at', 'ASC')->where('jenis_hewan', $jenis_hewan)->whereYear('hijri', $nowHijriYear)->get();
        $pdf = PDF::loadview('dashboard.qurban.print.print-full',['dataQurban'=>$dataQurban, 'nowHijriYear'=>$nowHijriYear, 'jenis_hewan'=>$jenis_hewan])->setPaper('a4','landscape');
        if($dataQurban->isEmpty()){
            abort(404);
        }else{
            return $pdf->stream('qurban'.$jenis_hewan.'.pdf');
        }
    }
    public function printQurbanJamaah($id){
        $dataMasjid = MasjidProfile::first();
        $dataQurban = Qurban::findOrFail($id);
        return view('dashboard.qurban.print.print', compact('dataQurban','dataMasjid'));
    }
}
