@extends('layouts.dashboard')


@section('pageTitle')
    Laporan Penerimaan
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('titleBar')
<div class="section-header">
    <h1>Laporan Penerimaan</h1>
    <div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{ route('admin.kas.create') }}"> <i class="fas fa-pencil"></i> Tambah Data</a>
	</div>
	
</div>
@endsection


@section('mainContent')
<div class="row">
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Kas Masjid</h6>
            </div>
			<div class="card-body">
                              
                
                <br/> 
				<div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Tanggal</td>
                                <td>Kategori</td>
                                <td>Keterangan</td>
                                <td>Debit</td>
                                <td>Kredit</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kas as $kasnya)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{\Carbon\Carbon::parse($kasnya->created_at)->format('d/m/Y')}}</td>
                                    <td>{{$kasnya->kategori_transaksi->cat_transaksi}}</td>
                                    <td>{{$kasnya->nama_transaksi}}</td>
                                    <td>{{number_format($kasnya->debit)}}</td>
                                    <td>{{number_format($kasnya->kredit)}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-header">
                <h4>Laporan Dari Data Tersebut</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        Jenis : {{request()->jenis}}<br/>
                        Kategori : {{ $reqKategori }}<br/>
                        Periode Tanggal : {{request()->startDate}} - {{request()->endtDate}}<br/>
                        Tahun : {{request()->tahun}}<br/>
                        <hr/>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        Total Penerimaan
                        <h2>
                            {{number_format($totalKasPenerimaan)}}
                        </h2>
                    </div>
                    <div class="col">
                        Total Pengeluaran
                        <h2>
                            {{number_format($totalKasPengeluaran)}}
                        </h2>
                    </div>
                    <div class="col">
                        Selisih
                        <h2>
                            {{number_format($totalKasPenerimaan - $totalKasPengeluaran)}}
                        </h2>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('DynamicScript')
<script src="https://demo.getstisla.com/assets/js/page/forms-advanced-forms.js"></script>
<script src="{{ asset('dashboard/js/cleave.min.js') }}"></script>
@endsection

@section('mainContentPopup')

@endsection
