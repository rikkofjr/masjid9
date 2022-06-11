@extends('layouts.dashboard')


@section('pageTitle')
Selamat Datang pada sistem informasi Masjid {{env('APP_NAME')}}
@endsection

@section('DynamicCss')
<!-- Specific Page Vendor CSS -->
<link href="{{asset('dashboard/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
<style type="text/css">
    .border-bottom{
        border-bottom:solid 0.5px #ccc;
    }
    .card-min-heigt{
        min-height:193px;
    }
</style>
@endsection

@section('titleBar')
<div class="section-header">
    <h1>Selamat Datang pada sistem informasi Masjid {{$masjidProfile->nama_masjid}}</h1>
</div>
@endsection

@section('mainContent')
<livewire:dashboard.dashboard-index /> 
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"> <h4>Profile Masjid</h4> </div>
            <div class="card-body card-min-height">
                <table>
                    <tr class="border-bottom">
                        <td width="80px">Nama</td>
                        <td>{{$masjidProfile->nama_masjid}}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td>Alamat </td>
                        <td>{{$masjidProfile->alamat}}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td>Telepon</td>
                        <td>{{$masjidProfile->nomor_telepon}}</td>
                    </tr>
                    <tr class="border-bottom">
                        <td>Email</td>
                        <td>{{$masjidProfile->email}}</td>
                    </tr>
                </table>
                <br/>
                @if(count(app\Models\User::all()) == 1 || Auth::user()->hasrole('Admin') )
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-pencil-alt"></i> &nbsp;Edit
                </button>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h4>Informasi</h4></div>
            <div class="card-body h-100">Informasi</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header"><h4>Artikel Terbaru</h4></div>
            <div class="card-body card-min-height">Ea</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Admin</h4>
                        </div>
                        <div class="card-body">
                            10
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pimpinan Outsource</h4>
                        </div>
                        <div class="card-body">
                            {{number_format($jumlahOutsourceHead->count())}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Outsource</h4>
                        </div>
                        <div class="card-body">
                        {{number_format($jumlahOutsourceStaf)}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-home"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Rumaah Jamaah</h4>
                        </div>
                        <div class="card-body">
                            {{number_format($jumlahAlamatJamaah)}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Donatur</h4>
                        </div>
                        <div class="card-body">
                            {{number_format($jumlahJamaahDonatur)}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Mustahiq</h4>
                        </div>
                        <div class="card-body">
                            {{number_format($jumlahJamaahMustahiq)}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"> <h4>Penerimaan Masjid {{$masjidProfile->nama_masjid}}</h4> </div>
                    <div class="card-body">
                       <canvas id="myChart" height="182"></canvas>
                       <small>Rekapan</small>
                       <table class="table table-bordered table-md">
                           <tr>
                               <td width="20%">Tahun</td>
                               <td width="80%">Diterima</td>
                           </tr>
                           @foreach($kasPenerimaan as $rekapan)
                                <tr>
                                    <td>{{$rekapan->tahun}}</td>
                                    <td>{{number_format($rekapan->penerimaan)}}</td>
                                </tr>
                           @endforeach
                       </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"> <h4>Pengeluaran Masjid {{$masjidProfile->nama_masjid}}</h4> </div>
                    <div class="card-body">
                        <canvas id="chartPengeluaran" height="182"></canvas>
                        <small>Rekapan</small>
                        <table class="table table-bordered table-md">
                            <tr>
                               <td width="20%">Tahun</td>
                               <td width="80%">Dikeluarkan</td>
                            </tr>
                            @foreach($kasPengeluaran as $rekapan)
                                <tr>
                                    <td>{{$rekapan->tahun}}</td>
                                    <td>{{number_format($rekapan->pengeluaran)}}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('DynamicScript')
<script src="{{asset('dashboard/js/Chart.min.js')}}"></script>

<script>
var statistics_chart = document.getElementById("myChart").getContext('2d');

var myChart = new Chart(statistics_chart, {
  type: 'line',
  data: {
    labels: [
        @foreach($kasPenerimaan as $tahun)
            {{$tahun->tahun}},
        @endforeach
    ],
    datasets: [{
      label: 'Statistics',
      data: [@foreach($kasPenerimaan as $jumlah) {{$jumlah->penerimaan}}, @endforeach],
      borderWidth: 5,
      borderColor: '#6777ef',
      backgroundColor: 'transparent',
      pointBackgroundColor: '#fff',
      pointBorderColor: '#6777ef',
      pointRadius: 4
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        gridLines: {
          display: false,
          drawBorder: false,
        },
        ticks: {
          stepSize: 2000000000,
          callback: function(value, index, values) {
              if(parseInt(value) >= 1000){
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              } else {
                return value;
              }
            }
        }
      }],
      xAxes: [{
        gridLines: {
          color: '#fbfbfb',
          lineWidth: 2
        }
      }]
    },
  }
});
</script>

<script>
var statistics_chart = document.getElementById("chartPengeluaran").getContext('2d');

var myChart = new Chart(statistics_chart, {
  type: 'line',
  data: {
    labels: [
        @foreach($kasPengeluaran as $tahun)
            {{$tahun->tahun}},
        @endforeach
    ],
    datasets: [{
      label: 'Statistics',
      data: [@foreach($kasPengeluaran as $jumlah) {{$jumlah->pengeluaran}}, @endforeach],
      borderWidth: 5,
      borderColor: '#6777ef',
      backgroundColor: 'transparent',
      pointBackgroundColor: '#fff',
      pointBorderColor: '#6777ef',
      pointRadius: 4
    }]
  },
  options: {
    locale:'en-ID',
    legend: {
      display: false,
    },
    scales: {
      yAxes: [{
        gridLines: {
          display: false,
          drawBorder: false,
        },
        ticks: {
            stepSize: 1000000000,
            callback: function(value, index, values) {
              if(parseInt(value) >= 1000){
                return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
              } else {
                return value;
              }
            }
        }
      }],
      xAxes: [{
        gridLines: {
          color: '#fbfbfb',
          lineWidth: 2
        }
      }]
    },
  }
});
</script>

@endsection

@section('mainContentPopup')
@if(count(app\Models\User::all()) == 1 || Auth::user()->hasrole('Admin') )
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Profil Masjid</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                {{ Form::model($masjidProfile, array('route' => array('admin.update.MasjidInfo'), 'method' => 'PUT')) }}
                <div class="form-group">
                    {{ Form::label('nama_masjid', 'Nama Masjid') }} <small style="color:red;">*</small>
                    {{ Form::text('nama_masjid', null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('alamat', 'Alamat') }}<small style="color:red;">*</small>
                    {{ Form::textarea('alamat', null, array('class' => 'form-control', 'style' => 'height:70px;')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('nomor_telepon', 'Nomor Telepon') }}<small style="color:red;">*</small>
                    {{ Form::text('nomor_telepon', null, array('class' => 'form-control')) }}
                </div>
                <small>Apabila tidak ada nomor Telephone bisa diisi dengan nomor Handphone penanggung jawab </small>
                <div class="form-group">
                    {{ Form::label('nomor_handphone', 'Nomor Handphone') }}
                    {{ Form::text('nomor_handphone', null, array('class' => 'form-control')) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', null, array('class' => 'form-control')) }}
                </div>           
                <small style="color:red;">*</small> Wajib diisi 
        </div>
        <div class="modal-footer">
            {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
            {{ Form::close() }}
        </div>
        </div>
    </div>
</div>
@endif

@endsection