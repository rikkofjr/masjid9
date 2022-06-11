
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            body{
                font-family:sans-serif;
            }
            .row:after{
                content: "";
                display: table;
                clear: both;
            }
            .col{
                width : 30%;
                float:left;
                padding:10px;
                box-shadow:1px 1px 1px #ccc;
            }
            .table-header-data{
                background:#ccaaaa;
                text-align:center;
            }
            .table-bordered tr td{
                border-bottom: 1px solid #000;
            }
            .table tr:nth-child(even){background-color: #f2f2f2;}
            .page_break { page-break-before: always; }
        </style>
    </head>
    <body>
        <section class="section">
            <div class="section-header">
                <h1 style="text-align:center;">Rekap Data Zakat Tahun {{$year}}H </h1>
            </div>
            <div class="section-body">
                <div class="invoice">
                    <div class="invoice-print">
                        <table width="100%" class="table ">
                            <tr>
                                <td width="5%" class="table-header-data" style="text-align:center;" rowspan="2">No</td>
                                <td width="20%" class="table-header-data" rowspan="2">Tanggal</td>
                                <td width="20%" class="table-header-data" rowspan="2">Nama</td>
                                <td width="20%" class="table-header-data" rowspan="2">Jenis Zakat</td>
                                <td width="25%" class="table-header-data" style="text-align:center;" colspan="2">Jumlah Uang</td>
                                <td width="25%" class="table-header-data" style="text-align:center;" colspan="2">Jumlah Beras</td>
                            </tr>
                            <tr>
                                <td class="table-header-data"">Zakat</td>
                                <td class="table-header-data"">Infaq</td>
                                <td class="table-header-data"">Zakat</td>
                                <td class="table-header-data"">Infaq</td>
                            </tr>
                            <?php $no = 1;?>
                            @foreach($zis as $zias)
                            <tr style="table-border">
                                <td class="table-body" style="text-align:center;">{{$no++}}</td>
                                <td class="table-body">{{date_format($zias->created_at, 'd-m-Y')}}</td>
                                <td class="table-body">{{$zias->atas_nama}}</td>
                                <td class="table-body">{{$zias->jenis_zakat->zis_type}}</td>
                                <td class="table-body" style="text-align:right;">{{number_format($zias->uang)}}</td>
                                <td class="table-body" style="text-align:right;">{{number_format($zias->uang_infaq)}}</td>
                                <td class="table-body" style="text-align:right;">{{$zias->beras}}</td>
                                <td class="table-body" style="text-align:right;">{{$zias->beras_infaq}}</td>
                            </tr>
                            @endforeach
                        </table>

                        <hr/>
                        <div class="page_break">                        
                            <div class="section-title">Rincian Total Zakat {{$year}}H</div>
                            <div class="row">
                                @foreach($zisYear as $zisYear)
                                <div class="col">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>{{$zisYear->jenis_zakat->zis_type}}</h4>
                                        </div>
                                        <div class="card-body">
                                            <table class="table table-bordered" width="100%">
                                                <tr>
                                                    <td colspan="2"><b>Uang</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Uang Zakat</td>
                                                    <td style="text-align:right">{{number_format($zisYear->uang_tahunan)}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Uang Infaq</td>
                                                    <td style="text-align:right">{{number_format($zisYear->uang_infaq_tahunan)}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><b>Beras</b></td>
                                                </tr>
                                                <tr>
                                                    <td>Beras Zakat</td>
                                                    <td style="text-align:right">: {{number_format($zisYear->beras_tahunan)}} kg</td>
                                                </tr>
                                                <tr>
                                                    <td>Uang Infaq</td>
                                                    <td style="text-align:right">{{number_format($zisYear->beras_infaq_tahunan)}} kg</td>
                                                </tr>
                                                
                                            </table>
                                            Jumlah Data Transaksi - {{$zisYear->jumlah_data}} <br/>
                                            Jumlah Jiwa - {{$zisYear->jiwa_tahunan}}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <small>Sumber : {{route('adminPrintZakatTahun', $year)}} </small><br/>
        <small>Tanggal Download : {{Carbon\Carbon::now()->format('j F, Y | H:i:s')}} </small>
    </body>
</html>

