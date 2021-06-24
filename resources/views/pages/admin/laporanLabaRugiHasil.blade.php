@extends('layout.indexOfAdmin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css') }}" />
    <link type="text/css" href="{{ asset('plugins/form-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
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
<script>
    var dataBulan = {!!json_encode($dataBulan) !!};
    var bulan = {!!json_encode($bulan) !!};
    var tahun = {!!json_encode($tahun) !!};
</script>
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboardAdmin') }}">Home</a></li>
                <li>Keuangan</li>
                <li class="active"><a href="">Laporan Laba Rugi</a></li>
            </ol>
            <div class="page-heading">
                <h1> Laporan Laba Rugi </h1>
                <div class="options">
                    <div class="btn-toolbar">
                    <a href="{{ route('showlaporanLabaRugi') }}" class="btn btn-primary">Cari transaksi lainnya? <i
                                class="fa fa-fw fa-search"></i></a>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                @endif
                @if (\Session::has('errors'))
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ \Session::get('errors') }}</p>
                    </div>
                @endif                    
                <div class="row">
                    <div class="col-md-3">
                        <a class="info-tile tile-sky has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Total Transaksi Bulan {{ $bulan }}</div>
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
                        <a class="info-tile tile-info has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Total Modal Bulan {{ $bulan }}</div>
                                <div class="pull-right">
                                    <div id="tiletickets" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">                                
                                <div class="pull-right">Rp. {{ $modalPerBulan }}</div>
                            </div>
                                <div class="tile-footer">
                                    <div class="pull-left">Tahun {{ $tahun }}</div>
                                </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-success has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Total Pemasukan Bulan {{ $bulan }}</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">Rp. {{ $pemasukanPerBulan }}</div>
                               
                            </div>
                            <div class="tile-footer">
                                <div class="pull-left">Tahun {{ $tahun }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-magenta has-footer">
                            <div class="tile-heading">
                                <div class="pull-left">Total Laba Bulan {{ $bulan }}</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">Rp. {{ $labaPerBulan }}</div>
                               
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
                                <h2 id="judul">Daftar Seluruh Transaksi Bulan {{$judulBulan}} - {{$tahun}}</h2>
                                <div class="panel-ctrls">
                                    <a  class="button-icon has-bg" onclick="cetakLaporan()">Cetak <i class="zmdi zmdi-print zmdi-hc-lg"></i></a>
                                </div>
                            </div>
                            <div></div>
                            <div class="table-responsive">
                                <div class="panel-body">                                    
                                    <div id="spinner" class="text-center" style="display: none">
                                        <div class="spinner-border text-info" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <table id="table" class="table table-striped table-bordered table-hover" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr style=" background-color: #57cbff;">                                                
                                                <th>Tanggal Transaksi</th>
                                                <th>Keterangan Transaksi</th>
                                                <th>Pengeluaran</th>
                                                <th>Pemasukan</th>
                                                {{-- <th>Laba Transaksi</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="panel-footer"></div>
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
    <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.18/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.18/js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/form-daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootbox/bootbox.js') }}"></script> <!-- Bootbox -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/wijets/wijets.js') }}"></script>

    <!-- Button -->

    <script type="text/javascript" src="{{ asset('demo/demo-laporan-laba-rugi-hasil.js') }}"></script>
@stop
