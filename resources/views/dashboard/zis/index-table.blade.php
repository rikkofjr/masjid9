@extends('layouts.dashboard')


@section('pageTitle')
    Laporan ZIS Tahun {{$nowHijri}}H / {{$nowMasehi}}M
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
    <h1>Laporan ZIS Tahun {{$nowHijri}}H / {{$nowMasehi}}M</h1>
    <div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{ route('admin.kas-penerimaan.create') }}"> <i class="fas fa-pencil"></i> Tambah Data</a>
	</div>
	
</div>
@endsection


@section('mainContent')
<div class="row">
	<div class="col-md-8">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan ZIS Tahun {{$nowHijri}}H / {{$nowMasehi}}M</h6>
            </div>
			<div class="card-body">
				<div class="table-responsive">
                    <table class="table table-striped" id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Atas Nama</th>
                                <th>Jenis Zakat</th>
                                <th>Uang Zakat</th>
                                <th>Uang Infaq</th>
                                <th>Beras Zakat</th>
                                <th>Beras Infaq</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="m-0 font-weight-bold text-primary">Saldo Terhitung</h6>
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
<button type="button" class="btn btn-success btn-sm" id="getEditArticleData">Edit Data</button>'
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
                        {data: 'atas_nama', name: 'atas_nama'},
                        {data: 'id_zis_typex', name: 'id_zis_typex'},
                        {data: 'uang', name: 'uang', className: 'text-format-number'},
                        {data: 'uang_infaq', name: 'uang_infaq', className: 'text-format-number'},
                        {data: 'beras', name: 'beras', className: 'text-format-number'},
                        {data: 'beras_infaq', name: 'beras_infaq', className: 'text-format-number'},
                    ]
                });
            });
        </script>
@endsection

@section('mainContentPopup')
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Details</label>
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control"></textarea>
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
