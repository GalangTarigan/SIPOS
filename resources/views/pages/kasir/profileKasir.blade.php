@extends('layout.indexOfKasir')
@section('css')
@stop
@section('content')
<div class="static-content">
    <div class="page-content">
        <ol class="breadcrumb">
            <li><a href="{{route('dashboardAdmin')}}">Home</a></li>
            <li>Akun</li>
            <li class="active"><a href=''>Profil-Kasir</a></li>
        </ol>
        <div class="page-heading">
            <h1>Profile Kasir</h1>
        </div>
        <div class="container-fluid">
            <div class="row">
                @foreach($data as $data)
                <div class="col-sm-offset-4 col-sm-4">
                    <div class="panel panel-profile">
                        <div class="panel-body">
                            <div class="user-card">
                                <div class="text-center">
                                    @if($data->foto && Storage::disk('public')->has($data->foto))
                                    <div align="center">
                                    <div class="img-circular" onclick="imagesOldPic('{{$data->foto}}')"  style="background-image: url({{ request()->getSchemeAndHttpHost() }}/kasir/akun/profile/get-userImage-kasir/?filename={{$data->foto}})"></div>
                                    {{-- <img class="img-brand" src="{{asset('img/tech-logo.png')}}"></img> --}}
                                    </div>
                                    @else
                                    <img onclick="imagesPicNull('user/no_picture.png')" src="/kasir/akun/profile/get-foto/?filename=user/no_picture.png"
                                    class="avatar img-responsive">
                                    @endif
                                </div>
                                <br>
                                <div class="text-center">
                                    <a href="#" class=""
                                        onclick="$('input[name=image]').click();"><i class="fa fa-camera"></i> Edit Foto</a>
                                </div>
                                <form id="image-form" method="post" action="{{ route('uploadProfile') }}" enctype="multipart/form-data">
                                    @csrf

                                    <input style="display: none" type="file" name="image" accept="image/*"/>
                                    <input style="display: none" type="text" name="id" value="{{Auth::user()->id}}" />
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
                                <div class="contact-name">{{$data->nama_lengkap}}</div>
                                <div class="contact-status">Kasir</div>
                                <ul class="details">
                                    <li><i class="fas fa-fw fa-envelope"></i>{{$data->email}}</li>
                                    <li><i class="fas fa-fw fa-phone"></i>{{$data->no_telepon}}</li>
                                    <li><i class="fas fa-fw fa-map-marker"></i>{{$data->alamat}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div> <!-- .container-fluid -->
    </div> <!-- #page-content -->
</div>
@stop
@section('script')

<script src="{{asset('demo/demo-profile-kasir.js')}}"></script>
<script src="{{asset('plugins/jquery-form/jquery.form.js')}}"></script>
<!--Must Include -->
@stop
