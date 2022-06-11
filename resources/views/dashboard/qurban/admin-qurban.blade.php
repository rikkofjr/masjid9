@extends('layouts.dashboard')
@section('pageTitle')
    Qurban Dashboard
@endsection
@section('DynamicCss')
   <!-- <link rel="stylesheet" href="{{asset('dashboard/vendor/datatables/buttons.dataTables.min.css')}}">-->

@endsection
@section('titleBar')
<div class="section-header">
    <h1>Qurban Dashboard</h1>
	
</div>
@endsection

@section('mainContent')
<!--Row1-->

<!--Row2-->
<style type="text/css">
    .text-format-number{
        text-align:right;
    }
    .dataTables_filter {
    width: 50%;
    float: right;
    text-align: right;
    }
</style>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h4>Semua Data Qurban<br/>
            </div>
            <div class="card-body table-responsive">
                <div class="row">
                    
                    
                </div>
                <br>
                <table class="table table-striped" id="data-table">
                    
                    <thead>
                        <tr>
                            <td>
                                <select data-column="0" class="form-control filter-select" name="" id="">
                                    <option value="" hidden>Pilih Tahun</option>
                                    <option value="">Semua Tahun</option>
                                    @foreach($year as $yearDate)
                                        <option value="{{$yearDate}}">{{$yearDate}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td></td>
                            <td>
                                <select data-column="2" class="form-control filter-select" name="" id="">
                                    <option value="" hidden>Pilih Hewan</option>
                                    <option value="">Semua Hewan</option>
                                    @foreach($jenisHewan as $hewannya)
                                        <option value="{{$hewannya}}">{{$hewannya}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td colspan="5"></td>
                        </tr>
                        <tr>
                            <td>Hijri</td>
                            <td>Tanggal</td>
                            <td>Jenis Hewan</td>
                            <td>Nomor Hewan</td>
                            <td>Atas Nama</td>
                            <td>Nama Lain</td>
                            <td>Permintaan</td>
                            <td>Keterangan</td>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('DynamicScript')
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>

<script src="{{asset('dashboard/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/datatables/buttons.flash.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/datatables/jszip.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('dashboard/vendor/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('dashboard/vendor/datatables/buttons.print.min.js')}}"></script>
        <script>
            $(function(){
                var table = $('#data-table').DataTable({
                    processing: true,
                    serverSide: true,
                    "bInfo" : true,
                    language: {
                        searchPlaceholder: "Cari Data"
                    },
                    dom: 'lBfrtip',
                    buttons: [
                        {extend : 'excel', className : 'btn btn-primary'},
                        {extend : 'pdf', className : 'btn btn-primary'},
                        {extend : 'print', className : 'btn btn-primary'},
                    ],
                    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                    ajax: "{{ route('admin.api.all.qurban.data') }}",
                    columns : [
                        {data:'hijri',name:'hijri', orderable : false},
                        {data:'created_at',name:'created_at', orderable : false},
                        {data:'jenis_hewan',name:'jenis_hewan', orderable : false},
                        {data:'nomor_hewan',name:'nomor_hewan', orderable : false},
                        {data: 'atas_nama', name: 'atas_nama', orderable: false},
                        {data: 'nama_lain', name: 'nama_lain', orderable: false},
                        {data: 'permintaan', name: 'permintaan', orderable: false},
                        {data: 'keterangan', name: 'keterangan', orderable: false},
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