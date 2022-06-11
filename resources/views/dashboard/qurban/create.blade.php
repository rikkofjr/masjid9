@extends('layouts.dashboard')
@section('pageTitle')
Tambah Data Penerimaan Qurban
@endsection

@section('titleBar')
<div class="section-header">
    <h1>Tambah Data Penerimaan Qurban</h1>

</div>
@endsection

@section('mainContent')


<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Penerimaan Qurban - {{$nowMasehiDate}} | {{$nowHijriYear}}</h4>
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
                {{ Form::open(array('route' => 'admin.qurban.store'))}}
                <div class="form-group">
                    Jenis Hewan <b style="color:red;">*</b>
                    <div class="selectgroup w-100">
                        <label class="selectgroup-item">
                            <input type="radio" name="jenis_hewan" value="Kambing" class="selectgroup-input" checked="">
                            <span class="selectgroup-button" style="height:100px;"><img src="{{asset('img/svg/kambing.svg')}}"><br/>Kambing</span>
                        </label>
                        <label class="selectgroup-item">
                            <input type="radio" name="jenis_hewan" value="Sapi" class="selectgroup-input">
                            <span class="selectgroup-button" style="height:100px;"><img src="{{asset('img/svg/sapi.svg')}}"><br/>Sapi</span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-8">

                        <div class="form-group">
                            {{ Form::label('atas_nama', 'Atas Nama') }} <b style="color:red;">*</b>
                            {{ Form::text('atas_nama', '', array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('nama_lain', 'Atas Nama Lain') }}
                            {{ Form::textarea('nama_lain', '', array('class' => 'form-control', 'style' => 'height:150px;')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('alamat', 'Alamat') }}<b style="color:red;">*</b>
                            {{ Form::textarea('alamat', '', array('class' => 'form-control', 'style' => 'height:150px;')) }}
                        </div>

                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            {{ Form::label('permintaan', 'Permintaan') }}<b style="color:red;">*</b>
                            {{ Form::textarea('permintaan', '', array('class' => 'form-control', 'style' => 'height:150px;')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('nomor_handphone', 'Nomor Whatsapp') }}<b style="color:red;">*</b><br />
                            <small>Jika tidak ada Whatsapp tulis nomor handphone & tulis diketerangan "HP" </small>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        +62
                                    </div>
                                </div>
                                <input type="text" name="nomor_handphone" placeholder="812xxxx" class="form-control currency">
                            </div>
                        </div>
                        <br />Keterangan Disaksikan
                        <select name="disaksikan" id="">
                            <option value="Disaksikan">Disaksikan</option>
                            <option value="Tidak Disaksikan">Tidak Disaksikan</option>
                        </select>
                        <br/>
                        <div class="form-group">
                            {{ Form::label('keterangan', 'Keterangan Catatan') }}
                            {{ Form::textarea('keterangan', '', array('class' => 'form-control', 'style' => 'height:50px;')) }}
                        </div>

                    </div>
                </div>
                <b style="color:red;">*</b> Wajib diisi
                {{ Form::submit('Tambah Data', array('class' => 'col-md-12 btn btn-primary')) }}
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