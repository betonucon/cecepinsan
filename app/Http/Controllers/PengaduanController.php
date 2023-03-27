<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Events\KirimCreated;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use App\Mpelayanan;
use App\Pengaduan;
use App\User;
use PDF;

class PengaduanController extends Controller
{
    
    public function index(request $request)
    {
        $template='top';
        return view('pengaduan.index',compact('template'));
    }
    public function index_user(request $request)
    {
        $template='top';
        return view('pengaduan.index_user',compact('template'));
    }
    public function create(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Pelayanan::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('pengaduan.create',compact('template','data','disabled','id'));
    }
    public function create_user(request $request,$tipe)
    {
        error_reporting(0);
        $template='top';
        $pelayanan=Mpelayanan::where('tipe',$tipe)->first();
        $data=Pengaduan::find($request->id);
        $id=$request->id;
        $tipe=$tipe;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('pengaduan.create_user',compact('template','data','disabled','id','pelayanan','tipe'));
    }
    public function view(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Pengaduan::where('nomor_pengaduan',$request->nomor_pengaduan)->first();
        $nomor_pengaduan=$request->nomor_pengaduan;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('pengaduan.view',compact('template','data','disabled','nomor_pengaduan'));
    }
    public function view_user(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Pengaduan::where('nomor_pengaduan',$request->nomor_pengaduan)->first();
        $nomor_pengaduan=$request->nomor_pengaduan;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('pengaduan.view_user',compact('template','data','disabled','nomor_pengaduan'));
    }

    

