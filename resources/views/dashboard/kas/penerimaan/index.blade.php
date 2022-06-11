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
		<a class="btn btn-icon icon-left btn-primary" href="{{ route('admin.kas-penerimaan.create') }}"> <i class="fas fa-pencil"></i> Tambah Data</a>
	</div>
	
</div>
@endsection


@section('mainContent')
<div class="row">
	<div class="col-md-8">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Penerimaan</h6>
            </div>
			<div class="card-body">
                <select data-column="1" class="form-control filter-select" name="" id="">
                    <option value="" hidden>Pilih Tahun</option>
                    @foreach($tahunPenerimaan as $tahun)
                        <option value="{{$tahun}}">{{$tahun}}</option>
                    @endforeach
                </select>  
                <br/> 
				<div class="table-responsive">
                    <table class="table table-striped" id="data-table">
                        <thead>
                            <tr>
                                <th name="DT_RowIndex">No</th>
                                <th name="created_at">Tanggal</th>
                                <th name="keterangan">Keterangan</th>
                                <th name="penerimaan">Jumlah Uang</th>
                                <th name="Actions">Lihat</th>
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
                Penerimaan<br/>
                <p style="text-align:right;">{{number_format($totalKasPenerimaan)}}</p>
                Pengeluaran<br/>
                <p style="text-align:right;">{{number_format($totalKasPengeluaran)}}</p>
                <hr/>
                Total : {{number_format($totalKasPenerimaan-$totalKasPengeluaran)}}
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
                    ajax: "{{ route('admin.kas-penerimaan.index') }}",
                    columns : [
                        {data:'DT_RowIndex',name:'DT_RowIndex', orderable:'false'},
                        {data: 'created_at', name: 'created_at', orderable:'false'},
                        {data: 'keterangan', name: 'keterangan', orderable:'false'},
                        {data: 'penerimaan', name: 'penerimaan', orderable:'false'},
                        {data: 'action', name: 'action', orderable: 'false', searchable : 'false'},
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
