@extends('layout.indexOfAdmin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/form-daterangepicker/daterangepicker.css') }}">
    <link type="text/css" href="{{ asset('css/keuangan.css') }}" rel="stylesheet">
    <!-- DateRangePicker -->
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }

    </style> <!-- for justify data table -->
@stop
@section('content')
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
                <li><a href="{{route('dashboardAdmin')}}">Home</a></li>
                <li>Keuangan</li>
                <li class="active"><a href="">Cari Laporan Laba Rugi</a></li>
            </ol>
            <div class="page-heading">
                <h1>Cari Laporan Laba Rugi</h1>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-midnightblue">
                            <div class="panel-heading">
                                <h2> Form Filter Laporan Laba Rugi</h2>
                                <div class="panel-ctrls">
                                </div>
                            </div>
                            <div class="panel-body">
                                <form action="{{route('LaporanLabaRugiHasil')}}" method="POST" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Pilih Bulan &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100 input-group" data-validate="Harus Diisi">
                                            <span id="daterangepicker_tanggal_mulai" class="input-group-addon"
                                                style="border: none; background-color: inherit !important;"><i
                                                    id="cal-click" class="fas fa-calendar-alt"></i></span>
                                            <input readonly required
                                                class="input100 mask @error('tanggalMulai') is-invalid @enderror"
                                                type="text" name="tanggalMulai" autocomplete="off"
                                                value="{{ old('tanggalMulai') }}" spellcheck="false">
                                            <span class="focus-input100"></span>

                                        </div>
                                            <input id="date_start" name="date_start" hidden type="text">
                                            <input id="year_start" name="year_start" hidden type="text">
                                        @error('tanggalMulai')
                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>
                                        @enderror
                                       
                                        <br>
                                        <div class=" col-sm-offset-2 col-sm-6">
                                            <button id="submit" class="btn btn-success-alt col-sm-12" type="submit"><i
                                                    class="fa fa-search"></i>&nbsp; Cari Laporan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div><!-- panel body -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-orange">
                            <div class="panel-heading">
                                <h2 style="color: black">Daftar Seluruh Transaksi</h2>
                                <div class="panel-ctrls">
                                </div>
                            </div>
                            <div class="panel-body" >
                                <div class="alert" style="background: #FF9800; color: black">
                                    <i class="fa fa-fw fa-info-circle"></i>&nbsp; <strong>Info :</strong> 
                                    Silhkan filter laporan terlebih dahulu
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container-fluid -->
        </div> <!-- #page-content -->
    </div>
@stop
@section('script')
    <!-- Load page level scripts data tables-->
    
    <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.18/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.18/js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/form-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Date Range Picker -->
    <script type="text/javascript" src="{{ asset('plugins/form-parsley/parsley.js') }}"></script>
    <!-- Validate Plugin / Parsley -->
    <script type="text/javascript" src="{{ asset('plugins/form-inputmask/dist/jquery.inputmask.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{asset('demo/demo-laporan-laba-rugi-filter.js')}}"></script>
@stop