    public function get_data(request $request)
    {
        error_reporting(0);
        $query = Pengaduan::query();
        $data = $query->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($row) {
                return $row->mwarga['nama'];
            })
            ->addColumn('pengaduan', function ($row) {
                return $row->mkategoripengaduan['kategori_pengaduan'];
            })
            ->addColumn('action', function ($row) {
                if($row->status==0){
                $btn='
                    <span class="btn btn-primary btn-xs" onclick="location.assign(`'.url('pengaduan/view').'?nomor_pengaduan='.$row->nomor_pengaduan.'`)">Konfirmasi</span>
                ';
                }
                if($row->status==1){
                $btn='
                    <span class="btn btn-success btn-xs" onclick="location.assign(`'.url('pengaduan/view').'?nomor_pengaduan='.$row->nomor_pengaduan.'`)">Pemrosesan/Review</span>
                ';
                }
                if($row->status==2){
                $btn='
                    <span class="btn btn-warning btn-xs" onclick="location.assign(`'.url('pengaduan/view').'?nomor_pengaduan='.$row->nomor_pengaduan.'`)">Selesai/Hasil Review</span>
                ';
                }
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    public function get_data_user(request $request)
    {
        error_reporting(0);
        $query = Pengaduan::query();
        $data=$query->where('nik',Auth::user()->username);
        $data = $query->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($row) {
                return $row->mwarga['nama'];
            })
            ->addColumn('action', function ($row) {
                $btn='
                <div class="note note-lime  m-b-0">
                    <div class="note-content">
                        <h5><b>'.$row->nomor_pengaduan.'/'.$row->mkategoripengaduan['kategori_pengaduan'].'</b></h5>
                        <dl>
                            <dt class="text-inverse">Dibuat</dt>
                            <dd style="margin-bottom: 0.1%;">'.strip_tags($row->waktu).'</dd>
                            <dt class="text-inverse">Status</dt>
                            <dd style="margin-bottom: 0.1%;">'.status_pengaduan($row->status).'</dd>';
                            if($row->status==0){
                                $btn.='<dd style="margin-bottom: 0.1%;">
                                            <span class="btn btn-primary btn-xs" onclick="location.assign(`'.url('pengaduan/view_user').'?nomor_pengaduan='.$row->nomor_pengaduan.'`)">Lihat progres</span>
                                            <span class="btn btn-danger btn-xs" onclick="hapus_data('.$row->id.')">Batalkan</span>
                                        </dd>';
                            }else{
                                $btn.='<dd style="margin-bottom: 0.1%;">
                                            <span class="btn btn-primary btn-xs" onclick="location.assign(`'.url('pengaduan/view_user').'?nomor_pengaduan='.$row->nomor_pengaduan.'`)">Lihat progres</span>';
                                            
                                        $btn.='
                                        </dd>';
                            }
                            $btn.='
                            
                        </dl>
                    </div>
                </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    

    public function delete_data(request $request){
        $data = Pengaduan::where('id',$request->id)->delete();
    }
    public function terima(request $request){
        $data = Pengaduan::where('id',$request->id)->update([
            'status'=>1,
            'konfirmasi'=>date('Y-m-d H:i:s'),
        ]);
    }

    
   
    public function proses(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['content']= 'required';
        $messages['content.required']= 'Lengkapi kolom keterangan';
        
        
        
        
       
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                foreach(parsing_validator($val) as $value){
                    
                    foreach($value as $isi){
                        echo'-&nbsp;'.$isi.'<br>';
                    }
                }
            echo'</div></div>';
        }else{
            
                $data=Pengaduan::UpdateOrcreate([
                    'id'=>$request->id,
                ],
                [
                    'hasil'=>$request->content,
                    'status'=>2,
                    'pemrosesan'=>date('Y-m-d H:i:s'),
                ]);

                echo'@ok';
           
        }
    }
    public function store(request $request){
        error_reporting(0);
        // echo $tipe;
        $rules = [];
        $messages = [];
        
        $rules['kategori_pengaduan_id']= 'required';
        $messages['kategori_pengaduan_id.required']= 'Pilih Kategori';
        $rules['file']= 'required|mimes:jpg,jpeg,png,jiff';
        $messages['file.required']= 'Upload lampiran';
        $rules['deskripsi']= 'required';
        $messages['deskripsi.required']= 'Lengkapi deskaripsi';
        
        
       
        $validator = Validator::make($request->all(), $rules, $messages);
        $val=$validator->Errors();


        if ($validator->fails()) {
            echo'<div class="nitof"><b>Oops Error !</b><br><div class="isi-nitof">';
                foreach(parsing_validator($val) as $value){
                    
                    foreach($value as $isi){
                        echo'-&nbsp;'.$isi.'<br>';
                    }
                }
            echo'</div></div>';
        }else{
            if($request->id==0){
                $nomor=penomoran_pengaduan();
                $lampiran = $request->file;
                $lampiranFileName ='lampiranpengaduan'.$nomor.'.'.$lampiran->getClientOriginalExtension();
                $lampiranPath =$lampiranFileName;
                $file =\Storage::disk('public_photo');
                if($file->put($lampiranPath, file_get_contents($lampiran))){
                    $data=Pengaduan::create([
                        
                        'nik'=>Auth::user()->username,
                        'kategori_pengaduan_id'=>$request->kategori_pengaduan_id,
                        'nomor_pengaduan'=>$nomor,
                        'file'=>$lampiranPath,
                        'deskripsi'=>$request->deskripsi,
                        'waktu'=>date('Y-m-d H:i:s'),
                        'status'=>0,
                    ]);
                    KirimCreated::dispatch('@2@Laporan Pengaduan Baru@'.nama_kategori($request->kategori_pengaduan_id).' Nomor '.$nomor);
                    echo'@ok@'.$nomor;
                }
               
            }else{
                $data=Pengumuman::where('id',$request->id)->update([
                    'catatan'=>$request->content,
                    'waktu'=>date('Y-m-d H:i:s'),
                    'status'=>0,
                ]);

                
                echo'@ok';
            }
        }

        
    }

    public function cetak(request $request){
        error_reporting(0);
        $data=Pelayanan::where('id',$request->id)->first();
        $pdf = PDF::loadView('pelayanan.'.$tipe, compact('data'));
        $pdf->setPaper('A4', 'Potrait');
        return $pdf->stream();

    }
}
