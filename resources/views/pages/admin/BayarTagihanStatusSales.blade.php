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
    <link type="text/css" href="{{ asset('css/kasir.css') }}" rel="stylesheet">
@stop
@section('content')
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboardAdmin') }}">Home</a></li>
                <li>Manajemen Sales</li>
                <li><a href="{{route('showCariTagihanSales')}}">Bayar Tagihan Sales - Cari</a></li>
                <li class="active"><a href="">Bayar Tagihan Sales Status Tagihan</a></li>
            </ol>
            <div class="page-heading">
                <h1>Bayar Tagihan Sales - {{ $data->nama_sales }}</h1>
                <div class="options">
                    <div class="btn-toolbar">
                        <a href="{{route('showCariTagihanSales')}}" class="btn btn-primary">Cari Tagihan Sales lain? <i
                                class="fa fa-fw fa-search"></i></a>
                    </div>
                </div>
            </div>


            <div class="container-fluid">
                <div data-widget-group="group1">
                    <div class="panel panel-midnightblue">
                        <div class="panel-heading">
                            <h2>Form Bayar Tagihan Sales   </h2>
                            
                        </div>

                        <div class="panel-body">
                            

                        <form action="{{route('editStatusTagihan')}}" method="POST" class="form-horizontal row-border"
                        data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                        {{ csrf_field() }}

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Nomor Faktur
                                        &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input  class="input100" readonly
                                            value="{{ $data->no_faktur }}" name="no_faktur">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Tanggal Faktur
                                        &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input  class="input100" readonly
                                            value="{{ $data_tanggal }}" name="faktur">
                                            <span class="focus-input100"></span>
                                            
                                            <input type="text" value={{$data->id_tagihan}} name="id_tagihan" hidden>
                                            <input type="text" value={{$data->nama_sales}} name="nama_sales" hidden>
                                            <input type="text" value={{$data->id_sales}} name="id_sales" hidden>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Jatuh Tempo
                                        &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input  class="input100" readonly
                                            value="{{ $data_tempo }}" name="tempo">
                                            <span class="focus-input100"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 16px !important;">Jumlah Tagihan
                                        &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100">
                                            <input class="input100" readonly
                                            value="{{ $data->jumlah_tagihan }}" name="jumlah_tagihan">
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
                                                    <div class="img" onclick="imagesOldPic('{{$foto->nama_file_tagihan}}')"
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
                                
                                <div class="form-group" id="form_model_bayar">
                                    <div class="wrap-input100" data-validate="Inputan tidak valid" style="text-align:center; background-color: #2dd632;">
                                        <label class="labalaba bold" style="margin-top: 9px;"> Ubah Status Tagihan</label>
                                    </div>
                                    <br>
                                    <label class="col-sm-4 control-label  " style="padding-top: 11px !important;">
                                        Model Pembayaran &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <select required  onchange="getval(this);"
                                            id="select2_status_pembayaran" name="status" style="margin-top: 1%">
                                            <option></option>
                                            
                                        </select>
                                    </div>
                                </div>
                                         
                                    <div class="alert alert-info">
                                        <i class="fa fa-fw fa-info-circle"></i>&nbsp; <strong>Info :</strong> Jika model Pembayaran
                                        dengan Transfer, maka wajib upload bukti transfer<br>
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
    <script type="text/javascript" src="{{ asset('plugins/form-daterangepicker/daterangepicker.js') }}"></script>
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

    <script type="text/javascript" src="{{ asset('demo/demo-edit-status-tagihan-sales.js') }}"></script>
    <!--Must Include -->


    <!--End loading page level scripts formscomponents-->
@stop
