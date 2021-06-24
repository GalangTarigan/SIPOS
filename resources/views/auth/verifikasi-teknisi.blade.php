<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Verify your email address</title>
  {{-- <link type="text/css" href="{{asset('css/button-verifikasi.css')}}" rel="stylesheet"> <!-- keluhan components--> --}}
<style>
.myButton {
    background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #1e718f), color-stop(1, #019ad2));
    background:-moz-linear-gradient(top, #1e718f 5%, #019ad2 100%);
    background:-webkit-linear-gradient(top, #1e718f 5%, #019ad2 100%);
    background:-o-linear-gradient(top, #1e718f 5%, #019ad2 100%);
    background:-ms-linear-gradient(top, #1e718f 5%, #019ad2 100%);
    background:linear-gradient(to bottom, #1e718f 5%, #019ad2 100%);
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#1e718f', endColorstr='#019ad2',GradientType=0);
    background-color:#1e718f;
    -moz-border-radius:6px;
    -webkit-border-radius:6px;
    border-radius:6px;
    display:inline-block;
    cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:23px;
	padding:7px 24px;
	text-decoration:none;
  }
  .button:hover {
    background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #019ad2), color-stop(1, #1e718f));
    background:-moz-linear-gradient(top, #019ad2 5%, #1e718f 100%);
    background:-webkit-linear-gradient(top, #019ad2 5%, #1e718f 100%);
    background:-o-linear-gradient(top, #019ad2 5%, #1e718f 100%);
    background:-ms-linear-gradient(top, #019ad2 5%, #1e718f 100%);
    background:linear-gradient(to bottom, #019ad2 5%, #1e718f 100%);
    filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#019ad2', endColorstr='#1e718f',GradientType=0);
    background-color:#019ad2;
  }
  .button:active {
    position:relative;
    top:1px;
  }
    /* Base ------------------------------ */
    *:not(br):not(tr):not(html) {
        font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
      }
      body {
        width: 100% !important;
        height: 100%;
        margin: 0;
        line-height: 1.4;
        background-color: #F5F7F9;
        color: #839197;
        -webkit-text-size-adjust: none;
      }
      a.myButton, a.myButton:visited, a.myButton:link, a.myButton:active
        {
            color: white;
            text-decoration: none;
        }
      /* Layout ------------------------------ */
      .email-wrapper {
        width: 100%;
        margin: 0;
        padding: 0;
        background-color: #F5F7F9;
      }
      .email-content {
        width: 100%;
        margin: 0;
        padding: 0;
      }
      /* Masthead ----------------------- */
      .email-masthead {
        padding: 25px 0;
        text-align: center;
      }
      .email-masthead_logo {
        max-width: 400px;
        border: 0;
      }
      .email-masthead_name {
        font-size: 16px;
        font-weight: bold;
        color: #839197;
        text-decoration: none;
        text-shadow: 0 1px 0 white;
      }
      /* Body ------------------------------ */
      .email-body {
        width: 100%;
        margin: 0;
        padding: 0;
        border-top: 1px solid #E7EAEC;
        border-bottom: 1px solid #E7EAEC;
        background-color: #FFFFFF;
      }
      .email-body_inner {
        width: 570px;
        margin: 0 auto;
        padding: 0;
      }
      .email-footer {
        width: 570px;
        margin: 0 auto;
        padding: 0;
        text-align: center;
      }
      .email-footer p {
        color: #839197;
      }
      .body-action {
        width: 100%;
        margin: 30px auto;
        padding: 0;
        text-align: center;
      }
      .body-sub {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid #E7EAEC;
      }
      .content-cell {
        padding: 35px;
      }
      .align-right {
        text-align: right;
      }
      /* Type ------------------------------ */
      h1 {
        margin-top: 0;
        color: #292E31;
        font-size: 19px;
        font-weight: bold;
        text-align: left;
      }
      h2 {
        margin-top: 0;
        color: #292E31;
        font-size: 16px;
        font-weight: bold;
        text-align: left;
      }
      h3 {
        margin-top: 0;
        color: #292E31;
        font-size: 14px;
        font-weight: bold;
        text-align: left;
      }
      p {
        margin-top: 0;
        color: #839197;
        font-size: 16px;
        line-height: 1.5em;
        text-align: left;
      }
      p.sub {
        font-size: 12px;
      }
      p.center {
        text-align: center;
      }
      /* Buttons ------------------------------ */
      /* .button {
        display: inline-block;
        width: 200px;
        background-color: #414EF9;
        border-radius: 3px;
        color: #ffffff;
        font-size: 15px;
        line-height: 45px;
        text-align: center;
        text-decoration: none;
        -webkit-text-size-adjust: none;
        mso-hide: all;
      }
      .button--green {
        background-color: #28DB67;
      }
      .button--red {
        background-color: #FF3665;
      }
      .button--blue {
        background-color: #414EF9;
      } */
      /*Media Queries ------------------------------ */
      @media only screen and (max-width: 600px) {
        .email-body_inner,
        .email-footer {
          width: 100% !important;
        }
      }
      @media only screen and (max-width: 500px) {
        .button {
          width: 100% !important;
        }
      }
</style>
</head>
<body>
  <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">
        <table class="email-content" width="100%" cellpadding="0" cellspacing="0">
          <!-- Logo -->
          <tr>
            <td class="email-masthead">
              <a class="email-masthead_name">{{config('app.name')}}</a>
            </td>
          </tr>
          <!-- Email Body -->
          <tr>
            <td class="email-body" width="100%">
              <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0">
                <!-- Body content -->
                <tr>
                  <td class="content-cell">
                    <h1>Verifikasi Email</h1>
                    <p>Hello! Selamat datang {{$user['nama_lengkap']}} di perusahaan .......</p>
                    <p>Silahkan lakukan verifikasi email agar Kamu dapat mengakses aplikasi pelaporan instalasi menggunakan email {{$user['email']}}</p>
                    <!-- Action -->
                    <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td align="center">
                          <div>
                            <a href="{{url('user/verify', $user->verifikasiTeknisi->token)}}" class="myButton">Verify Email</a>
                          </div>
                        </td>
                      </tr>
                    </table>
                    <p>Salam hangat,<br>{{config('app.name')}}</p>
                    <!-- Sub copy -->
                    <table class="body-sub">
                      <tr>
                        <td>
                          <p class="sub">Jika kamu memiliki masalah dengan tombol Verifikasi Email, kamu dapat mengcopy paste url berikut di browser kamu.
                          </p>
                          <p class="sub"><a href="{{url('user/verify', $user->verifikasiTeknisi->token)}}">{{url('user/verify', $user->verifikasiTeknisi->token)}}</a></p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
          <tr>
            <td>
              <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-cell">
                    <p class="sub center">
                      CV.Nakula Sadewa
                      <br>Jl. Candi Waringin, Malang
                    </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>