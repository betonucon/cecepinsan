@extends('layouts.web')

@section('content')
<div id="content" class="content">
    
    <!-- begin page-header -->
    <h1 class="page-header">Pengaduan <small></small></h1>
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
                                    <span class="d-sm-none">LAPORAN PENGADUAN</span>
                                    <span class="d-sm-block d-none">LAPORAN PENGADUAN</span>
                                </a>
                            </li>
                            
                        </ul>
                        <!-- end nav-tabs -->
                        <!-- begin tab-content -->
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="default-tab-1">
                                <div class="container">                      
                                    <div class="row text-center justify-content-center mb-5">
                                        <div class="col-xl-6 col-lg-8">
                                            <h2 class="font-weight-bold">Timeline Pelayanan</h2>
                                            <p class="text-muted">Proses dengan cepat akan sangat membantu masyarakat , dan mendapatkan nilai pelayanan yang baik.</p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                                                <div class="timeline-step">
                                                    @if($data->status==0)
                                                        <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" >
                                                            <div class="inner-circle" ></div>
                                                            <p class="h6 mt-3 mb-1">Konfirmasi</p>
                                                        </div>
                                                    @else
                                                        <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
                                                            <div class="inner-circle" ></div>
                                                            <p class="h6 mt-3 mb-1">Konfirmasi</p>
                                                            <p class="h6 text-muted mb-0 mb-lg-0">{{tanggal_eng($data->konfirmasi)}}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="timeline-step">
                                                    @if($data->status>1)
                                                        <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
                                                            <div class="inner-circle" ></div>
                                                            <p class="h6 mt-3 mb-1">Selesai</p>
                                                            <p class="h6 text-muted mb-0 mb-lg-0">{{tanggal_eng($data->pemrosesan)}}</p>
                                                        </div>
                                                    @else
                                                        
                                                        <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" >
                                                            <div class="inner-circle" ></div>
                                                            <p class="h6 mt-3 mb-1">Selesai</p>
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <table class="table table-bordered">
                                            <tr>
                                                <td width="30%"><b>No Pengaduan </b></td>
                                                <td>{{$data->nomor_pengaduan}}</td>
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
                                                <td><b>Kategori </b></td>
                                                <td>{{$data->mkategoripengaduan['kategori_pengaduan']}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Waktu Pengaduan  </b></td>
                                                <td>{{tanggal_eng($data->waktu)}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Status  </b></td>
                                                <td>{!!status_pengaduan($data->status)!!}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Deskripsi  </b></td>
                                                <td>{!!$data->deskripsi!!}</td>
                                            </tr>
                                            <tr>
                                                <td><b>File dilampirkan  </b></td>
                                                <td><img src="{{url_plug()}}/file/{{$data->file}}" width="100%"></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-5">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th style="background:#afafd1">Approve</th>
                                                <th style="background:#afafd1">Action</th>
                                            </tr>
                                            @if($data->status>0)
                                            <tr>
                                                <td><b>Konfirmasi</b></td>
                                                <td style="text-align:center">
                                                    {{tanggal_eng($data->konfirmasi)}}
                                                </td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td><b>Konfirmasi</b></td>
                                                <td style="text-align:center">
                                                    <span class="btn btn-primary btn-sm" onclick="terima()">Terima Pengaduan</span>
                                                </td>
                                            </tr>
                                            @endif
                                            @if($data->status>0)
                                                @if($data->status>1)
                                                <tr>
                                                    <td><b>Selesai</b></td>
                                                    <td style="text-align:center">
                                                        {{tanggal_eng($data->pemrosesan)}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <b>Hasil Review</b><br>
                                                        {!!$data->hasil!!}
                                                    </td>
                                                    
                                                </tr>
                                                @endif
                                                @if($data->status==1)
                                                <tr>
                                                    <td><b>Selesai</b></td>
                                                    <td style="text-align:center">
                                                        <span class="btn btn-primary btn-sm" onclick="proses_layanan()">Buat Hasil Review</span>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endif
                                            
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
                            <a href="javascript:;"  class="btn btn-success btn-sm" onclick="location.assign(`{{url('/pengaduan')}}`)"><i class="fas fa-plus"></i> Kembali</a>
                        </div>  
                    </form>
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        
    </div>
    <!-- end row -->
</div>
<div class="modal fade" id="modalproses" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Proses Layanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal form-bordered" id="mydataproses" method="post" action="{{ url('pengumuman') }}" enctype="multipart/form-data" >
                    @csrf 
                    <input type="hidden" name="id" value="{{$data->id}}">
                    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
									<label>Lengkapi Hasil Review</label>
									<textarea id="editor1" class="ckeditor" placeholder="ketik.." name="keterangan_1"></textarea>
									
								</div>
                                
                            </div>
                            
                        </div>

                    

                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-success" id="save-proses">Proses</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('ajax')
    <script>
        $('#datepicker').datepicker({
            format:"yyyy-mm-dd",
            autoclose: true
        });

        function cetak(){
            window.open(`{{url('/pengaduan'.'/cetak')}}`,'_blank')
        }
        $('#textarea').wysihtml5();
        function proses_layanan(){
            $('#modalproses').modal('show');
        }
        function terima(){
            swal({
				title: "Yakin untuk melakukan konfirmasi ?",
				text: "Pelayanan akan dilanjutkan keproses berikutnya",
				type: "warning",
				icon: "info",
				showCancelButton: true,
				align:"center",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			}).then((willDelete) => {
				if (willDelete) {
						$.ajax({
							type: 'GET',
							url: "{{url('pengaduan/terima')}}",
							data: "id={{$data->id}}",
							success: function(msg){
								swal("Success! berhasil terhapus!", {
									icon: "success",
								});
								location.assign(`{{url('/pengaduan')}}`)
							}
						});
					
					
				} else {
					
				}
			});
        }

        $('#save-proses').on('click', () => {
            
            var form=document.getElementById('mydataproses');
            var data = new FormData(form);
                data.append('content', CKEDITOR.instances['editor1'].getData());
                $.ajax({
                    type: 'POST',
                    url: "{{ url('pengaduan/proses') }}",
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
									title: "Success! berhasil diproses!",
									icon: "success",
                            });
                            location.assign("{{url('pengaduan')}}")
                                
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
