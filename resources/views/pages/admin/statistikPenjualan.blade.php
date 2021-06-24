@extends('layout.indexOfAdmin')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/charts-chartistjs/chartist.min.css') }}">
    <!-- Chartist -->
    <link type="text/css" href="{{ asset('plugins/form-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
@stop
@section('content')
    <script>
        var mulai = {!!json_encode($dataTahun) !!};
        var dataStatsHari = {!!json_encode($dataStatsHari) !!};
    </script>
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboardAdmin') }}">Home</a></li>
                <li class="active"><a href="">Statistik Penjualan</a></li>
            </ol>
            <div class="page-heading">
                <h1>Stattistik Penjualan</h1>
                <div class="options">
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <a class="info-tile tile-sky has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Omset Hari Ini -> {{ $hari }}</div>
                                <div class="pull-right">
                                    <div id="tiletickets" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">Rp. {{ $hasilHari }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-success has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Omset Bulan ini -> {{ $bulan }}</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                {{-- <div class="pull-left"><i class="fa fa-check-square"></i>
                                </div> --}}
                                <div class="pull-right">Rp. {{ $hasilBulan }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-magenta has-footer">
                            <div class="tile-heading">
                                <div class="pull-left">Omset Tahun Ini -> {{ $dataTahun }}</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">Rp. {{ $hasilTahun }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-danger has-footer">
                            <div class="tile-heading">
                                <div class="pull-left"> Total Transaksi Bulan {{ $bulan }}</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">{{ $jumlahTransakBulan }}</div>

                            </div>
                        </a>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-3">
                        <a class="info-tile tile-sky has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Laba Hari Ini -> {{ $hari }}</div>
                                <div class="pull-right">
                                    <div id="tiletickets" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">Rp. {{ $labaHari }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-success has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Laba Bulan Ini -> {{ $bulan }}</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                {{-- <div class="pull-left"><i class="fa fa-check-square"></i>
                                </div> --}}
                                <div class="pull-right">Rp. {{ $labaBulan }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-magenta has-footer">
                            <div class="tile-heading">
                                <div class="pull-left">Laba Tahun Ini -> {{ $dataTahun }}</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">Rp. {{ $labaTahun }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-danger has-footer">
                            <div class="tile-heading">
                                <div class="pull-left">Total Transaksi Tahun {{ $dataTahun }}</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">{{ $jumlahTransakTahun }}</div>
                            </div>
                        </a>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel">
                            <div class="panel-heading">
                                <h2 id="judulTahun">Statistik Penjualan Tahun {{ $dataTahun }}</h2>
                            </div>
                            <div class="panel-body" style="padding: 10px 15px">
                                <div class="clearfix mb-md">
                                    <button class="btn btn-default pull-left" id="daterangepicker_daftarPenjualan">
                                        <i class="far fa-calendar-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="hidden-xs" style="text-transform: uppercase;"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i
                                            class="fas fa-angle-down"></i></button>
                                    <input id="date_start" name="date_start" hidden type="text">
                                </div>
                                <div id="spinner" class="text-center" style="display: none">
                                    <div class="spinner-border text-info" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <div class="text-center" id="msg-info"></div>
                                <canvas id="bar-chart" height="180" width="500"></canvas>
                                <input type="text" name="date-start" hidden>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel">
                            <div class="panel-heading">
                                <h2 id="judulHari">Statistik Penjualan Hari ini - Tanggal {{ $dataStatsHari }}</h2>
                            </div>
                            <div class="panel-body" style="padding: 10px 15px">
                                <div class="clearfix mb-md">
                                    <button class="btn btn-default pull-left" id="daterangepicker_dashboard">
                                        <i class="far fa-calendar-alt"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <span class="hidden-xs" style="text-transform: uppercase;"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i
                                            class="fas fa-angle-down"></i></button>
                                    <input id="date_start_hari" name="date_start_hari" hidden type="text">
                                    <input id="date_end_hari" name="date_end_hari" hidden type="text">
                                </div>

                                <div id="spinner_hari" class="text-center" style="display: none">
                                    <div class="spinner-border text-info" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                                <div class="text-center" id="msg-info_hari"></div>
                                <canvas id="bar-chart_hari" height="180" width="500"></canvas>
                                <input type="text" name="date-start_hari" hidden>
                                <input name="date_end_hari" hidden type="text">
                            </div>
                        </div>
                    </div>
                </div>


            </div> <!-- .container-fluid -->
        </div> <!-- #page-content -->
    </div>


@stop
@section('script')
    <!-- Load page level scripts data tables-->
    <script type="text/javascript" src="{{ asset('plugins/form-daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootbox/bootbox.js') }}"></script> <!-- Bootbox -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- load page leve scripts chart -->
    <script type="text/javascript" src="{{ asset('plugins/charts-chartjs/Chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/wijets/wijets.js') }}"></script>
    <!-- Button -->

    <script type="text/javascript" src="{{ asset('demo/demo-statistik-penjualan.js') }}"></script>
@stop
