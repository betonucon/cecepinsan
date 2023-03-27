@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Warga</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Form Warga <small></small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">&nbsp;</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body panel-form">
                    <form class="form-horizontal form-bordered" style="padding:1%;background: #c1c1c5;" id="mydata" method="post" action="{{ url('warga') }}" enctype="multipart/form-data" >
                        @csrf 
                        <input type="hidden" name="id" value="{{$id}}">

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#default-tab-1" data-toggle="tab" class="nav-link active">
                                    <span class="d-sm-none">FORM WARGA</span>
                                    <span class="d-sm-block d-none">FORM WARGA</span>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="#default-tab-2" data-toggle="tab" class="nav-link">
                                    <span class="d-sm-none">Tab 2</span>
                                    <span class="d-sm-block d-none">Default Tab 2</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#default-tab-3" data-toggle="tab" class="nav-link">
                                    <span class="d-sm-none">Tab 3</span>
                                    <span class="d-sm-block d-none">Default Tab 3</span>
                                </a>
                            </li> -->
                        </ul>
                        <!-- end nav-tabs -->
                        <!-- begin tab-content -->
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="default-tab-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">NIK</label>
                                            <div class="col-lg-5">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" {{$disabled}} name="nik" value="{{$data->nik}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">NO KK</label>
                                            <div class="col-lg-5">
                                                <div class="input-group input-group-sm">
                                                    <input type="text"  {{$disabled}}  name="no_kk" value="{{$data->no_kk}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Nama</label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="nama" value="{{$data->nama}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">RW & RT</label>
                                            <div class="col-lg-3">
                                                <div class="input-group input-group-sm">
                                                    <select name="rw" class="form-control" placeholder="Ketik disini....">
                                                        <option value="">Pilih RW</option>
                                                        @foreach(get_rw() as $rw)
                                                            <option value="{{$rw->rw}}"  @if($data->rw==$rw->rw) selected @endif>{{$rw->rw}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="input-group input-group-sm">
                                                    <select name="rt" class="form-control" placeholder="Ketik disini....">
                                                        <option value="">Pilih RT</option>
                                                        @foreach(get_rt() as $rt)
                                                            <option value="{{$rt->rt}}" @if($data->rt==$rt->rt) selected @endif>{{$rt->rt}}</option>
                                                        @endforeach
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Tempat & Tanggal Lahir</label>
                                            <div class="col-lg-5">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="tempat_lahir" value="{{$data->tempat_lahir}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" readonly id="tanggal_lahir" name="tanggal_lahir" value="{{$data->tanggal_lahir}}" class="form-control" placeholder="yyyy-mm-dd" />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Alamat</label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="alamat" value="{{$data->alamat}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Jenis Kelamin</label>
                                            <div class="col-lg-4">
                                                <div class="input-group input-group-sm">
                                                    <select name="j_kelamin" class="form-control" placeholder="Ketik disini....">
                                                        <option value="">Pilih </option>
                                                        <option value="L" @if($data->j_kelamin=='L') selected @endif >Laki-laki </option>
                                                        <option value="P" @if($data->j_kelamin=='P') selected @endif >Perempuan </option>
                                                    
                                                    </select>
                                                    
                                                </div>
                                            </div> 
                                        </div> 
                                        
                                        
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Status Penikahan</label>
                                            <div class="col-lg-4">
                                                <div class="input-group input-group-sm">
                                                    <select name="status_pernikahan" class="form-control" placeholder="Ketik disini....">
                                                        <option value="">Pilih </option>
                                                        <option value="M" @if($data->status_pernikahan=='M') selected @endif >Menikah </option>
                                                        <option value="BM" @if($data->status_pernikahan=='BM') selected @endif >Belum Menikah </option>
                                                        <option value="DJ" @if($data->status_pernikahan=='DJ') selected @endif >Duda / Janda </option>
                                                    
                                                    </select>
                                                    
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Email</label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="email" value="{{$data->email}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label">Handphone</label>
                                            <div class="col-lg-8">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" name="no_hp" value="{{$data->no_hp}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <div class="col-xl-12" style="margin-bottom:1%;text-align:center">
                            <a href="javascript:;" class="btn btn-primary btn-sm" id="save-data"><i class="fas fa-save"></i> Simpan</a>
                            <a href="javascript:;"  class="btn btn-success btn-sm" onclick="location.assign(`{{url('warga')}}`)"><i class="fas fa-plus"></i> Kembali</a>
                        </div>  
                    </form>
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        
    </div>
    <!-- end row -->
</div>
@endsection

@push('ajax')
    <script>
        $('#tanggal_lahir').datepicker({
            format:"yyyy-mm-dd",
            autoclose: true
        });

        $('#save-data').on('click', () => {
            
            var form=document.getElementById('mydata');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('warga') }}",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData:false,
                    beforeSend: function() {
                        document.getElementById("loadnya").style.width = "100%";
                    },
                    success: function(msg){
                        var bat=msg.split('@');
                        if(bat[1]=='ok'){
                            $('#modal-import').modal('hide');
                            document.getElementById("loadnya").style.width = "0px";
                            swal({
									title: "Success! berhasil disimpan!",
									icon: "success",
                            });
                            location.assign("{{url('warga')}}")
                                
                        }else{
                            document.getElementById("loadnya").style.width = "0px";
                            swal({
                                title: 'Notifikasi',
                               
                                html:true,
                                text:'ss',
                                icon: 'error',
                                buttons: {
                                    cancel: {
                                        text: 'Tutup',
                                        value: null,
                                        visible: true,
                                        className: 'btn btn-dangers',
                                        closeModal: true,
                                    },
                                    
                                }
                            });
                            $('.swal-text').html('<div style="width:100%;background:#f2f2f5;padding:1%;text-align:left;font-size:13px">'+msg+'</div>')
                        }
                        
                        
                    }
                });
        });
    </script>
@endpush
