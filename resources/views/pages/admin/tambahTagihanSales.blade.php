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
                <li>Manajemen Sales</li>
                <li class="active"><a href="">Tambah Tagihan Sales</a></li>

            </ol>
            <div class="page-heading">
                <h1>Tambah Tagihan Sales</h1>
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
                            <h2>Form Tambah Tagihan Baru</h2>
                        </div>
                        <div class="panel-body">
                            <div class="alert alert-info">
                                <i class="fa fa-fw fa-info-circle"></i>&nbsp; <strong>Info :</strong> Harap upload
                                dokumentasi foto <strong> FAKTUR TAGIHAN </strong>sebelum anda men-submit form tambah tagihan baru <br>
                                <i class="fa fa-fw fa-info-circle"></i>&nbsp; <strong>Info :</strong> Maksimal Foto yang diupload hanya 5

                            </div>                           

                            <form action="{{route('addTagihanSales')}}" method="POST" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nama Perusahaan &nbsp;&nbsp;&nbsp;&nbsp; : 
                                        <i id="loadingIcon4" class="fa fa-circle-notch fa-spin"></i>
                                    </label>
                                    <div class="col-sm-7">
                                        <select required class="@error('nama_perusahaan') is-invalid @enderror"
                                            id="select2_nama_perusahaan" name="nama_perusahaan">
                                            <option></option>
                                        </select>
                                        @if (!is_null(old('nama_perusahaan')))
                                            <script>
                                                var oldValP = {
                                                    !!json_encode(old('nama_perusahaan')) !!
                                                };

                                            </script>
                                        @endif
                                        @if ($errors->has('nama_perusahaan'))

                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>

                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Nama
                                        Sales &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required readonly
                                                class="input100 @error('nama_sales') is-invalid @enderror"
                                                type="text" name="nama_sales" autocomplete="off" id="nama_sales"
                                                value="{{ old('nama_sales') }}">
                                                <span class="focus-input100" data-placeholder="Nama Sales"></span>
                                                <input type="text" name="id_sales" id="id_sales" hidden>
                                            </div>
                                            @error('nama_sales')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Nomor Faktur &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                        <div class="col-sm-7">
                                            <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                                <input required class="input100 @error('no_faktur') is-invalid @enderror"
                                                    type="text" name="no_faktur" autocomplete="off"
                                                    value="{{ old('no_faktur') }}">
                                                <span class="focus-input100"></span>
                                            </div>
                                            @error('no_faktur')
                                                <span class="text-danger">
                                                    <div class="parsley-required">{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Tanggal Faktur &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                        <div class="col-sm-7">
                                            <div class="wrap-input100 input-group" data-validate="Harus Diisi">
                                                <span id="date-rangepicker-tanggal-faktur" class="input-group-addon"
                                                    style="border: none; background-color: inherit !important;"><i
                                                        id="cal-click" class="fas fa-calendar-alt"></i></span>
                                                <input class="input100 mask @error('tanggal_faktur') is-invalid @enderror"
                                                    type="text" name="tanggal_faktur" autocomplete="off"
                                                    value="{{ old('tanggal_faktur') }}" spellcheck="false" required>
                                                <span class="focus-input100" data-placeholder="Tanggal Instalasi"></span>
                                            </div>
                                            @error('tanggal_faktur')
                                                <span class="text-danger">
                                                    <div class="parsley-required">{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Jumlah Tagihan &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                        <div class="col-sm-7">
                                            <div class="wrap-input100" data-validate="Inputan tidak valid">
                                                <input required 
                                                    class="input100 @error('jumlah_tagihan') is-invalid @enderror"
                                                    type="number" name="jumlah_tagihan" autocomplete="off" id="jumlah_tagihan"
                                                    value="{{ old('jumlah_tagihan') }}" min="1">
                                                    <span class="focus-input100" data-placeholder="Jumlah Tagihan"></span>                                                    
                                                </div>
                                                @error('jumlah_tagihan')
                                                <span class="text-danger">
                                                    <div class="parsley-required">{{ $message }}</div>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Upload
                                        Foto Faktur &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7" id="imgPrevContainer">
                                        <div class="images_prev">
                                            <div class="pic">
                                                <i class="fas fa-plus fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input required type="file" name="images[]" accept="image/*" multiple
                                    style="display:none !important" />


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
    <script type="text/javascript" src="{{ asset('demo/demo-tambah-tagihan-sales.js') }}"></script>
    <!--Must Include -->

    <!--End loading page level scripts formscomponents-->
@stop
