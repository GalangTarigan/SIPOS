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
    var bulan = {!!json_encode($namaBulan) !!};
    var tahun = {!!json_encode($dataTahun) !!};
</script>
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboardAdmin') }}">Home</a></li>
                <li>Transaksi Pengeluaran</li>
                <li class="active"><a href="">Daftar Transkasi Keluar</a></li>
            </ol>
            <div class="page-heading">
                <h1>Daftar Transaksi Keluar </h1>
                <div class="options">
                    <div class="btn-toolbar">
                    <a href="{{ route('LaporanPengeluaranFilter') }}" class="btn btn-primary">Cari transaksi lainnya? <i
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
                    <div class="col-md-4">
                        <a class="info-tile tile-sky has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Total Transaksi</div>
                                <div class="pull-right">
                                    <div id="tileorders" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-left"><i class="fa fa-tasks"></i></div>
                                <div class="pull-right">{{ $jumlahTransak }}</div>
                               
                            </div>
                            <div class="tile-footer">
                                <div class="pull-left">Bulan {{ $namaBulan }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a class="info-tile tile-success has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Total Pengeluaran</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">Rp. {{ $hasilBulan }}</div>
                               
                            </div>
                            <div class="tile-footer">
                                <div class="pull-left">Bulan {{ $namaBulan }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a class="info-tile tile-magenta has-footer">
                            <div class="tile-heading">
                                <div class="pull-left">Total Pengeluaran</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">Rp. {{ $hasilTahun }}</div>
                               
                            </div>
                            <div class="tile-footer">
                                <div class="pull-left">Tahun {{ $dataTahun }}</div>
                            </div>
                        </a>
                    </div>
                </div> 
                {{-- batas row --}}


                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h2 id="judul">Daftar Seluruh Transaksi Keluar Bulan {{$namaBulan}} - {{$dataTahun}}</h2>
                                <div class="panel-ctrls">
                                    <a  class="button-icon has-bg" onclick="cetakLaporanKeluar()">Cetak <i class="zmdi zmdi-print zmdi-hc-lg"></i></a>
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
                                                <th>No</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Keterangan Transaksi</th>
                                                <th>Total Biaya</th>
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

    <script type="text/javascript" src="{{ asset('demo/demo-laporan-pengeluaran-hasil.js') }}"></script>
@stop
