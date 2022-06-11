@extends('layouts.dashboard')

@section('pageTitle')
    Data Jamaah
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('titleBar')
<div class="section-header">
    <h1>Alamat Jamaah</h1>
    <div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{route('admin.alamat-jamaah.create')}}"> <i class="fas fa-edit"></i> Tambah Data</a>
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
                <h6 class="m-0 font-weight-bold text-primary">Data Jamaah</h6>
            </div>
			<div class="card-body">
				<div class="tabs">
					<ul class="nav nav-tabs nav-justified">
						<li class="nav-item active">
							<a href="#internal" data-toggle="tab" class="nav-link active text-center" aria-expanded="true"><i class="fa fa-money"></i> internal</a>
						</li>
						<li class="nav-item">
							<a href="#external" data-toggle="tab" class=" nav-link text-center" aria-expanded="false"><i class="fa fa-bookmark"></i> external</a>
						</li>
					</ul>
					<div class="tab-content">
						<div id="internal" class="tab-pane active">
							<br/>
							<h1>Jamaah Dalam Komplek</h1>
							<br/>
							<br/>
							<div class="table-responsive">
								<table class="table table-bordered table-striped" id="tableInternal" width="100%">
									<thead>
										<tr height="50">
											<!--<td rowspan="2" name="DT_RowIndex" width="10px">No</td>-->
											<td width="20px" name="DT_RowIndex"">No</td>
											<td width="150px" name="nama_pemilik">Nama Pemilik</td>
											<td name="alamat">Alamat</td>
											<td name="rt">RT</td>
											<td name="rw">RW</td>
											<td name="anggota_keluarga_count">Jumlah Anggota</td>
											<td name="kategori_jamaah">Kategori</td>
											<td name="action">Action</td>
										</tr>
									</thead>
									
									<tbody>
									
									</tbody>
								</table>
							</div>
						</div>
						<div id="external" class="tab-pane">
							<br/>
							<h1>Jamaah Luar Komplek</h1>
							<br/>
							<br/>
							<div class="table-responsive">
							<table class="table table-bordered table-striped" id="tableExternal" width="100%">
									<thead>
										<tr height="50">
											<!--<td rowspan="2" name="DT_RowIndex" width="10px">No</td>-->
											<td width="20px" name="DT_RowIndex"">No</td>
											<td width="150px" name="nama_pemilik">Nama Pemilik</td>
											<td name="alamat">Alamat</td>
											<td name="rt">RT</td>
											<td name="rw">RW</td>
											<td name="anggota_keluarga_count">Jumlah Anggota</td>
											<td name="kategori_jamaah">Kategori</td>
											<td name="action">Action</td>
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
                var table = $('#tableInternal').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.api.all.jamaah.internal') }}",
                    columns : [
                        {data:'DT_RowIndex',name:'DT_RowIndex'},
                        {data: 'nama_pemilik', name: 'nama_pemilik'},
                        {data: 'alamat', name: 'alamat'},
                        {data: 'rt', name: 'rt'},
                        {data: 'rw', name: 'rw'},
                        {data: 'anggota_keluarga_count', name: 'anggota_keluarga_count'},
                        {data: 'kategori_jamaah', name: 'kategori_jamaah'},
                        {data: 'action', name: 'action'},
                    ]
                });
            });
            $(function(){
                var table = $('#tableExternal').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.api.all.jamaah.internal') }}",
                    columns : [
                        {data:'DT_RowIndex',name:'DT_RowIndex'},
                        {data: 'nama_pemilik', name: 'nama_pemilik'},
                        {data: 'alamat', name: 'alamat'},
                        {data: 'rt', name: 'rt'},
                        {data: 'rw', name: 'rw'},
                        {data: 'anggota_keluarga_count', name: 'anggota_keluarga_count'},
                        {data: 'kategori_jamaah', name: 'kategori_jamaah'},
                        {data: 'action', name: 'action'},
                    ]
                });
            });
        </script>
@endsection

