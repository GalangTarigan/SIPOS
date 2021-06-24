@extends('layout.indexOfAdmin')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/DataTables-1.10.18/css/dataTables.bootstrap4.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('plugins/Responsive-2.2.2/css/responsive.bootstrap4.css')}}" />
<link type="text/css" href="{{asset('plugins/iCheck/skins/minimal/blue.css')}}" rel="stylesheet"> <!-- iCheck -->
<link type="text/css" href="{{asset('plugins/form-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
<!-- DateRangePicker -->
<link type="text/css" href="{{asset('plugins/charts-chartistjs/chartist.min.css')}}" rel="stylesheet">
<link type="text/css" href="{{asset('plugins/form-select2/select2.css')}}" rel="stylesheet"> <!-- Select2 -->
<link type="text/css" href="{{asset('plugins/form-select2/select2-skins.css')}}" rel="stylesheet"> <!-- Select2 skin -->
<link type="text/css" href="{{asset('css/form-components.css')}}" rel="stylesheet"> <!-- form components-->
<link type="text/css" href="{{asset('css/subjek-keluhan.css')}}" rel="stylesheet"> 
@stop
@section('content')
<div class="static-content">
    <div class="page-content">
        <ol class="breadcrumb">
            <li><a href="{{route('dashboardAdmin')}}">Home</a></li>
            <li>Manajemen-Barang</li>
            <li class="active"><a href="">Kategori & Merk Barang</a></li>
        </ol>
        <div class="page-heading">
            <h1>Kategori & Merk Barang</h1>
        </div>
        <div class="container-fluid">
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p>{{\Session::get('success')}}</p>
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <p>{{$errors->first()}}</p>
                </div>
                @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h2>Daftar Kategori Barang</h2>
                            <div class="options">
                                <ul class="nav nav-tabs">
                                    <li><a class="active show" href="#edit-kategori" data-toggle="tab">Daftar Kategori</a></li>
                                    <li><a href="#tambah-kategori" data-toggle="tab">Tambah Kategori</a></li>
                                </ul>
                            </div>
                        </div>                        
                        <div class="table-responsive">
                            <div class="panel-body">                                
                                <div class="tab-content">
                                    <div class="tab-pane active" id="edit-kategori">
                                        <div id="spinner" class="text-center" style="display: none">
                                            <div class="spinner-border text-info" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        <table id="table" class="table table-striped table-bordered table-hover" cellspacing="0"
                                            width="100%">
                                            <thead>
                                                <tr style=" background-color: #57cbff;">
                                                    <th class="a">No</th>
                                                    <th>Kategori Barang</th>
                                                    <th class="b">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tambah-kategori">
                                            <form action="{{route('addKategori')}}" method="POST" class="form-horizontal row-border"
                                            data-parsley-validate data-parsley-errors-messages-disabled id="validate-form"> {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Ketikkan Kategori Baru &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                                <div class="col-sm-7">
                                                    <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                                        <input required class="input100" type="text" name="nama_kategori"
                                                        autocomplete="off" placeholder="Masukkan kategori baru disini ....">
                                                        <span class="focus-input100" data-placeholder="Masukkan Nama Kategori Baru"></span>
                                                    </div>
                                                    @error('nama_kategori')   
                                                    <span class="text-danger"><div class="parsley-required">{{$message}}</div></span>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                    <div class="row">
                                                        <div class=" col-sm-offset-5 col-sm-7">
                                                            <button id="submit" class="btn btn-primary-alt" type="submit">Submit</button>
                                                            <button id="cancel" type="reset" class="btn btn-danger-alt">Reset</button>
                                                        </div>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h2>Daftar Merk Barang</h2>
                            <div class="options">
                                <ul class="nav nav-tabs">
                                    <li><a class="active show" href="#edit-merk" data-toggle="tab">Daftar Merk</a></li>
                                    <li><a href="#tambah-merk" data-toggle="tab">Tambah Merk</a></li>
                                </ul>
                            </div>
                        </div>                        
                        <div class="table-responsive">
                            <div class="panel-body">                                
                                <div class="tab-content">
                                    <div class="tab-pane active" id="edit-merk">
                                        <div id="spinner" class="text-center" style="display: none">
                                            <div class="spinner-border text-info" role="status">
                                                <span class="sr-only">Loading...</span>
                                            </div>
                                        </div>
                                        <table id="table-merk" class="table table-striped table-bordered table-hover" cellspacing="0"
                                            width="100%">
                                            <thead>
                                                <tr style=" background-color: #ffeb3b;">
                                                    <th class="a">No</th>
                                                    <th>Merk Barang</th>
                                                    <th class="b">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane" id="tambah-merk">
                                        <form action="{{route('addMerkBarang')}}" method="POST" class="form-horizontal row-border"
                                            data-parsley-validate data-parsley-errors-messages-disabled id="validate-form"> {{ csrf_field() }}
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Ketikkan Merk Baru &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                                <div class="col-sm-7">
                                                    <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                                        <input required class="input100" type="text" name="nama_merk"
                                                        autocomplete="off" placeholder="Masukkan merk baru disni .....">
                                                        <span class="focus-input100" data-placeholder="Masukkan merk Baru"></span>
                                                    </div>
                                                    @error('nama_merk')   
                                                    <span class="text-danger"><div class="parsley-required">{{$message}}</div></span>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="panel-footer">
                                                    <div class="row">
                                                        <div class=" col-sm-offset-5 col-sm-7">
                                                            <button id="submit" class="btn btn-primary-alt" type="submit">Submit</button>
                                                            <button id="cancel" type="reset" class="btn btn-danger-alt">Reset</button>
                                                        </div>
                                                    </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </div> <!-- .container-fluid -->
    </div> <!-- #page-content -->
</div>

<!-- Modal edit kategori-->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #57cbff">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="modal-title" id="exampleModalLabel">Form Edit Kategori</p>
            </div>
            <div class="modal-body" style="margin-top: 10px !important">
                <form action="{{route('updateKategori')}}" method="POST" class="form-horizontal row-border"
                    data-parsley-validate data-parsley-errors-messages-disabled id="validate-form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-4 control-label" style="padding-top: 11px !important;">Ketikkan Kategori Baru &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                        <div class="col-sm-8">
                            <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                            <input placeholder="Ketik disini ..." required class="input100" id="nama_kategori" name="nama_kategori"
                                type="text" autofocus="autofocus" >
                                <span class="focus-input100" data-placeholder="Ketik disini kaka..."></span>    
                            <input name="id_kategori" required type="hidden">                    
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background: #ececec">
                <button type="button" id="submit-update" class="btn btn-primary-alt" type="submit">Simpan</button>
                <button type="button" class="btn btn-danger-alt" data-dismiss="modal">Batal</button>                
            </div>
        </div>
    </div>
</div>
<!-- end modal -->

<!-- Modal edit merk-->
<div class="modal fade" id="editModalMerk" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background: #ffeb3b">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="modal-title" id="exampleModalLabel">Form Edit Merk Barang</p>
            </div>
            <div class="modal-body" style="margin-top: 10px !important">
                <form action="{{route('updateMerkBarang')}}" method="POST" class="form-horizontal row-border"
                    data-parsley-validate data-parsley-errors-messages-disabled id="validate-form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-sm-4 control-label" style="padding-top: 11px !important;">Ketikkan Merk Baru &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                        <div class="col-sm-8">
                            <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                            <input placeholder="Ketik disini ..." required class="input100" id="nama_merk" name="nama_merk"
                                type="text" autofocus="autofocus" >
                                <span class="focus-input100" data-placeholder="Ketik disini kaka..."></span>    
                            <input name="id_merk" required type="hidden">                    
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer" style="background: #ececec">
                <button type="button" id="submit-update-merk" class="btn btn-primary-alt" type="submit">Simpan</button>
                <button type="button" class="btn btn-danger-alt" data-dismiss="modal">Batal</button>                
            </div>
        </div>
    </div>
</div>
<!-- end modal -->


@stop
@section('script')
<!-- Load page level scripts form validation-->
<script>
        // See Docs
        window.ParsleyConfig = {
            successClass: 'info-success'
            , errorClass: 'alert-validate'
            , classHandler: function (el) {
                return el.$element.parent();
            }
        };
    </script>
<script type="text/javascript" src="{{asset('plugins/form-parsley/parsley.js')}}"></script>
<!-- Validate Plugin / Parsley -->
<!-- Load page level scripts data tables-->
<script type="text/javascript" src="{{asset('plugins/DataTables-1.10.18/js/jquery.dataTables.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/DataTables-1.10.18/js/dataTables.bootstrap4.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/Responsive-2.2.2/js/dataTables.responsive.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/bootbox/bootbox.js')}}"></script> <!-- Bootbox -->
<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/wijets/wijets.js')}}"></script>
<!-- Button -->
<script type="text/javascript" src="{{asset('plugins/form-inputmask/dist/jquery.inputmask.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/form-select2/select2.js')}}"></script>
<script type="text/javascript" src="{{asset('plugins/iCheck/icheck.min.js')}}"></script><!-- iCheck -->
<script type="text/javascript" src="{{asset('demo/demo-kategori-barang.js')}}"></script>
@stop
