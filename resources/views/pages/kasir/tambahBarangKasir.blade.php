@extends('layout.indexOfKasir')
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

                <li><a href="{{ route('dashboardKasir') }}">Home</a></li>
                <li>Manajemen Barang</li>
                <li><a href="{{ route('showDaftarBarangKasir') }}">Daftar Barang</a></li>
                <li class="active"><a href="">Tambah Barang</a></li>

            </ol>
            <div class="page-heading">
                <h1>Tambah Barang</h1>
            </div>
            <div class="container-fluid">
                <div data-widget-group="group1">
                    <div class="panel panel-midnightblue">
                        <div class="panel-heading">
                            <h2>Form Tambah Barang Baru</h2>
                        </div>
                            <form action="{{ Route('addBarangKasir') }}" method="POST" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Kategori Barang &nbsp;&nbsp;&nbsp;&nbsp; : 
                                        <i id="loadingIcon3" class="fa fa-circle-notch fa-spin"></i>
                                    </label>
                                    <div class="col-sm-7">
                                        <select required class="@error('kategori_barang') is-invalid @enderror"
                                            id="select2_kategori_barang" name="kategori_barang">
                                            <option></option>
                                        </select>
                                        @if (!is_null(old('kategori_barang')))
                                            <script>
                                                var oldValS = {
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
                                    <label class="col-sm-3 control-label">Merk Barang &nbsp;&nbsp;&nbsp;&nbsp; : 
                                        <i id="loadingIcon1" class="fa fa-circle-notch fa-spin"></i>
                                    </label>
                                    <div class="col-sm-7">
                                        <select required class="@error('merk') is-invalid @enderror"
                                            id="select2_merk_barang" name="merk">
                                            <option></option>
                                        </select>
                                        @if (!is_null(old('merk')))
                                            <script>
                                                var oldValM = {
                                                    !!json_encode(old('merk')) !!
                                                };

                                            </script>
                                        @endif
                                        @if ($errors->has('merk'))
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>

                                        @endif
                                    </div>
                                </div>

                                

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Tipe
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('tipe_barang') is-invalid @enderror"
                                                type="text" name="tipe_barang" autocomplete="off"
                                                value="{{ old('tipe_barang') }}">
                                            <span class="focus-input100" data-placeholder="Tipe Barang"></span>
                                        </div>
                                        @error('tipe_barang')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label"
                                        style="padding-top: 11px !important;">Stock &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('jumlah') is-invalid @enderror"
                                                type="number" min="1" name="jumlah" autocomplete="off"
                                                value="{{ old('jumlah') }}">
                                            <span class="focus-input100" data-placeholder="Jumlah Barang"></span>
                                        </div>
                                        @error('jumlah')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Harga
                                        Modal &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('modal') is-invalid @enderror"
                                                type="number" min="1" name="modal" autocomplete="off"
                                                value="{{ old('modal') }}">
                                            <span class="focus-input100" data-placeholder="Modal"></span>
                                        </div>
                                        @error('modal')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Harga
                                        Jual &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('jual') is-invalid @enderror"
                                                type="number" min="1" name="jual" autocomplete="off"
                                                value="{{ old('jual') }}">
                                            <span class="focus-input100" data-placeholder="Harga Jual"></span>
                                        </div>
                                        @error('jual')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Nama Perusahaan Sales &nbsp;&nbsp;&nbsp;&nbsp; : 
                                        <i id="loadingIcon4" class="fa fa-circle-notch fa-spin"></i>
                                    </label>
                                    <div class="col-sm-7">
                                        <select required class="@error('nama_sales') is-invalid @enderror"
                                            id="select2_nama_sales" name="nama_sales">
                                            <option></option>
                                        </select>
                                        @if (!is_null(old('nama_sales')))
                                            <script>
                                                var oldValP = {
                                                    !!json_encode(old('nama_sales')) !!
                                                };

                                            </script>
                                        @endif
                                        @if ($errors->has('nama_sales'))

                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>

                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Keterangan
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required
                                                class="input100 @error('keterangan_barang') is-invalid @enderror"
                                                type="text" name="keterangan_barang" autocomplete="off"
                                                value="{{ old('keterangan_barang') }}">
                                            <span class="focus-input100" data-placeholder="Keterangan Barang"></span>
                                        </div>
                                        @error('keterangan_barang')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Upload
                                        Foto &nbsp;&nbsp;&nbsp;&nbsp; : </label>
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

                                    <div class="panel-body">
                                        <div class="alert alert-info">
                                            <i class="fa fa-fw fa-info-circle"></i>&nbsp; <strong>Info :</strong> Harap upload
                                            dokumentasi foto sebelum anda men-submit form barang baru <br>
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
    <script type="text/javascript" src="{{ asset('demo/demo-tambah-barang-kasir.js') }}"></script>
    <!--Must Include -->

    <!--End loading page level scripts formscomponents-->
@stop
