@extends('layouts.dashboard')


@section('pageTitle')
    Laporan ZIS Tahun {{date('Y', strtotime($nowHijri))}} -|| {{$nowHijri->format('Y')}}H / {{$nowMasehi}}M
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<style>
    .text-format-number{
        text-align:right;
    }
</style>
@endsection

@section('titleBar')
<div class="section-header">
    <h1>Laporan ZIS Tahun {{$nowHijri->format('Y')}}H / {{$nowMasehi}}M</h1>
    <div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{ route('admin.zis.create') }}"> <i class="fas fa-pencil-alt"></i> Tambah Data</a>
	</div>
	
</div>
@endsection


@section('mainContent')
             
<div class="row">
@foreach($zisHariIni as $zisHariIni)
    <div class="col-md-6">
        <div class="card card-statistic-2">
            <div class="card-stats">
                <div class="card-stats-title">{{$zisHariIni->jenis_zakat->zis_type}}</div>
                <div class="card-stats-items">
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">{{number_format($zisHariIni->uang_harian)}}</div>
                        <div class="card-stats-item-label">Uang</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">{{number_format($zisHariIni->uang_infaq_harian)}}</div>
                        <div class="card-stats-item-label">Uang <br> Infaq</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">{{$zisHariIni->beras_harian}}</div>
                        <div class="card-stats-item-label">Beras <br><small>kg</small></div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count">{{$zisHariIni->beras_infaq_harian}}</div>
                        <div class="card-stats-item-label">Beras Infaq <br> <small>kg</small></div>
                    </div>
                </div>
            </div>
            <div class="card-icon shadow-primary bg-primary">
                <i class="fas fa-archive"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Jumlah Data Harian</h4>
                </div>
                <div class="card-body">
                    {{$zisHariIni->jumlah_data}}
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>
<div class="row">
	<div class="col-md-9">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan ZIS Tahun Ini</h6>
            </div>
			<div class="card-body">
                <select data-column="9" class="form-control filter-select" name="" id="">
                    <option value="" hidden>Pilih Amil</option>
                    @foreach($namaAmilPenginput as $namaAmil)
                        <option value="{{$namaAmil->data_amil->name}}">{{$namaAmil->data_amil->name}}</option>
                    @endforeach
                </select>
                <br>
				<div class="table-responsive">
                    <table class="table table-striped" id="data-table">
                        
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Tanggal</td>
                                <td>Atas Nama</td>
                                <td>Jenis Zakat</td>
                                <td>Uang Zakat</td>
                                <td>Uang Infaq</td>
                                <td>Beras Zakat</td>
                                <td>Beras Infaq</td>
                                <td>Jiwa</td>
                                <td>Amil</td>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Jenis Zakat</h6>
            </div>
            <div class="card-body">
                @foreach($zisType as $ztp)
                    <a href="{{route('admin.zis.rekap.harian', $ztp->id)}}" class="btn btn-sm btn-success m-1">
                        {{$ztp->zis_type}}
                        <span class="badge badge-transparent">{{$ztp->zis_by_year_count}}</span> 
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('DynamicScript')
		<!-- Specific Page Vendor -->
		<script src="{{asset('dashboard/vendor/datatables/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script>
            $(function(){
                var table = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.api.zis.data.ByThisYear') }}",
                    columns : [
                        {data:'DT_RowIndex',name:'DT_RowIndex'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'atas_nama', name: 'atas_nama', orderable:false},
                        {data: 'id_zis_typex', name: 'id_zis_typex'},
                        {data: 'uang', name: 'uang', className: 'text-format-number'},
                        {data: 'uang_infaq', name: 'uang_infaq', className: 'text-format-number'},
                        {data: 'beras', name: 'beras', className: 'text-format-number'},
                        {data: 'beras_infaq', name: 'beras_infaq', className: 'text-format-number'},
                        {data: 'jumlah_jiwa', name: 'jiwa', className: 'text-format-number'},
                        {data: 'amil', name: 'amil', orderable:false}
                    ]
                });
                $('.filter-select').change(function(){
                    table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
                });
            });
        </script>
@endsection

@section('mainContentPopup')

@endsection
