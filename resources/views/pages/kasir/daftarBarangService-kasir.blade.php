@extends('layout.indexOfKasir')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css') }}" />
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
                <li><a href="{{ route('dashboardKasir') }}">Home</a></li>
                <li>Barang Service</li>
                <li class="active"><a href="">Daftar Barang Service</a></li>
            </ol>
            <div class="page-heading">
                <h1>Daftar Barang Service</h1>               
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
                        <a class="info-tile tile-info has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Total Seluruh Barang Service</div>
                                <div class="pull-right">
                                    <div id="tileorders" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-left"><i class="fa fa-tasks"></i></div>
                                <div class="pull-right">{{ $totalService }}</div>
                               
                            </div>
                            <div class="tile-footer">
                                <div class="pull-left">∞</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-magenta has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Barang Tidak Dapat Diservice</div>
                                <div class="pull-right">
                                    <div id="tiletickets" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">                                
                                <div class="pull-left"><i class="fa fa-window-close"></i></div>
                                <div class="pull-right">{{ $hasilGagal }}</div>
                            </div>
                                <div class="tile-footer">
                                    <div class="pull-left">Tahun {{ $tahun }}</div>
                                </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-sky has-footer" href="#">
                            <div class="tile-heading">
                                <div class="pull-left">Barang Selesai, Belum Diambil</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-left"><i class="fa fa-spinner fa-spin"></i></div>
                                <div class="pull-right">{{ $hasilBelumAmbil }}</div>
                               
                            </div>
                            <div class="tile-footer">
                                <div class="pull-left">Tahun {{ $tahun }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="info-tile tile-success has-footer">
                            <div class="tile-heading">
                                <div class="pull-left">Barang Selesai, Telah Diambil</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-left"><i class="fa fa-check-square"></i></div>
                                <div class="pull-right">{{ $hasilLunas }}</div>
                               
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
                                <h2>Daftar Seluruh Barang Service</h2>
                                <div class="panel-ctrls">
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
                                                <th>No.</th>
                                                <th>Nama</th>
                                                <th>Barang</th>
                                                <th>Keluhan</th>
                                                <th>Status</th>
                                                <th>Biaya</th>
                                                <th>Pembayaran</th>
                                                <th>Lokasi</th>
                                                <th>Action</th>
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

    <script type="text/javascript" src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootbox/bootbox.js') }}"></script> <!-- Bootbox -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/wijets/wijets.js') }}"></script>

    <!-- Button -->

    <script type="text/javascript" src="{{ asset('demo/demo-daftar-barang-service-for-kasir.js') }}"></script>
@stop
