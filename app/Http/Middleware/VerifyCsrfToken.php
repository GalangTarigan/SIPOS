<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        // '/login',
        // '/admin/instansi/tambah-instansi/',
        // '/admin/manajemen/kategori/addNew',
        // '/laporan-instalasi/buat-baru',
        // '/laporan-instalasi-baru',
        // '/laporan-berkala/buat',
        // '/laporan-berkala',
        // '/laporan-training',
        // '/laporan-training/buat',
        // '/dokumentasi/foto/upload-foto',
        // '/dokumentasi/video/upload-video'
    ];
}
