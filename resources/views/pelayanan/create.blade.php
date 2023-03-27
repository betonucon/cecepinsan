@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">pengumuman</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Form pengumuman <small></small></h1>
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
                    <form class="form-horizontal form-bordered" style="padding:1%;background: #c1c1c5;" id="mydata" method="post" action="{{ url('pengumuman') }}" enctype="multipart/form-data" >
                        @csrf 
                        <input type="hidden" name="id" value="{{$id}}">

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#default-tab-1" data-toggle="tab" class="nav-link active">
                                    <span class="d-sm-none">FORM PENGUMUMAN</span>
                                    <span class="d-sm-block d-none">FORM PENGUMUMAN</span>
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
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Judul</label>
                                            <div class="col-lg-10">
                                                <div class="input-group input-group-sm">
                                                    <input type="text"  name="judul" value="{{$data->judul}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label" style="align-items: start;">Deskripsi</label>
                                            <div class="col-lg-10">
                                                
                                                    <textarea  name="deskripsi" rows="12" class="ckeditor" id="editor1" style="width:100%" placeholder="Ketik disini....">{!! $data->deskripsi !!}</textarea>
                                                    
                                                
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Thumbnail</label>
                                            <div class="col-lg-4">
                                                <div class="input-group input-group-sm">
                                                    <input type="file"  name="file" value="{{$data->background}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Lampiran</label>
                                            <div class="col-lg-4">
                                                <div class="input-group input-group-sm">
                                                    <input type="file"  name="lampiran" value="{{$data->background}}" class="form-control" placeholder="Ketik disini...." />
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div> 
                        <div class="col-xl-12" style="margin-bottom:1%;text-align:center">
                            <a href="javascript:;" class="btn btn-primary btn-sm" id="save-data"><i class="fas fa-save"></i> Simpan</a>
                            <a href="javascript:;"  class="btn btn-success btn-sm" onclick="location.assign(`{{url('pengumuman')}}`)"><i class="fas fa-plus"></i> Kembali</a>
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
                    url: "{{ url('pengumuman') }}",
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
                            location.assign("{{url('pengumuman')}}")
                                
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
