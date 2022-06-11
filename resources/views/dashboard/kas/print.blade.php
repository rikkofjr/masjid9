<html>
    <head>
        <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}" >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" >

        <!-- CSS Libraries -->  

        <!-- Template CSS -->
        <link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('dashboard/css/components.css') }}">
        <style type="text/css">
            @media print{
            * {-webkit-print-color-adjust:exact;}
            .hidden-print,
                .hidden-print * {
                    display: none !important;
                }
            }
            tbody tr{border-bottom:solid 1px #ccc;}
            tbody tr:nth-of-type(odd) { background-color: #fafafa; }
            body{
                background:none;
            }
            .box{
                width:95%;
                padding-top:30px;
                margin:0 auto;
                padding:0 auto;
            }
            .page_break { page-break-before: always;padding-top:30px; }
        </style>
    </head>
    <body>
        <div class="box">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Laporan Kas Masjid</h6> 
                            <button id="btnPrint" class="btn btn-lg btn-primary hidden-print"><i class="fas fa-print"></i>Print</button>
                        </div>
                        <div class="card-body">        
                            <br/> 
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>No</td>
                                            <td>Tanggal</td>
                                            <td>Kategori</td>
                                            <td>Keterangan</td>
                                            <td>Debit</td>
                                            <td>Kredit</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kas as $kasnya)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{\Carbon\Carbon::parse($kasnya->created_at)->format('d/m/Y')}}</td>
                                                <td>{{$kasnya->kategori_transaksi->cat_transaksi}}</td>
                                                <td>{{$kasnya->nama_transaksi}}</td>
                                                <td>{{number_format($kasnya->debit)}}</td>
                                                <td>{{number_format($kasnya->kredit)}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row page_break">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Laporan Dari Data Tersebut</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    Jenis : {{request()->jenis}}<br/>
                                    Kategori : {{ $reqKategori }}<br/>
                                    Periode Tanggal : {{request()->startDate}} - {{request()->endtDate}}<br/>
                                    Tahun : {{request()->tahun}}<br/>
                                    <hr/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    Total Penerimaan
                                    <h2>
                                        {{number_format($totalKasPenerimaan)}}
                                    </h2>
                                </div>
                                <div class="col">
                                    Total Pengeluaran
                                    <h2>
                                        {{number_format($totalKasPengeluaran)}}
                                    </h2>
                                </div>
                                <div class="col">
                                    Selisih
                                    <h2>
                                        {{number_format($totalKasPenerimaan - $totalKasPengeluaran)}}
                                    </h2>                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>
<!-- General CSS Files -->




<script src="{{ asset('dashboard/js/jquery-3.3.1.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" ></script>
  <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"  ></script>
  <script src="{{ asset('dashboard/js/jquery.nicescroll.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('dashboard/js/stisla.js') }}"></script>
