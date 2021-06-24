@extends('layout.indexOfAdmin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css') }}" />
    <link type="text/css" href="{{ asset('plugins/form-select2/select2.css') }}" rel="stylesheet"> <!-- Select2 -->
    <link type="text/css" href="{{ asset('plugins/form-select2/select2-skins.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/keuangan.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('css/form-components.css') }}" rel="stylesheet"> <!-- form components-->
    <link type="text/css" href="{{ asset('css/daftar-barang.css') }}" rel="stylesheet">
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
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
                <li><a href="{{route('dashboardAdmin')}}">Home</a></li>
                <li>Keuangan</li>
                <li class="active"><a href="">Bayar Tagihan Sales - Cari</a></li>
            </ol>
            <div class="page-heading">
                <h1>Cari Tagihan Sales</h1>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-midnightblue">
                            <div class="panel-heading">
                                <h2> Form Cari Tagihan Sales</h2>
                                <div class="panel-ctrls">
                                </div>
                            </div>
                            <div class="panel-body">
                                <form action="{{ Route('showDetailTagihanSales') }}" method="POST" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Pilih Perusahaan & Sales &nbsp;&nbsp;&nbsp;&nbsp; : 
                                        <i id="loadingIcon1" class="fa fa-circle-notch fa-spin"></i>
                                    </label>
                                    <div class="col-sm-7">
                                        <select required class="@error('nama_perusahaan') is-invalid @enderror"
                                            id="select2_nama_perusahaan" name="nama_perusahaan">
                                            <option></option>
                                        </select>
                                        @if (!is_null(old('nama_perusahaan')))
                                            <script>
                                                var oldValP = {
                                                    !!json_encode(old('nama_perusahaan')) !!
                                                };

                                            </script>
                                        @endif
                                        @if ($errors->has('nama_perusahaan'))

                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>

                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Pilih No.Faktur &nbsp;&nbsp;&nbsp;&nbsp; : 
                                        <i id="loadingIcon2" class="fa fa-circle-notch fa-spin"></i>
                                    </label>
                                    <div class="col-sm-7">
                                        <select required class="@error('no_faktur') is-invalid @enderror"
                                            id="select2_no_faktur" name="no_faktur">
                                            <option></option>
                                        </select>
                                        @if (!is_null(old('no_faktur')))
                                            <script>
                                                var oldValS = {
                                                    !!json_encode(old('no_faktur')) !!
                                                };

                                            </script>
                                        @endif
                                        @if ($errors->has('no_faktur'))

                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>

                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-offset-4 col-sm-4">
                                    <button id="submit" class="btn btn-success-alt col-sm-12" type="submit"><i
                                        class="fa fa-search"></i>&nbsp; Cari Laporan</button>
                                </div>

                            </form>
                            </div><!-- panel body -->
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <h2>Daftar seluruh tagihan yang belum lunas</h2>
                                <div class="panel-ctrls">
                                </div>
                            </div>
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
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Sales</th>
                                                <th>No. Faktur</th>
                                                <th>Tanggal Faktur</th>
                                                <th>Jatuh Tempo</th>
                                                <th>Tagihan</th>
                                                <th>Status</th>
                                                <th>Faktur</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
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
    <script type="text/javascript" src="{{ asset('plugins/form-select2/select2.js') }}"></script>
    <!-- Date Range Picker -->
    <script type="text/javascript" src="{{ asset('plugins/form-parsley/parsley.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script> <!-- untuk modal -->
    <!-- Validate Plugin / Parsley -->
    <script type="text/javascript" src="{{ asset('plugins/form-inputmask/dist/jquery.inputmask.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{asset('demo/demo-cari-tagihan-sales.js')}}"></script>
@stop
