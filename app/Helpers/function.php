
<?php

function name(){
    return "Kedai PePE";
}
function telepon(){
    return "0254 233795";
}

function bulan($bulan)
{
   Switch ($bulan){
      case '01' : $bulan="Januari";
         Break;
      case '02' : $bulan="Februari";
         Break;
      case '03' : $bulan="Maret";
         Break;
      case '04' : $bulan="April";
         Break;
      case '05' : $bulan="Mei";
         Break;
      case '06' : $bulan="Juni";
         Break;
      case '07' : $bulan="Juli";
         Break;
      case '08' : $bulan="Agustus";
         Break;
      case '09' : $bulan="September";
         Break;
      case 10 : $bulan="Oktober";
         Break;
      case 11 : $bulan="November";
         Break;
      case 12 : $bulan="Desember";
         Break;
      }
   return $bulan;
}

function ubah_bulan($bul){
    if($bul>9){
        return $bul;
    }else{
        return '0'.$bul;
    }
}
function parsing_validator($url){
    $content=utf8_encode($url);
    $data = json_decode($content,true);
 
    return $data;
}
function kelurahan(){
    return "Deringo";
}
function nama_lurah(){
    return "DR Cecep";
}
function nip_lurah(){
    return "1101920001";
}
function kecamatan(){
    return "Citangkil";
}
function kota(){
    return "Cilegon";
}
function rekening(){
    return "163000000930300";
}
function phone(){
    return "62 21 5596 1456";
}
function whatsapp(){
    return "62 81 1800 9129";
}
function uang($uang){
    return number_format($uang,0);
}
function encoder($b) {
    $data=base64_encode(base64_encode($b));
    return $data;
 }
 function decoder($b) {
    $data=base64_decode(base64_decode($b));
    return $data;
 }
function hari_tagihan($tgl){
    $pinjam            = $tgl;
    $time        = mktime(0,0,0,date("n"),date("j")+7,date("Y"));
    $data        = date("Y-m-d", $time);
    return $data;
}
function masa_diskon($id){
    $tglmulai=date('Y-m-d');
    $tgl=date('Y-m-d');
    if($tglmulai<=date('Y-m-d') && $tgl>=date('Y-m-d')){
        $tgl1 = new DateTime(date('Y-m-d'));
        $tgl2 = new DateTime($tgl);
        $jarak = $tgl2->diff($tgl1);

        $data=($jarak->d+1);
    }else{
        $data=0;
    }
    return $data;
}



function cek_aktif($id){
    if($id==1){
        return'Aktif';
    }else{
        return'Non Aktif';
    }
}

function cek_sts($id){
    if($id==1){
        return'<span class="label label-info">Perencanaan</span>';
    }
    if($id==2){
        return'<span class="label label-warning">Permintaan</span>';
    }
    if($id==3){
        return'<span class="label label-success">Selesai</span>';
    }
}
function cek_tagihan($nilai1,$nilai2,$sts){
    if($sts==3){
        if($nilai1==$nilai2){
            return'<span class="label label-info">LUNAS</span>';
        }
        else{
            return'<span class="label label-red">HUTANG</span>';
        }
    }else{
        return'-';
    }
}
function cek_metode($id){
    if($id==1){
        return'CASH';
    }
    if($id==2){
        return'TEMPO';
    }
    if($id==3){
        return'-';
    }
}

function diskon($harga,$diskon){
    $data=($harga*$diskon)/100;
    $diskon=($harga-$data);
    return $diskon;

}

function diskon_harga($id,$harga,$diskon){
    if( masa_diskon($id)>0){
        $data=($harga*$diskon)/100;
        $diskon=($harga-$data);
    }else{
        $diskon=$harga;
    }
    
    return $diskon;

}
function tanggal_eng($date=null){
    if($date=="" || $date==null){
       return null;
    }else{
       return date('d M Y H:i:s',strtotime($date));
    }
    
 }
function tanggal_tok($date=null){
    if($date=="" || $date==null){
       return null;
    }else{
       return date('d M Y',strtotime($date));
    }
    
 }
function email(){
    return "Tokosparepart@gmail.com";
}
function url_plug(){
    $data=url('public');
    return $data;
}
function selisih_waktu($waktu1,$waktu2){
    $waktu_awal        =strtotime($waktu1);
    $waktu_akhir        =strtotime($waktu2);
    $diff    =$waktu_akhir - $waktu_awal;
    $jam    =floor($diff / (60 * 60));
    $menit    =$diff - $jam * (60 * 60);
    $data= $jam .  ' Hrs ' . floor( $menit / 60 ) . ' min';
    return $data;
 }
