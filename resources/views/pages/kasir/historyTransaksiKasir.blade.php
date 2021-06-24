@extends('layout.indexOfKasir')
@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css') }}" />
    <link type="text/css" href="{{ asset('css/kasir.css') }}" rel="stylesheet">
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
                <li>Transaksi Penjualan</li>
                <li class="active"><a href="">Daftar History Transaksi</a></li>
            </ol>
            <div class="page-heading">
                <h1>Daftar History Transaksi</h1>
                {{-- <div class="options">
                    <div class="btn-toolbar">
                        <a href="{{route('showTambahBarangReturn')}}" class="btn btn-primary">Tambah Barang Return <i
                                class="fa fa-fw fa-plus-square"></i></a>
                    </div>
                </div> --}}
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
                    <div class="col-md-12">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h2 style="color:black">Daftar Seluruh Transaksi</h2>
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
                                                <th>No. Invoice</th>
                                                <th>Tanggal</th>
                                                <th>Pelanggan</th>
                                                <th>Alamat</th>
                                                <th>No. HP</th>
                                                <th>Total Bayar</th>
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

    <!-- Modal detail barang-->
    <div class="modal fade" id="detailTransaksiModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="width:800px;">
            <div class="modal-content">
                <div class="modal-header" style=" background-color: #ffbb00;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="modal-title bold" id="exampleModalLabel">Detail Transaksi</p>
                </div>
                <div class="modal-body">

                    <div class="form-group">                        
                        <div class="row">
                            <label class="col-sm-1 control-label bold" style="padding-top: 11px !important;">Kasir Melayani</label>
                            <div class="col-sm-3">
                                <div class="wrap-input100" data-validate="Inputan tidak valid">
                                    <input readonly class="input100 " type="text" name="kasir" autocomplete="off">
                                    <span class="focus-input100" data-placeholder="Keterangan Barang"></span>
                                </div>
                            </div>

                                <label class="col-sm-1 bold" style="padding-top: 11px !important;">Tanggal Transaksi</label>
                                <div class="col-sm-3">
                                    <div class="wrap-input100" data-validate="Inputan tidak valid">
                                        <input readonly class="input100" type="text" name="tanggal_beli" autocomplete="off">
                                        <span class="focus-input100" data-placeholder="Keterangan Barang"></span>
                                    </div>
                                </div>

                                <label class="col-sm-1 bold" style="padding-top: 11px !important;">No. Invoice</label>
                                <div class="col-sm-3">
                                    <div class="wrap-input100" data-validate="Inputan tidak valid">
                                        <input readonly class="input100 " type="text" name="no_invoice" autocomplete="off">
                                        <span class="focus-input100" data-placeholder="Keterangan Barang"></span>
                                    </div>
                                </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="wrap-input100" data-validate="Inputan tidak valid" style="text-align:center; background-color: #ffbb00;">
                            <label class="labalaba bold" > Data Pelanggan</label>
                        </div>
                        <div class="row">                                                                                    
                            <div class="col-sm-4" style="float:left; ">
                                <div class="wrap-input100" data-validate="Inputan tidak valid">
                                    <label class="mbot bold">Nama Pelanggan</label>
                                    <input readonly class="input100 mbot" type="text" name="nama_pelanggan" autocomplete="off" id="nama_pelanggan">
                                    <span class="focus-input100" data-placeholder="Nama_pelanggan"></span>
                                </div>                               
                            </div>
                            <div class="col-sm-5" style="float:left;">
                                <div class="wrap-input100" data-validate="Inputan tidak valid">
                                    <label class="mbot bold">Alamat Pelanggan</label>
                                    <input readonly class="input100 mbot" type="text" name="alamat_pelanggan" autocomplete="off" id="alamat">
                                    <span class="focus-input100" data-placeholder="Alamat Pelanggan"></span>
                                </div>                                
                            </div>
                            <div class="col-sm-3" style="float:left;">
                                <div class="wrap-input100" data-validate="Inputan tidak valid">
                                    <label class="mbot bold">Nomor HP</label>
                                    <input readonly class="input100 mbot" type="text" name="no_telepon" autocomplete="off" id="no_telepon">
                                    <span class="focus-input100" data-placeholder="Nomor Telepon"></span>
                                </div>                               
                            </div>
                        </div>{{-- row
                        --}}{{-- row
                        --}}
                    </div> {{-- form group --}}


                    {{-- table --}}
                    <div class="wrap-input100" data-validate="Inputan tidak valid" style="text-align:center; background-color: #ffbb00;">
                        <label class="labalaba bold"> Daftar Pembelian Barang</label>
                    </div>
                    <div class="table">
                        <div class="panel-body">
                            <div id="spinner" class="text-center" style="display: none">
                                <div class="spinner-border text-info" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <table id="myTable"
                                class="table table-striped table-bordered table-hover" cellspacing="0"
                                width="100%">
                                <thead>
                                    <tr style=" background-color: #57cbff;">
                                        <th>Kategori Barang</th>
                                        <th>Merk Barang</th>
                                        <th>Tipe Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody>                                    
                                </tbody>
                            </table>
                            <label class="col-sm-10 control-label labalaba bold" style="padding-top: 10px !important; text-align:right;" >
                                Total Pembelian</label>
                            <div class="col-sm-2 ">
                                <div class="wrap-input100 " data-validate="Inputan tidak valid">
                                    <input class="input100 labalaba bold" style="text-align:right;"
                                        type="text" name="total_pembelian" id="total_pembelian"
                                        readonly>
                                </div>                                           
                            </div>                            
                        </div>                        
                    </div> {{-- table --}}
                </div>{{--modalBody--}}
                <div class="modal-footer">
                    <button type="button" id="closeModal2" class="btn btn-primary-alt">Tutup</button>                
                </div>

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
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/wijets/wijets.js') }}"></script>

    <!-- Button -->

    <script type="text/javascript" src="{{ asset('demo/demo-history-transaksi-kasir.js') }}"></script>
@stop
