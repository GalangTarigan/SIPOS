@extends('layout.indexOfAdmin')
@section('css')
    <link type="text/css" href="{{ asset('plugins/iCheck/skins/minimal/blue.css') }}" rel="stylesheet"> <!-- iCheck -->
    <link type="text/css" href="{{ asset('plugins/charts-chartistjs/chartist.min.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ asset('plugins/form-select2/select2.css') }}" rel="stylesheet"> <!-- Select2 -->
    <link type="text/css" href="{{ asset('plugins/form-select2/select2-skins.css') }}" rel="stylesheet">
    <!-- Select2 skin -->
    <link type="text/css" href="{{ asset('css/form-components.css') }}" rel="stylesheet"> <!-- form components-->
@stop
@section('content')
    {{-- <script>
        var user = {!!  json_encode($user) !!};
        console.log(user)
</script> --}}
    <div class="static-content">
        <div class="page-content">
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboardAdmin') }}">Home</a></li>
                <li>Statistik</li>
                <li><a href="{{ route('showPegawai') }}">Daftar Pegawai</a></li>
                <li class="active"><a href="/detail-teknisi">EditPegawai</a></li>
            </ol>
            <div class="page-heading">
                <h1>Edit Pegawai</h1>
            </div>
            <div class="container-fluid">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <p>{{ $errors->first() }}</p>
                    </div>
                @endif
                <div class="row">

                    <div class="col-md-4">
                        <script>
                        </script>
                        <div class="panel panel-profile">
                            <div class="panel-body">
                                <div class="user-card">
                                    <div class="text-center">
                                        @if ($userProfile->foto && Storage::disk('public')->has($userProfile->foto))
                                            <div align="center">
                                                <div class="img-circular"  onclick="imagesOldPic('{{$userProfile->foto}}')"
                                                    style="background-image: url({{ request()->getSchemeAndHttpHost() }}/akun/profile/get-userImage/?filename={{$userProfile->foto}})">
                                                </div>
                                            </div>
                                        @else
                                            <img onclick="imagesPicNull('user/no_picture.png')" src="/admin/akun/profile/get-foto/?filename=user/no_picture.png"
                                                class="avatar img-responsive">
                                        @endif
                                    </div>
                                    <br>
                                    <div class="text-center">
                                        <a href="#" class="" onclick="$('input[name=image]').click();"><i
                                                class="fa fa-camera"></i> Edit Foto</a>

                                    </div>
                                    <form id="image-form" method="post" action="{{ route('uploadProfile') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input style="display: none" type="file" name="image" accept="image/*" />
                                        <input style="display: none" type="text" name="id" value="{{$userProfile->id}}" />
                                        {{-- harus diubah --}}
                                    </form>

                                    <div class="contextual-progress" style="display: none;">
                                        <div class="clearfix">
                                            <div class="progress-title">Status</div>
                                            <div class="progress-percentage"></div>
                                        </div>
                                        <div id="progress" class="progress">
                                            <div id="progress-bar" class="progress-bar" role="progressbar" aria-valuenow=""
                                                aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="contact-name ">{{ $userProfile->nama_lengkap }}</div>
                                        <div class="contact-status"><i class="far fa-user"></i> {{ $userProfile->posisi }}</div>
                                    <ul class="details">
                                        <li><i class="far fa-user"></i>{{ $userProfile->posisi }}</li> 
                                        <li><i class="far fa-envelope"></i>{{ $userProfile->email }}</li>
                                        <li><i class="fa fa-phone-alt"></i>{{ $userProfile->no_telepon }}</li>
                                        <li><i class="fa fa-map-marker-alt"></i>{{ $userProfile->alamat }}</li>
                                    </ul>
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                    </div> 


                    <div class="col-md-8">
                        <div class="panel panel">
                            <div class="panel-heading">
                                <h2>Form Edit Data Pegawai</h2>
                            </div>
                            <div class="panel-body" style="height: 110%">
                                <form action="{{route('EditPegawai')}}" method="POST" class="form-horizontal row-border"
                                data-parsley-validate data-parsley-errors-messages-disabled enctype="multipart/form-data" id=validate-form>
                                {{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Nomor
                                            Telepon </label>
                                            <div class="col-sm-7">
                                                <div class="wrap-input100" data-validate="Inputan tidak valid">
                                                    <input minlength="10" type="number" class="input100 mask"
                                                    id="no_telepon" name="no_telepon" autocomplete="off" value="{{ $userProfile->no_telepon}}"
                                                    onKeyPress="if(this.value.length==12) return false;">
                                                    <span class="focus-input100" ></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" style="padding-top: 11px !important;">Alamat
                                            </label>
                                        <div class="col-sm-7">
                                            <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                                <input class="input100" id="alamat" required
                                                name="alamat" type="text" autocomplete="off" value="{{ $userProfile->alamat }}">
                                                <span class="focus-input100"></span>
                                            </div>
                                        </div>
                                    </div>                                   

                                    <input type="text" value={{ $userProfile->id }} name="user_id" hidden>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="padding-top: 11px !important;"> Status Pegawai &nbsp;&nbsp;&nbsp;&nbsp; : 
                                        </label>
                                        <div class="col-sm-7">
                                            <div class="wrap-input100" data-validate="Inputan tidak valid">
                                                <input class="input100" readonly
                                                type="text" autocomplete="off" 
                                                value="{{ $userProfile->posisi }}">
                                                <span class="focus-input100" ></span>
                                            </div>
                                        </div>
                                            
                                        <div class="col-sm-1" style="padding-top: 11px !important; display:block" id="ed_button2">
                                            <button type="button" id="edit_button2" class="btn btn-success-alt" onclick="show()"> Ubah ?</button>
                                        </div>
                                        
                                        <label class="col-sm-3 control-label" style="padding-top: 17px !important; display:none" id="label_posisi">
                                            Ubah Status &nbsp;&nbsp;&nbsp;&nbsp; : </label> 
    
                                        <div class="col-sm-7" style="padding-top: 11px !important; display:none" id="input_posisi">
                                            <select id="select2_posisi_pegawai" name="posisi_pegawai">
                                                <option></option>
                                            </select>
                                        </div>
                                        <div class="col-sm-1" style="padding-top: 11px !important; display:none" id="bat_button2">
                                            <button type="button" id="batal_button2" class="btn btn-danger-alt" onclick="hide()"> &nbsp;Batal&nbsp;</button>
                                        </div>
                                    </div>

                                
                                    <div class="panel-footer">
                                        <div class="row">
                                            <div class=" col-sm-offset-5 col-sm-7">
                                                <button id="submit" class="btn btn-primary-alt" type="submit">Submit</button>
                                                <button id="cancel" type="reset" class="btn btn-danger-alt" onclick="hideAll()">Reset</button>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- .container-fluid -->
    </div> <!-- #page-content -->
</div>

@stop
@section('script')

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
    <script type="text/javascript" src="{{ asset('plugins/form-parsley/parsley.js') }}"></script>
    <!-- Load page level scripts data tables-->


    <script type="text/javascript" src="{{ asset('plugins/form-inputmask/dist/jquery.inputmask.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/form-select2/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script><!-- iCheck -->

    <script src="{{ asset('plugins/jquery-form/jquery.form.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/wijets/wijets.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/bootstrap-switch/bootstrap-switch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-form/jquery.form.js') }}"></script>
    <script type="text/javascript" src="{{ asset('demo/demo-edit-pegawai.js') }}"></script>
@stop
