@extends('layouts.dashboard')


@section('pageTitle')
    Laporan ZIS a.n {{$zis->atas_nama}} Tahun {{$nowHijri}}H / {{$nowMasehi}}M
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->

@endsection

@section('titleBar')
<div class="section-header">
    <h1>Laporan ZIS a.n {{$zis->atas_nama}} Tahun {{$nowHijri}}H / {{$nowMasehi}}M</h1>
    <div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{ route('admin.zis.index') }}"> <i class="fas"></i> Data Zis</a>
	</div>
	
</div>
@endsection


@section('mainContent')
<!--Row1-->

<!--Row2-->
<style type="text/css">
    .number-form{
        text-align:right;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Zakat Atas Nama : {{$zis->atas_nama}}</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-stripped">
                    <tr>
                        <td colspan="3">Atas Nama : {{$zis->atas_nama}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">Jenis Zakat : {{$zis->jenis_zakat->zis_type}}</td>
                    </tr>
                    <tr>
                        <td><b>Uang</b></td>
                        <td><b> Beras</b></td>
                    </tr>
                    <tr width="50%">
                        <td>Zakat : {{number_format($zis->uang)}}</td>
                        <td>Zakat : {{$zis->beras}}</td>
                    </tr>
                    <tr width="50%">
                        <td>Infaq : {{number_format($zis->uang_infaq)}}</td>
                        <td>Infaq : {{$zis->beras_infaq}}</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Penerima : {{$zis->data_amil->name}}
                        </td>
                        <tr>
                        
                        </tr>
                    </tr>
                </table>
                <br>
                <a href="{{route('admin.print.zakat.jamaah', $zis->id)}}" class="btn btn-primary btn-icon-split" target="_blank">
                    <span class="icon text-white-50">
                      <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Print</span>
                </a>
                <a href="{{route('admin.zis.edit', $zis->id)}}" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                      <i class="fas fa-pen"></i>
                    </span>
                    <span class="text">Edit</span>
                </a>
                @can('outsource-delete')
                    <form method="POST" action="{{route('admin.softdelete.zis', $zis->id)}}">
                       @csrf
                       <input name="_method" type="hidden" value="DELETE">
                       <button type="submit" class="m-1 btn btn-xs btn-danger btn-flat show_delete_confirm" data-toggle="tooltip" >Hapus</button>
                    </form>
                @endcan
                
            </div>
        </div>
	</div>
</div>
@endsection
@section('DynamicScript')
<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
@can('outsource-delete')
<script type="text/javascript">
 
 $('.show_delete_confirm').click(function(event) {
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
@endcan
@endsection

@section('mainContentPopup')

@endsection
