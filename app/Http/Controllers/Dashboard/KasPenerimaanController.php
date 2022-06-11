<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KasPenerimaan;
use App\Models\KasPengeluaran;

//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Auth;
use App\Models\User;

use Carbon\Carbon;
use DataTables;
use Ramsey\Uuid\Uuid;
use DB;
use Alert;

class KasPenerimaanController extends Controller
{
    public function __construct(){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    ////Api Data
    public function getAllDataPenerimaan(){
            $nowMasehi = Carbon::today()->format('Y');
            $data = KasPenerimaan::orderBy('created_at', 'DESC')->get();
            return Datatables::of($data)
            ->editColumn('created_at', function ($datanya){
                return $datanya->created_at ? with (new carbon($datanya->created_at))->format('j F, Y') : '';
            })
            ->editColumn('penerimaan', function ($datanya){
                return $datanya->penerimaan ? with (number_format($datanya->penerimaan)): '';
            })
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '<button type="button" class="btn btn-success btn-sm" id="getEditArticleData" data-id="'.$row->id.'">Edit Data</button>';
                $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="far fa-trash-alt text-white" data-feather="delete"></i></a>';
                return $btn;
            })
            ->removeColumn('catatan','penginput','updated_at','deleted_at')
            ->rawColumns(['action'])->make(true);
    }
    ////

    public function index(Request $request)
    {
        $nowMasehi = Carbon::today()->format('j F , Y');
        //$kasPenerimaan = KasPenerimaan::orderBy('created_at', 'DESC')->get();
        $totalKasPenerimaan = KasPenerimaan::sum('penerimaan');
        $totalKasPengeluaran = KasPengeluaran::sum('pengeluaran');
        $tahunPenerimaan = KasPenerimaan::select(DB::raw('YEAR(created_at) as year'))->distinct()->get()->pluck('year');
        
        if($request->ajax()){
            $data = KasPenerimaan::orderBy('created_at', 'DESC')->get();
            return Datatables::of($data)
            ->editColumn('created_at', function ($datanya){
                return $datanya->created_at ? with (new carbon($datanya->created_at))->format('Y, j F') : '';
            })
            ->editColumn('penerimaan', function ($datanya){
                return $datanya->penerimaan ? with (number_format($datanya->penerimaan)): '';
            })
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '<a href="'.route('admin.kas-penerimaan.edit', $row->id).'" data-toggle="tooltip" class="btn btn-primary btn-sm deleteProduct"><i class="far fa-eye text-white"></i></a>';
                //$btn = $btn.' <a href="'.route('adminkas-penerimaan.show', $row->id).'" data-toggle="tooltip" class="btn btn-primary btn-sm deleteProduct"><i class="far fa-eye text-white"></i></a>';
                return $btn;
            })
            ->removeColumn('catatan','penginput','deleted_at')
            ->rawColumns(['action'])->make(true);
        }
        
        return view('dashboard.kas.penerimaan.index', compact('nowMasehi', 'totalKasPenerimaan', 'totalKasPengeluaran', 'tahunPenerimaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Penerimaan';
        $route = 'admin.kas-penerimaan';

        $nowMasehi = Carbon::today()->format('j F, Y');
        return view('dashboard.kas.penerimaan.create', compact('nowMasehi', 'title', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'keterangan.required' => 'Keterangan Wajid Diisi',
            'penerimaan.required' => 'Jumlah uang diterima harap diisi',
        ];
        $this->validate($request, [
            'keterangan'=>'required', 
            'penerimaan'=>'required'
        ],$messages);
        $kp = new KasPenerimaan;
        $kp->keterangan = $request->keterangan;
        $kp->catatan = $request->catatan;
        $kp->penerimaan = str_replace(".", "", $request->penerimaan);
        $kp->penginput = Auth::user()->id;
        $kp->save();

        Alert::success('Berhasil Menambah Penerimaan Kas', 'Penerimaan '.$kp->keterangan.'  berhasil ditambah');
        return redirect()->route('admin.kas-penerimaan.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nowMasehi = Carbon::today()->format('Y');
        $kasPenerimaan = KasPenerimaan::findOrFail($id);
        return view('dashboard.kas.penerimaan.edit', compact('nowMasehi', 'kasPenerimaan'));
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
            'keterangan.required' => 'Keterangan Wajid Diisi',
            'penerimaan.required' => 'Jumlah uang diterima harap diisi',
        ];
        $this->validate($request, [
            'keterangan'=>'required', 
            'penerimaan'=>'required'
        ],$messages);
        $kp = KasPenerimaan::findOrFail($id);
        $kp->keterangan = $request->keterangan;
        $kp->catatan = $request->catatan;
        $kp->penerimaan = str_replace(".", "", $request->penerimaan);
        $kp->penginput = Auth::user()->id;
        $kp->save();
        Alert::success('Berhasil Merubah Penerimaan Kas', 'Penerimaan '.$kp->keterangan.'');
        return redirect()->route('admin.kas-penerimaan.index');
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
}
