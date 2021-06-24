@extends('layout.indexOfKasir')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/form-daterangepicker/daterangepicker.css') }}">
    <link type="text/css" href="{{ asset('css/kasir.css') }}" rel="stylesheet">
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
<script>
    var no_invoice = {!! json_encode($invoice) !!};
    var id =  {!! json_encode($id) !!};
</script>    
    
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
                <li><a href="{{route('dashboardKasir')}}">Home</a></li>
                <li><a href="{{route('showGaransikasir')}}">Cari Info Garansi</a></li>
                <li class="active">Lihat Info Garansi</li>
            </ol>
            <div class="page-heading">
            <h1>Lihat Info Garansi</h1>
            </div>
            <div class="container-fluid">
               
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h2>Data Transaksi Penjualan</h2>
                                <div class="panel-ctrls">
                                </div>
                            </div>                                                                                    
                            <div class="table-responsive">
                                <div class="panel-body">                                                                        
                                    <div class="row">
                                        <div class="column" style=" width: 37%;">
                                            <label class="col-sm-5  control-label bold" style="padding-top: 21px !important;">
                                                No. Invoice</label>
                                            <div class="col-sm-6">
                                                <div class="wrap-input100 aturHead" data-validate="Inputan tidak valid" style="width: 90%;">
                                                    <input class="input100"
                                                        type="text" autocomplete="off"
                                                        value=" {{ $invoice}}" readonly>
                                                </div>
                                            </div>
                                            
                                            <label class="col-sm-5 control-label bold" style="padding-top: 21px !important;">
                                                Nama Pelanggan</label>
                                                <div class="col-sm-6">
                                                    <div class="wrap-input100 aturHead" data-validate="Inputan tidak valid" style="width: 90%;">
                                                        <input class="input100"
                                                        type="text"  autocomplete="off"
                                                        value="{{ $nama}}" readonly>
                                                    </div>
                                                </div>
                                                <label class="col-sm-5 control-label bold" style="padding-top: 21px !important;">
                                                    Nomor Hp</label>
                                                <div class="col-sm-6">
                                                    <div class="wrap-input100 aturHead" data-validate="Inputan tidak valid" style="width: 90%;">
                                                        <input class="input100"
                                                            type="text"  autocomplete="off"
                                                            value="{{ $telepon}}" readonly>
                                                    </div>
                                                </div>
                                        </div> <!-- batas colum 1 -->

                                        <div class="column" style="width: 50%;">
                                            <label class="col-sm-4 control-label bold" style="padding-top: 21px !important;">
                                                Tanggal Pembelian</label>
                                            <div class="col-sm-8">
                                                <div class="wrap-input100 aturHead" data-validate="Inputan tidak valid" style="width: 50%;">
                                                    <input class="input100"
                                                        type="text"  autocomplete="off"
                                                        value="{{ $tanggal}}" readonly>
                                                </div>
                                            </div>
                                            <label class="col-sm-4 control-label bold" style="padding-top: 21px !important;">
                                                Alamat</label>
                                            <div class="col-sm-8">
                                                <div class="wrap-input100 aturHead" data-validate="Inputan tidak valid" style="width: 50%;">
                                                    <input class="input100"
                                                        type="text"  autocomplete="off"
                                                        value="{{ $alamat}}" readonly>
                                                </div>
                                            </div>
                                            <label class="col-sm-4 control-label bold" style="padding-top: 21px !important;">
                                                Total Pembelian</label>
                                            <div class="col-sm-8">
                                                <div class="wrap-input100 aturHead" data-validate="Inputan tidak valid" style="width: 50%;">
                                                    <input class="input100"
                                                        type="text"  autocomplete="off"
                                                        value="{{ $total_beli}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                    
                                    <br>
                                    <div class="wrap-input100" data-validate="Inputan tidak valid" >
                                    </div>
                                    <div class="wrap-input100" data-validate="Inputan tidak valid" style="text-align: center" >
                                        <label class="labalaba bold" > Daftar Barang Beli</label>
                                    </div>
                                    <div id="spinner" class="text-center" style="display: none">
                                        <div class="spinner-border text-info" role="status">
                                            <span class="sr-only">Loading...</span>
                                        </div>
                                    </div>
                                    <table id="table" class="table table-striped table-bordered table-hover" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kategori Barang</th>
                                                <th>Merk Barang</th>
                                                <th>Tipe Barang</th>
                                                <th>Jumlah</th>
                                                <th>Batas Garansi</th>
                                                <th>Status</th>
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
                </div> <!-- content -->

            </div> <!-- container-fluid -->
        </div> <!-- #page-content -->
    </div> <!-- #static content -->
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
    <script type="text/javascript" src="{{asset('demo/demo-lihat-info-garansi-kasir.js')}}"></script>
@stop
