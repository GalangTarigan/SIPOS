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
                <li>Manajemen Sales</li>
                <li><a href="{{ route('showSales') }}">Daftar Sales</a></li>
                <li class="active"><a href="">Tambah Sales</a></li>
            </ol>
            <div class="page-heading">
                <h1>Tambah Sales Baru</h1>
            </div>
            <div class="container-fluid">
                @if (\Session::has('success'))
                    <script>
                        var messageSuccessCreateUser = {
                            !!json_encode(session('success')) !!
                        };

                    </script>
                    {{ session()->forget('success') }}
                @endif
                @if (session('failed'))
                    <script>
                        var messageFailedCreateUser = {
                            !!json_encode(session('failed')) !!
                        };

                    </script>
                    {{ session()->forget('failed') }}
                @endif
                <div data-widget-group="group1">
                    <div class="panel panel-midnightblue">
                        <div class="panel-heading">
                            <h2>Form Tambah Sales Baru</h2>
                        </div>
                        <div class="panel-body" style="margin-top: 10px !important">
                        <form class="form-horizontal row-border" action="{{route('addSales')}}" method="POST"
                                class="form-horizontal row-border" data-parsley-validate
                                data-parsley-errors-messages-disabled id="validate-form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Nama
                                        Perusahaan &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('nama_lengkap') is-invalid @enderror"
                                                type="text" name="nama_perusahaan" autocomplete="off"
                                                value="{{ old('nama_lengkap') }}" placeholder="Nama Perusahan">
                                            <span class="focus-input100" data-placeholder="Nama Perusahaan"></span>
                                        </div>
                                        @error('nama_lengkap')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Nama Sales &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('nama_lengkap') is-invalid @enderror"
                                                type="text" name="nama_sales" autocomplete="off"
                                                value="{{ old('nama_lengkap') }}" placeholder="Nama Sales">
                                            <span class="focus-input100" data-placeholder="Nama Sales"></span>
                                        </div>
                                        @error('nama_lengkap')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label"
                                        style="padding-top: 11px !important;">No.Telepon &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required type="number" minlength="10" maxlength="15"
                                                class="input100 mask @error('no_telepon') is-invalid @enderror"
                                                name="no_telepon" autocomplete="off" value="{{ old('no_telepon') }}" onKeyPress="if(this.value.length==12) return false;">
                                            <span class="focus-input100"></span>
                                        </div>
                                        @error('no_telepon')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Alamat &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('nama_lengkap') is-invalid @enderror"
                                                type="text" name="alamat" autocomplete="off"
                                                value="{{ old('nama_lengkap') }}" placeholder="Alamat">
                                            <span class="focus-input100" data-placeholder="Alamat"></span>
                                        </div>
                                        @error('nama_lengkap')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Nama & No.Rekening &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('nama_lengkap') is-invalid @enderror"
                                                type="text" name="nama_no_rekening" autocomplete="off"
                                                value="{{ old('nama_lengkap') }}" placeholder="Contoh: Galang/123-456-789">
                                            <span class="focus-input100" data-placeholder="Contoh: Galang/123-456-789"></span>
                                        </div>
                                        @error('nama_lengkap')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Product Dijual &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('nama_lengkap') is-invalid @enderror"
                                                type="text" name="product" autocomplete="off"
                                                value="{{ old('nama_lengkap') }}" placeholder="Daftar Product">
                                            <span class="focus-input100" data-placeholder="Daftar Product"></span>
                                        </div>
                                        @error('nama_lengkap')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
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
                <!--data widget group1-->
            </div> <!-- .container-fluid -->
        </div> <!-- #page-content -->
    </div>
@stop
@section('script')

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
    <script src="{{ asset('plugins/form-autosize/autosize.js') }}"></script> <!-- Autogrow Text Area -->

    <script type="text/javascript" src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script><!-- iCheck -->

    <script type="text/javascript" src="{{ asset('demo/demo-tambah-sales.js') }}"></script>
    <!--Must Include -->


    <!--End loading page level scripts formscomponents-->
@stop
