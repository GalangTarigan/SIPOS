@extends('layout.indexOfAdmin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/form-daterangepicker/daterangepicker.css') }}">
    <!-- DateRangePicker -->
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">
@stop
@section('content')
<script>
    var mulai = {!!json_encode($tahun) !!};
</script>
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboardAdmin') }}">Home</a></li>
                <li class="active"><a href="{{ route('dashboardAdmin') }}">Dashboard-Admin</a></li>
            </ol>
            <div class="page-heading">
                <h1>Dashboard Admin</h1>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <a class="info-tile tile-midnightblue has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Total Transaksi Penjualan</div>
                                <div class="pull-right">
                                    <div id="tileorders" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-left"><i class="fa fa-tasks"></i></div>
                                <div class="pull-right">{{ $jumlahTransak }}</div>
                               
                            </div>
                            <div class="tile-footer">
                                <div class="pull-left">Tahun {{ $tahun }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-sky has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Omset Penjualan Hari Ini</div>
                                <div class="pull-right">
                                    <div id="tiletickets" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">                                
                                <div class="pull-right">Rp. {{ $hasilHari }}</div>
                            </div>
                                <div class="tile-footer">
                                    <div class="pull-left">Hari {{ $hari }}</div>
                                </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-success has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Omset Penjualan Bulan Ini</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">Rp. {{ $hasilBulan }}</div>
                               
                            </div>
                            <div class="tile-footer">
                                <div class="pull-left">Bulan {{ $bulan }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-magenta has-footer">
                            <div class="tile-heading">
                                <div class="pull-left">Omset Penjualan Tahun Ini</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">Rp. {{ $hasilTahun }}</div>
                               
                            </div>
                            <div class="tile-footer">
                                <div class="pull-left">Tahun {{ $tahun }}</div>
                            </div>
                        </a>
                    </div>
                </div> 
                {{-- batas row --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h2>Statistik Penjualan Tahun ini - {{ $tahun }}</h2>
                            </div>

                            <div class="panel-body">
                                
                                <canvas id="bar-chart" height="200" width="600"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- .container-fluid -->
        </div> <!-- #page-content -->
    </div>
@stop
@section('script')
    <!-- load page leve scripts chart -->
    <script type="text/javascript" src="{{ asset('plugins/charts-chartjs/Chart.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/wijets/wijets.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('plugins/form-daterangepicker/daterangepicker.js') }}"></script>
    
    <script type="text/javascript" src="{{ asset('demo/demo-dashboard-admin.js') }}"></script>
@stop
