@extends('layout.indexOfKasir')
@section('css')
<link type="text/css" href="{{ asset('plugins/iCheck/skins/minimal/blue.css') }}" rel="stylesheet"> <!-- iCheck -->
<link type="text/css" href="{{ asset('plugins/form-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
<!-- DateRangePicker -->
<link type="text/css" href="{{ asset('plugins/charts-chartistjs/chartist.min.css') }}" rel="stylesheet">
<link type="text/css" href="{{ asset('plugins/form-select2/select2.css') }}" rel="stylesheet"> <!-- Select2 -->
<link type="text/css" href="{{ asset('plugins/form-select2/select2-skins.css') }}" rel="stylesheet">
<!-- Select2 skin -->
<link type="text/css" href="{{ asset('css/form-components.css') }}" rel="stylesheet"> <!-- form components-->
@stop
@section('content')
<script>
    var data = {!!json_encode($data) !!};
</script>
<div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">

                <li><a href="{{ route('dashboardKasir') }}">Home</a></li>
                <li>Barang Service</li>
                <li><a href="{{ route('showDaftarBarangService-kasir') }}">Daftar Barang Service</a></li>
                <li class="active"><a href="">Edit Catatan Service</a></li>

            </ol>
            <div class="page-heading">
                <h1>Edit Catatan Service</h1>
            </div>
            <div class="container-fluid">
                <div data-widget-group="group1">
                    <div class="panel panel-midnightblue">
                        <div class="panel-heading">
                            <h2>Form Edit Catatan Service</h2>
                        </div>
                        <div class="panel-body">
                    
                            <form action="{{route('editServiceKasir')}}" method="POST" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Nama Pelanggan &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100" type="text"
                                                name="nama_pelanggan" autocomplete="off" value="{{ $data->nama_pelanggan }}">
                                            <span class="focus-input100" data-placeholder="Nama Pelanggan"></span>
                                        </div>
                                       
                                    </div>
                                </div>
                                <input type="text" value={{$data->id_service}} name="id_service" hidden>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">No.Telepon &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required type="number" minlength="10" class="input100 " name="no_telepon"
                                                   autocomplete="off" value="{{ $data->no_telepon }}" onKeyPress="if(this.value.length==12) return false;">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Jenis
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100"
                                                type="text" name="jenis_barang" autocomplete="off"
                                                value="{{ $data->jenis_barang }}">
                                            <span class="focus-input100" data-placeholder="Jenis Barang"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"
                                        style="padding-top: 11px !important;">Permasalahan &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100"
                                                type="text" name="permasalahan" autocomplete="off"
                                                value="{{ $data->permasalahan }}">
                                            <span class="focus-input100" data-placeholder="Permasalahan"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Kelengkapan
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100"
                                                type="text" name="kelengkapan" autocomplete="off"
                                                value="{{ $data->kelengkapan }}">
                                            <span class="focus-input100" data-placeholder="Kelengkapan Barang"></span>
                                        </div>
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Lokasi 
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>                                    
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input class="input100" readonly
                                                type="text" autocomplete="off" 
                                                value="{{ $data->lokasi_barang }}">
                                            <span class="focus-input100" ></span>
                                        </div>
                                    </div>
                                        
                                    <div class="col-sm-1" style="padding-top: 11px !important; display:block" id="ed_button">
                                        <button type="button" id="edit_button" class="btn btn-success-alt" onclick="showLokasi()"> Ubah?</button>
                                    </div>
                                    
                                    <label class="col-sm-3 control-label" style="padding-top: 17px !important; display:none" id="label_lokasi">
                                        Lokasi Baru &nbsp;&nbsp;&nbsp;&nbsp; : </label> 

                                    <div class="col-sm-7" style="padding-top: 11px !important; display:none" id="input_lokasi">
                                        <select id="select2_lokasi_barang" name="lokasi_barang">
                                            <option></option>                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-1" style="padding-top: 11px !important; display:none" id="bat_button">
                                        <button type="button" id="batal_button" class="btn btn-danger-alt" onclick="hideLokasi()"> &nbsp;Batal&nbsp;</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 15px !important;">
                                        Foto Barang * &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                        @if (!$dokumentasi->isEmpty())
                                        <div class="col-sm-7" id="imgPrevContainer">                                    
                                            <div class="images_prev_lang">                                            
                                                <script>
                                                    var counter = {!!json_encode($dokumentasi) !!};

                                                    counter = counter.length
                                                </script>
                                                  @foreach ($dokumentasi as $foto)
                                                  <div class="img" onclick="imagesNewTab('{{$foto->nama_file_service}}')"
                                                      style="background-image:url({{ asset('/dokumentasi/barang_service/get-foto/' . $foto->nama_file_service) }})"
                                                      >
                                                      <span></span>
                                                  </div>            
                                                  @endforeach
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-sm-7">
                                            <div class="wrap-input100">
                                                <input class="input100" readonly
                                                    value="Foto tidak ada">
                                                <span class="focus-input100"></span>
                                            </div>
                                        </div>
                                        @endif
                                </div>

                                <div class="form-group" id="ubah_status">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;"> Status Barang Service &nbsp;&nbsp;&nbsp;&nbsp; : 
                                    </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input class="input100" readonly
                                                type="text" autocomplete="off" id="status_lama"
                                                value="{{ $data->status_barang }}">
                                            <span class="focus-input100" ></span>
                                        </div>
                                    </div>
                                        
                                    <div class="col-sm-1" style="padding-top: 11px !important; display:block" id="ed_button2">
                                        <button type="button" id="edit_button2" class="btn btn-success-alt" onclick="showStatusBaru()"> Ubah?</button>
                                    </div>
                                    
                                    <label class="col-sm-3 control-label" style="padding-top: 17px !important; display:none" id="label_status">
                                        Ubah Status Barang Service &nbsp;&nbsp;&nbsp;&nbsp; : </label> 

                                    <div class="col-sm-7" style="padding-top: 11px !important; display:none" id="input_status">
                                        <select id="select2_status_barang" name="status_barang"  onchange="checkPlihanUser()">
                                            <option></option>                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-1" style="padding-top: 11px !important; display:none" id="bat_button2">
                                        <button type="button" id="batal_button2" class="btn btn-danger-alt"> &nbsp;Batal&nbsp;</button>
                                    </div>
                                </div>                                                        
                                <div class="alert alert-info">
                                    <i class="fa fa-fw fa-info-circle"></i>&nbsp; <strong>Info* :</strong> Field foto barang 
                                    tidak dapat diubah
                                </div>

                                <div class="panel-footer">
                                    <div class="row">
                                        <div class=" col-sm-offset-5 col-sm-7">
                                            <button id="submit" class="btn btn-primary-alt" type="submit">Submit</button>
                                            <button id="cancel" type="reset" class="btn btn-danger-alt" onclick="hideAll()">Reset</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                </div>

            </div> <!-- .container-fluid -->
        </div> <!-- #page-content -->
    
    </div>
    @if ($errors->has('failed'))
        <script>
            var error_failed = {
                !!json_encode($errors - > first('failed')) !!
            };

        </script>
    @endif
