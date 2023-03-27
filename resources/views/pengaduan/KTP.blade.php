<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Aloha!</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
        font-size:15px;
    }
    html{
        margin:7%
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .coli{
        padding:2px 2px 2px 2px;
    }
    .col{
        padding:3px 2px 3px 12px;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top"><img src="{{url_plug()}}/img/logo2.png" alt="" width="60%"/><hr style="border:double 1px;color:#000;margin:1px"><hr style="margin:0px;border:double 1px;color:#000"></td>
    </tr>

  </table>

  <table width="100%">
    <tr>
        <td align="center"><strong><u>SURAT PENGANTAR</u></strong></td>
    </tr>
    <tr>
        <td align="center"><strong>Nomor: {{$data->nomor_surat}}</strong></td>
    </tr>

  </table><br><br>
  <table width="94%" align="center">
    <tr>
        <td class="coli" colspan="3">Dengan ini Lurah {{kelurahan()}}, Kecamatan {{kecamatan()}} Kota - {{kota()}}, menerangkan dengan sebenarnya bahwa:</td>
    </tr>
    <tr>
        <td class="col" width="30%">Nama</td>
        <td class="col" width="3%">:</td>
        <td class="col">{{$data->mwarga['nama']}}</td>
    </tr>
    <tr>
        <td class="col">Tempat/Tanggal Lahir</td>
        <td class="col">:</td>
        <td class="col">{{$data->mwarga['tempat_lahir']}} ,{{$data->mwarga['tanggal_lahir']}}</td>
    </tr>
    <tr>
        <td class="col">Jenis Kelamin</td>
        <td class="col">:</td>
        <td class="col">{{kelamin($data->mwarga['j_kelamin'])}}</td>
    </tr>
    <tr>
        <td class="col">Agama</td>
        <td class="col">:</td>
        <td class="col">{{$data->mwarga['agama']}}</td>
    </tr>
    <tr>
        <td class="col">Pekerjaan</td>
        <td class="col">:</td>
        <td class="col">{{$data->mwarga->mpekerjaan['pekerjaan']}}</td>
    </tr>
    <tr>
        <td class="col">Nomor KTP</td>
        <td class="col">:</td>
        <td class="col">{{$data->mwarga['nik']}}</td>
    </tr>
    <tr>
        <td class="col">Alamat Lengkap</td>
        <td class="col">:</td>
        <td class="col">{{kelurahan()}} RT/RW {{$data->mwarga['rt']}}/{{$data->mwarga['rw']}}, Kecamatan {{kecamatan()}} Kota - {{kota()}}</td>
    </tr>
    <tr>
        <td class="coli" colspan="3">
            {!!$data->deskripsi!!}
        </td>
    </tr>

  </table>

  <br/>
  <table width="94%" align="center">
        <tr>
            <td align="center" width="67%"></td>
            <td align="center">{{kota()}},{{tanggal_tok($data->pemrosesan)}}<br>Kelurahan {{kelurahan()}}<br>Lurah<br>
            <?php $ttd=nama_lurah().'/'.nip_lurah().'/Approve'.$data->pemrosesan; ?>
            <img src="data:image/png;base64,{!!DNS2D::getBarcodePNG($ttd, 'QRCODE',4,4)!!}" width="40%" alt="barcode"   />
            <br>{{nama_lurah()}}<hr>NIP : {{nip_lurah()}}</td>
        </tr>
    </table>

</body>
</html>