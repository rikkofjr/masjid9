@extends('layouts.dashboard')

@section('pageTitle')
    Tambah Data Alamat Jamaah
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('startbootstrap/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

@endsection

@section('titleBar')
<div class="section-header">
    <h1>Tambah Data Alamat Jamaah</h1>
</div>
@endsection

@section('mainContent')

@if (count($errors) > 0)
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
        <div class="card">
            <div class="card-header">
              Tambah Data Jamaah
            </div>
            <div class="card-body">
                {{ Form::open(array('route' => 'admin.alamat-jamaah.store'))}}
                <div class="form-group">
                    <div class="row">
                        <div class="col" style="text-align:center;">
                            -
                            <br/>
                            Sekitar Masjid
                            <br/>
                                {{ Form::radio('kategori_alamat', 'Sekitar Masjid')}}
                        </div>
                        
                        <div class="col" style="text-align:center;">
                            -
                            <br/>
                            Luar Masjid
                            <br/>
                                {{ Form::radio('kategori_alamat', 'Luar Masjid')}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-8">

                        <div class="form-group">
                            {{ Form::label('nama_pemilik', 'Nama Jamaah') }}
                            {{ Form::text('nama_pemilik', '', array('class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('alamat', 'Alamat') }}
                            {{ Form::textarea('alamat', '', array('class' => 'form-control', 'rows' => 4)) }}
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    {{ Form::label('rt', 'RT') }}
                                    {{ Form::number('rt', '', array('class' => 'form-control', 'placeholder' => '00')) }}
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    {{ Form::label('rw', 'RW') }}
                                    {{ Form::number('rw', '', array('class' => 'form-control', 'placeholder' => '00')) }}
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
                            {{ Form::label('kategori_jamaah', 'Kategori Jamaah') }}<br/>
                            <select name="kategori_jamaah" class="form-control">
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

