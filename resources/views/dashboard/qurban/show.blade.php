@extends('layouts.dashboard')


@section('pageTitle')
Qurban Atas Nama : {{$qurban->atas_nama}}
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->

@endsection

@section('titleBar')
<div class="section-header">
    <h4>Qurban Atas Nama : {{$qurban->atas_nama}}</h4>
    <div class="section-header-breadcrumb">
        <a class="btn btn-icon icon-left btn-primary" href="{{ route('admin.qurban.index') }}"> <i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

</div>
@endsection


@section('mainContent')
<!--Row1-->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Qurban Atas Nama : {{$qurban->atas_nama}}</h4>
                @if($qurban->jenis_hewan == 'Sapi')
                    <img src="{{asset('img/svg/sapi.svg')}}">
                @endif
                @if($qurban->jenis_hewan == 'Kambing' || $qurban->jenis_hewan == 'Domba')
                    <img src="{{asset('img/svg/kambing.svg')}}">
                @endif
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <b>Atas Nama</b> : {{$qurban->atas_nama}}<br />
                            <b>Nomor Handphone </b> : +{{$qurban->nomor_handphone}}<br />
                            <b>Alamat </b> : {{$qurban->alamat}}
                        </td>
                        <td>
                            <b>Jenis Hewan</b> : {{$qurban->jenis_hewan}}
                            <br>
                            <b>Nomor Hewan</b> : {{$qurban->nomor_hewan}}
                        </td>
                    </tr>
                    <tr>
                        <td><b>Nama Lain :</b> <br />{!! nl2br(e($qurban->nama_lain)) !!}</td>
                        <td><b>Permintaan :</b> <br />{!! nl2br(e($qurban->permintaan)) !!}</td>
                    </tr>
                    <tr>
                        <td>Keterangan : {{$qurban->keterangan}}</td>
                        <td colspan="3">
                            Penerima : {{$qurban->data_amil->name}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Kode :
                            <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($qurban->id, 'QRCODE')}}" alt="barcode" />
                        </td>
                    </tr>
                </table>
                <br>

                </a>
                <a href="{{route('admin.qurban.edit', $qurban->id)}}" class="btn btn-primary btn-icon-split" target="_blank">
                    <span class="icon text-white-50">
                        <i class="fas fa-pen"></i>
                    </span>
                    <span class="text">Edit</span>
                </a>
                <a href="{{route('admin.print.qurban.jamaah', $qurban->id)}}" class="btn btn-primary btn-icon-split" target="_blank">
                    <span class="icon text-white-50">
                        <i class="fas fa-print"></i>
                    </span>
                    <span class="text">Print</span>
                </a>
                <a href="https://api.whatsapp.com/send?phone={{$qurban->nomor_handphone}}&text={{$textWhatsapp}}" target="_blank" class="btn btn-success">
                    <i class="fab fa-whatsapp text-white-50"></i>
                    Hubungi
                </a>
                
                @can('outsource-delete')

                <form method="POST" action="{{route('admin.softdelete.qurban', $qurban->id)}}">
                    @csrf
                    <input name="_method" type="hidden" value="DELETE">
                    <button type="submit" class="m-1 btn btn-xs btn-danger btn-flat show_delete_confirm" data-toggle="tooltip">Hapus</button>
                </form>
                @endcan

            </div>
        </div>
    </div>
</div>
@endsection
@section('DynamicScript')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript">
    $('.show_delete_confirm').click(function(event) {
        var form = $(this).closest("form");
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
@endsection

@section('mainContentPopup')

@endsection