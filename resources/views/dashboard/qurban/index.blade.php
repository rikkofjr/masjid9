@extends('layouts.dashboard')

@section('pageTitle')
    Data Qurban {{$nowHijriYear}}
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('titleBar')
<div class="section-header">
    <h1>Data Qurban {{$nowHijriYear}}</h1>
    <div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{route('admin.qurban.create')}}"> <i class="fas fa-edit"></i> Tambah Data</a>
	</div>
</div>
@endsection

@section('mainContent')
<!--Row1-->
<style type="text/css">
    .number-form{
        text-align:right;
    }
</style>
<!--Row2-->
<div class="row">
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Qurban {{$nowHijriYear}}</h6>
            </div>
			<div class="card-body">
				<div class="tabs">
					<ul class="nav nav-tabs nav-justified">
						<li class="nav-item active">
							<a href="#internal" data-toggle="tab" class="nav-link active text-center" aria-expanded="true"><img src="{{asset('img/svg/kambing.svg')}}" width="20px">&nbsp;  Kambing</a>
						</li>
						<li class="nav-item">
							<a href="#external" data-toggle="tab" class=" nav-link text-center" aria-expanded="false"><img src="{{asset('img/svg/sapi.svg')}}" width="20px">&nbsp; Sapi</a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="internal" class="tab-pane active">
							<br/>
							<h1>Qurban Kambing</h1>
							<br/>
                            <a target="_blank" href="{{route('admin.print.qurbanRekapJamaah', 'Kambing')}}" class="btn-lg btn-primary"><i class="fas fa-print"></i> Print </a>
							<br/>
							<br/>
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="tableKambing" width="100%">
									<thead>
										<tr height="50">
											<!--<td rowspan="2" name="DT_RowIndex" width="10px">No</td>-->
											<td width="20px" name="created_at">Tanggal Input</td>
											<td width="20px" name="DT_RowIndex">No</td>
											<td width="150px" name="nama_pemilik">Nama Pengqurban</td>
											<td name="alamat">Alamat</td>
											<td name="permintaan">Permintaan</td>
											<td name="Disaksikan">Disaksikan</td>
											<td name="keterangan">Keterangan</td>
											<td width="100px" name="id">Action</td>
										</tr>
									</thead>
									
									<tbody>
									
									</tbody>
								</table>
							</div>
						</div>
						<div id="external" class="tab-pane">
							<br/>
							<h1>Qurban Sapi</h1>
							<br/>
                            <a target="_blank" href="{{route('admin.print.qurban.rekap.jamaah', 'Sapi')}}" class="btn-lg btn-primary"><i class="fas fa-print"></i> Print </a>
							<br/>
							<br/>
							<div class="table-responsive">
							<table class="table table-bordered table-striped" id="tableSapi" width="100%">
									<thead>
                                    <tr height="50">
											<!--<td rowspan="2" name="DT_RowIndex" width="10px">No</td>-->
											<td width="20px" name="created_at">Tanggal Input</td>
											<td width="20px" name="DT_RowIndex">No</td>
											<td width="150px" name="nama_pemilik">Nama Pengqurban</td>
											<td name="alamat">Alamat</td>
											<td name="permintaan">Permintaan</td>
											<td name="Disaksikan">Disaksikan</td>
											<td name="keterangan">Keterangan</td>
											<td width="100px" name="id">Action</td>
										</tr>
									</thead>
									
									<tbody>
									
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!-- Modal -->

@endsection
@section('DynamicScript')
		<!-- Specific Page Vendor -->
		<script src="{{asset('dashboard/vendor/datatables/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script>
            $(function(){
                var table = $('#tableKambing').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.api.qurban.kambing.by.this.year') }}",
                    columns : [
                        {data:'created_at',name:'created_at', orderable : false},
                        {data:'nomor_hewan',name:'nomor_hewan', orderable : false},
                        {data: 'atas_nama', name: 'atas_nama', orderable: false},
                        {data: 'alamat', name: 'alamat', orderable: false},
                        {data: 'permintaan', name: 'permintaan', orderable: false},
                        {data: 'disaksikan', name: 'disaksikan', orderable: false},
                        {data: 'keterangan', name: 'keterangan', orderable: false},
                        {data: 'id', name: 'id', orderable: false, searchable:false},
                    ]
                });
            });
            $(function(){
                var table = $('#tableSapi').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.api.qurban.kambing.by.this.year') }}",
                    columns : [
                        {data:'created_at',name:'created_at', orderable : false},
                        {data:'nomor_hewan',name:'nomor_hewan', orderable : false},
                        {data: 'atas_nama', name: 'atas_nama', orderable: false},
                        {data: 'alamat', name: 'alamat', orderable: false},
                        {data: 'permintaan', name: 'permintaan', orderable: false},
                        {data: 'disaksikan', name: 'disaksikan', orderable: false},
                        {data: 'keterangan', name: 'keterangan', orderable: false},
                        {data: 'id', name: 'id', orderable: false, searchable:false},
                    ]
                });
            });
        </script>
@endsection

