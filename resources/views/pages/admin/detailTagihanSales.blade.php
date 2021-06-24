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
                <li><a href="{{route('showSales')}}">Daftar Sales</a></li>
                <li><a href="{{route('showDetailSales', ['data' => $data->id_sales])}}">Detail Sales</a></li>
                <li class="active"><a href="">Detail Tagihan Sales</a></li>
            </ol>
            <div class="page-heading">
                <h1>Detail Tagihan Sales</h1>
            </div>
            <div class="container-fluid">
                <div data-widget-group="group1">
                    <div class="panel panel-midnightblue">
                        <div class="panel-heading">
                            <h2>Detail Tagihan Sales</h2>
                        </div>
                        <div action="#" method="POST" class="panel-body" style="margin-top: 10px !important">
                            <form class="form-horizontal row-border" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled id="validate-form" enctype="multipart/form-data">
                                {{ csrf_field() }} 
                                {{-- start form --}}                            
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Nama
                                        Perusahaan &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly
                                                value="{{ $data->nama_perusahaan }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label " style="padding-top: 16px !important;">Nama Sales
                                        &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly
                                                value="{{ $data->nama_sales }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Nomor Faktur
                                        &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly
                                                value="{{ $data->no_faktur }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Tanggal Faktur
                                        &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly 
                                            value="{{ $data_tanggal }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Jatuh Tempo
                                        &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly 
                                            value="{{ $data_tempo }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Jumlah Tagihan
                                        &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly 
                                            value="{{ $data->jumlah_tagihan }}">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>
                                                    
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">
                                        Foto Faktur &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="col-sm-7" id="imgPrevContainer">
                                    
                                        <div class="images_prev_lang">                                            
                                            @if (!$dokumentasi->isEmpty())
                                                <script>
                                                    var counter = {!!json_encode($dokumentasi) !!};

                                                    counter = counter.length
                                                </script>
                                                @foreach ($dokumentasi as $foto)
                                                    <div class="img" onclick="imagesNewTab('{{$foto->nama_file_tagihan}}')"
                                                        style="background-image:url({{ asset('/dokumentasi/tagihan/get-foto/' . $foto->nama_file_tagihan) }})"
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

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Status
                                        &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input required class="input100" readonly
                                                value="{{ $data->status_pembayaran }}">
                                            <span class="focus-input100"></span>
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

    <script type="text/javascript" src="{{ asset('demo/demo-detail-tagihan-sales.js') }}"></script>
    <!--Must Include -->


    <!--End loading page level scripts formscomponents-->
@stop
