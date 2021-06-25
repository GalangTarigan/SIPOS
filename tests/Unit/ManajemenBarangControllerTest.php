<?php

namespace Tests\Unit;

use App\Model\Barang;
use App\Model\Merk_Barang;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\User;
use Illuminate\Support\Facades\Storage;
use Mockery;

class ManajemenBarangControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     * Unit test ketika skenario tambah produk berhasil dan proses tsb dilakukan oleh admin
     * @return void
     */
    public function testJalur1()
    {
        // Event::fake();
        $file = UploadedFile::fake()->create('barang.jpg', 100, 100);
        //stub auth () -> hasAdminRole()
        $admin = User::find(1);
        //stub storage disk
        Storage::fake('public');
        //stub barang repository (barang model)
        $this->instance('App\Repository\BarangRepositoryInterface', Mockery::mock('App\Repository\BarangRepositoryInterface', function ($mock) {
            $barangDummy = new Barang();
            $barangDummy->id_barang = '46';
            $barangDummy->merk_id = '6';
            $barangDummy->tipe_barang = 'Sabeb';
            $mock->shouldReceive('create')->once()->andReturn($barangDummy);
        }));
        //stub merk barang repository (merk barang model)
        $this->instance('App\Repository\MerkBarangRepositoryInterface', Mockery::mock('App\Repository\MerkBarangRepositoryInterface', function ($mock) {
            $merkBarangDummy = new Merk_Barang();
            $merkBarangDummy->nama_merk = 'Sony';
            $mock->shouldReceive('find')->andReturn($merkBarangDummy);
        }));
        //stub dokumentasi barang repository (dokumentasi barang model)
        $this->instance('App\Repository\DokumentasiBarangRepositoryInterface', Mockery::mock('App\Repository\DokumentasiBarangRepositoryInterface', function ($mock) {
            $mock->shouldReceive('create');
        }));
        $this->be($admin);
        $reponse = $this->call('POST', '/admin/manajemen-barang/tambahBarang', [
            'merk'     =>     '1',
            'tipe_barang' => 'TV',
            'jumlah' => 1,
            'modal' => 1000000,
            'jual' => 1100000,
            'nama_sales' => '1',
            'keterangan_barang' => 'TV saya',
            'kategori_barang' => '1',
            'images' => [$file, $file]
        ])->assertRedirect('/admin/manajemen-barang/show-daftar-barang');
        //assert rediret diatas utk mengecek apakah ketika sukses diarahkan ke route tsb.
    }
}
