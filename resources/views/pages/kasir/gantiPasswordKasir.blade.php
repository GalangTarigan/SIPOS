@extends('layout.indexOfKasir')
@section('css')
<link type="text/css" href="{{asset('plugins/iCheck/skins/minimal/blue.css')}}" rel="stylesheet"> <!-- iCheck -->
<link type="text/css" href="{{asset('plugins/charts-chartistjs/chartist.min.css')}}" rel="stylesheet">
<link type="text/css" href="{{asset('plugins/form-select2/select2.css')}}" rel="stylesheet"> <!-- Select2 -->
<link type="text/css" href="{{asset('plugins/form-select2/select2-skins.css')}}" rel="stylesheet"> <!-- Select2 skin -->
<link type="text/css" href="{{asset('css/form-components.css')}}" rel="stylesheet"> <!-- form components-->
<link type="text/css" href="{{asset('fonts/iconic/css/material-design-iconic-font.min.css')}}" rel="stylesheet" >
@stop
@section('content')
<div class="static-content">
    <div class="page-content">
        <ol class="breadcrumb">
            <li><a href="{{route('dashboardAdmin')}}">Home</a></li>
            <li><a href="{{route('gantiPassword')}}">Ganti Password</a></li>
          
        </ol>
        <div class="page-heading">
            <h1>Ganti Password</h1>
        </div>
        <div class="container-fluid">
                @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{\Session::get('success')}}</p>
                </div>
                @endif
            <div class="row">
                    @foreach($userProfile as $data)
                <div class="col-sm-3">
                    <script>
                        </script>
                    <div class="panel panel-profile">
                        <div class="panel-body">
                            <div class="user-card">
                                    <div class="text-center">
                                            @if($data->foto && Storage::disk('public')->has($data->foto))
                                            <div align="center">
                                                <div class="img-circular" style="background-image: url({{ request()->getSchemeAndHttpHost() }}/kasir/akun/profile/get-userImage-kasir/?filename={{$data->foto}})"></div>
                                            
                                            </div>
                                            @else
                                            <img src="https://www.pngkey.com/png/full/202-2024792_user-profile-icon-png-download-fa-user-circle.png" class="avatar img-responsive">
                                            @endif
                                        </div>
                                        <br>
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
                                <div class="contact-name ">{{$data->nama_lengkap}}</div> 
                                {{-- <div class="contact-status">Teknisi</div> --}}
                                <ul class="details">
                                    <li><i class="far fa-envelope"></i><a >{{$data->email}}</a></li>
                                    <li><i class="fa fa-phone-alt"></i>{{$data->no_telepon}}</li>
                                    <li><i class="fa fa-map-marker-alt"></i>{{$data->alamat}}</li>
                                </ul>
                            </div>
                            <br>
                            <br>
                            
                            <hr class="outsider">
                        </div>
                    </div>
                </div>
                @endforeach
                <div class="col-sm-9">
                <div data-widget-group="group1">
                        <div class="panel">
                            <div class="panel-heading">
                                <h2>Form Ganti Password</h2>
                            </div>                        
                            <div class="panel-body" style="margin-top: 10px !important">
                                <form class="form-horizontal row-border" action="{{route('postGantiPassword')}}" method="POST" id="validate-form" data-parsley-validate
                                    data-parsley-errors-messages-disabled>{{ csrf_field() }}
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="padding-top: 10px !important;">Password Sekarang &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                        <div class="col-sm-7">
                                            <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                                    <span class="btn-show-pass">
                                                            <i class="zmdi zmdi-eye"></i>
                                                    </span>
                                                <input required class="input100 @error('old_password') is-invalid @enderror" type="password" name="old_password"
                                                    autocomplete="off"  placeholder="Masukkan Password Lama">
                                                <span class="focus-input100" ></span>
                                            </div>
                                                @error('old_password')   
                                                    <span class="text-danger"><div class="parsley-required">{{$message}}</div></span>
                                                @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <label class="col-sm-3 control-label" style="padding-top: 10px !important;">Password Baru &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                            <div class="col-sm-7">
                                                <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                                        <span class="btn-show-pass">
                                                                <i class="zmdi zmdi-eye"></i>
                                                        </span>
                                                    <input required class="input100 @error('password') is-invalid @enderror" type="password" name="password"
                                                        autocomplete="off" placeholder="Masukkan Password Baru, Minimal 8 karakter">
                                                    <span class="focus-input100"></span>
                                                </div>
                                                @error('password')   
                                                    <span class="text-danger"><div class="parsley-required">{{$message}}</div></span>
                                                @enderror
                                            </div>
                                        </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" style="padding-top: 10px !important;">Ulangi Password Baru &nbsp;&nbsp;&nbsp;&nbsp; : </label>
                                        <div class="col-sm-7">
                                                <div class="wrap-input100" data-validate="Kolom tidak boleh kosong">
                                                    <input required class="input100 @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation"
                                                        autocomplete="off"   data-placeholder-equalto="#password">
                                                    <span class="focus-input100"></span>
                                                </div>
                                                @error('password_confirmation')   
                                                    <span class="text-danger"><div class="parsley-required">{{$message}}</div></span>
                                                @enderror
                                        </div>
                                    </div>
                                            <div class="panel-footer">
                                                    <div class="row">
                                                        <div class=" col-sm-offset-3 col-sm-7">
                                                            <button id="submit" class="btn-primary btn" type="submit">Submit</button>
                                                            <button id="cancel" type="reset" class="btn-default btn">Reset</button>
                                                        </div>
                                                    </div>
                                            </div>
                                </form>
                            </div>
                        </div>
                    </div><!--data widget group1-->
                </div>
            </div>
        </div><!-- .container-fluid -->
    </div><!-- .page content -->
</div> <!-- .static content-->
        



@stop
@section('script')

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
<script type="text/javascript" src="{{asset('demo/demo-ganti-password.js')}}"></script>
@stop


