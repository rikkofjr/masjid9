@extends('layouts.dashboard')

@section('pageTitle')
    Rubah Alamat Jamaah | {{$aj->nama_pemilik}}
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('startbootstrap/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('titleBar')
<div class="section-header">
    <h1>Rubah Alamat Jamaah | {{$aj->nama_pemilik}}</h1>
    <div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{ route('admin.alamat-jamaah.show', $aj->id) }}"> <i class="fas fa-arrow-left"></i> Back</a>
	</div>
</div>
@endsection

@section('mainContent')

<style type="text/css">
    .outerDivFull { margin:0px; } 

.switchToggle input[type=checkbox]{height: 0; width: 0; visibility: hidden; position: absolute; }
.switchToggle label {cursor: pointer; text-indent: -9999px; width: 300px; max-width: 300px; height: 30px; background: #d1d1d1; display: block; border-radius: 100px; position: relative; }
.switchToggle label:after {content: ''; position: absolute; top: 2px; left: 2px; width: 30px; height: 26px; background: #fff; border-radius: 90px; transition: 0.3s; }
.switchToggle input:checked + label, .switchToggle input:checked + input + label  {background: #3e98d3; }
.switchToggle input + label:before, .switchToggle input + input + label:before {content: 'Tidak Disaksikan'; position: absolute; top: 5px; left: 35px; width: 1220px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
.switchToggle input:checked + label:before, .switchToggle input:checked + input + label:before {content: 'Disaksikan'; position: absolute; top: 5px; left: 10px; width: 130px; height: 26px; border-radius: 90px; transition: 0.3s; text-indent: 0; color: #fff; }
.switchToggle input:checked + label:after, .switchToggle input:checked + input + label:after {left: calc(100% - 2px); transform: translateX(-100%); }
.switchToggle label:active:after {width: 160px; } 
.toggle-switchArea { margin: 10px 0 10px 0; }



</style>
@if ($errors->any())
    <div class="container">      
        <div class="alert alert-danger">
            <em> {{ implode('', $errors->all(':message')) }}</em>
         </div>
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              Tambah Data Jamaah
            </div>
            <div class="card-body">
            {{ Form::model($aj, array('route' => array('admin.alamat-jamaah.update', $aj->id), 'method' => 'PUT')) }}
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-8">

                        <div class="form-group">
                            {{ Form::label('nama_pemilik', 'Nama Jamaah') }}
                            {{ Form::text('nama_pemilik',null , array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('alamat', 'Alamat') }}
                            {{ Form::textarea('alamat', null, array('class' => 'form-control', 'rows' => 4)) }}
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ Form::label('rt', 'RT') }}
                                    {{ Form::number('rt',null, array('class' => 'form-control', 'placeholder' => '00')) }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    {{ Form::label('rw', 'RW') }}
                                    {{ Form::number('rw', null, array('class' => 'form-control', 'placeholder' => '00')) }}
                                </div>
                            </div>
                        </div>
                        
                    
                        <!--<div id="radios">
                            <label for="driving" class="material-icons">
                                <input type="radio" name="mode" id="driving" value="driving" checked/>
                                <span>
                                    <i class="fas fa-people-carry"></i></span>
                            </label>								
                            <label for="cycling" class="material-icons">
                                <input type="radio" name="mode" id="cycling" value="cycling" />
                                <span>&#xE52F;</span>
                            </label>
                            <label for="walking" class="material-icons">
                                <input type="radio" name="mode" id="walking" value="walking" />
                                <span>&#xE536;</span>
                            </label>
                        </div>--->

                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div class="form-group">
                            {{ Form::label('kategori_alamat', 'Kategori Alamat') }}<br/>
                            <select name="kategori_alamat" class="form-control">
                                <option value="{{$aj->kategori_alamat}}" seelcted hidden>{{$aj->kategori_alamat}}</option>
                                <option value="Sekitar Masjid">Sekitar Masjid</option>
                                <option value="Luar Masjid">Luar Masjid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            {{ Form::label('kategori_jamaah', 'Kategori Jamaah') }}<br/>
                            <select name="kategori_jamaah" class="form-control">
                                <option value="{{$aj->kategori_jamaah}}" seelcted hidden>{{$aj->kategori_jamaah}}</option>
                                <option value="Jamaah Biasa">Jamaah Biasa</option>
                                <option value="Donatur">Donatur</option>
                                <option value="Mustahiq">Mustahiq</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{ Form::submit('Add', array('class' => 'col-md-12 btn btn-primary')) }}
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('DynamicScript')
        
@endsection

