@extends('layouts.dashboard')


@section('pageTitle')
    Rekap Laporan {{$zisType[0]->zis_type}}
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
    <h1>Rekap Laporan {{$zisType[0]->zis_type}}</h1>
    <div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{ url()->previous() }}"> <i class="fas fa-arrow-left"></i> Kembali</a>
	</div>
	
</div>
@endsection


@section('mainContent')
<div class="row">
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Harian {{$zisType[0]->zis_type}} Tahun {{$nowHijri}}H / {{$nowMasehi}}M</h6>
            </div>
			<div class="card-body">
				<div class="table-responsive">

                    <table class="table table-striped" id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Uang Zakat</th>
                                <th>Uang Infaq</th>
                                <th>Beras Zakat</th>
                                <th>Beras Infaq</th>
                                <th>Jiwa</th>
                            </tr>
                        </thead>
                        @foreach($zisHarian as $zis)
                        <tbody>
                            <td width="10px" style="width:20px;">{{$loop->iteration}}</td>
                            <td>{{date('d-m-Y', strtotime($zis->date))}}</td>
                            <td style="text-align:right">{{number_format($zis->uang_harian)}}</td>
                            <td style="text-align:right">{{number_format($zis->uang_infaq_harian)}}</td>
                            <td style="text-align:right">{{$zis->beras_harian}}</td>
                            <td style="text-align:right">{{$zis->beras_infaq_harian}}</td>
                            <td style="text-align:right">{{$zis->jiwa_harian}}</td>
                        </tbody>
                        @endforeach
                        <tfoot style="background-color:#ccc;">
                            <td colspan="2"><h4>Total</h4></td>
                            <td style="text-align:right">{{number_format($jumlahUangTotal)}}</td>
                            <td style="text-align:right">{{number_format($jumlahUangInfaqTotal)}}</td>
                            <td style="text-align:right">{{$jumlahBerasTotal}}</td>
                            <td style="text-align:right">{{$jumlahBerasInfaqTotal}}</td>
                            <td style="text-align:right">{{$jumlahJiwaTotal}}</td>
                        </tfoot>
                    </table>
                </div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Tahunan</h6>
            </div>
			<div class="card-body">
				<div class="table-responsive">
                    <table class="table table-striped" id="data-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Uang Zakat</th>
                                <th>Uang Infaq</th>
                                <th>Beras Zakat</th>
                                <th>Beras Infaq</th>
                                <th>jiwa</th>
                            </tr>
                        </thead>
                        @foreach($zisTahunan as $zisTahunan)
                        <tbody>
                            <td width="10px" style="width:20px;">{{$loop->iteration}}</td>
                            <td>{{$zisTahunan->date}}</td>
                            <td style="text-align:right">{{number_format($zisTahunan->uang_harian)}}</td>
                            <td style="text-align:right">{{number_format($zisTahunan->uang_infaq_harian)}}</td>
                            <td style="text-align:right">{{$zisTahunan->beras_harian}}</td>
                            <td style="text-align:right">{{$zisTahunan->beras_infaq_harian}}</td>
                            <td style="text-align:right">{{$zisTahunan->jiwa_harian}}</td>
                        </tbody>
                        @endforeach
                    </table>
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('DynamicScript')
		
@endsection

@section('mainContentPopup')

@endsection
