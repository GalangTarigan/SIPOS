@extends('layout.indexOfAdmin')
@section('css')
    <link type="text/css" href="{{ asset('plugins/form-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- DateRangePicker -->
    <link type="text/css" href="{{ asset('plugins/form-select2/select2.css') }}" rel="stylesheet"> <!-- Select2 -->
    <link type="text/css" href="{{ asset('plugins/form-select2/select2-skins.css') }}" rel="stylesheet">
    <!-- Select2 skin -->
    <link type="text/css" href="{{ asset('plugins/iCheck/skins/minimal/blue.css') }}" rel="stylesheet"> <!-- iCheck -->
    <link type="text/css" href="{{ asset('css/form-components.css') }}" rel="stylesheet"> <!-- form components-->
@stop
@section('content')
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">

                <li><a href="{{ route('dashboardAdmin') }}">Home</a></li>
                <li>Barang Service</li>
                <li class="active"><a href="">Buat Catatan Service</a></li>

            </ol>
            <div class="page-heading">
                <h1>Buat Catatan Service</h1>
            </div>
            <div class="container-fluid">
                <div data-widget-group="group1">
                    <div class="panel panel-midnightblue">
                        <div class="panel-heading">
                            <h2>Form Buat Catatan Service</h2>
                        </div>
                        <div class="panel-body">
                    
                            <form action="{{route('addBarangService')}}" method="POST" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Nama Pelanggan &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100 @error('nama_pelanggan') is-invalid @enderror" type="text"
                                                name="nama_pelanggan" autocomplete="off" value="{{ old('nama_pelanggan') }}">
                                            <span class="focus-input100" data-placeholder="Nama Pelanggan"></span>
                                        </div>
                                        @error('nama_pelanggan')   
                                        <span class="text-danger">
                                            <div class="parsley-required">{{$message}}</div></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">No.Telepon &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required type="number" minlength="10" class="input100 mask @error('no_telepon') is-invalid @enderror" name="no_telepon"
                                                   autocomplete="off" value="{{old('no_telepon')}}" onKeyPress="if(this.value.length==12) return false;">

                                            <span class="focus-input100"></span>
                                        </div>
                                        @error('no_telepon')   
                                            <span class="text-danger"><div class="parsley-required">{{$message}}</div></span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Jenis
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100 @error('jenis_barang') is-invalid @enderror"
                                                type="text" name="jenis_barang" autocomplete="off"
                                                value="{{ old('jenis_barang') }}">
                                            <span class="focus-input100" data-placeholder="Jenis Barang"></span>
                                        </div>
                                        @error('jenis_barang')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"
                                        style="padding-top: 11px !important;">Permasalahan &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100 @error('permasalahan') is-invalid @enderror"
                                                type="text" name="permasalahan" autocomplete="off"
                                                value="{{ old('permasalahan') }}" >
                                            <span class="focus-input100" data-placeholder="Permasalahan"></span>
                                        </div>
                                        @error('permasalahan')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Kelengkapan
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100 @error('kelengkapan') is-invalid @enderror"
                                                type="text" name="kelengkapan" autocomplete="off"
                                                value="{{ old('kelengkapan') }}">
                                            <span class="focus-input100" data-placeholder="Kelengkapan Barang"></span>
                                        </div>
                                        @error('kelengkapan')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                        
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Lokasi Barang &nbsp;&nbsp;&nbsp;&nbsp; : 
                                        {{-- <i id="loadingIcon4" class="fa fa-circle-notch fa-spin"></i> --}}
                                    </label>
                                    <div class="col-sm-7">
                                        <select required class="@error('lokasi_barang') is-invalid @enderror"
                                            id="select2_lokasi_barang" name="lokasi_barang">
                                            <option></option>
                                        </select>
                                        @if ($errors->has('lokasi_barang'))

                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>

                                        @endif
                                    </div>
                                </div>

                            

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Upload
                                        Foto (Opsional) &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7" id="imgPrevContainer">
                                        <div class="images_prev">
                                            <div class="pic">
                                                <i class="fas fa-plus fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="file" name="images[]" accept="image/*" multiple
                                    style="display:none !important" />

                                    <div class="panel-body">
                                        <div class="alert alert-info">
                                            <i class="fa fa-fw fa-info-circle"></i>&nbsp; <strong>Info :</strong> Upload foto bersifat 
                                            <strong>Opsional</strong> (tidak wajib)
                                             <br>
                                            <i class="fa fa-fw fa-info-circle"></i>&nbsp; <strong>Info :</strong> Jumlah foto yang 
                                            dapat diupload maksimal <strong>5 foto.</strong>
                                    </div>


                                <div class="panel-footer">
                                    <div class="row">
                                        <div class=" col-sm-offset-5 col-sm-7">
                                            <button id="submit" class="btn btn-primary-alt" type="submit">Submit</button>
                                            <button id="cancel" type="reset" class="btn btn-danger-alt">Reset</button>
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
    <script type="text/javascript" src="{{ asset('demo/demo-tambah-barang-service.js') }}"></script>
    <!--Must Include -->

    <!--End loading page level scripts formscomponents-->
@stop
