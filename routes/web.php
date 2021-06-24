<?php
use Illuminate\Support\Facades\Route;

//Middleware auth routes;
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login'); 

// lihat info garansi

Route::get('/lihat-info-garansi-user', 'ManajemenBarangController@ShowlihatGaransiUser')->name('garansiUser');

Route::post('/lihat-info-garansi-user-hasil', 'ManajemenBarangController@ShowlihatGaransiUserHasil')->name('garansiUserHasil');
Route::get('/table-garansi-user', 'ManajemenBarangController@dataTabelGaransiUser'); //untuk data table

Route::get('/tutu', 'ManajemenBarangController@ShowlihatGaransiUserHasil');

//Middleware auth
Route::group([ 'middleware' => 'auth' ], function () {

        //buat kalau logout jadi balik ke route awal
        Route::get('/', function () {
            return redirect()->intended('login');
        });

        Route::get('/home', function () {
            return redirect()->intended('login');
        });
        
        


        //user profile routes
        Route::get('akun/profile', 'UserController@showProfile')->name('profile');
        Route::post('akun/profile/upload-image', 'UserController@uploadImageProfile')->name('uploadProfile');
        Route::get('akun/profile/get-userImage/', 'UserController@getUserImage')->name('getImgProfile');
        Route::get('/akun/notifikasi', 'UserController@allNotifications')->name('notifikasi');
        Route::post('post-ganti-password', 'UserController@gantiPassword')->name('postGantiPassword');

        //dokumentasi get
        Route::get('/dokumentasi/foto/get-foto/{nama_file}', 'ManajemenBarangController@getImage')->name('getImage');    
        Route::get('/dokumentasi/foto/get-foto-barang/{id_barang}', 'ManajemenBarangController@listFotoBarang');    
        Route::get('/dokumentasi/tagihan/get-foto/{nama_file}', 'SalesController@getImageTagihan')->name('getImageTagihan');    
        Route::get('/dokumentasi/bukti_transfer/get-foto/{nama_file}', 'SalesController@getImageTagihanLunas')->name('getImageTagihanLunas');    
        Route::get('/dokumentasi/barang_service/get-foto/{nama_file}', 'BarangServiceController@getImageBarangService')->name('getImageBarangService');    
         //unread notification routes
        Route::get('/unreadNotifications', 'UserController@unreadNotifications');
            

        // ini buat kasir
        //Middleware kasir routes prefix kasir eg kasir/....
         Route::group(['middleware'=> 'kasir', 'prefix'=>'kasir'], function(){
          
            Route::get('/home', function () {
                return redirect()->intended('dashboard-kasir');
            });
            Route::get('/dashboard-kasir', 'HomeController@indexOfDashboard')->name('dashboardKasir');
            Route::post('akun/logout', 'Auth\LoginController@logout')->name('logoutKasir');
            
            Route::get('akun/ganti-password', 'UserController@indexGantiPassword')->name('gantiPassword');

            // untuk lihat info garansi
            Route::get('/lihat-info-garansi-kasir', 'ManajemenBarangController@showInfoGaransiKasir')->name('showGaransikasir');
            Route::get('/get-all-invoice', 'ManajemenBarangController@getInvoice'); //untuk data select 2 lihat garansi
            Route::post('/lihat-info-garansi-kasir-hasil', 'ManajemenBarangController@ShowlihatGaransiKasirHasil')->name('showGaransiKasirHasil');
            Route::get('/table-garansi-kasir', 'ManajemenBarangController@dataTabelGaransi'); //untuk data table

            //profile
            Route::get('akun/profile', 'UserController@showProfile')->name('profileKasir');
            Route::get('akun/profile/get-userImage-kasir/', 'UserController@getUserImage')->name('getImgProfileKasir');
            Route::post('akun/profile/upload-image', 'UserController@uploadImageProfile')->name('uploadProfileKasir');
            Route::get('akun/profile/get-foto', 'UserController@getFoto');

            Route::post('/bar-stats-tahun', 'KeuanganController@barStatsTahun'); //menampilkan bar pertahun

            //transaksi penjualan--> kasir
            Route::get('/transaksi-penjualan-kasir/form-kasir', 'TransaksiPenjualanController@showFormKasir')->name('formKasir-kasir'); // menampilkan halaman form kasir    
            Route::post('/transaksi-penjualan-kasir/list-barang', 'TransaksiPenjualanController@listBarang');
            Route::post('/kasir-for-kasir', 'TransaksiPenjualanController@addOrders');
            Route::get('/transaksi-penjualan-kasir/daftar-transaksi-success', 'TransaksiPenjualanController@showHistoryTransaksiSuccess')->name('historyKasirSuccess'); // menampilkan halaman daftar history transaksi success    

            //transaksi penjualan--> history transaksi
            Route::get('/transaksi-penjualan-kasir/daftar-transaksi', 'TransaksiPenjualanController@showHistoryTransaksi')->name('historyKasir-kasir'); // menampilkan halaman daftar history transaksi    
            Route::post('/transaksi-penjualan-kasir/list-transaksi', 'TransaksiPenjualanController@dataHistoryTransaksi'); // menampilkan seluruh data history transaksi
            Route::post('/transaksi-penjualan-kasir/detail-transaksi/{id_transaksi}', 'TransaksiPenjualanController@detailHistoryTransaksi'); // menampilkan detail history transaksi

            //manajemen barang--> halaman daftar barang
            Route::get('/manajemen-barang-kasir/show-daftar-barang', 'ManajemenBarangController@showDaftarBarang')->name('showDaftarBarangKasir'); //menampilkan halaman daftar barang
            Route::post('/manajemen-barang-kasir/list-barang', 'ManajemenBarangController@listBarang')->name('listBarang');
            Route::get('/manajemen-barang-kasir/form-tambah-barang', 'ManajemenBarangController@formTambahBarang')->name('formTambahBarangKasir'); //menampilkan halaman tambah barang
            Route::get('/manajemen-barang-kasir/getKategoriBarang', 'ManajemenBarangController@getKategoriBarang')->name('getKategoriBarang');
            Route::get('/manajemen-barang-kasir/get-merk-barang', 'ManajemenBarangController@getMerkBarang');
            Route::post('/manajemen-barang-kasir/tambahBarang', 'ManajemenBarangController@tambahBarang')->name('addBarangKasir');
            Route::get('/manajemen-barang-kasir/getSales', 'ManajemenBarangController@getSales')->name('getSales');
            Route::get('/manajemen-barang-kasir/detailBarang/{id_barang}', 'ManajemenBarangController@indexDetailBarang');
            Route::get('/manajemen-barang-kasir/formEditBarang', 'ManajemenBarangController@formEditBarang')->name('formEditBarangKasir');
            Route::post('/manajemen-barang-kasir/editBarang', 'ManajemenBarangController@editBarang')->name('editBarangKasir');
            Route::post('/manajemen-barang-kasir/delete_barang/{id_barang}','ManajemenBarangController@deleteBarang'); //function for delete kategori
            Route::get('/manajemen-barang-kasir/delete-barang-success', 'ManajemenBarangController@deleteBarangSuccess'); //menampilkan halaman daftar barang

            //Manajemen -> stock barang -> kategori dan merk barang
            Route::get('/manajemen-barang-kasir/show-kategori-barang', 'ManajemenBarangController@showKategori')->name('showKategoriKasir'); // menampilkan halaman kategori
            Route::post('/manajemen-barang-kasir/daftar-kategori-barang', 'ManajemenBarangController@listKategori');
            Route::post('/manajemen-barang-kasir/add-kategori','ManajemenBarangController@addKategori')->name('addKategoriKasir'); //function for add kategori
            Route::post('/manajemen-barang-kasir/delete/{id_kategori}','ManajemenBarangController@deleteKategori'); //function for delete kategori
            Route::post('/manajemen-barang-kasir/update', 'ManajemenBarangController@updateKategori')->name('updateKategoriKasir'); // function for update kategori
            Route::get('/manajemen-barang-kasir/delete-kategori-barang-success', 'ManajemenBarangController@deleteKategoriSuccess');
            
            // manajemen -> stock ->untuk merk
            Route::post('/manajemen-barang-kasir/data-merk-barang', 'ManajemenBarangController@listMerkBarang');
            Route::post('/manajemen-barang-kasir/add-merk-barang','ManajemenBarangController@addMerkBarang')->name('addMerkBarangKasir'); //function for add merk
            Route::post('/manajemen-barang-kasir/delete-merk/{id_merk}','ManajemenBarangController@deleteMerkBarang'); //function for delete merk
            Route::post('/manajemen-barang-kasir/update-merk-barang', 'ManajemenBarangController@updateMerkBarang')->name('updateMerkBarangKasir'); // function for update merk barang

            //Barang Service --> daftarBarangService
            Route::get('/barang-service-kasir/daftar-barang-service', 'BarangServiceController@showDaftarService')->name('showDaftarBarangService-kasir');
            Route::post('/barang-service-kasir/list-barang-service', 'BarangServiceController@getAllDataService');
            Route::get('/barang-service-kasir/edit-barang-service', 'BarangServiceController@showEditBarangService');
            Route::post('/barang-service-kasir/edit-barang-service', 'BarangServiceController@editBarangService')->name('editServiceKasir');
            Route::get('/barang-service-kasir/detail-barang-service', 'BarangServiceController@showDetailBarangService');
            Route::post('/barang-service-kasir/delete-barang-service', 'BarangServiceController@deleteCatatanService');
            Route::get('/barang-service-kasir/daftar-barang-service-success', 'BarangServiceController@showDaftarSuccess');

            //Barang Service --> tambahBarangService
            Route::get('/barang-service-kasir/form-tambah-barang-service', 'BarangServiceController@showTambahBarangService')->name('formAddBarangService-kasir');
            Route::post('/barang-service-kasir/add-barang-service', 'BarangServiceController@addBarangService')->name('addBarangService-kasir');

            //Barang Return --> daftar barang return
            Route::get('/barang-return-kasir/show-daftar-barang-return', 'BarangReturnController@indexBarangReturn')->name('showDaftarBarangReturn-kasir'); //menampilkan halaman daftar barang
            Route::post('/barang_return-kasir/list-barang-return', 'BarangReturnController@listBarangReturn')->name('listBarangReturn');
            Route::post('/barang_return-kasir/delete_barang_return','BarangReturnController@deleteBarangReturn'); //function for delete barang return            
            Route::get('/barang-return-kasir/formEditBarangReturn', 'BarangReturnController@showFormEditReturn')->name('showFormEditReturn-kasir');
            Route::post('/barang-return-kasir/editBarangReturn', 'BarangReturnController@editBarangReturn')->name('editBarangReturn-kasir');
            Route::get('/barang-return-kasir/delete-barang-return-success', 'BarangReturnController@deleteBarangReturnSuccess');

            //Barang Return --> tambah barang return
            Route::get('/barang-return-kasir/form-tambah-barang-return', 'BarangReturnController@indexTambahBarangReturn')->name('showTambahBarangReturn-kasir'); //menampilkan halaman form tambah barang return
            Route::get('/barang-return-kasir/getKategori', 'BarangReturnController@getKategoriBarang');
            Route::post('/barang-return-kasir/getDaftarMerk', 'BarangReturnController@getDaftarMerk');
            Route::post('/barang-return-kasir/getTipeBarang', 'BarangReturnController@getTipeBarang');
            Route::post('/barang-return-kasir/getMaxBarang', 'BarangReturnController@getMaxBarang');
            Route::post('/barang-return/addBarangReturn', 'BarangReturnController@addBarangReturn')->name('addBarangReturn-kasir');

            //pages pegawai            
            Route::get('/pegawai/daftar-pegawai','PegawaiController@showPegawai')->name('showPegawaiKasir'); //show pages daftar pegawai
            Route::post('/pegawai/list-pegawai','PegawaiController@listPegawai'); //menampilkan seluruh pegawai
            

            //Statistik Penjualan
            Route::get('/statistik-penjualan-kasir', 'KeuanganController@showStatistik')->name('statistikPenjualan-kasir'); //menampilkan halaman statistik penjualan
            Route::post('/bar-stats-tahun', 'KeuanganController@barStatsTahun'); //menampilkan bar pertahun
            Route::post('/bar-stats-hari', 'KeuanganController@barStatsHari'); //menampilkan bar perhari


            route::get('/coba_aja', 'ManajemenBarangController@coba');
                
        });




       





        // ini buat admin
        //Middleware admin routes prefix admin eg admin/....
        Route::group(['middleware'=>'admin', 'prefix'=>'admin'], function(){
               
                Route::get('/home', 'HomeController@indexOfDashboard')->name('home');
                Route::get('/dashboard', 'HomeController@indexOfDashboard')->name('dashboardAdmin');
                Route::get('/dashboard/data', 'HomeController@getYearData');
                Route::post('akun/logout', 'Auth\LoginController@logout')->name('logoutAdmin');
                Route::get('akun/profile', 'UserController@showProfile')->name('profileAdmin');
                Route::get('akun/profile/get-userImage/', 'UserController@getUserImage')->name('getImgProfileAdmin');
                Route::get('akun/profile/get-foto', 'UserController@getFoto');
                Route::get('akun/notifikasi', 'UserController@allNotifications')->name('notifikasiAdmin');
                Route::get('akun/ganti-password-admin', 'UserController@indexGantiPassword')->name('gantiPasswordAdmin');

                //transaksi penjualan--> kasir penjualan
                Route::get('/transaksi-penjualan/form-kasir', 'TransaksiPenjualanController@showFormKasir')->name('formKasir'); // menampilkan halaman form kasir    
                Route::get('/transaksi-penjualan/coba-kasir', 'TransaksiPenjualanController@testFormKasir'); // menampilkan halaman form kasir    
                Route::post('/transaksi-penjualan/list-barang', 'TransaksiPenjualanController@listBarang');
                Route::post('/kasir', 'TransaksiPenjualanController@addOrders');
                
                //transaksi penjualan--> history transaksi
                Route::get('/transaksi-penjualan/daftar-transaksi', 'TransaksiPenjualanController@showHistoryTransaksi')->name('historyKasir'); // menampilkan halaman daftar history transaksi    
                Route::get('/transaksi-penjualan/daftar-transaksi-success', 'TransaksiPenjualanController@showHistoryTransaksiSuccess')->name('historyKasirSuccess'); // menampilkan halaman daftar history transaksi success    
                Route::post('/transaksi-penjualan/list-transaksi', 'TransaksiPenjualanController@dataHistoryTransaksi'); // menampilkan seluruh data history transaksi
                Route::post('/transaksi-penjualan/detail-transaksi/{id_transaksi}', 'TransaksiPenjualanController@detailHistoryTransaksi'); // menampilkan detail history transaksi


                //manajemen barang--> halaman kategori
                Route::get('/manajemen-barang/show-kategori-barang', 'ManajemenBarangController@showKategori')->name('showKategori'); // menampilkan halaman kategori
                Route::post('/manajemen-barang/daftar-kategori','ManajemenBarangController@listKategori')->name('listKategori'); //function for show daftar kategori
                Route::post('/manajemen-barang/add-kategori','ManajemenBarangController@addKategori')->name('addKategori'); //function for add kategori
                Route::post('/manajemen-barang/delete/{id_kategori}','ManajemenBarangController@deleteKategori'); //function for delete kategori
                Route::post('/manajemen-barang/update', 'ManajemenBarangController@updateKategori')->name('updateKategori'); // function for update kategori
                Route::get('/manajemen-barang/delete-kategori-barang-success', 'ManajemenBarangController@deleteKategoriSuccess');
                
                // manajemen barang -->untuk merk
                Route::post('/manajemen-barang/data-merk-barang', 'ManajemenBarangController@listMerkBarang');
                Route::post('/manajemen-barang/add-merk-barang','ManajemenBarangController@addMerkBarang')->name('addMerkBarang'); //function for add merk
                Route::post('/manajemen-barang/delete-merk/{id_merk}','ManajemenBarangController@deleteMerkBarang'); //function for delete merk
                Route::post('/manajemen-barang/update-merk-barang', 'ManajemenBarangController@updateMerkBarang')->name('updateMerkBarang'); // function for update merk barang



                //manajemen barang--> halaman daftar barang
                Route::get('/manajemen-barang/show-daftar-barang', 'ManajemenBarangController@showDaftarBarang')->name('showDaftarBarang'); //menampilkan halaman daftar barang
                Route::post('/manajemen-barang/list-barang', 'ManajemenBarangController@listBarang')->name('listBarang');
                Route::get('/manajemen-barang/form-tambah-barang', 'ManajemenBarangController@formTambahBarang')->name('formTambahBarang'); //menampilkan halaman tambah barang
                Route::get('/manajemen-barang/getKategoriBarang', 'ManajemenBarangController@getKategoriBarang')->name('getKategoriBarang');
                Route::get('/manajemen-barang/get-merk-barang', 'ManajemenBarangController@getMerkBarang');
                Route::post('/manajemen-barang/tambahBarang', 'ManajemenBarangController@tambahBarang')->name('addBarang');
                Route::post('/manajemen-barang/delete_barang/{id_barang}','ManajemenBarangController@deleteBarang'); //function for delete kategori
                Route::get('/manajemen-barang/getSales', 'ManajemenBarangController@getSales')->name('getSales');
                Route::get('/manajemen-barang/detailBarang/{id_barang}', 'ManajemenBarangController@indexDetailBarang')->name('detailBarang');
                Route::get('/manajemen-barang/formEditBarang', 'ManajemenBarangController@formEditBarang')->name('formEditBarang');
                Route::post('/manajemen-barang/editBarang', 'ManajemenBarangController@editBarang')->name('editBarang');
                Route::get('/manajemen-barang/delete-barang-success', 'ManajemenBarangController@deleteBarangSuccess'); //menampilkan halaman daftar barang

                //Barang Service --> tambahBarangService
                Route::get('/barang-service/form-tambah-barang-service', 'BarangServiceController@showTambahBarangService')->name('formAddBarangService');
                Route::post('/barang-service/add-barang-service', 'BarangServiceController@addBarangService')->name('addBarangService');

                //Barang Service --> daftarBarangService
                Route::get('/barang-service/daftar-barang-service', 'BarangServiceController@showDaftarService')->name('showDaftarBarangService');
                Route::post('/barang-service/list-barang-service', 'BarangServiceController@getAllDataService');
                Route::get('/barang-service/edit-barang-service', 'BarangServiceController@showEditBarangService');
                Route::post('/barang-service/edit-barang-service', 'BarangServiceController@editBarangService')->name('editService');
                Route::get('/barang-service/detail-barang-service', 'BarangServiceController@showDetailBarangService');
                Route::post('/barang-service/delete-barang-service', 'BarangServiceController@deleteCatatanService');
                Route::get('/barang-service/daftar-barang-service-success', 'BarangServiceController@showDaftarSuccess');


                //Barang Return
                Route::get('/barang-return/show-daftar-barang-return', 'BarangReturnController@indexBarangReturn')->name('showDaftarBarangReturn'); //menampilkan halaman daftar barang
                Route::post('/barang_return/list-barang-return', 'BarangReturnController@listBarangReturn')->name('listBarangReturn');
                Route::post('/barang_return/delete_barang_return','BarangReturnController@deleteBarangReturn'); //function for delete barang return
                Route::get('/barang-return/form-tambah-barang-return', 'BarangReturnController@indexTambahBarangReturn')->name('showTambahBarangReturn'); //menampilkan halaman form tambah barang return
                Route::get('/barang-return/getKategori', 'BarangReturnController@getKategoriBarang');
                Route::post('/barang-return/getDaftarMerk', 'BarangReturnController@getDaftarMerk');
                Route::post('/barang-return/getTipeBarang', 'BarangReturnController@getTipeBarang');
                Route::post('/barang-return/getMaxBarang', 'BarangReturnController@getMaxBarang');
                Route::post('/barang-return/addBarangReturn', 'BarangReturnController@addBarangReturn')->name('addBarangReturn');
                Route::get('/barang-return/formEditBarangReturn', 'BarangReturnController@showFormEditReturn')->name('showFormEditReturn');
                Route::post('/barang-return/editBarangReturn', 'BarangReturnController@editBarangReturn')->name('editBarangReturn');
                Route::get('/barang-return/delete-barang-return-success', 'BarangReturnController@deleteBarangReturnSuccess');


                //Keuangan --> Laporan Penjualan
                Route::get('/keuangan/laporan-penjualan-filter', 'KeuanganController@showLaporanPenjualanFilter')->name('laporanPenjualanFilter'); //menampilkan halaman laporan penjualan yang pertama (filter)
                Route::post('/keuangan/laporan-penjualan-hasil', 'KeuanganController@showLaporanPenjualanHasil')->name('laporanPenjualanHasil'); //menampilkan halaman laporan penjualan setelah difilter (hasil)
                Route::get('/keuangan/daftar-laporan-penjualan', 'KeuanganController@listLaporanPenjualan');

                //keuangan --> laporan laba rugi
                Route::get('/keuangan/laporan-laba-rugi-filter', 'KeuanganController@showLaporanLabaRugiFilter')->name('showlaporanLabaRugi'); //menampilkan halaman laporan laba rugi yang pertama (filter)
                Route::post('/keuangan/laporan-laba-rugi-hasil', 'KeuanganController@showLaporanLabaRugiHasil')->name('LaporanLabaRugiHasil');
                Route::post('/keuangan/list-laba-rugi', 'KeuanganController@listDataLabaRugi');
                
                //Keuangan --> transaksi pengeluaran //Laporan Pengeluaran
                Route::get('/keuangan/laporan-pengeluaran-filter', 'KeuanganController@showLaporanPengeluaranFilter')->name('LaporanPengeluaranFilter'); //menampilkan halaman laporan pengeluaran pertama (filter)
                Route::post('/keuangan/laporan-pengeluaran-hasil', 'KeuanganController@showLaporanPengeluaranHasil')->name('LaporanPengeluaranHasil'); //menampilkan halaman daftar transaksi keluar
                Route::post('/keuangan/list-transaksi-pengeluaran', 'KeuanganController@listTransaksiKeluar');

                //keuangan --> transaksi pengeluaran // tambah transaksi keluar
                Route::get('/keuangan/form-transaksi-pengeluaran', 'KeuanganController@showFormTambahTransaksiKeluar')->name('showFormTambahTransaksiKeluar'); //menampilkan halaman untuk menambah transaksi keluar
                Route::post('/keuangan/add-transaksi-pengeluaran', 'KeuanganController@addTransaksiKeluar')->name('addTransaksiKeluar'); //untuk transaksi keluar

                //keuangan --> transaksi pengeluaran //untuk bayar tagihan sales versi keuangan 
                Route::get('/keuangan/cari-tagihan-sales', 'SalesController@showCariTagihanSales')->name('showCariTagihanSales'); //menampilkan halaman untuk filter tagihan sales
                Route::post('/keuangan/daftar-tagihan-belum-lunas', 'SalesController@listSeluruhTagihanSales');
                Route::get('/keuangan/daftar-sales-belum-lunas', 'SalesController@salesTagihanBelumLunas');
                Route::post('/keuangan/daftar-no-faktur', 'SalesController@getDaftarNoFaktur');
                Route::post('/keuangan/edit-status-tagihan-sales', 'SalesController@showDetailTagihanSales')->name('showDetailTagihanSales');

                //Manajemen sales--> halaman daftar sales
                Route::get('/manajemen-sales/show-daftar-sales', 'SalesController@showSales')->name('showSales'); //menampilkan halaman daftar sales
                Route::post('/manajemen-sales/list-sales', 'SalesController@listSales')->name('listSales'); //menampilkan isi dari tabel daftar s
                Route::get('/manajemen-sales/form-tambah-sales', 'SalesController@formAddSales')->name('formAddSales'); //menampilkan halaman daftar sales
                Route::post('/manajemen-sales/tambah-sales', 'SalesController@addSales')->name('addSales'); //menambahkan sales ke dB
                Route::post('/manajemen-sales/delete/{id_sales}', 'SalesController@deleteSales')->name('deleteSales'); //menghapus sales
                Route::get('/manajemen-sales/form-edit-sales/{id_sales}', 'SalesController@formEditSales')->name('formEditSales'); //menampilkan form edit sales
                Route::post('/manajemen-sales/edit_sales/{id_sales}', 'SalesController@editSales')->name('editSales'); //edit sales
                Route::get('/manajemen-sales/detail-sales', 'SalesController@showDetailSales')->name('showDetailSales'); //halaman detail sales
                
                Route::post('/manajemen-sales/data-tabel-detail', 'SalesController@dataTabelDetailSales');

                Route::get('/manajemen-sales/detail-tagihan-sales', 'SalesController@showDetailTagihan');
                Route::get('/manajemen-sales/edit-status-tagihan-sales', 'SalesController@showFormEditStatusTagihan');
                Route::post('/manajemen-sales/lala', 'SalesController@editTagihanStatus')->name('editStatusTagihan');
                Route::get('/manajemen-sales/daftar-tagihan-lunas', 'SalesController@showDaftarTagihanLunas')->name('showDaftarTagihanLunas');
                Route::post('/manajemen-sales/data-tagihan-lunas', 'SalesController@dataTabelTagihanLunas');
                Route::get('/manajemen-sales/detail-tagihan-lunas', 'SalesController@showDetailTagihanLunas');
                Route::get('/manajemen-sales/delete-sales-success', 'SalesController@deleteSalesSuccess');
                // Route::get('/manajemen-sales/delete-sales-gagal', 'SalesController@deleteSalesGagal');

                //Manajemen sales--> halaman tambah tagihan sales
                Route::get('/manajemen-sales/form-add-tagihan-sales', 'SalesController@formTagihanSales')->name('formTambahTagihan'); //menampilkan form tambah tagihan sales
                Route::post('/manajemen-sales/daftar-perusahaan', 'SalesController@listPerusahaan');
                Route::post('/manajemen-sales/nama-sales', 'SalesController@getNamaSales');
                Route::post('/manajemen-sales/add-tagihan-sales', 'SalesController@tambahTagihanSales')->name('addTagihanSales');


                Route::post('/pegawai/edit-pegawai', 'PegawaiController@editPegawai')->name('EditPegawai');

                // Route::get('/manajemen-sales/form-edit-sales', 'SalesController@editSales')->name('editSales'); //menampilkan halaman daftar sales

                //pages pegawai
                Route::get('/pegawai/form-tambah-pegawai','PegawaiController@formAddPegawai')->name('formAddPegawai');//show form add pegawai
                Route::post('/pegawai/tambah-pegawai','PegawaiController@addPegawai')->name('addPegawai'); //show add teknisi pages
                Route::get('/pegawai/daftar-pegawai','PegawaiController@showPegawai')->name('showPegawai'); //show pages daftar pegawai
                Route::post('/pegawai/list-pegawai','PegawaiController@listPegawai')->name('listPegawai'); //menampilkan seluruh pegawai
                Route::get('/pegawai/list-pegawai-admin','PegawaiController@listPegawai')->name('listPegawai'); //menampilkan seluruh pegawai
                Route::post('/pegawai/delete/{id}','PegawaiController@deletePegawai'); //function for delete pegawai

                Route::get('/pegawai/list-pegawai/detail-edit-pegawai','PegawaiController@showEditPegawai')->name('showEditPegawai'); //pages detail teknisi

                Route::get('/pegawai/daftar-pegawai-success', 'PegawaiController@showPegawaiSuccess');
                Route::get('/pegawai/delete-pegawai-success', 'PegawaiController@deletePegawaiSuccess');
                Route::post('/pegawai/edit-pegawai', 'PegawaiController@editPegawai')->name('EditPegawai');
                Route::get('/pegawai/detail-pegawai-status-admin', 'PegawaiController@detailPegawaiStatusAdmin');

                

                //statistik Penjualan
                Route::get('/statistik-penjualan', 'KeuanganController@showStatistik')->name('statistikPenjualan'); //menampilkan halaman statistik penjualan
                Route::post('/bar-stats-tahun', 'KeuanganController@barStatsTahun'); //menampilkan bar pertahun
                Route::post('/bar-stats-hari', 'KeuanganController@barStatsHari'); //menampilkan bar perhari

                //lihat garansi
                Route::get('/lihat-info-garansi-admin', 'ManajemenBarangController@ShowlihatGaransi')->name('showGaranasiAdmin');
                Route::post('/lihat-info-garansi-admin-hasil', 'ManajemenBarangController@ShowlihatGaransiHasil')->name('showGaransiAdminHasil');
                Route::get('/table-garansi-admin', 'ManajemenBarangController@dataTabelGaransi'); //untuk data table
                Route::get('/get-all-invoice', 'ManajemenBarangController@getInvoice'); //untuk data select 2 lihat garansi
                


                //test controller
                Route::get('/test', 'ManajemenBarangController@coba')->name('coba');
                Route::get('/testis', 'SalesController@coba')->name('coba');

                Route::get('/testus', 'BarangReturnController@coba');
                

        });
    
        //print transaksi penjualan 
        Route::get('/print/transaksi-penjualan', 'TransaksiPenjualanController@printTransaksi')->name('printTransaksi');

        //print struk
        Route::get('/print/struk-service', 'BarangServiceController@printStrukService')->name('printStrukService');

        //print laporan penjualan
        Route::get('/print/laporan-penjualan', 'KeuanganController@pirntLaporanPenjualan')->name('printLaporanPenjualan');

        //print laporan laba rugi
        Route::get('/print/laporan-laba-rugi', 'KeuanganController@printLaporanLabaRugi');

        //print laporan pengeluaran
        Route::get('/print/laporan-pengeluaran', 'KeuanganController@printLaporanPengeluaran')->name('printLaporanPengeluaran');
        
        //logout routes
        Route::post('logout', 'Auth\LoginController@logout')->name('logout');
});