@stop
@section('script')
    <script type="text/javascript" src="{{ asset('plugins/form-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Date Range Picker -->
    <!-- Load page level scripts form validation-->
    <script>
        // See Docs
        window.ParsleyConfig = {
            successClass: 'info-success',
            errorClass: 'alert-validate',
            classHandler: function(el) {
                return el.$element.parent();
            }
        };

    </script>
    <script type="text/javascript" src="{{ asset('plugins/form-parsley/parsley.js') }}"></script>
    <!-- Validate Plugin / Parsley -->
    <script type="text/javascript" src="{{ asset('plugins/form-inputmask/dist/jquery.inputmask.js') }}"></script>
    <!-- Input Masks Plugin -->
    <!-- End loading page level scripts form validation-->

    <!--Load page level scripts forms components-->
    <script type="text/javascript" src="{{ asset('plugins/form-select2/select2.js') }}"></script>
    {{-- <script type="text/javascript" src="{{asset('plugins/iCheck/icheck.min.js')}}"></script><!-- iCheck --> --}}
    <!-- Advanced Select Boxes -->
    <script type="text/javascript" src="{{ asset('demo/demo-edit-barang-service-for-kasir.js') }}"></script>
    <!--Must Include -->

    <!--End loading page level scripts formscomponents-->
@stop
