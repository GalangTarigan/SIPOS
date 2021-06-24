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
                <li>Manajemen Barang</li>
                <li><a href="{{ route('showDaftarBarang') }}">Daftar Barang</a></li>
                <li class="active"><a href="">Detail Barang</a></li>
            </ol>
            <div class="page-heading">
                <h1>Detail Barang</h1>
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
                            <h2>Detail Barang {{ $data_barang->nama_merk }} {{ $data_barang->tipe_barang }} </h2>
                        </div>
                        <div action="#" method="POST" class="panel-body" style="margin-top: 10px !important">
                            <form class="form-horizontal row-border" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled id="validate-form" enctype="multipart/form-data">
                                {{ csrf_field() }} 
                                {{-- start form --}}

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Kategori
                                        Barang  &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly
                                                value="{{ $data_barang->nama_kategori }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label labalaba"
                                        style="padding-top: 16px !important;">Merk  &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100 labalaba">
                                            <input required class="input100 labalaba" readonly
                                                value="{{ $data_barang->nama_merk }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label " style="padding-top: 16px !important;">Tipe Barang
                                        &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly
                                                value="{{ $data_barang->tipe_barang }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Stock
                                        &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly value="{{ $data_barang->jumlah }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Harga Modal
                                        &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly value="{{ $data_barang->modal }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Harga Jual
                                        &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly value="{{ $data_barang->jual }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Nama Sales
                                        &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly
                                                value="{{ $data_barang->nama_perusahaan }} - {{ $data_barang->nama_sales }} ">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Keterangan
                                        Barang  &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly
                                                value="{{ $data_barang->keterangan_barang }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">
                                        Foto Barang  &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7" >
                                    
                                        <div class="images_prev_lang">                                            
                                            @if (!$dokumentasi->isEmpty())
                                                <script>
                                                    var counter = {!!json_encode($dokumentasi) !!};

                                                    counter = counter.length
                                                </script>
                                                @foreach ($dokumentasi as $foto)
                                                    <div class="img" onclick="imagesNewTab('{{$foto->nama_file}}')"
                                                        style="background-image:url({{ asset('/dokumentasi/foto/get-foto/' . $foto->nama_file) }})"
                                                        >
                                                        <span></span>
                                                    </div>                                                
                                                    @endforeach
                                                @else
                                                <script>
                                                    var counter = 0;

                                                </script>
                                            @endif
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

    <script type="text/javascript" src="{{ asset('demo/demo-detail-barang.js') }}"></script>
    <!--Must Include -->


    <!--End loading page level scripts formscomponents-->
@stop
