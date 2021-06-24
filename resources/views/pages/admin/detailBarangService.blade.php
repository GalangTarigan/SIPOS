@extends('layout.indexOfAdmin')
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
<div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">

                <li><a href="{{ route('dashboardAdmin') }}">Home</a></li>
                <li>Barang Service</li>
                <li><a href="{{ route('showDaftarBarangService') }}">Daftar Barang Service</a></li>
                <li class="active"><a href="">Detail Catatan Service</a></li>

            </ol>
            <div class="page-heading">
                <h1>Detail Catatan Service</h1>
            </div>
            <div class="container-fluid">
                <div data-widget-group="group1">
                    <div class="panel panel-midnightblue">
                        <div class="panel-heading">
                            <h2>Form Detail Catatan Service</h2>
                        </div>
                        <div class="panel-body">
                    
                            <form action="{{route('addBarangService')}}" method="POST" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Nama Pelanggan &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100" type="text" readonly
                                                name="nama_pelanggan" autocomplete="off" value="{{ $data->nama_pelanggan }}">
                                            <span class="focus-input100" data-placeholder="Nama Pelanggan"></span>
                                        </div>
                                       
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">No.Telepon &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required type="number" minlength="10" class="input100 " name="no_telepon" readonly
                                                   autocomplete="off" value="{{ $data->no_telepon }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Jenis
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100" readonly
                                                type="text" name="jenis_barang" autocomplete="off"
                                                value="{{ $data->jenis_barang }}" style="text-transform: capitalize">
                                            <span class="focus-input100" data-placeholder="Jenis Barang"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"
                                        style="padding-top: 11px !important;">Permasalahan &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100" readonly
                                                type="text" name="permasalahan" autocomplete="off"
                                                value="{{ $data->permasalahan }}" style="text-transform: capitalize" >
                                            <span class="focus-input100" data-placeholder="Permasalahan"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Kelengkapan
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100" readonly
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
                                            <input required class="input100" readonly
                                                type="text" name="lokasi_barang" autocomplete="off"
                                                value="{{ $data->lokasi_barang }}">
                                            <span class="focus-input100" data-placeholder="Lokasi Barang"></span>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">
                                        Foto Barang &nbsp;&nbsp;&nbsp;&nbsp;:</label>
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
                                                <input required class="input100" readonly
                                                    value="Foto tidak ada">
                                                <span class="focus-input100"></span>
                                            </div>
                                        </div>
                                        @endif
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Status
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100" readonly id="status_barang"
                                                type="text" name="status_barang" autocomplete="off"
                                                value="{{ $data->status_barang }}">
                                            <span class="focus-input100" data-placeholder="Status Barang"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" style="display:block" id="form_modal">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Total
                                        Biaya Service &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100" readonly
                                                type="text" name="status_barang" autocomplete="off"
                                                value="{{ $data->total_biaya_service }}">
                                            <span class="focus-input100" data-placeholder="Status Barang"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" style="display:block" id="form_biaya">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Modal Biaya
                                        Service &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100" readonly
                                                type="text" name="status_barang" autocomplete="off"
                                                value="{{ $data->modal_biaya_service }}">
                                            <span class="focus-input100" data-placeholder="Status Barang"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" style="display:block" id="form_status_bayar">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Status Pembayaran
                                        Service &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100" readonly
                                                type="text" name="status_bayar" autocomplete="off"
                                                value="{{ $data->status_pembayaran }}">
                                            <span class="focus-input100" data-placeholder="Status Barang"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" style="display:none" id="form_note">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Alasan Tidak Dapat Diperbaiki &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100" readonly
                                                type="text" name="note" autocomplete="off"
                                                value="{{ $data->note_tidak_bisa_diperbaiki }}">
                                            <span class="focus-input100"></span>
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
    <!-- Advanced Select Boxes -->
    <script type="text/javascript" src="{{ asset('demo/demo-detail-barang-service.js') }}"></script>
    <!--Must Include -->

    <!--End loading page level scripts formscomponents-->
@stop
