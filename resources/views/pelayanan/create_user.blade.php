@extends('layouts.web_top')

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Pengajuan Pelayanan</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Pengajuan Pelayanan <small></small></h1>
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
                    <form class="form-horizontal form-bordered" style="padding:1%;background: #c1c1c5;" id="mydata" method="post" action="{{ url('pelayananuser/'.$tipe) }}" enctype="multipart/form-data" >
                        @csrf 
                        <input type="hidden" name="id" value="{{$id}}">
                        <input type="hidden" name="tipe" value="{{$tipe}}">
                        <input type="submit">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#default-tab-1" data-toggle="tab" class="nav-link active">
                                    <span class="d-sm-none">PENGAJUAN PELAYANAN</span>
                                    <span class="d-sm-block d-none">PENGAJUAN PELAYANAN</span>
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
                                            <label class="col-lg-3 col-form-label">NIK</label>
                                            <div class="col-lg-9">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" readonly name="nik" value="{{warga()->nik}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Nama</label>
                                            <div class="col-lg-9">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" readonly name="nama" value="{{warga()->nama}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">Tanggal Lahir</label>
                                            <div class="col-lg-9">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" readonly  value="{{warga()->tempat_lahir}}, {{warga()->tanggal_lahir}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label">RT/RW</label>
                                            <div class="col-lg-9">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" readonly value="{{warga()->rt}}/{{warga()->rw}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                            <div class="tab-pane fade active show" style="border-top:solid 2px #d5d5e9">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-lg-12 col-form-label" style="padding:1.5%;text-transform:uppercase">KETERANGAN  PELAYANAN</label>
                                            <label class="col-lg-2 col-form-label" style="padding:1.5%;">Jenis Pelayanan</label>
                                            <div class="col-lg-7">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" readonly  value="[{{$pelayanan->tipe}}] {{$pelayanan->pelayanan}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label" style="padding:1.5%;">Catatan</label>
                                            <div class="col-lg-9">
                                                <div class="input-group input-group-sm">
                                                    <textarea id="editor1" name="catatan" class="ckeditor" placeholder="Ketik disini...." ></textarea>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                   
                                    
                                    
                                </div>
                            </div>
                            
                        </div> 
                        <div class="col-xl-12" style="margin-bottom:1%;text-align:center">
                            <a href="javascript:;" class="btn btn-primary btn-sm" id="save-data"><i class="fas fa-save"></i> Simpan</a>
                            <a href="javascript:;"  class="btn btn-success btn-sm" onclick="location.assign(`{{url('/')}}`)"><i class="fas fa-plus"></i> Kembali</a>
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

        $('#textarea').wysihtml5();

        $('#save-data').on('click', () => {
            
            var form=document.getElementById('mydata');
            var data = new FormData(form);
                data.append('content', CKEDITOR.instances['editor1'].getData());
                $.ajax({
                    type: 'POST',
                    url: "{{ url('pelayananuser/'.$tipe) }}",
                    data: data,
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
                            location.assign("{{url('pelayananuser/'.$tipe)}}")
                                
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
