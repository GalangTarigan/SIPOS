@extends('layout.indexOfAdmin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css') }}" />
    <link type="text/css" href="{{ asset('css/form-components.css') }}" rel="stylesheet"> <!-- form components-->
    <link type="text/css" href="{{ asset('css/daftar-barang.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/kasir.css') }}" rel="stylesheet">
    <!-- DateRangePicker -->
    <style>
        th {
            text-align: center;
        }

        td {
            text-align: center;
        }
        div.kanan{
            text-align:right;
        }


    </style> <!-- for justify data table -->
@stop
@section('content')
<script>
    var id = {!! json_encode($data_sales->id_sales) !!};
</script>    
    
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboardAdmin') }}">Home</a></li>
                <li>Manajemen Sales</li>
                <li><a href="{{route('showSales')}}">Daftar Sales</a></li>
                <li class="active"><a href="">Detail Sales</a></li>
            </ol>
            <div class="page-heading">
                <h1>Detail Sales</h1>
                <div class="options">
                    <div class="btn-toolbar">
                        
                        <a href="{{route('showDaftarTagihanLunas', ['data' => $data_sales->id_sales])}}" class="btn btn-primary">Lihat Daftar Tagihan telah Lunas <i
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
                    <div class="col-md-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h2>Detail Sales {{$data_sales->nama_sales}}</h2>
                                <div class="panel-ctrls">
                                </div>
                            </div>                                                                                    
                            <div class="table-responsive">
                                <div class="panel-body">                                                                        
                                    <div class="row">
                                       
                                        <div class="form-group kanan">
                                            <label class="col-sm-4 control-label" style="padding-top: 11px !important;">Nama
                                                Perusahaan  &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                            <div class="col-sm-7">
                                                <div class="wrap-input100" style="width: 70%">
                                                    <input class="input100" type="text" name="keterangan_barang" autocomplete="off"
                                                    value="{{$data_sales->nama_perusahaan}}" readonly>
                                                    <span class="focus-input100" data-placeholder="Keterangan Barang" ></span>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        
                                        <div class="form-group kanan">
                                            <label class="col-sm-4 control-label" style="padding-top: 11px !important;">Nama
                                                Sales  &nbsp;&nbsp;&nbsp;&nbsp;: </label>
                                            <div class="col-sm-7">
                                                <div class="wrap-input100" style="width: 70%">
                                                    <input class="input100" type="text" name="keterangan_barang" autocomplete="off"
                                                    value="{{$data_sales->nama_sales}}" readonly>
                                                    <span class="focus-input100" data-placeholder="Keterangan Barang"></span>
                                                </div>
                                               
                                            </div>
                                        </div>

                                        <div class="form-group kanan">
                                            <label class="col-sm-4 control-label" style="padding-top: 11px !important;">Nomor Hp  &nbsp;&nbsp;&nbsp;&nbsp;: </label>
                                            <div class="col-sm-7">
                                                <div class="wrap-input100" style="width: 70%">
                                                    <input class="input100" type="text" name="keterangan_barang" autocomplete="off"
                                                    value="{{$data_sales->no_telepon}}" readonly>
                                                    <span class="focus-input100" data-placeholder="Keterangan Barang"></span>
                                                </div>
                                               
                                            </div>
                                        </div>

                                        <div class="form-group kanan">
                                            <label class="col-sm-4 control-label" style="padding-top: 11px !important;">Alamat  &nbsp;&nbsp;&nbsp;&nbsp;: 
                                                </label>
                                            <div class="col-sm-7">
                                                <div class="wrap-input100" style="width: 70%">
                                                    <input class="input100" type="text" name="keterangan_barang" autocomplete="off"
                                                    value="{{$data_sales->alamat}}" readonly>
                                                    <span class="focus-input100" data-placeholder="Keterangan Barang"></span>
                                                </div>
                                               
                                            </div>
                                        </div>

                                        <div class="form-group kanan">
                                            <label class="col-sm-4 control-label" style="padding-top: 11px !important;">Nama &
                                                Nomor Rekening  &nbsp;&nbsp;&nbsp;&nbsp;: </label>
                                            <div class="col-sm-7">
                                                <div class="wrap-input100" style="width: 70%">
                                                    <input class="input100" type="text" name="keterangan_barang" autocomplete="off"
                                                    value="{{$data_sales->nama_no_rekening}}" readonly>
                                                    <span class="focus-input100" data-placeholder="Keterangan Barang"></span>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        <div class="form-group kanan">
                                            <label class="col-sm-4 control-label" style="padding-top: 11px !important;">
                                                Product yang dijual  &nbsp;&nbsp;&nbsp;&nbsp;: </label>
                                            <div class="col-sm-7">
                                                <div class="wrap-input100" style="width: 70%">
                                                    <input class="input100" type="text" name="keterangan_barang" autocomplete="off"
                                                    value="{{$data_sales->product}}" readonly>
                                                    <span class="focus-input100" data-placeholder="Keterangan Barang"></span>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        
                                      </div> {{-- ini row --}}
                                    
                                    <br>
                                    <br>
                                    <div class="wrap-input100" data-validate="Inputan tidak valid" style="text-align:center; background-color: #2dd632;">
                                        <label class="labalaba bold" style="margin-top: 9px;"> Daftar Tagihan Yang Belum Dibayar</label>
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
                                                <th>Nama Sales</th>
                                                <th>No. Faktur</th>
                                                <th>Tanggal Faktur</th>
                                                <th>Jatuh Tempo</th>
                                                <th>Tagihan</th>
                                                <th>Status</th>
                                                <th>Faktur</th>
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
            </div> <!-- container-fluid -->
        </div> <!-- #page-content -->
    </div>

     <!-- Modal foto barang-->
     <div class="modal fade" id="fotoFakturTagihan" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document" style="width:900px;">
            <div class="modal-content">
                <div class="modal-header" style=" background-color: #ffbb00;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="modal-title bold" id="exampleModalLabel" style="color: black">Foto Faktur Tagihan Sales</p>
                </div>
                <div class="modal-body">
                    <div style="width:100%; text-align: center;">                        
                        <a class="slide" id='prev_image'><</a>
                        <img id="main-foto" src="" alt="centered image" height="500" width="700"/>                        
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
    <!-- Date Range Picker -->
    <script type="text/javascript" src="{{ asset('plugins/form-parsley/parsley.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootbox/bootbox.js') }}"></script> <!-- Bootbox -->
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script> <!-- untuk modal -->
    <script type="text/javascript" src="{{ asset('plugins/wijets/wijets.js') }}"></script>
    <!-- Validate Plugin / Parsley -->
    <script type="text/javascript" src="{{ asset('plugins/form-inputmask/dist/jquery.inputmask.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{asset('demo/demo-detail-sales.js')}}"></script>
@stop
