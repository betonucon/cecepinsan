@extends('layouts.web_top')

@section('content')
<div id="content" class="content">
    
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
                    <form class="form-horizontal form-bordered" style="padding:1%;background: #c1c1c5;" id="mydata" method="post" action="{{ url('pengumuman') }}" enctype="multipart/form-data" >
                        @csrf 
                        <input type="hidden" name="id" value="{{$id}}">
                        <input type="hidden" name="tipe" value="{{$tipe}}">

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a href="#default-tab-1" data-toggle="tab" class="nav-link active">
                                    <span class="d-sm-none">PENGAJUAN PELAYANAN</span>
                                    <span class="d-sm-block d-none">PENGAJUAN PELAYANAN</span>
                                </a>
                            </li>
                            
                        </ul>
                        <!-- end nav-tabs -->
                        <!-- begin tab-content -->
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="default-tab-1">
                                <div class="row">
                                    <div class="col-md-7">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td width="30%"><b>No Pelayanan </b></td>
                                                <td>{{$data->nomor}}</td>
                                            </tr>
                                            <tr>
                                                <td width="30%"><b>NIK </b></td>
                                                <td>{{$data->nik}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Nama </b></td>
                                                <td>{{$data->mwarga['nama']}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>RT/RW </b></td>
                                                <td>{{$data->mwarga['rt']}}/{{$data->mwarga['rw']}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>TTGL </b></td>
                                                <td>{{$data->mwarga['tempat_lahir']}}, {{$data->mwarga['tanggal_lahir']}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Pelayanan </b></td>
                                                <td>[{{$data->tipe}}] {{$data->mpelayanan['pelayanan']}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Status  </b></td>
                                                <td>{!!status($data->status)!!}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-5">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="background:#c8c8df" width="30%"><b>Progres </b></th>
                                                <th style="background:#afafd1">Rentan Waktu</th>
                                            </tr>
                                            <tr>
                                                <td><b>Konfirmasi </b></td>
                                                <td>@if($data->status>0) {{selisih_waktu($data->waktu,$data->konfirmasi)}} @endif</td>
                                            </tr>
                                            <tr>
                                                <td><b>Pemrosesan </b></td>
                                                <td>@if($data->status>1) {{selisih_waktu($data->konfirmasi,$data->pemrosesan)}} @endif</td>
                                            </tr>
                                            <tr>
                                                <td><b>Selesai </b></td>
                                                <td>@if($data->status>2) {{selisih_waktu($data->pemrosesan,$data->selesai)}} @endif</td>
                                            </tr>
                                            
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="tab-pane fade active show" style="border-top:solid 2px #d5d5e9">
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                       
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
