@extends('layout.indexOfKasir')
@section('css')
    <link type="text/css" href="{{ asset('plugins/form-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- DateRangePicker -->
    <link type="text/css" href="{{ asset('plugins/form-select2/select2.css') }}" rel="stylesheet"> <!-- Select2 -->
    {{-- <link type="text/css" href="{{ asset('plugins/form-select2/select2-skins.css') }}" rel="stylesheet"> --}}
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
                <li class="active"><a href="">Edit Barang</a></li>

            </ol>
            <div class="page-heading">
                <h1>Edit Barang</h1>
            </div>
            <div class="container-fluid">

                <div data-widget-group="group1">
                    <div class="panel panel-midnightblue">
                        <div class="panel-heading">
                            <h2>Form Edit Data Barang {{ $data_barang->nama_merk }} {{ $data_barang->tipe_barang }}</h2>
                        </div>
                        <div class="panel-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error->message }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action=" {{ Route('editBarangKasir') }} " method="POST" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data">
                                {{ csrf_field() }}

                                {{-- from start --}}
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Kategori 
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>                                    
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input name="id_barang" value="{{ $data_barang->id_barang }}" required type="hidden">
                                            <input class="input100" readonly
                                                type="text" autocomplete="off" 
                                                value="{{ $data_barang->nama_kategori }}">
                                            <span class="focus-input100" ></span>
                                        </div>
                                    </div>
                                        
                                    <div class="col-sm-1" style="padding-top: 11px !important; display:block" id="ed_button">
                                        <button type="button" id="edit_button" class="btn btn-success-alt" onclick="show()"> Ubah?</button>
                                    </div>
                                    
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important; display:none" id="label_kategori">
                                        Ubah Kategori Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label> 

                                    <div class="col-sm-7" style="padding-top: 11px !important; display:none" id="input_kategori">
                                        <select id="select2_kategori_barang" name="kategori_barang">
                                            <option></option>                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-1" style="padding-top: 11px !important; display:none" id="bat_button">
                                        <button type="button" id="batal_button" class="btn btn-danger-alt" onclick="hide()"> &nbsp;Batal&nbsp;</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Merk 
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>                                    
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input class="input100" readonly type="text" autocomplete="off" 
                                                value="{{ $data_barang->nama_merk }}">
                                            <span class="focus-input100" ></span>
                                        </div>
                                    </div>
                                        
                                    <div class="col-sm-1" style="padding-top: 11px !important; display:block" id="ed_button_merk">
                                        <button type="button" id="edit_button_merk" class="btn btn-success-alt" onclick="showEditMerk()"> Ubah?</button>
                                    </div>
                                    
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important; display:none" id="label_merk">
                                        Ubah Merk Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label> 

                                    <div class="col-sm-7" style="padding-top: 11px !important; display:none" id="input_merk">
                                        <select id="select2_merk_barang" name="merk">
                                            <option></option>                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-1" style="padding-top: 11px !important; display:none" id="bat_button_merk">
                                        <button type="button" id="batal_button_merk" class="btn btn-danger-alt" onclick="hideEditMerk()"> &nbsp;Batal&nbsp;</button>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Tipe
                                        Barang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                            <input required class="input100 @error('tipe_barang') is-invalid @enderror"
                                                type="text" name="tipe_barang" autocomplete="off"
                                                value="{{ $data_barang->tipe_barang }}">
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
                                                type="number" min="0" name="jumlah" autocomplete="off"
                                                value="{{ $data_barang->jumlah }}">
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
                                                type="number" min="0" name="modal" autocomplete="off"
                                                value="{{ $data_barang->modal }}">
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
                                                type="number" min="0" name="jual" autocomplete="off"
                                                value="{{ $data_barang->jual }}">
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
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;"> Nama Sales &nbsp;&nbsp;&nbsp;&nbsp; : 
                                    </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <input class="input100" readonly
                                                type="text" autocomplete="off" 
                                                value="{{ $data_barang->nama_sales }}">
                                            <span class="focus-input100" ></span>
                                        </div>
                                    </div>
                                        
                                    <div class="col-sm-1" style="padding-top: 11px !important; display:block" id="ed_button2">
                                        <button type="button" id="edit_button2" class="btn btn-success-alt" onclick="show2()"> Ubah?</button>
                                    </div>
                                    
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important; display:none" id="label_sales">
                                        Ubah Nama Sales &nbsp;&nbsp;&nbsp;&nbsp; : </label> 

                                    <div class="col-sm-7" style="padding-top: 11px !important; display:none" id="input_sales">
                                        <select id="select2_nama_sales" name="nama_sales">
                                            <option></option>                                            
                                        </select>
                                    </div>
                                    <div class="col-sm-1" style="padding-top: 11px !important; display:none" id="bat_button2">
                                        <button type="button" id="batal_button2" class="btn btn-danger-alt" onclick="hide2()"> &nbsp;Batal&nbsp;</button>
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
                                                value="{{ $data_barang->keterangan_barang }}">
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
                                            @if (!$data->isEmpty())
                                                <script>
                                                    var counter = {!!json_encode($data) !!};

                                                    counter = counter.length
                                                </script>
                                                @foreach ($data as $foto)
                                                    <div class="img" onclick="imagesNewTab('{{$foto->nama_file}}')"
                                                        style="background-image:url({{ asset('/dokumentasi/foto/get-foto/' . $foto->nama_file) }})">
                                                        <span></span>
                                                    </div>
                                                </a>
                                            @endforeach
                                            @else
                                                <script>
                                                    var counter = 0;

                                                </script>
                                            @endif
                                            <div class="pic">
                                                <i class="fas fa-plus fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="file" name="images[]" accept="image/*" multiple
                                    style="display:none !important" />
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
    <!-- Advanced Select Boxes -->
    <script type="text/javascript" src="{{ asset('demo/demo-edit-barang-kasir.js') }}"></script>
    <!--Must Include -->

    <!--End loading page level scripts formscomponents-->
@stop
