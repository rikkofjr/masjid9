@extends('layouts.dashboard')
@section('pageTitle')
Tambah Data ZIS
@endsection

@section('titleBar')
<div class="section-header">
    <h1>Tambah Penerimaan ZIS</h1>

</div>
@endsection

@section('mainContent')
<style type="text/css">
    .number-form {
        text-align: right;
    }
    .mandatory{
        color:#ff0000;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Penerimaan ZIS - {{$todayHijri}}</h4>
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
                {{ Form::open(array('route' => 'admin.zis.store'))}}


                <div class="form-group">
                    {{ Form::label('zis_name', 'Jenis Zakat') }} <b class="mandatory">*</b>
                    {{ Form::select('zis_name', $ZisType, null, array('class'=>'form-control', 'placeholder'=>'Plih Jenis Zakat......')) }}
                    @if($errors->has('zis_name'))
                        <small class="mandatory">{{ $errors->first('zis_name') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::label('atas_nama', 'Atas Nama') }} <b class="mandatory">*</b>
                    {{ Form::text('atas_nama', '', array('class' => 'form-control')) }}
                    @if($errors->has('atas_nama'))
                        <small class="mandatory">{{ $errors->first('atas_nama') }}</small>
                    @endif
                </div>

                <div class="form-group">
                    {{ Form::label('nama_lain', 'Nama Lain') }}
                    {{ Form::textarea('nama_lain', '', array('class' => 'form-control', 'style' => 'height:200px;')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('jumlah_jiwa', 'Jumlah Jiwa') }} <b class="mandatory">*</b>
                    {{ Form::number('jumlah_jiwa', '', array('class' => 'form-control')) }}
                    
                    @if($errors->has('jumlah_jiwa'))
                        <small class="mandatory">{{ $errors->first('jumlah_jiwa') }}</small>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h4>Uang</h4>
                        <hr>
                        <div class="form-group">
                            {{ Form::label('uang', 'Total Uang Zakat') }}
                            {{ Form::text('uang', '', array('class' => 'form-control number-form currency', 'id' =>'tanpa-rupiah')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('uang_infaq', 'Uang Infaq') }}
                            {{ Form::text('uang_infaq', '', array('class' => 'form-control number-form currency1', 'id' =>'tanpa-rupiah1')) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4>Beras - Kg</h4>
                        <hr>
                        <div class="form-group">
                            {{ Form::label('beras', 'Beras Zakat - gunakan titik untuk angka desimal')}}
                            {{ Form::number('beras', '', array(
                                'class' => 'form-control number-form', 
                                'step' => 'any',
                                'placeholder' => '0.0'
                            )) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('beras_infaq', 'Beras Infaq - gunakan titik untuk angka desimal') }}
                            {{ Form::number('beras_infaq', '', array(
                                'class' => 'form-control number-form', 
                                'step' => 'any',
                                'placeholder' => '0.0'
                            )) }}
                        </div>
                    </div>
                </div>
                <br />

                {{ Form::submit('Tambah Data', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}

            </div>
        </div>
    </div>
</div>
@endsection
@section('DynamicScript')
<!--<script src="{{asset ('js/calculate.js')}}"></script>-->
<script src="{{ asset('dashboard/js/cleave.min.js') }}"></script>
<script>
    var cleaveC = new Cleave('.currency', {
        numeral: true,
        delimeter: '.',
        numeralThousandsGroupStyle: 'thousand'
    });
    var cleaveC = new Cleave('.currency1', {
        numeral: true,
        delimeter: '.',
        numeralThousandsGroupStyle: 'thousand'
    });
</script>
@endsection