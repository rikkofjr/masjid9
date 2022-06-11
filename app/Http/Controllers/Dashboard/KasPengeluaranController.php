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

class KasPengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nowMasehi = Carbon::today()->format('Y');
        //$kasPenerimaan = KasPenerimaan::orderBy('created_at', 'DESC')->get();
        $totalKasPenerimaan = KasPenerimaan::sum('penerimaan');
        $totalKasPengeluaran = KasPengeluaran::sum('pengeluaran');
        $tahunPenerimaan = KasPengeluaran::select(DB::raw('YEAR(created_at) as year'))->distinct()->get()->pluck('year');

        if($request->ajax()){
            $data = KasPengeluaran::orderBy('created_at', 'DESC')->get();
            return Datatables::of($data)
            ->editColumn('created_at', function ($datanya){
                return $datanya->created_at ? with (new carbon($datanya->created_at))->format('Y, j F') : '';
            })
            ->editColumn('pengeluaran', function ($datanya){
                return $datanya->pengeluaran ? with (number_format($datanya->pengeluaran)): '';
            })
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '<a href="'.route('admin.kas-pengeluaran.edit', $row->id).'" data-toggle="tooltip" class="btn btn-primary btn-sm deleteProduct"><i class="far fa-eye text-white"></i></a>';
                //$btn = $btn.' <a href="'.route('adminkas-penerimaan.show', $row->id).'" data-toggle="tooltip" class="btn btn-primary btn-sm deleteProduct"><i class="far fa-eye text-white"></i></a>';
                return $btn;
            })
            ->removeColumn('catatan','penginput','deleted_at')
            ->rawColumns(['action'])->make(true);
        
        }
        return view('dashboard.kas.pengeluaran.index', compact('nowMasehi', 'tahunPenerimaan', 'totalKasPenerimaan', 'totalKasPengeluaran'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Pengeluaran';
        $route = 'admin.kas-pengeluaran';
        $nowMasehi = Carbon::today()->format('j F, Y');
        return view('dashboard.kas.penerimaan.create', compact('nowMasehi', 'title', 'route'));
        //nebeng file di penerimaan
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
            'penerimaan.required' => 'Jumlah uang dikeluarkan harap diisi',
        ];
        $this->validate($request, [
            'keterangan'=>'required', 
            'penerimaan'=>'required'
        ],$messages);
        $kp = new KasPengeluaran;
        $kp->keterangan = $request->keterangan;
        $kp->catatan = $request->catatan;
        $kp->pengeluaran = str_replace(".", "", $request->penerimaan);
        $kp->penginput = Auth::user()->id;
        $kp->save();

        Alert::success('Berhasil Menambah Pengeluaran Kas', 'Pengeluaran '.$kp->keterangan.'  berhasil dimasukan');
        return redirect()->route('admin.kas-pengeluaran.index');
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
        $nowMasehi = Carbon::today()->format('j F, Y');
        $kasPengeluaran = KasPengeluaran::findOrFail($id);
        return view('dashboard.kas.pengeluaran.edit', compact('nowMasehi', 'kasPengeluaran'));
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
            'pengeluaran.required' => 'Jumlah uang dikeluarkan harap diisi',
        ];
        $this->validate($request, [
            'keterangan'=>'required', 
            'pengeluaran'=>'required'
        ],$messages);
        $kp = KasPengeluaran::findOrFail($id);
        $kp->keterangan = $request->keterangan;
        $kp->catatan = $request->catatan;
        $kp->pengeluaran = str_replace(".", "", $request->pengeluaran);
        $kp->penginput = Auth::user()->id;
        $kp->save();

        Alert::success('Berhasil mengubah pengeluaran kas', 'Pengeluaran '.$kp->keterangan.'');
        return redirect()->route('admin.kas-pengeluaran.index');
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
