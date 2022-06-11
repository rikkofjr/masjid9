<style type="text/css">
    @media print {
    .hidden-print,
        .hidden-print * {
            display: none !important;
        }
    }
    h1{
        font-family:sans-serif;
        color:#ff0000;
        font-size:30px;
    }
    /*Paper Size*/
    .box{
        width:215px;
        border: solid 0.3px #000;
        font: 10px Arial, sans-serif;

    }
    .table-header{
        border-bottom:solid 1px #e3e6f0;
        padding: 5px 0px;
        font-family:sans-serif;
    }
    .table-header-data{
        background-color:#e3e6f0;
        font-family:sans-serif;
    }
    .table-body{
        border-bottom:solid 1px #e3e6f0;
        font-family:sans-serif;
    }
    .table td{
        border-bottom:solid 1px #ccc;
        font: 10px Arial, sans-serif;
    }
    .button1{
        background-color:#394EEA;
        padding:5px 10px;
        color:#fff;
        border:none;
        width:100%;
        font-size:20px;
    }
    .button1:hover{
        background-color:#394BBA;
    }

</style>
<div class="box">
    <table class="table" width="100%">
        <tr>
            <td colspan="2" style="text-align:center"><b>Panitia Qurban Masjid <br/>{{$dataMasjid->nama_masjid}} <br/>Faktur Qurban {{date('Y', strtotime($dataQurban->hijri))}}</b></td>
        </tr>
        <tr>
            <td colspan="2">No : <b>{{$dataQurban->nomor_hewan}} </b> | {{$dataQurban->disaksikan}}</td>
        </tr>
        <tr>
            <td>Atas Nama </td>
            <td>: {{$dataQurban->atas_nama}}</td>
        </tr>
        <tr>
            <td valign="top">Nama Lain</td>
            <td>:{!! nl2br(e($dataQurban->nama_lain)) !!}</td>
        </tr>
        <tr>
            <td valign="top">Alamat</td>
            <td>: {{$dataQurban->alamat}}</td>
        </tr>
        <tr>
            <td valign="top">Permintaan</td>
            <td>: {!! nl2br(e($dataQurban->permintaan)) !!}</td>
        </tr>
    </table>
    
    <img style="opacity: 9;margin:0 auto;" src="data:image/png;base64,{{DNS2D::getBarcodePNG(route('admin.qurban.show', $dataQurban->id), 'QRCODE')}}" alt="barcode" />

    <hr>
    Keterangan : {{$dataQurban->keterangan}} <br/>
    Penerima : {{$dataQurban->data_amil->name}}<br/>
    Tanggal Input : {{date('d-m-Y', strtotime($dataQurban->created_at))}}
</div>
<br/>
<button id="btnPrint" class="hidden-print button1">Print</button>
<script>
    const $btnPrint = document.querySelector("#btnPrint");
    $btnPrint.addEventListener("click", () => {
        window.print();
    });
</script>