function selisih_waktu_jam($waktu1,$waktu2){
    $waktu_awal        =strtotime($waktu1);
    $waktu_akhir        =strtotime($waktu2);
    $diff    =$waktu_akhir - $waktu_awal;
    $jam    =floor($diff / (60 * 60));
    $menit    =$diff - $jam * (60 * 60);
    $data= $jam;
    return $data;
 }
function gambar(){
    $data=url('public/dist/produk/');
    return $data;
}

function link_artikel($nama){
    $patr='/\s+/';
    $link=preg_replace($patr,'_',$nama);
    return $link;
}
function get_rw(){
    $data=App\Mrw::orderBy('id','Asc')->get();
    return $data;
}
function penomoran($tipe){
    
    $cek=App\Pelayanan::where('tipe',$tipe)->count();
    if($cek>0){
        $depan=strlen($tipe);
        $mst=App\Pelayanan::where('tipe',$tipe)->orderBy('nomor','Desc')->firstOrfail();
        $urutan = (int) substr($mst['nomor'], $depan, 4);
        $urutan++;
        $nomor=$tipe.sprintf("%04s",  $urutan);
    }else{
        $nomor=$tipe.sprintf("%04s",  1);
    }
    return $nomor;
}
function penomoran_pengaduan(){
    
    $cek=App\Pengaduan::count();
    if($cek>0){
        
        $mst=App\Pengaduan::orderBy('nomor_pengaduan','Desc')->firstOrfail();
        $urutan = (int) substr($mst['nomor_pengaduan'], 4, 4);
        $urutan++;
        $nomor=date('ym').sprintf("%04s",  $urutan);
    }else{
        $nomor=date('ym').sprintf("%04s",  1);
    }
    return $nomor;
}
function penomoran_surat($tipe){
    
    $cek=App\Pelayanan::where('tipe',$tipe)->where('status','>',0)->where('bulan',date('m'))->where('tahun',date('Y'))->count();
    if($cek>0){
        $depan=strlen($tipe);
        $mst=App\Pelayanan::where('tipe',$tipe)->where('status','>',0)->where('bulan',date('m'))->where('tahun',date('Y'))->orderBy('nomor_surat','Desc')->firstOrfail();
        $urutan = (int) substr($mst['nomor_surat'], 0, 3);
        $urutan++;
        $nomor=sprintf("%03s",  $urutan).'/'.$tipe.'/'.date('m').'/'.date('Y');
    }else{
        $nomor=sprintf("%03s",  1).'/'.$tipe.'/'.date('m').'/'.date('Y');
    }
    return $nomor;
}
function get_pelayanan(){
    $data=App\Mpelayanan::orderBy('id','Asc')->get();
    return $data;
}
function count_pelayanan(){
    $data=App\Mpelayanan::count();
    $col=(12/$data);
    return $col;
}
function warga(){
    $data=App\Warga::where('nik',Auth::user()->username)->first();
    return $data;
}
function get_mpengaduan(){
    $data=App\Mpengaduan::orderBy('id','Asc')->get();
    return $data;
}
function get_rt(){
    $data=App\Mrt::orderBy('id','Asc')->get();
    return $data;
}
function total_rw($rw){
    $data=App\Warga::where('rw',$rw)->count();
    return $data;
}
function cek_user($nik){
    $data=App\User::where('username',$nik)->count();
    return $data;
}
function nama_pelayanan($id){
    $data=App\Mpelayanan::where('tipe',$id)->first();
    return $data['pelayanan'];
}
function totalpelayanan($id){
    
    $data=App\Pelayanan::where('status',$id)->count();
    return $data;
}
function countpelayanan($id){
    
    $data=App\Pelayanan::where('tipe',$id)->count();
    return $data;
}
function nama_kategori($id){
    $data=App\Mpengaduan::where('id',$id)->first();
    return $data['kategori_pengaduan'];
}
function kelamin($id){
   if($id=='L'){
    return 'Laki-laki';
   }else{
    return 'Perempuan';
   }
}
function status($id){
   if($id=='0'){
    return '<font color="blue">Menunggu Konfirmasi</font>';
   }
   if($id==1){
    return '<font color="green">Pemrosesan Pelayanan</font>';
   }
   if($id==2){
    return '<font color="blue">Selesai/ Pengambilan surat</font>';
   }
   if($id==3){
    return '<font color="red">Ditolak</font>';
   }
}
function status_pengaduan($id){
   if($id=='0'){
    return '<font color="blue">Menunggu Konfirmasi</font>';
   }
   if($id==1){
    return '<font color="green">Pemrosesan Pengaduan</font>';
   }
   if($id==2){
    return '<font color="blue">Selesai/Hasil Review</font>';
   }
   if($id==3){
    return '<font color="red">Ditolak</font>';
   }
}



?>