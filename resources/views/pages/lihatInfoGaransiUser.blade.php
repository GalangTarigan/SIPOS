@extends('layout.indexOfUser')
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
    <div class="static-content">
        <div class="page-content">            
            <ol class="breadcrumb">
                <li><a href="{{ route('login') }}">Login</a></li>
                <li class="active"><a href="">Cari Info Garansi</a></li>
            </ol>  
            <div class="page-heading">
            <h1>Cari Info Garansi</h1>
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
                        <div class="panel panel-midnightblue">
                            <div class="panel-heading">
                                <h2> Form Cari Transaksi</h2>
                                <div class="panel-ctrls">
                                </div>
                            </div>
                            <div class="panel-body">
                                <form action="{{route('garansiUserHasil')}}" method="POST" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Masukkan No.Invoice</label>
                                    <div class="col-sm-7">
                                        <div class="wrap-input100 input-group" data-validate="Harus Diisi">
                                            <input required
                                                class="input100 mask "
                                                type="text" name="no_invoice" autocomplete="off"
                                                value="{{ old('no_invoice') }}" spellcheck="false" placeholder="Misal. 01-020304">
                                            <span class="focus-input100" ></span>
                                        </div>
                                        
                                        <br>
                                        <div class=" col-sm-offset-2 col-sm-6">
                                            <button id="submit" class="btn btn-default-alt col-sm-12" type="submit"><i
                                                    class="fa fa-search"></i>&nbsp; Cari Transaksi</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div><!-- panel body -->
                        </div>
                    </div>
                </div> <!-- row -->            
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
    <script type="text/javascript" src="{{asset('demo/demo-cari-info-garansi-user.js')}}"></script>
@stop
