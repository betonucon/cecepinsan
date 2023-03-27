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
use App\Pelayanan;
use App\User;
use PDF;

class PelayananController extends Controller
{
    
    public function index(request $request,$tipe)
    {
        $tipe=$tipe;
        $template='top';
        $data=Mpelayanan::where('tipe',$tipe)->first();
        return view('pelayanan.index',compact('template','data','tipe'));
    }
    public function index_user(request $request)
    {
        $template='top';
        return view('pelayanan.index_user',compact('template'));
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
        return view('pelayanan.create',compact('template','data','disabled','id'));
    }
    public function create_user(request $request,$tipe)
    {
        error_reporting(0);
        $template='top';
        $pelayanan=Mpelayanan::where('tipe',$tipe)->first();
        $data=Pelayanan::find($request->id);
        $id=$request->id;
        $tipe=$tipe;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('pelayanan.create_user',compact('template','data','disabled','id','pelayanan','tipe'));
    }
    public function view(request $request,$tipe)
    {
        error_reporting(0);
        $template='top';
        $pelayanan=Mpelayanan::where('tipe',$tipe)->first();
        $data=Pelayanan::find($request->id);
        $id=$request->id;
        $tipe=$tipe;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('pelayanan.view',compact('template','data','disabled','id','pelayanan','tipe'));
    }
    public function view_user(request $request,$tipe)
    {
        error_reporting(0);
        $template='top';
        $pelayanan=Mpelayanan::where('tipe',$tipe)->first();
        $data=Pelayanan::find($request->id);
        $id=$request->id;
        $tipe=$tipe;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('pelayanan.view_user',compact('template','data','disabled','id','pelayanan','tipe'));
    }

    

    public function get_data(request $request,$tipe)
    {
        error_reporting(0);
        $query = Pelayanan::query();
        $data=$query->where('tipe',$tipe);
        $data = $query->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($row) {
                return $row->mwarga['nama'];
            })
            ->addColumn('pelayanan', function ($row) {
                return $row->mpelayanan['pelayanan'];
            })
            ->addColumn('action', function ($row) {
                if($row->status==0){
                $btn='
                    <span class="btn btn-primary btn-xs" onclick="location.assign(`'.url('pelayanan/'.$row->tipe.'/view').'?id='.$row->id.'`)">Konfirmasi</span>
                ';
                }
                if($row->status==1){
                $btn='
                    <span class="btn btn-success btn-xs" onclick="location.assign(`'.url('pelayanan/'.$row->tipe.'/view').'?id='.$row->id.'`)">Pemrosesan</span>
                ';
                }
                if($row->status==2){
                $btn='
                    <span class="btn btn-warning btn-xs" onclick="location.assign(`'.url('pelayanan/'.$row->tipe.'/view').'?id='.$row->id.'`)">Pengambilan</span>
                ';
                }
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    public function get_data_user(request $request,$nik)
    {
        error_reporting(0);
        $query = Pelayanan::query();
        $data=$query->where('nik',$nik);
        $data = $query->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('nama', function ($row) {
                return $row->mwarga['nama'];
            })
            ->addColumn('pelayanan', function ($row) {
                return $row->mpelayanan['pelayanan'];
            })
            ->addColumn('action', function ($row) {
                $btn='
                <div class="note note-lime  m-b-0">
                    <div class="note-content">
                        <h5><b>'.$row->nomor.'/'.$row->mpelayanan['pelayanan'].'</b></h5>
                        <dl>
                            <dt class="text-inverse">Dibuat</dt>
                            <dd style="margin-bottom: 0.1%;">'.strip_tags($row->waktu).'</dd>
                            <dt class="text-inverse">Status</dt>
                            <dd style="margin-bottom: 0.1%;">'.status($row->status).'</dd>';
                            if($row->status==0){
                                $btn.='<dd style="margin-bottom: 0.1%;">
                                            <span class="btn btn-primary btn-xs" onclick="location.assign(`'.url('pelayananuser/'.$row->tipe.'/view').'?id='.$row->id.'`)">Lihat Pengajuan</span>
                                            <span class="btn btn-danger btn-xs">Batalkan</span>
                                        </dd>';
                            }else{
                                $btn.='<dd style="margin-bottom: 0.1%;">
                                            <span class="btn btn-primary btn-xs">Lihat Pengajuan</span>';
                                            if($row->status==2){
                                                $btn.='<span class="btn btn-success btn-xs">Download</span>';
                                            }
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
        $data = Pengumuman::where('id',$request->id)->delete();
    }
    public function terima(request $request,$tipe){
        $data = Pelayanan::where('id',$request->id)->update([
            'status'=>1,
            'nomor_surat'=>penomoran_surat($tipe),
            'konfirmasi'=>date('Y-m-d H:i:s'),
        ]);
    }

    
   
    public function proses(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['content']= 'required';
        $messages['content.required']= 'Lengkapi kolom keterangan';
        $rules['tanggal']= 'required';
        $messages['tanggal.required']= 'Lengkapi kolom tanggal';
        
        
        
        
       
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
            
                $data=Pelayanan::UpdateOrcreate([
                    'id'=>$request->id,
                ],
                [
                    'deskripsi'=>$request->content,
                    'tanggal_pengambilan'=>$request->tanggal,
                    'status'=>2,
                    'pemrosesan'=>date('Y-m-d H:i:s'),
                ]);

                echo'@ok';
           
        }
    }
    public function store_user(request $request,$tipe){
        error_reporting(0);
        // echo $tipe;
        $rules = [];
        $messages = [];
        
        $rules['content']= 'required';
        $messages['content.required']= 'Lengkapi Catatan';
        
        
        
       
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
                $nomor=penomoran($request->tipe);
                    $data=Pelayanan::create([
                        
                        'nik'=>$request->nik,
                        'tipe'=>$request->tipe,
                        'nomor'=>$nomor,
                        'catatan'=>$request->content,
                        'waktu'=>date('Y-m-d H:i:s'),
                        'status'=>0,
                    ]);
                    KirimCreated::dispatch('@1@Permintaan Layanan@'.nama_pelayanan($request->tipe).' Nomor '.$nomor);
                    echo'@ok';
               
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

    public function cetak(request $request,$tipe){
        error_reporting(0);
        $data=Pelayanan::where('id',$request->id)->first();
        $pdf = PDF::loadView('pelayanan.'.$tipe, compact('data'));
        $pdf->setPaper('A4', 'Potrait');
        return $pdf->stream();

    }
}
