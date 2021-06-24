@extends('layout.indexOfKasir')
@section('css')
    <link type="text/css" href="{{ asset('plugins/form-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- DateRangePicker -->
    <link type="text/css" href="{{ asset('plugins/form-select2/select2.css') }}" rel="stylesheet"> <!-- Select2 -->
    {{-- <link type="text/css" href="{{ asset('plugins/form-select2/select2-skins.css') }}" rel="stylesheet"> --}}
    <!-- Select2 skin -->
    <link type="text/css" href="{{ asset('plugins/iCheck/skins/minimal/blue.css') }}" rel="stylesheet"> <!-- iCheck -->
    <link type="text/css" href="{{ asset('plugins/iCheck/skins/minimal/blue.css') }}" rel="stylesheet"> <!-- iCheck -->
    <link type="text/css" href="{{ asset('plugins/iCheck/skins/minimal/_all.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}"
        rel="stylesheet"> <!-- Touchspin -->
    <!-- Custom Checkboxes / iCheck -->
    <link type="text/css" href="{{ asset('css/subjek-keluhan.css') }}" rel="stylesheet">
    <link type="text/css" href="{{asset('css/detail-keluhan.css')}}" rel="stylesheet"> <!-- keluhan components-->

@stop
@section('content')
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">

                <li><a href="{{ route('dashboardKasir') }}">Home</a></li>
                <li>Manajemen Barang</li>
                <li><a href="{{ route('showDaftarBarangReturn-kasir') }}">Daftar Barang Return</a></li>
                <li class="active"><a href="">Edit Barang Return</a></li>

            </ol>
            <div class="page-heading">
                <h1>Edit Barang Return</h1>
            </div>
            <div class="container-fluid">
                <div data-widget-group="group1">
                    <div class="panel panel-midnightblue">
                        <div class="panel-heading">
                            <h2>Form Edit Barang Return</h2>
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
                            
                            

                            <form action="{{ route('editBarangReturn-kasir') }}" method="POST" class="form-horizontal row-border" data-parsley-validate
                                data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">
                                        Kategori Barang*  &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7 labalaba" style="padding-top: 11px !important;">
                                        <div class="wrap-input100" > 
                                                <p> {{ $data->nama_kategori }}</p>
                                                <span class="focus-input100"></span>
                                            </div>
                                        </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">
                                        Merk Barang*  &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7 labalaba" style="padding-top: 11px !important;">
                                        <div class="wrap-input100" > 
                                            <input name="barang_id" value="{{ $data->barang_id }}" required type="hidden">
                                            <input name="id_barang_return" value="{{ $data->id_barang_return }}" required type="hidden">
                                                <p> {{ $data->nama_merk }}</p>
                                                <span class="focus-input100"></span>
                                            </div>
                                        </div>
                                </div>

                                

                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">
                                        Tipe Barang* &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7 labalaba" style="padding-top: 11px !important;">
                                        <div class="wrap-input100" > 
                                                <p> {{ $data->tipe_barang }}</p>
                                                <span class="focus-input100"></span>
                                            </div>
                                        </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">
                                        Nama Sales* &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7 labalaba" style="padding-top: 11px !important;">
                                        <div class="wrap-input100" > 
                                                <p> {{ $data->nama_sales }}</p>
                                                <span class="focus-input100" ></span>
                                            </div>
                                        </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">
                                        Nomor Seri Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7 labalaba">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input required class="input100 @error('tipe_barang') is-invalid @enderror"
                                                type="text" name="no_seri" autocomplete="off"
                                                value="{{ $data->no_seri }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">
                                        Kerusakan &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7 labalaba">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('tipe_barang') is-invalid @enderror"
                                                type="text" name="kerusakan" autocomplete="off"
                                                value="{{ $data->kerusakan }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group" id="div_status_barang">
                                    <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">Status
                                        Barang  &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7 labalaba" style="padding-top: 11px !important;" id="status_div">
                                    </div>
                                </div>

                                
                               

                                <div class="form-group" style="display:none" id="div1">
                                    <label class="col-sm-3 control-label labalaba" style="padding-top: 11px !important;">
                                        Tanggal Barang diambil  &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7 labalaba">
                                        <div class="wrap-input100 input-group" id="div_tanggal" data-validate="Kolom tidak boleh kosong">
                                            <span id="date-rangepicker-barang-return" class="input-group-addon"
                                                style="border: none; background-color: inherit !important;"><i
                                                    id="cal-click" class="fas fa-calendar-alt"></i></span>
                                            
                                            <span class="focus-input100" data-placeholder="Tanggal Instalasi"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group " id="wrapper-field" style="display:none">
                                    <label class="col-sm-3 control-label"
                                        style="padding-top: 11px !important;">Jumlah Barang Return Saat ini  &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="row">                                            
                                            <div class="col-sm-7" >
                                                <div class="wrap-input100" data-validate="Harus Diisi">
                                                    <input class="first-pic-field input100 @error('namaPic.0') is-invalid @enderror"
                                                        name="jumlah_saat_ini"  type="text"
                                                        autocomplete="off" value="{{ $data->jumlah_return }}" readonly>
                                                    <span class="focus-input100"></span>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-5" style="padding: 13px">
                                                <button type="button" id="add_button" class="btn btn-success">&nbsp;Tambahkan&nbsp;</button>
                                                    <button type="button" id="add1_button" class="btn btn-success">&nbsp;Kurangkan&nbsp;</button>
                                            </div>
                                            

                                            <div id="after-fields" style="display:none">
                                                <div class="col-sm-11" style="padding: 11px">                                                    
                                                <label class="col-sm-5 control-label bold"
                                                    style="padding-top: 5px !important; text-align:center; color:red;">
                                                    Jumlah Barang Return Baru &nbsp;&nbsp; : </label>
                                                    <input required type="number" id="jumlah_barang_tambah" name="jumlah_barang_tambah" 
                                                        value="0">                                                                                                        
                                                </div>
                                                
                                               
                                            </div>
                                            
                                            <div id="after-fields1" style="display:none">
                                            
                                                <div class="col-sm-11" style="padding: 11px">                                                    
                                                <label class="col-sm-5 control-label bold"
                                                    style="padding-top: 5px !important; text-align:center; color:blue;">
                                                    Kurangi Jumlah Barang &nbsp;&nbsp; : </label>
                                                    <input required type="number" id="jumlah_barang_kurang" name="jumlah_barang_kurang" 
                                                    value="0">                                                                                                        >                                                                                                        
                                                </div>
                                                
                                                
                                            </div>
                                            <div class="col-sm-1" style="padding: 11px">
                                                <button disabled style="display:none" type='button'
                                                    id='remove_button' class='btn btn-danger'><i
                                                        class='fas fa-times'></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="alert alert-info">
                                    <i class="fa fa-fw fa-info-circle"></i>&nbsp; <strong>Info :</strong> Apabila anda ingin menambah jumlah dari barang return silahkan klik tombol + (plus) <br>
                                    <i class="fa fa-fw fa-info-circle"></i>&nbsp; <strong>Info :</strong> Apabila anda ingin mengurangi jumlah dari barang return silahkan klik tombol - (minus) <br>
                                    <i class="fa fa-fw fa-info-circle"></i>&nbsp; <strong>Info :</strong> Kolom bertanda bintang (*) tidak dapat diubah
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
    <script type="text/javascript" src="{{ asset('plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}">
    </script> <!-- Touchspin -->
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
  
        var jumlahMax = {!! json_encode($data->jumlah) !!};
        var jumlahReturnSaatIni = {!! json_encode($data->jumlah_return) !!};
        
    </script>
    <script type="text/javascript" src="{{ asset('plugins/form-parsley/parsley.js') }}"></script>
    <!-- Validate Plugin / Parsley -->
    <script type="text/javascript" src="{{ asset('plugins/form-inputmask/dist/jquery.inputmask.js') }}"></script>
    <!-- Input Masks Plugin -->
    <!-- End loading page level scripts form validation-->

    <!-- iCheck -->
    <script type="text/javascript" src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

    <!--Load page level scripts forms components-->
    <script type="text/javascript" src="{{ asset('plugins/form-select2/select2.js') }}"></script>
    <!-- Advanced Select Boxes -->
    <script type="text/javascript" src="{{ asset('demo/demo-edit-barang-return.js') }}"></script>
    <!--Must Include -->

    <!--End loading page level scripts formscomponents-->
@stop
