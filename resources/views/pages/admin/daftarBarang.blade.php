@extends('layout.indexOfAdmin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css') }}" />
    <link type="text/css" href="{{ asset('css/form-components.css') }}" rel="stylesheet"> <!-- form components-->
    <link type="text/css" href="{{ asset('css/daftar-barang.css') }}" rel="stylesheet">
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
                <li><a href="{{ route('dashboardAdmin') }}">Home</a></li>
                <li>Manajemen Barang</li>
                <li class="active"><a href="">Daftar Barang</a></li>
            </ol>
            <div class="page-heading">
                <h1>Daftar Barang</h1>
                <div class="options">
                    <div class="btn-toolbar">
                        <a href="{{ route('formTambahBarang') }}" class="btn btn-success">Tambah Barang Baru <i
                                class="fa fa-fw fa-plus-square"></i></a>
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
                        <a class="info-tile tile-sky has-footer" href="{{route('showKategori')}}">
                            <div class="tile-heading">
                                <div class="pull-left">Total Stock Barang</div>
                                <div class="pull-right">
                                    <div id="tiletickets" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                <div class="pull-right">{{$total_barang}}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a class="info-tile tile-success has-footer" href="{{route('showKategori')}}">
                            <div class="tile-heading">
                                <div class="pull-left">Total Merk Barang</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                                {{-- <div class="pull-left"><i class="fa fa-check-square"></i>
                                </div> --}}
                            <div class="pull-right">{{$merk_barang}}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-4">
                        <a class="info-tile tile-magenta has-footer">
                            <div class="tile-heading">
                                <div class="pull-left">Total Kategori Barang</div>
                                <div class="pull-right">
                                    <div id="tilerevenues" class="sparkline-block"></div>
                                </div>
                            </div>
                            <div class="tile-body">
                            <div class="pull-right">{{$total_kategori}}</div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h2>Daftar Seluruh Barang</h2>
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
                                                <th>No</th>
                                                <th>Kategori</th>
                                                <th>Merk</th>
                                                <th>Tipe</th>
                                                <th>Sales</th>
                                                <th>Stock</th>
                                                <th>Modal</th>
                                                <th>Jual</th>
                                                <th>Foto</th>
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

    
    <!-- Modal foto barang-->
    <div class="modal fade" id="fotoBarangModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="width:700px;">
            <div class="modal-content">
                <div class="modal-header" style=" background-color: #ffbb00;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="modal-title bold" id="exampleModalLabel" style="color: black">Foto  Barang</p>
                </div>
                <div class="modal-body">
                    <div style="width:100%; text-align: center;">                        
                        <a class="slide" id='prev_image'><</a>
                        <img id="main-foto" src="" alt="centered image" height="400" width="450"/>                        
                        <a class="slide" id='next_image'>></a>
                    </div>
                    <div id='image_slider' class="images_prev_lang">
                        
                    </div>
                   
                </div>{{--modalBody--}}
            </div>
        </div>
    </div>
    <!-- end modal -->



@stop
@section('script')
    <!-- Load page level scripts data tables-->
    <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.18/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.18/js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>

    <script type="text/javascript" src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootbox/bootbox.js') }}"></script> <!-- Bootbox -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script> <!-- untuk modal -->
    <script type="text/javascript" src="{{ asset('plugins/wijets/wijets.js') }}"></script>

    <!-- Button -->

    <script type="text/javascript" src="{{ asset('demo/demo-daftar-barang.js') }}"></script>
@stop
