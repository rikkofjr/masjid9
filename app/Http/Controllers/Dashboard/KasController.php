<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kas;
use App\Models\KasKategori;

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
class KasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function kasLaporan(Request $request){

        $query = Kas::query();
        // if($request->input('jenis')){
        //     $query->where('jenis', '=' , $request->input('jenis'));
        // }
        
        // if($request->input('cat_transaksi_id')){
        //     $query->where('cat_transaksi_id', '=' , $request->input('cat_transaksi_id'));
        // }
        
        // if($request->input('tahun')){
        //     $query->whereYear('created_at', '=' , $request->input('tahun'));
        // }
        
        // $kas = $query->paginate(10);
        
        $kas = Kas::filter($request->all())->with('kategori_transaksi')->orderBy('created_at', 'desc')->get();
        $totalKasPenerimaan = $kas->sum('debit');
        $totalKasPengeluaran = $kas->sum('kredit');

        if(empty($request->input('kategori'))){
            $reqKategori = '-';
        }else{
            $reqKategorinya = KasKategori::where('id', $request->input('kategori'))->first();
            $reqKategori = $reqKategorinya->cat_transaksi;
        }
        

        return view('dashboard.kas.print', compact(
            //'tahunTransaksi', 'kategoriTransaksi', 'jenisTransaksi',
            'kas', 'totalKasPenerimaan', 'totalKasPengeluaran', 'reqKategori'
        ));
    }
    public function index(Request $request)
    {
        $nowMasehi = Carbon::today()->format('j F , Y');
        $totalKasPenerimaan = Kas::where('jenis', '=', 'penerimaan')->sum('debit');
        $totalKasPengeluaran = Kas::where('jenis', '=', 'pengeluaran')->sum('kredit');
        $tahunTransaksi = Kas::select(DB::raw('YEAR(created_at) as year'))->distinct()->get()->pluck('year');
        $kategoriTransaksi = Kas::select('cat_transaksi_id')->distinct()->get();

        $kategoriTransaksi1 = KasKategori::select('cat_transaksi', 'id')->get();
        $jenisTransaksi = Kas::select('jenis')->distinct()->get();

        if($request->ajax()){
            $data = Kas::orderBy('created_at', 'DESC')->get();
            return Datatables::of($data)
            ->editColumn('created_at', function ($datanya){
                return $datanya->created_at ? with (new carbon($datanya->created_at))->format('Y, j F') : '';
            })
            ->editColumn('cat_transaksi_id', function ($datanya){
                return $datanya->cat_transaksi_id ? with ($datanya->kategori_transaksi->cat_transaksi):'' ;
            })
            ->editColumn('debit', function ($datanya){
                return $datanya->debit ? with (number_format($datanya->debit)): '';
            })
            ->editColumn('kredit', function ($datanya){
                return $datanya->kredit ? with (number_format($datanya->kredit)): '';
            })
            ->addIndexColumn()
            ->addColumn('action',function($row){
                $btn = '<a href="'.route('admin.kas.edit', $row->id).'" data-toggle="tooltip" class="btn btn-primary btn-sm deleteProduct"><i class="far fa-eye text-white"></i></a>';
                return $btn;
            })
            ->removeColumn('catatan','penginput','deleted_at')
            ->rawColumns(['action'])->make(true);
        }
        
        return view('dashboard.kas.index', compact(
            'nowMasehi', 'totalKasPenerimaan', 'tahunTransaksi', 'totalKasPengeluaran', 'kategoriTransaksi',
            'jenisTransaksi', 'kategoriTransaksi1'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kasKategori = KasKategori::all()->sortBy('id')->pluck('cat_transaksi', 'id');

        $nowMasehi = Carbon::today()->format('j F, Y');
        return view('dashboard.kas.create', compact('nowMasehi', 'kasKategori'));
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
            'cat_transaksi_id.required' => 'Kategori Transaksi Wajid Diisi',
            'jumlah_uang.required' => 'Jumlah Uang harap diisi',
            'nama_transaksi.required' => 'Nama Transaksi harap diisi',
        ];
        $this->validate($request, [
            'cat_transaksi_id'=>'required', 
            'jumlah_uang'=>'required', 
            'nama_transaksi'=>'required', 
        ],$messages);

        $kas = new Kas;
        $kas->jenis=$request->jenis;
        $kas->cat_transaksi_id = $request->cat_transaksi_id;
        $kas->nama_transaksi = $request->nama_transaksi;
        $kas->catatan = $request->catatan;
        $kas->penginput = Auth::user()->id;

        if($request->jenis == 'penerimaan'){
           $kas->debit = str_replace(",", "", $request->jumlah_uang);
        }
        if($request->jenis == 'pengeluaran'){
           $kas->kredit = str_replace(",", "", $request->jumlah_uang);
        }

        $kas->save();
        return redirect()->route('admin.kas.index');
    
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
        //
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
        //
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
