<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Auth;
use App\Models\User;
//Plugin
use Carbon\Carbon;
use DataTables;
use PDF;
use DB;
//use spesific models
use App\Models\AlamatJamaah;
use App\Models\DataJamaah;

class AlamatJamaahController extends Controller
{
    public function __construct(){
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alamatJamaahInternal = AlamatJamaah::withCount('anggotaKeluarga')->where('kategori_alamat', 'Sekitar Masjid')->get();
        $alamatJamaahExternal = AlamatJamaah::withCount('anggotaKeluarga')->where('kategori_alamat', 'Luar Masjid')->get();
        //dd($alamatJamaahExternal);
        return view('dashboard.jamaah.alamat.index', compact('alamatJamaahInternal','alamatJamaahExternal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.jamaah.alamat.create');
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
            'nama_pemilik.required' => 'Formulir Nama Pemilik Wajid Diisi',
            'kategori_alamat.required' => 'Formulir Kategori Alamat Jamaah Wajid Diisi',
            'alamat.required' => 'Alamat harap diisi',
            'rt.required' => 'RT harap diisi',
            'rw.required' => 'RW Jiwa harap diisi',
        ];
        $this->validate($request, [
            //'amil'=>'required', 
            'nama_pemilik'=>'required', 
            'kategori_alamat'=>'required', 
            'alamat'=>'required', 
            'rt'=>'required', 
            'rw'=>'required', 
        ],$messages);

        $aj = new AlamatJamaah;
        $aj->nama_pemilik = $request->nama_pemilik;
        $aj->kategori_alamat = $request->kategori_alamat;
        $aj->kategori_jamaah = $request->kategori_jamaah;
        $aj->alamat = $request->alamat;
        $aj->rt = $request->rt;
        $aj->rw = $request->rw;
        $aj->penginput = Auth::user()->id;
        $aj->save();

        return redirect()->route('admin.alamat-jamaah.show', $aj->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alamatjamaah = AlamatJamaah::findOrFail($id);
        $datajamaah = DataJamaah::where('id_alamat_jamaah', $id)->orderBy('tanggal_lahir', 'ASC')->get();
        return view('dashboard.jamaah.alamat.show', compact('alamatjamaah','datajamaah'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aj = AlamatJamaah::findOrFail($id);
        if(Auth::user()->hasPermissionTo('outsource-delete') || ($aj->penginput == Auth::user()->id)){
            return view('dashboard.jamaah.alamat.edit', compact('aj'));
        }else{
            abort(404);
        }

        

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
            'nama_pemilik.required' => 'Formulir Atas Nama Wajid Diisi',
            'kategori_alamat.required' => 'Formulir Kategori Alamat Jamaah Wajid Diisi',
            'alamat.required' => 'Alamat harap diisi',
            'rt.required' => 'RT harap diisi',
            'rw.required' => 'RW Jiwa harap diisi',
        ];
        $this->validate($request, [
            //'amil'=>'required', 
            'nama_pemilik'=>'required', 
            'kategori_alamat'=>'required', 
            'alamat','rw','rw'=>'required', 
        ],$messages);

        $aj = AlamatJamaah::findOrFail($id);
        $aj->nama_pemilik = $request->nama_pemilik;
        $aj->kategori_alamat = $request->kategori_alamat;
        $aj->kategori_jamaah = $request->kategori_jamaah;
        $aj->alamat = $request->alamat;
        $aj->rt = $request->rt;
        $aj->rw = $request->rw;
        $aj->editor = Auth::user()->id;
        $aj->save();

        return redirect()->route('admin.alamat-jamaah.show', $aj->id);
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
    public function getJamaahInternal(){
        $data = AlamatJamaah::withCount('anggotaKeluarga')->where('kategori_alamat', 'Sekitar Masjid')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($datanya){
                $btn = '<a class="btn btn-primary btn-sm" href="'.route('admin.alamat-jamaah.show', $datanya->id).'"><i title="Lihat" class="fas fa-eye" style="color:#fff;"></i></a>';
                return $btn;
            })
            ->removeColumn('id','penginput', 'editor','updated_at', 'created_at','deleted_at')
            ->rawColumns(['action'])->make(true);
    }
    public function getJamaahExternal(){
        $data = AlamatJamaah::withCount('anggotaKeluarga')->where('kategori_alamat', 'Luar Masjid')->get();
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action',function($datanya){
                $btn = '<a class="btn btn-primary btn-sm" href="'.route('admin.alamat-jamaah.show', $datanya->id).'"><i title="Lihat" class="fas fa-eye" style="color:#fff;"></i></a>';
                return $btn;
            })
            ->removeColumn('id','penginput', 'editor','updated_at', 'created_at','deleted_at')
            ->rawColumns(['action'])->make(true);
    }
}
