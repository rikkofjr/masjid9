<style type="text/css">
    h1{
        font-family:sans-serif;
        color:#ff0000;
        font-size:30px;
    }
    .table-header{
        border-bottom:solid 1px #e3e6f0;
        margin: 10px 0px;
        font-family:sans-serif;
    }
    .table-header-data{
        background-color:#e3e6f0;
        font-family:sans-serif;
    }
    .table-body{
        border-bottom:solid 1px #e3e6f0;
        font-family:sans-serif;
        font-size: 10px;
    }
    tr:nth-child(even) {
        background-color: rgba(204, 204, 204,0.2);
    }

</style>
<h1 style="text-align:center;">Data Penerimaan {{$jenis_hewan}} Tahun {{$nowHijriYear}} H</h1>
<b style="font-family:sans-serif;">Total Hewan Qurban  : {{count($dataQurban)}}</b>
<table width="100%" valign="top">
    <tr>
        <td width="5%" class="table-header-data" style="text-align:center;" >No</td>
        <td width="20%" class="table-header-data" style="text-align:center;">Atas Nama</td>
        <td width="20%" class="table-header-data" style="text-align:center;">Nama Lain</td>
        <td width="25%" class="table-header-data" style="text-align:center;">Permintaan</td>
        <td width="25%" class="table-header-data" style="text-align:center;">Alamat</td>
        <td width="25%" class="table-header-data" style="text-align:center;">Handphone</td>
        <td width="25%" class="table-header-data" style="text-align:center;">Disaksikan</td>
    </tr>
    @foreach($dataQurban as $qurban)
    <tr>
        <td class="table-body" style="text-align:center;">{{(int)filter_var($qurban->nomor_hewan, FILTER_SANITIZE_NUMBER_INT)}}</td>
        <td class="table-body">{{$qurban->atas_nama}}</td>
        <td class="table-body">{!! nl2br(e($qurban->nama_lain)) !!}</td>
        <td class="table-body">{!! nl2br(e($qurban->permintaan)) !!}</td>
        <td class="table-body">{{$qurban->alamat}}</td>
        <td class="table-body">{{$qurban->nomor_handphone}}</td>
        <td class="table-body">{{$qurban->disaksikan}} <br/> {{$qurban->keterangan}}</td>
    </tr>
    @endforeach
</table>