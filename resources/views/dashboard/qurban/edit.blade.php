@extends('layouts.dashboard')
@section('pageTitle')
    Edit Data Qurban a.n {{$qurban->atas_nama}}
@endsection

@section('titleBar')
<div class="section-header">
    <h1>Edit Data Qurban a.n {{$qurban->atas_nama}}</h1>

</div>
@endsection

@section('mainContent')
<style type="text/css">
    .outerDivFull {
        margin: 0px;
    }

    .switchToggle input[type=checkbox] {
        height: 0;
        width: 0;
        visibility: hidden;
        position: absolute;
    }

    .switchToggle label {
        cursor: pointer;
        text-indent: -9999px;
        width: 300px;
        max-width: 300px;
        height: 30px;
        background: #d1d1d1;
        display: block;
        border-radius: 100px;
        position: relative;
    }

    .switchToggle label:after {
        content: '';
        position: absolute;
        top: 2px;
        left: 2px;
        width: 30px;
        height: 26px;
        background: #fff;
        border-radius: 90px;
        transition: 0.3s;
    }

    .switchToggle input:checked+label,
    .switchToggle input:checked+input+label {
        background: #3e98d3;
    }

    .switchToggle input+label:before,
    .switchToggle input+input+label:before {
        content: 'Tidak Disaksikan';
        position: absolute;
        top: 5px;
        left: 35px;
        width: 1220px;
        height: 26px;
        border-radius: 90px;
        transition: 0.3s;
        text-indent: 0;
        color: #fff;
    }

    .switchToggle input:checked+label:before,
    .switchToggle input:checked+input+label:before {
        content: 'Disaksikan';
        position: absolute;
        top: 5px;
        left: 10px;
        width: 130px;
        height: 26px;
        border-radius: 90px;
        transition: 0.3s;
        text-indent: 0;
        color: #fff;
    }

    .switchToggle input:checked+label:after,
    .switchToggle input:checked+input+label:after {
        left: calc(100% - 2px);
        transform: translateX(-100%);
    }

    .switchToggle label:active:after {
        width: 160px;
    }

    .toggle-switchArea {
        margin: 10px 0 10px 0;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Tanggal Input | {{$qurban->created_at->format('d-m-Y H:i:s')}}</h4>
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
                {{ Form::model($qurban, array('route' => array('admin.qurban.update', $qurban->id), 'method' => 'PUT')) }}
                <div class="form-group">
                    Jenis Hewan <b style="color:red;">*</b>
                    <select name="jenis_hewan" id="">
                        <option value="{{$qurban->jenis_hewan}}" hidden>{{$qurban->jenis_hewan}}</option>
                        <option value="Kambing">Kambing</option>
                        <option value="Kambing">Sapi</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-8">

                        <div class="form-group">
                            {{ Form::label('atas_nama', 'Atas Nama') }} <b style="color:red;">*</b>
                            {{ Form::text('atas_nama', null, array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('nama_lain', 'Atas Nama Lain') }}
                            {{ Form::textarea('nama_lain', null, array('class' => 'form-control', 'style' => 'height:150px;')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('alamat', 'Alamat') }}<b style="color:red;">*</b>
                            {{ Form::textarea('alamat', null, array('class' => 'form-control', 'style' => 'height:150px;')) }}
                        </div>

                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            {{ Form::label('permintaan', 'Permintaan') }}<b style="color:red;">*</b>
                            {{ Form::textarea('permintaan', null, array('class' => 'form-control', 'style' => 'height:150px;')) }}
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('nomor_handphone', 'Nomor Handphone') }}<b style="color:red;">*</b><br/>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        +62
                                    </div>
                                </div>
                                <input type="text" value="{{$qurban->nomor_handphone}}" name="nomor_handphone" class="form-control currency">
                            </div>
                        </div>
                        <br />Keterangan Disaksikan
                        <select name="disaksikan" id="">
                            <option value="{{$qurban->disaksikan}}" hidden>{{$qurban->disaksikan}}</option>
                            <option value="Disaksikan">Disaksikan</option>
                            <option value="Tidak Disaksikan">Tidak Disaksikan</option>
                        </select>
                        <div class="form-group">
                            {{ Form::label('keterangan', 'Keterangan Catatan') }}
                            {{ Form::textarea('keterangan', null, array('class' => 'form-control', 'style' => 'height:50px;')) }}
                        </div>
                        
                    </div>
                </div>
                <b style="color:red;">*</b> Wajib diisi
                {{ Form::submit('Rubah Data', array('class' => 'col-md-12 btn btn-primary')) }}
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
  numeralThousandsGroupStyle: 'thousand'
});
</script>
@endsection