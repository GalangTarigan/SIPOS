@extends('layout.indexOfKasir')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css') }}" />
    <link type="text/css" href="{{ asset('plugins/iCheck/skins/minimal/blue.css') }}" rel="stylesheet"> <!-- iCheck -->
    <link type="text/css" href="{{ asset('plugins/form-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <!-- DateRangePicker -->
    <link type="text/css" href="{{ asset('plugins/charts-chartistjs/chartist.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('plugins/form-select2/select2.css') }}" rel="stylesheet"> <!-- Select2 -->
    <link type="text/css" href="{{ asset('plugins/form-select2/select2-skins.css') }}" rel="stylesheet">
    <!-- Select2 skin -->
    <link type="text/css" href="{{ asset('css/form-components.css') }}" rel="stylesheet"> <!-- form components-->
    <link type="text/css" href="{{ asset('plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css') }}"
        rel="stylesheet"> <!-- Touchspin -->
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
    <script>
        var invoice = {!! json_encode($invoice)!!};  
      </script>
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboardKasir') }}">Home</a></li>
                <li>Transaksi Penjualan</li>
                <li class="active"><a href="">Kasir</a></li>
            </ol>

            <div class="page-heading">
                <h1>Kasir Penjualan</h1>
            </div>
            <div class="container-fluid">
                <div data-widget-group="group1">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h2>Form Kasir Penjualan</h2>
                        </div>
                        <div class="panel-body">
                            <form action="" method="POST" class="form-horizontal row-border" data-parsley-validate
                                data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}

                                {{-- data pelanggan --}}
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-2" style="float:left; ">
                                            <div class="wrap-input100" data-validate="Inputan tidak valid">
                                                <label class="mbot">No.Invoice</label>
                                                <input required
                                                    class="input100 @error('no_invoice') is-invalid @enderror mbot"
                                                    type="text" name="no_invoice" autocomplete="off" id="no_invoice"
                                                    value="{{$invoice}}" readonly>
                                                <span class="focus-input100" data-placeholder="No.invoice"></span>
                                            </div>
                                            @error('no_invoice')
                                                <span class="text-danger">
                                                    <div class="parsley-required">{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="col-sm-2" style="float:left;">
                                            <label class="mbot">Tanggal Pembelian</label>
                                            <div class="wrap-input100 input-group">
                                                <span id="date-rangepicker-tanggal-beli" class="input-group-addon"
                                                    style="border: none; background-color: inherit !important;"><i
                                                        id="cal-click" class="fas fa-calendar-alt"></i></span>
                                                <input required class="input100 mask @error('tanggal_beli') is-invalid @enderror"
                                                    type="text" name="tanggal_beli" autocomplete="off" id="tanggal"
                                                    value="{{ old('tanggal_beli') }}" spellcheck="false">
                                                <span class="focus-input100"></span>
                                            </div>
                                            @error('tanggal_beli')
                                                <span class="text-danger">
                                                    <div class="parsley-required">{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3" style="float:left; ">
                                            <div class="wrap-input100" data-validate="Inputan tidak valid">
                                                <label class="mbot">Nama Pelanggan</label>
                                                <input required
                                                    class="input100 @error('nama_pelanggan') is-invalid @enderror mbot"
                                                    type="text" name="nama_pelanggan" autocomplete="off" id="nama_pelanggan"
                                                    value="{{ old('nama_pelanggan') }}">
                                                <span class="focus-input100" data-placeholder="Nama_pelanggan"></span>
                                            </div>
                                            @error('nama_pelanggan')
                                                <span class="text-danger">
                                                    <div class="parsley-required">{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-3" style="float:left;">
                                            <div class="wrap-input100" data-validate="Inputan tidak valid">
                                                <label class="mbot">Alamat Pelanggan</label>
                                                <input required
                                                    class="input100 @error('alamat_pelanggan') is-invalid @enderror mbot"
                                                    type="text" name="alamat_pelanggan" autocomplete="off" id="alamat"
                                                    value="{{ old('alamat_pelanggan') }}">
                                                <span class="focus-input100" data-placeholder="Alamat Pelanggan"></span>
                                            </div>
                                            @error('alamat_pelanggan')
                                                <span class="text-danger">
                                                    <div class="parsley-required">{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-sm-2" style="float:left;">
                                            <div class="wrap-input100" data-validate="Inputan tidak valid">
                                                <label class="mbot">Nomor HP</label>
                                                <input required
                                                    class="input100 @error('no_telepon') is-invalid @enderror mbot"
                                                    type="text" name="no_telepon"  id="no_telepon"
                                                    value="{{ old('no_telepon') }}" onKeyPress="if(this.value.length==12) return false;">
                                                <span class="focus-input100" data-placeholder="Nomor Telepon"></span>
                                            </div>
                                            @error('no_telepon')
                                                <span class="text-danger">
                                                    <div class="parsley-required">{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>{{-- row--}}
                                </div> {{-- form group --}}
                                {{-- data pelanggan --}}





                                <div class="row">
                                    <div class="column" style="width: 30%;">

                                        <div class="wrap-input100" data-validate="Inputan tidak valid" style="width: 96%;">
                                            <label class="labalaba bold"> Tambah Pembelian</label>
                                        </div>
                                        {{-- ini dia --}}
                                        
                                            <label class="col-sm-3 control-label" style="padding-top: 32px !important;">
                                                Kategori</label>
                                            <div class="col-sm-5">
                                                <div class="wrap-input100" data-validate="Inputan tidak valid" style="padding-top: 20px !important;">
                                                    <input class="input100 @error('kategori_barang') is-invalid @enderror "
                                                        type="text" name="kategori_barang" id="kategori_barang" autocomplete="off"
                                                        value="{{ old('kategori_barang') }}" readonly>
                                                        <span class="focus-input100"></span>
                                                    <input name="id_barang" type="hidden">
                                                    <input name="total_barang" type="hidden">

                                                </div>
                                                @error('kategori_barang')
                                                    <span class="text-danger">
                                                        <div class="parsley-required">{{ $message }}</div>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-4" style="padding: 25px">
                                                <button type="button" id="add_button" class="btn btn-primary"><i
                                                        class="fa fa-search"></i>&nbsp; Cari</button>

                                            </div>
                                        
                                        {{-- ini juga --}}

                                        <label class="col-sm-3 control-label" style="padding-top: 20px !important;">
                                            Merk</label>
                                        <div class="col-sm-9">
                                            <div class="wrap-input100 aturHead" data-validate="Inputan tidak valid">
                                                <input class="input100 @error('merk_barang') is-invalid @enderror"
                                                    type="text" name="merk_barang" id="merk_barang" autocomplete="off"
                                                    value="{{ old('merk_barang') }}" readonly>
                                                    <span class="focus-input100"></span>
                                            </div>  
                                            @error('merk_barang')
                                                <span class="text-danger">
                                                    <div class="parsley-required">{{ $message }}</div>
                                                </span>
                                            @enderror
                                        </div>

                                            <label class="col-sm-3 control-label" style="padding-top: 20px !important;">
                                                Tipe</label>
                                            <div class="col-sm-9">
                                                <div class="wrap-input100 aturHead" data-validate="Inputan tidak valid">
                                                    <input class="input100 @error('tipe_barang') is-invalid @enderror"
                                                        type="text" name="tipe_barang" id="tipe_barang" autocomplete="off"
                                                        value="{{ old('tipe_barang') }}" readonly>
                                                        <span class="focus-input100"></span>
                                                </div>
                                                @error('tipe_barang')
                                                    <span class="text-danger">
                                                        <div class="parsley-required">{{ $message }}</div>
                                                    </span>
                                                @enderror
                                            </div>
                                        
                                        
                                            <label class="col-sm-3 control-label" style="padding-top: 20px !important;">
                                                Harga</label>
                                            <div class="col-sm-9">
                                                <div class="wrap-input100 aturHead" data-validate="Inputan tidak valid">
                                                    <input class="input100 @error('harga_barang') is-invalid @enderror"
                                                        type="text" name="harga_barang" id="harga_barang" autocomplete="off"
                                                        value="{{ old('harga_barang') }}" readonly>
                                                        <span class="focus-input100"></span>
                                                </div>
                                                @error('harga_barang')
                                                    <span class="text-danger">
                                                        <div class="parsley-required">{{ $message }}</div>
                                                    </span>
                                                @enderror
                                            </div>
                                        

                                        
                                            <label class="col-sm-3 control-label" style="padding-top: 25px !important;">
                                                Jumlah</label>
                                            <div class="col-sm-9" style="padding-top: 20px !important;" >
                                                <input type="number" class="@error('jumlah_barang') is-invalid @enderror"
                                                    id="jumlah_barang" name="jumlah_barang" value="">
                                                    
                                            </div>
                                            @error('jumlah_barang')
                                                <span class="text-danger">
                                                    <div class="parsley-required">{{ $message }}</div>
                                                </span>
                                            @enderror
                                        

                                        
                                            <label class="col-sm-3 control-label" style="padding-top: 20px !important;">
                                                Total Harga</label>
                                            <div class="col-sm-9 aturHead">
                                                <div class="wrap-input100" data-validate="Inputan tidak valid">
                                                    <input class="input100 @error('total_harga') is-invalid @enderror"
                                                        type="text" name="total_harga" id="total_harga"
                                                        autocomplete="off" value="{{ old('total_harga') }}" readonly>
                                                        <span class="focus-input100"></span>
                                                </div>
                                                <input id="total_modal" name="total_modal" type="hidden">

                                                @error('total_harga')
                                                    <span class="text-danger">
                                                        <div class="parsley-required">{{ $message }}</div>
                                                    </span>
                                                @enderror
                                            </div>
                                        

                                        <div class="col-sm-12" style="padding-top: 20px !important;">
                                            <button type="button" id="addBarang" class="btn btn-primary col-sm-12"><i
                                                    class="fa fa-plus"></i>&nbsp; Tambahkan Barang</button>
                                        </div>
                                    </div>


                                    {{--  coloum 2--}}
                                    <div class="column" style="width: 70%;">
                                        <div class="wrap-input100" data-validate="Inputan tidak valid">
                                            <label class="labalaba bold">Daftar Pembelian Barang </label>
                                        </div>
                                        {{-- table --}}
                                        <div class="table">
                                            <div class="panel-body">
                                                <div id="spinner" class="text-center" style="display: none">
                                                    <div class="spinner-border text-info" role="status">
                                                        <span class="sr-only">Loading...</span>
                                                    </div>
                                                </div>
                                                <table id="transactionTable"
                                                    class="table table-striped table-bordered table-hover" cellspacing="0"
                                                    width="100%">
                                                    <thead>
                                                        <tr style=" background-color: #57cbff;">
                                                            <th>Kategori</th>
                                                            <th>Merk</th>
                                                            <th>Tipe</th>
                                                            <th>Harga</th>
                                                            <th>Jumlah</th>
                                                            <th>Total Harga</th>
                                                            <th>Opsi</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <td colspan="7">Silahkan Pilih Barang</td>
                                                    </tbody>
                                                </table>
                                                <label class="col-sm-9 control-label labalaba bold" style="padding-top: 10px !important;" >
                                                    Total Pembelian</label>
                                                <div class="col-sm-3 ">
                                                    <div class="wrap-input100 " data-validate="Inputan tidak valid">
                                                        <input class="input100 labalaba bold" style="text-align:right;"
                                                            type="text" name="total_pembelian" id="total_pembelian" value="0"
                                                            autocomplete="off" value="{{ old('total_harga') }}" readonly>
                                                    </div>                                           
                                                    <input id="total_modal_semua" name="total_modal_semua" type="hidden">
                                                </div>
                                            </div>
                                            
                                        </div> {{-- table --}}                                
                                    </div>{{-- coloum--}}
                                </div>{{-- row--}}
                                <div class="panel-footer">
                                    <div class="row">
                                        <div class=" col-sm-offset-7">                                           
                                            <button id="resetAbc" type="button" class="btn btn-danger">Batalkan Transaksi</button>
                                            <button id="submitAbc" type="button" class="btn btn-success">Buat Transaksi</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div> <!-- .container-fluid -->
        </div> <!-- #page-content -->
    </div>

    <!-- Modal search barang-->
    <div class="modal fade" id="cariBarangModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="width:900px;">
            <div class="modal-content">
                <div class="modal-header" style=" background-color: #ffbb00;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="modal-title" id="exampleModalLabel" >Daftar Barang</p>
                </div>
                <div class="modal-body">
                    <table id="table" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr style=" background-color: #57cbff;">
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Tipe</th>
                                <th>Harga</th>
                                <th>Stock</th>                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <!-- end modal -->



@stop
@section('script')
    <!-- Load page level scripts form validation-->
    <script type="text/javascript" src="{{ asset('plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js') }}">
    </script> <!-- Touchspin -->
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
    <!-- Load page level scripts data tables-->
    <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.18/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.18/js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootbox/bootbox.js') }}"></script> <!-- Bootbox -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/wijets/wijets.js') }}"></script>
    <!-- Button -->
    <script type="text/javascript" src="{{ asset('plugins/form-inputmask/dist/jquery.inputmask.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/form-select2/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script><!-- iCheck -->
    <script type="text/javascript" src="{{ asset('demo/demo-kasir-for-kasir.js') }}"></script>
@stop
