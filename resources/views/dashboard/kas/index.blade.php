@extends('layouts.dashboard')


@section('pageTitle')
    Laporan Penerimaan
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset ('dashboard/vendor/select2/dist/css/select2.min.css')}}">

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
	<div class="col-md-8">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Terbaru Kas Masjid</h6>
            </div>
			<div class="card-body">
                <select data-column="1" class="form-control filter-select" name="" id="">
                    <option value="" hidden>Pilih Tahun</option>
                    <option value="" >Semua Tahun</option>
                    @foreach($tahunTransaksi as $tahun)
                        <option value="{{$tahun}}">{{$tahun}}</option>
                    @endforeach
                </select>  <br/>
                <select data-column="2" class="form-control filter-select" name="" id="">
                    <option value="" hidden>Pilih Kategori</option>
                    <option value="" >Semua Kategori</option>
                    @foreach($kategoriTransaksi as $kategori)
                        <option value="{{$kategori->kategori_transaksi->cat_transaksi}}">{{$kategori->kategori_transaksi->cat_transaksi}}</option>
                    @endforeach
                </select>  
                <br/> 
				<div class="table-responsive">
                    <table class="table table-striped" id="data-table">
                        <thead>
                            <tr>
                                <th name="DT_RowIndex">No</th>
                                <th name="created_at">Tanggal</th>
                                <th name="cat_transaksi_id">Kategori</th>
                                <th name="nama_transaksi">Transksi</th>
                                <th name="debit">Debit</th>
                                <th name="kredit">Kredit</th>
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

        <div class="card">
            <div class="card-header">
                <h6 class="font-weight-bold text-primary">Cari Data Spesifik</h6>
            </div>
            <div class="card-body">
            {{ Form::open(array('route' => 'admin.kas.laporan', 'method' => 'GET'))}}
                <div class="form-group">
                    {{ Form::label('jenis', 'Jenis Transaksi')}}
                    <select name="jenis" id="" class="form-control">
                        <option value="">Semua</option>
                        @foreach($jenisTransaksi as $jenis)
                            <option value="{{$jenis->jenis}}">{{$jenis->jenis}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    {{ Form::label('kategori', 'Kategori Transaksi')}}
                    <select name="kategori" id="kategori" class="form-control select2">
                        <option value="">Semua</option>
                        @foreach($kategoriTransaksi1 as $kategori)
                            <option value="{{$kategori->id}}">{{$kategori->cat_transaksi}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    {{ Form::label('', 'Periode Tanggal')}}<br/>
                    {{ Form::label('startDate', 'Tanggal Awal')}}
                    <input type="date" name="startDate" class="form-control datepicker">
                    {{ Form::label('kategori', 'Tanggal Akhir')}}
                    <input type="date" name="endDate" class="form-control datepicker">
                </div>

                <div class="form-group">
                    {{ Form::label('', 'Pilih Tahun')}}<br/>
                    <small>Gunakan apabila tidak dilakukan pencarian berdasarkan tanggal spesifik</small>
                    <select class="form-control select2" name="tahun" id="tahun">
                        <option value="" hidden>Pilih Tahun</option>
                        <option value="" >Semua Tahun</option>
                        @foreach($tahunTransaksi as $tahun)
                        <option value="{{$tahun}}">{{$tahun}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                {{ Form::submit('Cari Data', array('class' => 'btn btn-primary')) }}
                </div>
            {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@endsection
@section('DynamicScript')
		<!-- Specific Page Vendor -->
		<script src="{{asset('dashboard/vendor/datatables/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset ('dashboard/vendor/select2/dist/js/select2.full.min.js')}}"></script>
        <script>
            $(function(){
                var table = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('admin.kas.index') }}",
                    columns : [
                        {data:'DT_RowIndex',name:'DT_RowIndex', orderable:'false'},
                        {data: 'created_at', name: 'created_at', orderable:'false'},
                        {data: 'cat_transaksi_id', name: 'cat_transaksi_id', orderable:'false'},
                        {data: 'nama_transaksi', name: 'nama_transaksi', orderable:'false'},
                        {data: 'debit', name: 'debit', orderable:'false'},
                        {data: 'kredit', name: 'kredit', orderable:'false'},
                        {data: 'action', name: 'action', orderable: 'false', searchable : 'false'},
                    ]
                });
                $('.filter-select').change(function(){
                    table.column($(this).data('column'))
                    .search($(this).val())
                    .draw();
                });
            });
            $(document).ready(function() {
                $('#kategori').select2();
            });
            $(document).ready(function() {
                $('#tahun').select2();
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
