@extends('layouts.dashboard')


@section('pageTitle')
    Laporan Penerimaan Tahun {{$nowMasehi}}
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" name="tai" rel="stylesheet">

@endsection

@section('titleBar')
<div class="section-header">
    <h1>Laporan Penerimaan Tahunan - {{$nowMasehi}}</h1>
	<div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{route('admin.kas-penerimaan.create')}}"> <i class="fas fa-plus"></i> Tambah Data</a>
	</div>
</div>
@endsection

@section('mainContent')
<div class="row">
	<div class="col-md-8">
		main index
	</div>
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Saldo</h6>
            </div>
            <div class="card-body">
                <table border="0">
                    <tr>
                        <td>Total Penerimaan</td>
                        <td>:</td>
                        <td style="text-align:right;">{{number_format($totalKasPenerimaan)}}</td>
                    </tr>
                    <tr>
                        <td>Total Pengeluaran</td>
                        <td>:</td>
                        <td style="text-align:right;">{{number_format($totalKasPengeluaran)}}</td>
                    </tr>
                    <tr>
                        <td><b>Saldo</b></td>
                        <td>:</td>
                        <td style="text-align:right;"><b>{{number_format($totalKasPenerimaan - $totalKasPengeluaran)}}</b></td>
                    </tr>
                </table>
            </div>
        </div>
        <!--Buat uji coba calculate-->
    </div>
</div>
@endsection
@section('DynamicScript')
		<!-- Specific Page Vendor -->
		<script src="{{asset('dashboard/vendor/datatables/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                // init datatable.
                var dataTable = $('#kasPenerimaan').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    pageLength: 5,
                    // scrollX: true,
                    "order": [[ 0, "desc" ]],
                    ajax: '{{ route('admin.api.all.kas.penerimaan') }}',
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'keterangan', name: 'keterangan'},
                        {data: 'penerimaan', name: 'penerimaan',sClass:'text-right'},
                        {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                    ]
                });
            });
		</script>
        <script type="text/javascript">
$(function() {
				$('#kasPenerimaan').DataTable({
					processing: true,
					serverSide: true,
					ajax: "{{route('admin.api.all.kas.penerimaa')}}",
					columns: [
                        {data: 'DT_RowIndex', name:'DT_RowIndex',seacrhable:false, orderable:false},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'keterangan', name: 'keterangan'},
                        {data: 'penerimaan', name: 'penerimaan',sClass:'text-right'},
                        {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
					]
				});
            });
        </script>
@endsection

