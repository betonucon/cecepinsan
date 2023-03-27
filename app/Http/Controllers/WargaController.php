<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\WargaImport;
use Validator;
use App\Warga;
use App\User;

class WargaController extends Controller
{
    
    public function index(request $request)
    {
        $template='top';
        return view('warga.index',compact('template'));
    }
    public function create(request $request)
    {
        error_reporting(0);
        $template='top';
        $data=Warga::find($request->id);
        $id=$request->id;
        if($request->id==0){
            $disabled='';
        }else{
            $disabled='readonly';
        }
        return view('warga.create',compact('template','data','disabled','id'));
    }

    public function modal(request $request)
    {
        error_reporting(0);
        $data=Shift::where('id',$request->id)->first();
        return view('shift.modal',compact('data'));
    }

    public function generate_data(request $request)
    {
        error_reporting(0);
        $data=Warga::get();
        foreach($data as $o){
            $data=User::UpdateOrcreate([
                'username'=>$o->nik,
            ],
            [
                'email'=>$o->email,
                'name'=>$o->nama,
                'role_id'=>2,
                'password'=>Hash::make(date('Ymd',strtotime($o->tanggal_lahir))),
            ]);
        }
    }

    public function get_data(request $request)
    {
        error_reporting(0);
        $query = Warga::query();
        if($request->rw!=""){
            $data = $query->where('rw',$request->rw);
        }
        if($request->rt!=""){
            $data = $query->where('rt',$request->rt);
        }
        
        $data = $query->orderBy('id','Asc')->get();

        return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn='
                    <div class="btn-group">
                        <span class="btn btn-primary btn-sm" onclick="location.assign(`'.url('warga/create').'?id='.$row->id.'`)"><i class="fas fa-pencil-alt text-white"></i></span>
                        <span class="btn btn-danger btn-sm" onclick="delete_data('.$row->id.')"><i class="fas fa-pencil-alt text-white"></i></span>
                    </div>
                ';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }
    public function tampil_dashboard(request $request)
    {
        error_reporting(0);
        
        echo'
            <div class="row">';
            foreach(get_rw() as $no=>$o){
                echo'
                <div class="col-xl-2 col-md-6">
                    <div class="widget widget-stats bg-'.$o->color.'">
                        <div class="stats-icon"><i class="fa fa-users"></i></div>
                        <div class="stats-info">
                            <h4>RW '.$o->rw.'</h4>
                            <p>'.total_rw($o->rw).'</p>	
                        </div>
                    </div>
                </div>';
            } 
            echo'
            </div>

        ';
       
    }

    public function delete_data(request $request){
        $data = Warga::where('id',$request->id)->delete();
    }

    public function import(Request $request)
    {
        $rules = [
            'file'=> 'required|mimes:xlsx',
        ];

        $messages = [
            'file.required'=> 'Upload file excel',
            'file.mimes'=> 'Hanya menerima file .xlsx',
        ];
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
            $filess = $request->file('file');
            $nama_file = rand().$filess->getClientOriginalName();
            $filess->move('public/file_excel',$nama_file);
            Excel::import(new WargaImport(), public_path('/file_excel/'.$nama_file));
            echo '@ok';
        }
    }
   
    public function store(request $request){
        error_reporting(0);
        $rules = [];
        $messages = [];
        
        $rules['nik']= 'required';
        $messages['nik.required']= 'Lengkapi kolom nik';
        
        $rules['no_kk']= 'required';
        $messages['no_kk.required']= 'Lengkapi kolom no_kk';
        
        $rules['nama']= 'required';
        $messages['nama.required']= 'Lengkapi kolom nama';
        
        $rules['rt']= 'required';
        $messages['rt.required']= 'Lengkapi kolom rt';
        
        $rules['rw']= 'required';
        $messages['rw.required']= 'Lengkapi kolom rw';
        
        $rules['alamat']= 'required';
        $messages['alamat.required']= 'Lengkapi kolom alamat';
        
        $rules['j_kelamin']= 'required';
        $messages['j_kelamin.required']= 'Lengkapi kolom j_kelamin';
        
        $rules['tempat_lahir']= 'required';
        $messages['tempat_lahir.required']= 'Lengkapi kolom tempat_lahir';
        
        $rules['tanggal_lahir']= 'required';
        $messages['tanggal_lahir.required']= 'Lengkapi kolom tanggal_lahir';
        
        $rules['status_pernikahan']= 'required';
        $messages['status_pernikahan.required']= 'Lengkapi kolom status_pernikahan';
        
        $rules['email']= 'required';
        $messages['email.required']= 'Lengkapi kolom email';
        
        $rules['no_hp']= 'required';
        $messages['no_hp.required']= 'Lengkapi kolom no_hp';
       
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
                
                $data=Warga::UpdateOrcreate([
                    'nik'=>$request->nik,
                ],
                [
                    'no_kk'=>$request->no_kk,
                    'nama'=>$request->nama,
                    'rt'=>$request->rt,
                    'rw'=>$request->rw,
                    'alamat'=>$request->alamat,
                    'tempat_lahir'=>$request->tempat_lahir,
                    'tanggal_lahir'=>$request->tanggal_lahir,
                    'j_kelamin'=>$request->j_kelamin,
                    'status_pernikahan'=>$request->status_pernikahan,
                    'email'=>$request->email,
                    'no_hp'=>$request->no_hp,
                ]);

                echo'@ok';
                
            }else{
                $data=Warga::UpdateOrcreate([
                    'nik'=>$request->nik,
                ],
                [
                    'no_kk'=>$request->no_kk,
                    'nama'=>$request->nama,
                    'rt'=>$request->rt,
                    'rw'=>$request->rw,
                    'alamat'=>$request->alamat,
                    'tempat_lahir'=>$request->tempat_lahir,
                    'tanggal_lahir'=>$request->tanggal_lahir,
                    'j_kelamin'=>$request->j_kelamin,
                    'status_pernikahan'=>$request->status_pernikahan,
                    'email'=>$request->email,
                    'no_hp'=>$request->no_hp,
                ]);

                echo'@ok';
            }
        }
    }
}
