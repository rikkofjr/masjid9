@extends('layouts.dashboard')
@section('pageTitle')
    Management ZIS
@endsection
@section('DynamicCss')
   <!-- <link rel="stylesheet" href="{{asset('dashboard/vendor/datatables/buttons.dataTables.min.css')}}">-->

@endsection
@section('titleBar')
<div class="section-header">
    <h1>Management ZIS</h1>
	
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
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Semua Data ZIS<br/>
            </div>
            <div class="card-body table-responsive">
                <div class="row">
                    <select data-column="1" class="form-control filter-select" name="" id="">
                        <option value="" hidden>Pilih Tahun</option>
                        <option value="">Semua Tahun</option>
                        @foreach($year as $yearDate)
                            <option value="{{$yearDate}}">{{$yearDate}}</option>
                        @endforeach
                    </select>
                </div>
                <br>
                <table class="table table-striped" id="data-table">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Hijri</td>
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
    <div class="col-md-4">
        <!---Card 1--->
        <div class="card">
            <div class="card-header"><h4>Type Zis</h4></div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            <div class="card-body">
                <div class="row">
                    @can('outsource-delete')
                    <div class="col-8">
                        {{ Form::open(array('route' => 'admin.zis-type.store'))}}
                        <div class="form-group">
                            {{ Form::text('zis_type', '', array('class'=>'form-control', 'placeholder'=>'Contoh : Zakat Fitrah')) }}
                        </div>
                    </div>
                    <div class="col-4">
                        {{ Form::submit('Tambah', array('class' => 'btn btn-primary')) }}
                        {{ Form::close() }}
                    </div>
                    @endcan
                </div>
                <hr/>
                <div class="row">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Type Zakat</td>
                            @can('outsource-delete')
                            <td>Hapus</td>
                            @endcan
                        </tr>
                        @foreach($zisType as $ztp)
                        <tr>
                            <td>{{$ztp->zis_type}}</td>
                            @can('outsource-delete')
                            <td>
                                <form method="POST" action="{{route('admin.zis-type.destroy', $ztp->id)}}">
                                    @csrf
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Hapus</button>
                                </form>
                            </td>
                            @endcan
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
        <!--End Of Card 1--->
        <!--start card 2-->
        <div class="card">
            <div class="card-header"><h4>Arsip Zakat Tahunan</h4></div>
            <div class="card-body">
                @foreach($year as $yearDate)
                    <a href="{{route('admin.print.zakat.tahun', $yearDate)}}" class="btn btn-primary">{{$yearDate}}</a>
                @endforeach
            </div>
        </div>
        <!--end of card 2-->
    </div>
</div>
@endsection
@section('DynamicScript')
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
 
 $('.show_confirm').click(function(event) {
      var form =  $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
          title: 'Anda yakin akan menghapus data?',
          text: "Data akan terhapus secara permanen.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          form.submit();
        }
      });
  });

</script>
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
                    ajax: "{{ route('admin.api.zis.data') }}",
                    columns : [
                        {data:'DT_RowIndex',name:'DT_RowIndex'},
                        {data: 'hijri', name: 'hijri'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'atas_nama', name: 'atas_nama', orderable:false},
                        {data: 'id_zis_typex', name: 'id_zis_typex'},
                        {data: 'uang', name: 'uang', className: 'text-format-number'},
                        {data: 'uang_infaq', name: 'uang_infaq', className: 'text-format-number'},
                        {data: 'beras', name: 'beras', className: 'text-format-number'},
                        {data: 'beras_infaq', name: 'beras_infaq', className: 'text-format-number'},
                        {data: 'jumlah_jiwa', name: 'jumlah_jiwa'},
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