@extends('layouts.dashboard')
@section('pageTitle')
    Tambah data transaksi kas Masjid
@endsection

@section('DynamicCss')
    <link rel="stylesheet" href="{{asset ('dashboard/vendor/select2/dist/css/select2.min.css')}}">
@endsection

@section('titleBar')
<div class="section-header">
    <h1>Tambah data transaksi kas Masjid</h1>
	<div class="section-header-breadcrumb">
		<a class="btn btn-icon icon-left btn-primary" href="{{ route('admin.kas.index') }}"> <i class="fas fa-arrow-left"></i> Back</a>
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
    .mandatory{
        color:red;
    }
</style>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Pencatatan Tanggal - {{$nowMasehi}}</h4>
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
                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                    <li nav="nav-item">
                        <a class="nav-link active" id="home-tab2" data-toggle="tab" href="#home2" role="tab" aria-controls="home" aria-selected="true">Penerimaan</a>
                    </li>
                    <li nav="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#profile2" role="tab" aria-controls="profile" aria-selected="false">Pengeluaran</a>
                    </li>
                </ul>
                <div class="tab-content tab-bordered" id="myTab3Content">
                    <!--penerimaan-->
                    <div class="tab-pane fade show active" id="home2" role="tabpanel" aria-labelledby="home-tab2">
                        {{ Form::open(array('route' => 'admin.kas.store'))}}
                        
                        {{ Form::hidden('jenis', 'penerimaan') }}


                        <div class="form-group">
                            {{ Form::label('cat_transaksi_id', 'Kategory Transaksi') }}<small class="mandatory">*</small>
                            {{ Form::select('cat_transaksi_id', $kasKategori, null, array('class'=>'form-control select2', 'placeholder'=>'Plih Jenis Kategori......', 'id' => 'selectKategoriPenerimaan')) }}
                            @if($errors->has('cat_transaksi_id'))
                                <small class="mandatory">{{ $errors->first('cat_transaksi_id') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('nama_transaksi', 'Nama Transaksi') }} <small class="mandatory">*</small>
                            {{ Form::text('nama_transaksi', '', array('class'=>'form-control')) }}
                            @if($errors->has('nama_transaksi'))
                                <small class="mandatory">{{ $errors->first('nama_transaksi') }}</small>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('jumlah_uang', 'Jumlah Uang') }}<small class="mandatory">*</small>
                            {{ Form::text('jumlah_uang', '', array('class'=>'form-control number-form currency')) }}
                            @if($errors->has('debit'))
                                <small class="mandatory">{{ $errors->first('debit') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('catatan', 'Catatan') }}
                            {{ Form::textarea('catatan', '', array('class' => 'form-control', 'style' => 'height:200px;')) }}
                        </div>
                        <br/>

                        {{ Form::submit('Tambah Data', array('class' => 'btn btn-primary')) }}

                        {{ Form::close() }}
                    </div>
                    <!--pengeluaran-->
                    <div class="tab-pane fade" id="profile2" role="tabpanel" aria-labelledby="profile-tab2">
                        {{ Form::open(array('route' => 'admin.kas.store'))}}
                        
                        {{ Form::hidden('jenis', 'pengeluaran') }}


                        <div class="form-group">
                            {{ Form::label('cat_transaksi_id', 'Kategori Transaksi')}}<small class="mandatory">*</small>
                            {{ Form::select('cat_transaksi_id', $kasKategori, null, array('class'=>'form-control select2', 'placeholder'=>'Plih Jenis Kategori......', 'id' => 'selectKategoriPengeluaran')) }}
                            @if($errors->has('cat_transaksi_id'))
                                <small class="mandatory">{{ $errors->first('cat_transaksi_id') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('nama_transaksi', 'Nama Transaksi') }}<small class="mandatory">*</small>
                            {{ Form::text('nama_transaksi', '', array('class'=>'form-control')) }}
                            @if($errors->has('nama_transaksi'))
                                <small class="mandatory">{{ $errors->first('nama_transaksi') }}</small>
                            @endif
                        </div>
                        
                        <div class="form-group">
                            {{ Form::label('jumlah_uang', 'Jumlah Uang') }}<small class="mandatory">*</small>
                            {{ Form::text('jumlah_uang', '', array('class'=>'form-control number-form currency1')) }}
                            @if($errors->has('kredit'))
                                <small class="mandatory">{{ $errors->first('debit') }}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('catatan', 'Catatan') }}
                            {{ Form::textarea('catatan', '', array('class' => 'form-control', 'style' => 'height:200px;')) }}
                        </div>
                        <br/>

                        {{ Form::submit('Tambah Data', array('class' => 'btn btn-primary')) }}

                        {{ Form::close() }}
                    </div>
                </div>
            

            
            

            </div>
        </div>
	</div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Tambah Kategori Transaksi</h4> 
            </div>
            <div class="card-body">
                {{ Form::open(array('route' => 'admin.kas-kategori.store'))}}
                    <div class="form-group">
                        {{ Form::label('kategori', 'Kategori') }}
                        {{ Form::text('kategori', '', array('class' => 'form-control')) }}
                    </div>
                {{ Form::submit('Tambah Data', array('class' => 'btn btn-primary')) }}

                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection
@section('DynamicScript')
    <!--<script src="{{asset ('dashboard/vendor/select2/dist/js/select2.full.min.js')}}"></script>-->
    <script src="{{asset ('dashboard/vendor/select2/dist/js/select2.full.min.js')}}"></script>

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
        $(document).ready(function() {
            $('#selectKategoriPenerimaan').select2();
        });
        $(document).ready(function() {
            $('#selectKategoriPengeluaran').select2();
        });
    </script>
    
@endsection