@extends('layouts.dashboard')

@section('pageTitle')
    Rumah Jamaah - {{$alamatjamaah->nama_pemilik}} 
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('startbootstrap/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('titleBar')
<div class="section-header">
    <h1>Rumah Jamaah - {{$alamatjamaah->nama_pemilik}} </h1>
	<div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{ route('admin.alamat-jamaah.index') }}"> <i class="fas fa-arrow-left"></i> Back</a>
	</div>
</div>
@endsection

@section('mainContent')
<style type="text/css">
#radios label {
	cursor: pointer;
	position: relative;
}

#radios label + label {
	margin-left: 15px;
}

input[type="radio"] {
	opacity: 0; /* hidden but still tabable */
	position: absolute;
}

input[type="radio"] + span {
	font-family: arial;
	color: #B3CEFB;
	border-radius: 0%;
	padding: 10px;
	padding-top: 10px;
	transition: all 0.4s;
	-webkit-transition: all 0.4s;
}

input[type="radio"]:checked + span {
	color: #D9E7FD;
  background-color: #4285F4;
}

input[type="radio"]:focus + span {
	color: #fff;
}
#radios label:hover::before {
	content: attr(for);
	font-family: Roboto, -apple-system, sans-serif;
	text-transform: capitalize;
	font-size: 11px;
	position: absolute;
	top: 100%;
	left: 0;
	right: 0;
	opacity: 0.75;
	background-color: #323232;
	color: #fff;	
	padding: 5px;
	border-radius: 3px;
  display: block;
  width:90px;
  text-align:center;
}
.font-size{
    font-size:20px;
}
</style>
<!--Row2-->
@if (Session::has('hapus'))
   <div class="alert alert-info">Data Berhasil Dihapus</div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
                <div class="row">
                    <div class="col"><h6 class="m-0 font-weight-bold text-primary">Rumah Jamaah - {{$alamatjamaah->nama_pemilik}} </h6></div>
                </div>
            </div>
			<div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-md-4">Nama</div>
                            <div class="col-md-8">{{$alamatjamaah->nama_pemilik}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Alamat</div>
                            <div class="col-md-8">
                                {{$alamatjamaah->alamat}}<br/>
                            RT {{$alamatjamaah->rt}} / RW {{$alamatjamaah->rw}}    
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-md-4">Kategori Jamaah</div>
                            <div class="col-md-8">{{$alamatjamaah->kategori_jamaah}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">ID</div>
                            <div class="col-md-8">{{$alamatjamaah->id}}</div>
                        </div>
                    </div>
                </div>
                <div class="row table-responsive">
                    <table class="table">
                        <tr>
                            <td>No</td>
                            <td>Nama</td>
                            <td>Umur</td>
                            <td>Delete</td>
                        </tr>
                        <?php $no = 1; ?>
                        @foreach($datajamaah as $dj)
                        <tr>
                            <td>{{$no++}}</td>
                            <td>{{$dj->nama}}</td>
                            <td>{{date("Y") - date("Y" ,strtotime($dj->tanggal_lahir))}}</td>
                            <td>
                            @can('outsource-delete')
                            <form method="POST" action="{{route('admin.soft.delete.jamaah', $dj->id)}}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="m-1 btn btn-xs btn-danger btn-flat jamaah_delete_confirm" data-toggle="tooltip" >Hapus</button>
                            </form>
                            @endcan
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Tambah Anggota Keluarga <i class="fas fa-user"></i>
                </button>
                <a target="_blank"href="{{route('admin.print.keluarga', $alamatjamaah->id)}}" class="btn btn-primary">
                    Print <i class="fas fa-print"></i>
                </a>
                <a href="{{route('admin.alamat-jamaah.edit', $alamatjamaah->id)}}" class="btn btn-success">
                    edit <i class="fas fa-edit"></i>
                </a>
                @can('outsource-delete')
                <div class="section-header-breadcrumb">
                    <form method="POST" action="{{route('admin.softdelete.keluarga', $alamatjamaah->id)}}">
                       @csrf
                       <input name="_method" type="hidden" value="DELETE">
                       <button type="submit" class="m-1 btn btn-xs btn-danger btn-flat keluarga_delete_confirm" data-toggle="tooltip" >Hapus</button>
                    </form>
                </div>
                @endcan
			</div>
		</div>
	</div>
</div>

@endsection

@section('mainContentPopup')
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jamaah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Form::open(array('route' => 'admin.data-jamaah.store'))}}
                <div class="form-group">
                    {{ Form::label('nama', 'Nama Jamaah') }}
                    {{ Form::text('nama', '', array('class' => 'form-control')) }}
                    {{ Form::hidden('id_alamat_jamaah', $alamatjamaah->id) }}
                </div>
                {{ Form::label('jenis_kelamin', 'Jenis Kelamin') }}<br/><br/>
                    <div id="radios">
                            <label for="Pria" class="material-icons">
                                <input type="radio" name="jenis_kelamin" id="Pria" value="Pria" checked/>
                                <span>
                                    <i class="fas fa-male fa-2x"></i> Pria
                                </span>
                                <br/>
                            </label>								
                            <label for="Wanita" class="material-icons">
                                <input type="radio" name="jenis_kelamin" id="Wanita" value="Wanita" />
                                <span>
                                    <i class="fas fa-female fa-2x"></i> Wanita
                                </span>
                                <br/>
                            </label>
                        </div>


                <div class="form-group">
                    {{ Form::label('tanggal_lahir', 'Tanggal Lahir') }}
                    {{ Form::date('tanggal_lahir', '', array('class' => 'form-control')) }}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                {{ Form::submit('Tambah', array('class' => 'btn btn-primary')) }}
                {{ Form::close() }}
            </div>
            </div>
        </div>
    </div>
@endsection

@section('DynamicScript')
		<!-- Specific Page Vendor -->
		<script src="{{asset('startbootstrap/vendor/datatables/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('startbootstrap/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
        
        <script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
        
        @can('outsource-delete')
        <script type="text/javascript">
            $('.jamaah_delete_confirm').click(function(event) {
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    title: 'Anda yakin akan menghapus data?',
                    text: "Identitas jamaah akan dihapus.",
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
        <script type="text/javascript">
            $('.keluarga_delete_confirm').click(function(event) {
                var form =  $(this).closest("form");
                var name = $(this).data("name");
                event.preventDefault();
                swal({
                    title: 'Anda yakin akan menghapus data?',
                    text: "Semua anggota keluarga {{$alamatjamaah->nama_pemilik}} akan terhapus.",
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

