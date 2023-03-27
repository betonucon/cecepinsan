@extends('layouts.web')

@section('content')
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Profil</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">Form Plugins <small>header small text goes here...</small></h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-6 -->
        <div class="col-xl-12" style="margin-bottom:1%">
            <a href="javascript:;" onclick="location.assign(`{{url('warga/create')}}?id=0`)" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
            <a href="javascript:;" onclick="import_modal()" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> Import</a>
            <a href="javascript:;" onclick="generate_data()" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Generate Akun</a>
        </div>
        <div class="col-xl-12">
            <!-- begin panel -->
            <div class="panel panel-inverse" data-sortable-id="form-plugins-1">
                <!-- begin panel-heading -->
                <div class="panel-heading">
                    <h4 class="panel-title">Bootstrap Date Time Picker</h4>
                    <div class="panel-heading-btn">
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-redo"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <!-- end panel-heading -->
                <!-- begin panel-body -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="tampil_dashboard"></div>
                        </div>
                        <div class="col-md-12" style="background:#ecf9cd;padding:0.5%;margin-bottom:1%">
                            <div class="row">
                                <div class="col-md-8">
                                    
                                </div>
                                <div class="col-md-2">
                                    <select id="data_rw" onchange="cari_rw(this.value)" class="form-control form-control-sm">
                                        <option value="">Pilih RW</option>
                                        <option value="001">001</option>
                                        <option value="002">002</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select id="data_rt" onchange="cari_rt(this.value)" class="form-control form-control-sm">
                                        <option value="">Pilih RT</option>
                                        <option value="001">001</option>
                                        <option value="002">002</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive ">
                        <table id="data-table-fixed-header" class="table table-striped table-bordered table-td-valign-middle   dt-responsive display nowrap" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-nowrap" width="5%">No</th>
                                    <th class="text-nowrap" width="11%">NIK</th>
                                    <th class="text-nowrap" width="11%">NO KK</th>
                                    <th class="text-nowrap">Nama</th>
                                    <th class="text-nowrap" width="5%">RW</th>
                                    <th class="text-nowrap" width="5%">RT</th>
                                    <th class="text-nowrap" width="4%">JK</th>
                                    <th class="text-nowrap" width="4%">S.NIKAH</th>
                                    <th class="text-nowrap" width="15%">TTGL</th>
                                    
                                    
                                    <th class="text-nowrap" width="8%">Act</th>
                                </tr>
                            </thead>
                            
                        </table>
                
                    </div>
                </div>
                <!-- end panel-body -->
            </div>
            
        </div>
        
    </div>
    <!-- end row -->
</div>
<div class="modal fade" id="modal-import" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Alert Header</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger m-b-0" id="notifikasiimport">
                    <div id="notifikasi-import"></div>
                    
                </div>
                <form class="form-horizontal form-bordered" id="mydataimport" method="post" action="{{ url('warga/import') }}" enctype="multipart/form-data" >
                    @csrf 
                    <!-- <input type="submit"> -->
                    <div class="form-group">
                        <label>Upload File Excel</label>
                        <input type="file" name="file" class="form-control" />
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Tutup</a>
                <a href="javascript:;" class="btn btn-danger" id="import-data" >Proses</a>
            </div>
        </div>
    </div>
</div>   
@endsection

@push('ajax')
<script type="text/javascript">
        /*
        Template Name: Color Admin - Responsive Admin Dashboard Template build with Twitter Bootstrap 4
        Version: 4.6.0
        Author: Sean Ngu
        Website: http://www.seantheme.com/color-admin/admin/
        */
        
        var handleDataTableFixedHeader = function() {
            "use strict";
            
            if ($('#data-table-fixed-header').length !== 0) {
                var table=$('#data-table-fixed-header').DataTable({
                    lengthMenu: [20],
                    fixedHeader: {
                        header: true,
                        headerOffset: $('#header').height()
                    },
                    responsive: true,
                    ajax:"{{ url('warga/get_data')}}",
					columns: [
                        { data: 'id', render: function (data, type, row, meta) 
							{
								return meta.row + meta.settings._iDisplayStart + 1;
							} 
						},
						{ data: 'nik' },
						{ data: 'no_kk' },
						{ data: 'nama' },
						{ data: 'rw' },
						{ data: 'rt' },
						{ data: 'j_kelamin' },
						{ data: 'status_pernikahan' },
                        {render: function (data, type, row) {
                                return row.tempat_lahir+', '+row.tanggal_lahir;
                            }
                        },
						{ data: 'action' },
						
					],
					language: {
						paginate: {
							// remove previous & next text from pagination
							previous: '<< previous',
							next: 'Next>>'
						}
					}
                });
            }
        };

        var TableManageFixedHeader = function () {
            "use strict";
            return {
                //main function
                init: function () {
                    handleDataTableFixedHeader();
                }
            };
        }();

        $(document).ready(function() {
			TableManageFixedHeader.init();

		});

        $('#tampil_dashboard').load("{{ url('warga/tampil_dashboard')}}");
        function import_modal(){
            $('#modal-import').modal('show')
        }
        function cari_rw(rw){
            var rt=$('#data_rt').val();
            var table=$('#data-table-fixed-header').DataTable();
                table.ajax.url("{{ url('warga/get_data')}}?rw="+rw+"&rt="+rt).load();
        }
        function cari_rt(rt){
            var rw=$('#data_rw').val();
            var table=$('#data-table-fixed-header').DataTable();
                table.ajax.url("{{ url('warga/get_data')}}?rw="+rw+"&rt="+rt).load();
        }

        $('#notifikasiimport').hide();
        
        $('#import-data').on('click', () => {
            
            var form=document.getElementById('mydataimport');
                $.ajax({
                    type: 'POST',
                    url: "{{ url('warga/import') }}",
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
                            swal("Success! berhasil diimport!", {
									icon: "success",
                            });
                            var table=$('#data-table-fixed-header').DataTable();
                            table.ajax.url("{{ url('warga/get_data')}}").load();
                                
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

        function delete_data(id){
           
			swal({
				title: "Yakin menghapus data ini ?",
				text: "data akan hilang dari daftar ini",
				type: "warning",
				icon: "error",
				showCancelButton: true,
				align:"center",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false
			}).then((willDelete) => {
				if (willDelete) {
						$.ajax({
							type: 'GET',
							url: "{{url('warga/delete_data')}}",
							data: "id="+id,
							success: function(msg){
								swal("Success! berhasil terhapus!", {
									icon: "success",
								});
								var table=$('#data-table-fixed-header').DataTable();
								table.ajax.url("{{ url('warga/get_data')}}").load();
							}
						});
					
					
				} else {
					
				}
			});
			
		}

        function generate_data(){
           
			swal({
				title: "Yakin akan melakukan generate akun ?",
				type: "warning",
				icon: "error",
				showCancelButton: true,
				align:"center",
				confirmButtonClass: "btn-danger",
				confirmButtonText: "Yes, delete it!",
				closeOnConfirm: false,
                
			}).then((willDelete) => {
				if (willDelete) {
						$.ajax({
							type: 'GET',
							url: "{{url('warga/generate_data')}}",
							data: "id=1",
							success: function(msg){
								swal({
									title: "Generate akun  success",
									icon: "success",
								});
								var table=$('#data-table-fixed-header').DataTable();
								table.ajax.url("{{ url('warga/get_data')}}").load();
							}
						});
					
					
				} else {
					
				}
			});
			
		}

        
    </script>
@endpush
