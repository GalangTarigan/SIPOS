@extends('layout.indexOfAdmin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/form-daterangepicker/daterangepicker.css') }}">
    <link type="text/css" href="{{ asset('plugins/form-select2/select2.css') }}" rel="stylesheet"> <!-- Select2 -->
    <link type="text/css" href="{{ asset('plugins/form-select2/select2-skins.css') }}" rel="stylesheet">
    
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
{{-- <script>
    var mulai = {!! json_encode($mulai) !!};
    var selesai = {!! json_encode($selesai) !!};
</script>     --}}
    
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
                <li><a href="{{route('dashboardAdmin')}}">Home</a></li>
                <li class="active"><a href="">Lihat Info Garansi</a></li>
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
                                <form action="{{ Route('showGaransiAdminHasil') }}" method="POST" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}                                

                                <div class="form-group">
                                    <label class="col-sm-3 control-label ">Masukkan No.Invoice &nbsp;&nbsp;&nbsp;&nbsp; : 
                                        <i id="loadingIcon4" class="fa fa-circle-notch fa-spin"></i>
                                    </label>
                                    <div class="col-sm-7">
                                        <select required class="@error('no_invoice') is-invalid @enderror alala"
                                            id="select2_no_invoice" name="no_invoice">
                                            <option></option>
                                        </select>
                                        @if (!is_null(old('no_invoice')))
                                            <script>
                                                var oldValP = {
                                                    !!json_encode(old('no_invoice')) !!
                                                };

                                            </script>
                                        @endif
                                        @if ($errors->has('no_invoice'))

                                            <span class="text-danger">
                                                <div class="parsley-required">{{ $message }}</div>
                                            </span>

                                        @endif
                                        <br>
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
    </div>
@stop
@section('script')
    <!-- Load page level scripts data tables-->
    
    <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.18/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/DataTables-1.10.18/js/dataTables.bootstrap4.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/form-daterangepicker/daterangepicker.js') }}"></script>
    <!-- Date Range Picker -->
    <script type="text/javascript" src="{{ asset('plugins/form-parsley/parsley.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/form-select2/select2.js') }}"></script>
    <!-- Validate Plugin / Parsley -->
    <script type="text/javascript" src="{{ asset('plugins/form-inputmask/dist/jquery.inputmask.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/Responsive-2.2.2/js/dataTables.responsive.js') }}"></script>
    <script type="text/javascript" src="{{asset('demo/demo-cari-info-garansi-admin.js')}}"></script>
@stop
