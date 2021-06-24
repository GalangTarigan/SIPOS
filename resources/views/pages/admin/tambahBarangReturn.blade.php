@extends('layout.indexOfAdmin')
@section('css')
    <link type="text/css" href="{{ asset('plugins/form-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- DateRangePicker -->
    <link type="text/css" href="{{ asset('plugins/form-select2/select2.css') }}" rel="stylesheet"> <!-- Select2 -->
    <link type="text/css" href="{{ asset('plugins/form-select2/select2-skins.css') }}" rel="stylesheet">
    
    <link type="text/css" href="{{ asset('plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet"> <!-- Touchspin -->
    <!-- Custom Checkboxes / iCheck -->
    <link type="text/css" href="{{ asset('css/subjek-keluhan.css')}}" rel="stylesheet"> 
    <link type="text/css" href="{{asset('css/detail-keluhan.css')}}" rel="stylesheet"> <!-- keluhan components-->
    <link type="text/css" href="{{ asset('css/form-components.css') }}" rel="stylesheet"> <!-- form components-->

@stop
@section('content')
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">

                <li><a href="{{ route('dashboardAdmin') }}">Home</a></li>
                <li>Manajemen Barang</li>
                <li><a href="{{ route('showDaftarBarangReturn') }}">Daftar Barang</a></li>
                <li class="active"><a href="">Tambah Barang Return</a></li>

            </ol>
            <div class="page-heading">
                <h1>Tambah Barang Return</h1>
            </div>
            <div class="container-fluid">
                <div data-widget-group="group1">
                    <div class="panel panel-midnightblue">
                        <div class="panel-heading">
                            <h2>Form Tambah Barang Return</h2>
                        </div>
                        <div class="panel-body">

                            {{-- @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error->message }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif --}}

                            <form action="{{route('addBarangReturn')}}" method="POST" class="form-horizontal row-border" data-parsley-validate
                                data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}


                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba">Kategori Barang &nbsp;&nbsp;&nbsp;&nbsp; : 
                                        <i id="loadingIcon1" class="fa fa-circle-notch fa-spin"></i>
                                    </label>
                                    <div class="col-sm-7">
                                        <select required class="@error('kategori_barang') is-invalid @enderror"
                                            id="select2_kategori_barang" name="kategori_barang">
                                            <option></option>
                                        </select>
                                        
                                        @if (!is_null(old('kategori_barang')))
                                            <script>
                                                var oldValKat = {
                                                    !!json_encode(old('kategori_barang')) !!
                                                };

                                            </script>
                                        @endif
                                        @if ($errors->has('kategori_barang'))
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>

                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba">Merk Barang &nbsp;&nbsp;&nbsp;&nbsp; : 
                                        <i id="loadingIcon2" class="fa fa-circle-notch fa-spin"></i>
                                    </label>
                                    <div class="col-sm-7">
                                        <select required class="@error('merk_barang') is-invalid @enderror"
                                            id="select2_merk_barang" name="merk_barang">
                                            <option></option>
                                        </select>
                                        
                                        @if (!is_null(old('merk_barang')))
                                            <script>
                                                var oldValS = {
                                                    !!json_encode(old('merk_barang')) !!
                                                };

                                            </script>
                                        @endif
                                        @if ($errors->has('merk_barang'))
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>

                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba">Tipe Barang &nbsp;&nbsp;&nbsp;&nbsp; : 
                                        <i id="loadingIcon3" class="fa fa-circle-notch fa-spin"></i>
                                    </label>
                                    <div class="col-sm-7">
                                        <select required class="@error('id_barang') is-invalid @enderror"
                                            id="select2_tipe_barang" name="id_barang">
                                            <option></option>
                                        </select>
                                        @if (!is_null(old('id_barang')))
                                            <script>
                                                var oldValS = {
                                                    !!json_encode(old('id_barang')) !!
                                                };
                                            </script>
                                        @endif
                                        @if ($errors->has('id_barang'))
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>

                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">
                                       Nama Sales &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100" autocomplete="off"
                                            type="text" name="nama_sales" id="nama_sales" readonly>
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">
                                        Nomor Seri Barang&nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('tipe_barang') is-invalid @enderror"
                                                type="text" name="no_seri" autocomplete="off"
                                                value="{{ old('no_seri') }}" placeholder="Ketik nomor seri barang.....">
                                            <span class="focus-input100" data-placeholder="no_seri"></span>
                                        </div>
                                        @error('no_seri')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">
                                        Kerusakan Barang&nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('tipe_barang') is-invalid @enderror"
                                                type="text" name="kerusakan" autocomplete="off"
                                                value="{{ old('kerusakan') }}" placeholder="Ketik kerusakan barang.....">
                                            <span class="focus-input100" data-placeholder="kerusakan"></span>
                                        </div>
                                        @error('kerusakan')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">Status
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7 labalaba" style="padding-top: 11px !important;" id="status">
                                        <input type="radio" onclick="yesnoCheck();" name="status_barang" id="noCheck" value="Belum diambil"
                                        checked>
                                        &nbsp;Belum diambil
                                        <br>
                                        <input type="radio" onclick="yesnoCheck();" name="status_barang" id="yesCheck" value="Sudah Diambil"> 
                                        &nbsp;Telah dibawa Sales
                                    </div>
                                </div>

                                
                                    <div class="form-group"style="display:none" id="div1">
                                        <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">
                                        Tanggal Barang diambil &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                        <div class="col-sm-7 labalaba">
                                            <div class="wrap-input100 input-group">
                                                <span id="date-rangepicker-barang-return" class="input-group-addon"
                                                    style="border: none; background-color: inherit !important;"><i
                                                        id="cal-click" class="fas fa-calendar-alt"></i></span>
                                                <input class="input100 mask @error('tanggal_barang_return') is-invalid @enderror"
                                                    type="text" name="tanggal_barang_return" autocomplete="off"
                                                    value="{{ old('tanggal_barang_return') }}" spellcheck="false">
                                                <span class="focus-input100" data-placeholder="Tanggal Instalasi"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="control-label col-sm-3 labalaba">Jumlah Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                        <div class="col-sm-7 labalaba">
                                            <input type="number"
                                            id="jumlah_barang" name="jumlah_barang">
                                        </div>
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
    <script type="text/javascript" src="{{ asset('plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}"></script> <!-- Touchspin -->
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
    <script type="text/javascript" src="{{ asset('plugins/form-inputmask/dist/jquery.inputmask.js') }}"></script>
    <!-- Input Masks Plugin -->
    <!-- End loading page level scripts form validation-->

    <script type="text/javascript" src="{{ asset('plugins/form-parsley/parsley.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/form-inputmask/dist/jquery.inputmask.js') }}"></script>
    <!-- iCheck -->
    <script type="text/javascript" src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

    <!--Load page level scripts forms components-->
    <script type="text/javascript" src="{{ asset('plugins/form-select2/select2.js') }}"></script>
    <!-- Advanced Select Boxes -->
    <script type="text/javascript" src="{{ asset('demo/demo-tambah-barang-return.js') }}"></script>
    <!--Must Include -->

    <!--End loading page level scripts formscomponents-->
@stop
