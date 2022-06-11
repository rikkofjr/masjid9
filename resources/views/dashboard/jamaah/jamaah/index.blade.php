@extends('layouts.dashboard')


@section('pageTitle')
    Jamaah Masjid {{$masjidProfile->nama_masjid}}
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('titleBar')
<div class="section-header">
    <h1>Jamaah Masjid {{$masjidProfile->nama_masjid}}</h1>
    <div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{ route('admin.alamat-jamaah.create') }}"> <i class="fas fa-pencil-alt"></i> Tambah Jamaah</a>
	</div>
	
</div>
@endsection


@section('mainContent')
<div class="row">
	<div class="col-md-9">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Jamaah Masjid {{$masjidProfile->nama_masjid}}</h6>
            </div>
			<div class="card-body">
				<div class="table-responsive">
                    <table class="table table-striped" id="data-table">
                        
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Nama Jamaah</td>
                                <td>Jenis Kelamin</td>
                                <td>Umur</td>
                                <td>Lihat Keluarga</td>
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
                    ajax: "{{ route('admin.api.all.jamaah') }}",
                    columns : [
                        {data:'DT_RowIndex',name:'DT_RowIndex', orderable:false, searchable:false},
                        {data: 'nama', name: 'nama', orderable:false,},
                        {data: 'jenis_kelamin', name: 'jenis_kelamin', orderable:false},
                        {data: 'tanggal_lahir', name: 'tanggal_lahir'},
                        {data: 'action', name: 'action', orderable:false, searchable:false},
                    ]
                });
            });
        </script>
@endsection
