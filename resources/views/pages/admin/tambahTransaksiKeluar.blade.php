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
                <li>Transaksi Pengeluaran</li>
                <li class="active"><a href="">Tambah Transaksi Keluar</a></li>

            </ol>
            <div class="page-heading">
                <h1>Tambah Transaksi Keluar</h1>
            </div>
            <div class="container-fluid">
                @if (\Session::has('success'))
                <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p>{{\Session::get('success')}}</p>
                </div>
            @endif
            @if (\Session::has('errors'))
                <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p>{{\Session::get('errors')}}</p>
                </div>
            @endif


                <div data-widget-group="group1">
                    <div class="panel panel-midnightblue">
                        <div class="panel-heading">
                            <h2>Form Tambah Transaksi Keluar</h2>
                        </div>
                        <div class="panel-body">

                            <form action="{{route('addTransaksiKeluar')}}" method="POST" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Deskripsi/Keterangan  &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('keterangan') is-invalid @enderror"
                                                type="text" name="keterangan" autocomplete="off"
                                                value="{{ old('keterangan') }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                        @error('keterangan')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Jumlah Pengeluaran &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100 @error('jumlah_pengeluaran') is-invalid @enderror"
                                                type="number" name="jumlah_pengeluaran" autocomplete="off"
                                                value="{{ old('jumlah_pengeluaran') }}" min="1">
                                                <span class="focus-input100" ></span>                                                    
                                            </div>
                                            @error('jumlah_pengeluaran')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                            @enderror
                                        </div>
                                </div>
                            
                                
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Tanggal Transaksi &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100 input-group" data-validate="Harus Diisi">
                                            <span id="date-rangepicker-transaksi-keluar" class="input-group-addon"
                                                style="border: none; background-color: inherit !important;"><i
                                                    id="cal-click" class="fas fa-calendar-alt"></i></span>
                                            <input class="input100 mask @error('tanggal_transaksi') is-invalid @enderror"
                                                type="text" name="tanggal_transaksi" autocomplete="off"
                                                value="{{ old('tanggal_transaksi') }}" spellcheck="false" required>
                                            <span class="focus-input100" data-placeholder="Tanggal Instalasi"></span>
                                        </div>
                                        @error('tanggal_transaksi')
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
    <script type="text/javascript" src="{{ asset('demo/demo-tambah-transaksi-keluar.js') }}"></script>
    <!--Must Include -->

    <!--End loading page level scripts formscomponents-->
@stop
