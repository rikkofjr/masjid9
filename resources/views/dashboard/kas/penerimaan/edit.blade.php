@extends('layouts.dashboard')
@section('pageTitle')
    Rubah Data :  {{$kasPenerimaan->keterangan}}
@endsection

@section('titleBar')
<div class="section-header">
    <h1>Rubah Penerimaan :  {{$kasPenerimaan->keterangan}}</h1>
    <div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{ route('admin.kas-penerimaan.index') }}"> <i class="fas fa-arrow-left"></i> Back</a>
	</div>
	
</div>
@endsection

@section('mainContent')

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
                <h4>Rubah Data - {{$kasPenerimaan->keterangan}} -{{$nowMasehi}}</h4>
            </div>
            <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {{ Form::model($kasPenerimaan, array('route' => array('admin.kas-penerimaan.update', $kasPenerimaan->id), 'method' => 'PUT')) }}


                <div class="form-group">
                    {{ Form::label('keterangan', 'Keterangan') }}
                    {{ Form::text('keterangan', null, array('class'=>'form-control')) }}
                </div>
                
                <div class="form-group">
                    {{ Form::label('penerimaan', 'Jumlah Uang Diterima') }}
                    {{ Form::text('penerimaan', null, array('class'=>'form-control', 'id' =>'tanpa-rupiah')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('catatan', 'Catatan') }}
                    {{ Form::textarea('catatan', null, array('class' => 'form-control')) }}
                </div>
                <br/>

                {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}

            </div>
            <div class="card-footer">
                <small>Tanggal Diterima :{{ Carbon\Carbon::createFromTimeString($kasPenerimaan->created_at)->format('j F, Y : g i a')  }}</small><br/>
                <small>Tanggal Dirubah :{{ Carbon\Carbon::createFromTimeString($kasPenerimaan->updated_at)->format('j F, Y : g i a')  }} oleh {{$kasPenerimaan->data_penginput->name}}</small>

            </div>
        </div>
	</div>
</div>
@endsection
@section('DynamicScript')
    <!--<script src="{{asset ('js/calculate.js')}}"></script>-->
    <script type="text/javascript">
		var tanpa_rupiah = document.getElementById('tanpa-rupiah');
	tanpa_rupiah.addEventListener('keyup', function(e)
	{
		tanpa_rupiah.value = formatRupiah(this.value);
	});
	
	
	/* Fungsi */
	function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split	= number_string.split(','),
			sisa 	= split[0].length % 3,
			rupiah 	= split[0].substr(0, sisa),
			ribuan 	= split[0].substr(sisa).match(/\d{3}/gi);
			
		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
		
		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}
    </script>
    
@endsection