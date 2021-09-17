<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\tambahBarangBaruRequest;
use App\Model\Kategori_Barang;
use App\Model\Barang;
use App\Model\Dokumentasi_barang;
use App\Model\Sales;
use App\Model\Merk_Barang;
use App\Model\Transaksi;
use Illuminate\Support\Carbon;
use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\AddMerkRequest;
use App\Repository\BarangRepositoryInterface;
use App\Repository\MerkBarangRepositoryInterface;
use App\Repository\DokumentasiBarangRepositoryInterface;



class ManajemenBarangController extends Controller
{

    private $barangRepository;
    private $merkBarangRepository;
    private $dokumentasiBarangRepository;
    public function __construct(BarangRepositoryInterface $barangRepository, MerkBarangRepositoryInterface $merkBarangRepository, DokumentasiBarangRepositoryInterface $dokumentasiBarangRepository)
    {
        $this->barangRepository = $barangRepository;
        $this->merkBarangRepository = $merkBarangRepository;
        $this->dokumentasiBarangRepository = $dokumentasiBarangRepository;
    }
    //halaman kategori dan merk barang
    public function showKategori()
    {
        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.kategoriBarang');
        } else {
            return view('pages.kasir.kategoriDanMerkBarang');
        }
    }

    public function listKategori()
    {
        $data = Kategori_Barang::orderBy('nama_kategori')->get();
        return $data;
    }

    public function listMerkBarang()
    {
        $data = Merk_Barang::orderBy('nama_merk')->get();
        return $data;
    }

    public function addKategori(AddCategoryRequest $request)
    {

        Kategori_Barang::create([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return redirect()->back()->with('success', 'Kategori Baru telah berhasil ditambah');
    }

    public function addMerkBarang(AddMerkRequest $request)
    {

        Merk_Barang::create([
            'nama_merk' => $request->nama_merk,
        ]);
        return redirect()->back()->with('success', 'Merk Baru telah berhasil ditambah');
    }

    public function deleteKategori(Request $request)
    {
        Kategori_Barang::where('id_kategori', $request->id_kategori)->delete();
        return response()->json([
            'status' => true,
            'data' => 'Kategori berhasil dihapus!!!',
        ]);
    }

    public function deleteMerkBarang(Request $request)
    {
        Merk_Barang::where('id_merk', $request->id_merk)->delete();
        return response()->json([
            'status' => true,
            'data' => 'Merk berhasil dihapus!!!',
        ]);
    }

    public function updateKategori(AddCategoryRequest $request)
    {
        Kategori_Barang::where('id_kategori', $request->id_kategori)->update([
            "nama_kategori" => $request->nama_kategori,
        ]);
        return redirect()->back()->with('success', 'Kategori telah berhasil diubah');;
    }

    public function updateMerkBarang(AddMerkRequest $request)
    {
        Merk_Barang::where('id_merk', $request->id_merk)->update([
            "nama_merk" => $request->nama_merk,
        ]);
        return redirect()->back()->with('success', 'Merk telah berhasil diubah');;
    }


    public function getTotalKategori()
    {
        $total_kategori = Kategori_Barang::all()->count();
        return $total_kategori;
    }

    public function deleteKategoriSuccess()
    {
        return redirect()->back()->with('success', 'Data telah berhasil dihapus');;
    }

    //halaman daftar barang
    public function showDaftarBarang()
    {
        $total_barang = $this->getTotalBarang();
        $total_kategori = $this->getTotalKategori();
        $merk_barang = $this->getTotalMerkBarang();
        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.daftarBarang', ['total_barang' => $total_barang, 'total_kategori' => $total_kategori, 'merk_barang' => $merk_barang]);
        } else {
            return view('pages.kasir.daftarBarangKasir', ['total_barang' => $total_barang, 'total_kategori' => $total_kategori, 'merk_barang' => $merk_barang]);
        }
    }

    public function formTambahBarang()
    {
        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.tambahBarang');
        } else {
            return view('pages.kasir.tambahBarangKasir');
        }
    }

    public function listBarang()
    {
        $data = Barang::select('nama_kategori', 'nama_merk', 'tipe_barang', 'nama_sales', 'jumlah', 'modal', 'jual', 'id_barang')
            ->join('kategori_barang', 'kategori_barang.id_kategori', '=', 'barang.kategori_id')
            ->join('sales', 'sales.id_sales', '=', 'barang.sales_id')
            ->join('merk_barang', 'merk_barang.id_merk', '=', 'barang.merk_id')
            ->orderBy('barang.created_at', 'DESC')
            ->get();
        foreach ($data as $row) {
            $docs = Dokumentasi_barang::select('nama_file')->where("barang_id", "=", $row->id_barang)->get();
            $row->picture_urls = $docs;
        }
        return $data;
    }

    public function deleteBarang(Request $request)
    {
        $barang = Dokumentasi_barang::select('nama_file')->where('barang_id', $request->id_barang)->get();
        foreach ($barang as $b) {
            Storage::disk('public')->delete('dokumentasi/foto/' . $b->nama_file);
        }
        Barang::where('id_barang', $request->id_barang)->delete();
        Dokumentasi_barang::where('barang_id', $request->id_barang)->delete();
        return response()->json([
            'status' => true,
            'data' => 'Barang berhasil dihapus',
        ]);
    }

    public function getTotalBarang()
    {
        $total_barang = Barang::sum('jumlah');
        return $total_barang;
    }

    public function getTotalMerkBarang()
    {
        $merk = Merk_Barang::all()->count();
        return $merk;
    }


    //halaman form tambah barang
    public function getKategoriBarang()
    {
        $kategori_barang = Kategori_Barang::all();
        return response()->json([
            'status' => "success",
            'data' => $kategori_barang
        ]);
    }

    //halaman form tambah barang
    public function getMerkBarang()
    {
        $merk_barang = Merk_Barang::all();
        return response()->json([
            'status' => "success",
            'data' => $merk_barang
        ]);
    }

    public function getSales()
    {
        $sales = Sales::all();
        return response()->json([
            'status' => "success",
            'data' => $sales
        ]);
    }

    public function tambahBarang(tambahBarangBaruRequest $request)
    {
        if ($request->hasFile('images')) {
            $images_dir = array();
            // $barang  = new Barang();
            // $barang->merk_id = $request->merk;
            // $barang->tipe_barang = $request->tipe_barang;
            // $barang->jumlah = $request->jumlah;
            // $barang->modal = $request->modal;
            // $barang->jual = $request->jual;
            // $barang->sales_id = $request->nama_sales;
            // $barang->keterangan_barang = $request->keterangan_barang;
            // $barang->kategori_id = $request->kategori_barang;
            // $barang->save();
            $barang = $this->barangRepository->create(['merk_id' => $request->merk, 'tipe_barang' => $request->tipe_barang, 'jumlah' => $request->jumlah, 'modal' => $request->modal, 'jual' => $request->jual, 'sales_id' => $request->nama_sales, 'keterangan_barang' => $request->keterangan_barang, 'kategori_id' => $request->kategori_barang]);
            if (count($request->images) > 5) {
                return response()->json([
                    'success' => false,
                    'data' => 'Jumlah foto maksimal 5'
                ]);
            }
            foreach ($request->file('images') as $image) {
                $photo = $image;
                $rand = substr(uniqid('', true), -5);
                // $dataMerk = Merk_Barang::where('id_merk', '=', $barang->merk_id)->first();
                $dataMerk = $this->merkBarangRepository->find($barang->merk_id);
                $merk = preg_replace('/\s+/', '_', $dataMerk->nama_merk);
                $tipe = preg_replace('/\s+/', '_', $barang->tipe_barang);
                $new_name = 'foto_' . $merk . '_' . 'tipe_' . $tipe . '_' . $rand . '.' . $photo->getClientOriginalExtension();
                $directory = 'dokumentasi/foto' . '/' . $new_name;
                Storage::disk('public')->put($directory, File::get($photo));
                // Dokumentasi_barang::create([
                //     'nama_file' => $new_name,
                //     'barang_id' => $barang->id_barang
                // ]);
                $this->dokumentasiBarangRepository->create(['nama_file' => $new_name, 'barang_id' => $barang->id_barang]);

                array_push($images_dir, $directory);
            }

            if (auth()->user()->hasAdminRole()) {
                return redirect()->route('showDaftarBarang')->with('success', 'Barang Baru berhasil ditambah');
                return response()->json([
                    'success' => true,
                    'data' => "succes",
                    'directory' => $images_dir
                ]);
            } else {
                return redirect()->route('showDaftarBarangKasir')->with('success', 'Barang Baru berhasil ditambah');
                return response()->json([
                    'success' => true,
                    'data' => "succes",
                    'directory' => $images_dir
                ]);
            }
        }
        // baru dibuat
        else {
            return redirect()->back()->with('errors', 'Foto barang tidak boleh kosong');
            return response()->json([
                'danger' => false,
                'data' => 'Harap masukkan foto'
            ]);
        }
    }

    public function indexDetailBarang(Request $request)
    {
        $data_barang = Barang::select('nama_kategori', 'nama_merk', 'tipe_barang', 'nama_sales', 'nama_perusahaan', 'jumlah', 'modal', 'jual', 'keterangan_barang', 'id_barang')
            ->join('kategori_barang', 'kategori_barang.id_kategori', '=', 'barang.kategori_id')
            ->join('sales', 'sales.id_sales', '=', 'barang.sales_id')
            ->join('merk_barang', 'merk_barang.id_merk', '=', 'barang.merk_id')->where('id_barang', $request->id_barang)->first();
        $dokumentasi = Dokumentasi_barang::where('barang_id', $request->id_barang)->get();
        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.detailBarang', compact('data_barang', 'dokumentasi'));
        } else {
            return view('pages.kasir.detailBarangKasir', compact('data_barang', 'dokumentasi'));
        }
    }

    public function listFotoBarang(Request $request)
    {
        $dokumentasi = Dokumentasi_barang::where('barang_id', $request->id_barang)->get();
        return $dokumentasi;
    }


    public function getImage(Request $request)
    {
        $directory = storage_path('app\public\dokumentasi\foto\\' . $request->nama_file);
        $file = File::get($directory);
        $type = File::mimeType($directory);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function deleteBarangSuccess()
    {
        return redirect()->route('showDaftarBarang')->with('success', 'Barang telah berhasil dihapus');
    }

    public function formEditBarang(Request $request)
    {
        $data_barang = Barang::select('nama_kategori', 'nama_merk', 'tipe_barang', 'nama_sales', 'jumlah', 'modal', 'jual', 'keterangan_barang', 'id_barang')
            ->join('kategori_barang', 'kategori_barang.id_kategori', '=', 'barang.kategori_id')
            ->join('sales', 'sales.id_sales', '=', 'barang.sales_id')
            ->join('merk_barang', 'merk_barang.id_merk', '=', 'barang.merk_id')->where('id_barang', $request->barang)->first();
        $data = Dokumentasi_barang::where('barang_id', $request->barang)->get();
        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.editBarang', compact('data_barang', 'data'));
        } else {
            return view('pages.kasir.editBarangKasir', compact('data_barang', 'data'));
        }
    }

    //action edit barang
    public function editBarang(Request $request)
    {
        //    dd($request);
        if (!empty($request->kategori_barang) && !empty($request->merk) && !empty($request->nama_sales)) {
            // echo "semua diubah";
            Barang::where('id_barang', $request->id_barang)->update([
                "merk_id" => $request->merk,
                "tipe_barang" => $request->tipe_barang,
                "jumlah" => $request->jumlah,
                "modal" => $request->modal,
                "jual" => $request->jual,
                "sales_id" => $request->nama_sales,
                "keterangan_barang" => $request->keterangan_barang,
                "kategori_id" => $request->kategori_barang
            ]);
        } elseif (!empty($request->kategori_barang) && !empty($request->merk)) {
            // echo "kategori dan merk yang diubah";
            // Barang::where('id_barang', $request->id_barang)->update([
            //     "merk_id" => $request->merk,
            //     "tipe_barang" => $request->tipe_barang,
            //     "jumlah" => $request->jumlah,
            //     "modal" => $request->modal,
            //     "jual" => $request->jual,
            //     "keterangan_barang" => $request->keterangan_barang,
            //     "kategori_id" => $request->kategori_barang
            // ]);
            $this->barangRepository->updateById($request->id_barang, [
                "merk_id" => $request->merk,
                "tipe_barang" => $request->tipe_barang,
                "jumlah" => $request->jumlah,
                "modal" => $request->modal,
                "jual" => $request->jual,
                "keterangan_barang" => $request->keterangan_barang,
                "kategori_id" => $request->kategori_barang
            ]);
        } elseif (!empty($request->kategori_barang) && !empty($request->nama_sales)) {
            // echo "kategori dan nama sales yang diubah";
            Barang::where('id_barang', $request->id_barang)->update([
                "tipe_barang" => $request->tipe_barang,
                "jumlah" => $request->jumlah,
                "modal" => $request->modal,
                "jual" => $request->jual,
                "sales_id" => $request->nama_sales,
                "keterangan_barang" => $request->keterangan_barang,
                "kategori_id" => $request->kategori_barang
            ]);
        } elseif (!empty($request->merk) && !empty($request->nama_sales)) {
            // echo "merk dan nama sales yang diubah";
            Barang::where('id_barang', $request->id_barang)->update([
                "merk_id" => $request->merk,
                "tipe_barang" => $request->tipe_barang,
                "jumlah" => $request->jumlah,
                "modal" => $request->modal,
                "jual" => $request->jual,
                "sales_id" => $request->nama_sales,
                "keterangan_barang" => $request->keterangan_barang,
            ]);
        } elseif (!empty($request->kategori_barang)) {
            // echo "hanya kategori yang diubah";
            Barang::where('id_barang', $request->id_barang)->update([
                "tipe_barang" => $request->tipe_barang,
                "jumlah" => $request->jumlah,
                "modal" => $request->modal,
                "jual" => $request->jual,
                "keterangan_barang" => $request->keterangan_barang,
                "kategori_id" => $request->kategori_barang
            ]);
        } elseif (!empty($request->merk)) {
            // echo "hanya merk yang diubah";
            Barang::where('id_barang', $request->id_barang)->update([
                "merk_id" => $request->merk,
                "tipe_barang" => $request->tipe_barang,
                "jumlah" => $request->jumlah,
                "modal" => $request->modal,
                "jual" => $request->jual,
                "keterangan_barang" => $request->keterangan_barang,
            ]);
        } elseif (!empty($request->nama_sales)) {
            // echo "hanya sales yang diubah";
            Barang::where('id_barang', $request->id_barang)->update([
                "tipe_barang" => $request->tipe_barang,
                "jumlah" => $request->jumlah,
                "modal" => $request->modal,
                "jual" => $request->jual,
                "sales_id" => $request->nama_sales,
                "keterangan_barang" => $request->keterangan_barang,
            ]);
        } else {
            // echo "semua kosong, merk kosong, kategori kosong dan sales kosong";
            Barang::where('id_barang', $request->id_barang)->update([
                "tipe_barang" => $request->tipe_barang,
                "jumlah" => $request->jumlah,
                "modal" => $request->modal,
                "jual" => $request->jual,
                "keterangan_barang" => $request->keterangan_barang,
            ]);
        }
        // buat masukin foto yang baru
        if ($request->hasFile('images')) {
            $images_dir = array();
            if (count($request->images) > 5) {
                return response()->json([
                    'success' => false,
                    'data' => 'Jumlah foto maksimal 5'
                ]);
            }
            // untuk mencari data foto yang lama
            $barang = Dokumentasi_barang::select('nama_file')->where('barang_id', $request->id_barang)->get();
            // untuk hapus foto pada directory
            foreach ($barang as $b) {
                Storage::disk('public')->delete('dokumentasi/foto/' . $b->nama_file);
            }
            // untuk hapus foto pada db lama
            Dokumentasi_barang::where('barang_id', $request->id_barang)->delete();
            foreach ($request->file('images') as $image) {
                $photo = $image;
                $rand = substr(uniqid('', true), -5);
                $dataMerk = Barang::select('nama_merk', 'tipe_barang')->join('merk_barang', 'merk_barang.id_merk', '=', 'barang.merk_id')
                    ->where('id_barang', '=', $request->id_barang)->first();
                $merk = preg_replace('/\s+/', '_', $dataMerk->nama_merk);
                $tipe = preg_replace('/\s+/', '_', $dataMerk->tipe_barang);
                $new_name = 'foto_' . $merk . '_' . 'tipe_' . $tipe . '_' . $rand . '.' . $photo->getClientOriginalExtension();
                $directory = 'dokumentasi/foto' . '/' . $new_name;
                Storage::disk('public')->put($directory, File::get($photo));
                Dokumentasi_barang::create([
                    'nama_file' => $new_name,
                    'barang_id' => $request->id_barang
                ]);
                array_push($images_dir, $directory);
            }
            // ketika berhasil ke admin atau kekasir
            if (auth()->user()->hasAdminRole()) {
                return redirect()->route('showDaftarBarang')->with('success', 'Barang telah berhasil diubah');
                return response()->json([
                    'success' => true,
                    'data' => "succes",
                    'directory' => $images_dir
                ]);
            } else {
                return redirect()->route('showDaftarBarangKasir')->with('success', 'Barang telah berhasil diubah');
                return response()->json([
                    'success' => true,
                    'data' => "succes",
                    'directory' => $images_dir
                ]);
            }
        }
        // jika gambar tidak ada maka simpan data saja 
        else {
            if (auth()->user()->hasAdminRole()) {
                return redirect()->route('showDaftarBarang')->with('success', 'Barang telah berhasil diubah');
                return response()->json([
                    'success' => true,
                    'data' => "succes"
                ]);
            } else {
                return redirect()->route('showDaftarBarangKasir')->with('success', 'Barang telah berhasil diubah');
                return response()->json([
                    'success' => true,
                    'data' => "succes"
                ]);
            }
        }
    }


    public function ShowlihatGaransi()
    {
        return view('pages.admin.lihatInfoGaransiAdmin');
    }

    public function ShowlihatGaransiHasil(Request $request)
    {
        $data = Transaksi::select('no_invoice', 'id_transaksi', 'nama_pelanggan', 'alamat_pembeli', 'tanggal_pembelian', 'no_telepon_pembeli', 'total_pembelian')->where('no_invoice', $request->no_invoice)->get();
        if (sizeof($data) == 0) {
            return redirect()->back()->with('errors', 'Maaf, Data tidak ditemukan, silahkan masukkan dengan benar !!');
        } else {
            foreach ($data as $datas) {
                $invoice = $datas->no_invoice;
                $id = $datas->id_transaksi;
                $nama = $datas->nama_pelanggan;
                $alamat = $datas->alamat_pembeli;
                $tanggal = Carbon::parse($datas->tanggal_pembelian)->isoFormat('DD-MM-YYYY');
                $telepon = $datas->no_telepon_pembeli;
                $total_beli = $datas->total_pembelian;
            }
            return view('pages.admin.lihatInfoGaransiAdminHasil', compact('invoice', 'id', 'nama', 'alamat', 'tanggal', 'telepon', 'total_beli'));
        }
    }

    // coba ubah lang, where nya jangan pake id, tapi pakai no invoice aja
    public function dataTabelGaransi(Request $request)
    {

        $now = Carbon::now()->isoFormat('YYYY-MM-DD');
        $data = Transaksi::select('no_invoice', 'kategori_barang', 'merk_barang_beli', 'tipe_barang_beli',  'jumlah_barang_beli', 'batas_garansi')
            ->join('orders', 'transaksi_id', '=', 'id_transaksi')
            ->where('id_transaksi', '=', $request->id)->get();

        foreach ($data as $row) {
            $batas_garansi = Carbon::parse($row->batas_garansi)->isoFormat('YYYY-MM-DD');
            if ($batas_garansi < $now) {
                $row->status = "Diluar Masa Garansi";
            } else {
                $row->status = "Dalam Masa Garansi";
            }
        }
        return $data;
    }


    public function ShowlihatGaransiUser()
    {
        return view('pages.lihatInfoGaransiUser');
    }

    public function cekInvoice(Request $request)
    {
        $data = Transaksi::where('no_invoice', $request->no_invoice)->get();
        if (sizeof($data) == 0) {
            return redirect()->back()->with('errors', 'Data tidak ditemukan');
        } else {
        }
    }

    public function ShowlihatGaransiUserHasil(Request $request)
    {


        $data = Transaksi::select('no_invoice', 'id_transaksi', 'nama_pelanggan', 'alamat_pembeli', 'tanggal_pembelian', 'no_telepon_pembeli', 'total_pembelian')->where('no_invoice', $request->no_invoice)->get();
        if (sizeof($data) == 0) {
            return redirect()->back()->with('errors', 'Maaf, Data tidak ditemukan, silahkan masukkan dengan benar !!');
        } else {
            foreach ($data as $datas) {
                $invoice = $datas->no_invoice;
                $id = $datas->id_transaksi;
                $nama = $datas->nama_pelanggan;
                $alamat = $datas->alamat_pembeli;
                $tanggal = Carbon::parse($datas->tanggal_pembelian)->isoFormat('DD-MM-YYYY');
                $telepon = $datas->no_telepon_pembeli;
                $total_beli = $datas->total_pembelian;
            }

            return view('pages.lihatInfoGaransiUserHasil', compact('invoice', 'id', 'nama', 'alamat', 'tanggal', 'telepon', 'total_beli'));
        }
    }

    public function dataTabelGaransiUser(Request $request)
    {

        $now = Carbon::now()->isoFormat('YYYY-MM-DD');
        $data = Transaksi::select('no_invoice', 'kategori_barang', 'merk_barang_beli', 'tipe_barang_beli',  'jumlah_barang_beli', 'batas_garansi')
            ->join('orders', 'transaksi_id', '=', 'id_transaksi')
            ->where('id_transaksi', '=', $request->id)->get();

        foreach ($data as $row) {
            $batas_garansi = Carbon::parse($row->batas_garansi)->isoFormat('YYYY-MM-DD');
            if ($batas_garansi < $now) {
                $row->status = "Diluar Masa Garansi";
            } else {
                $row->status = "Dalam Masa Garansi";
            }
        }
        return $data;
    }

    public function getInvoice(Request $request)
    {
        $data = Transaksi::select('no_invoice')->get();
        return response()->json([
            'status' => "success",
            'data' => $data
        ]);
    }


    // ===================================== buat kasir ==================================================================================================================

    //history transaksi
    public function showInfoGaransiKasir()
    {
        return view('pages.kasir.lihatInfoGaransiKasir');
    }

    public function ShowlihatGaransiKasirHasil(Request $request)
    {
        $data = Transaksi::select('no_invoice', 'id_transaksi', 'nama_pelanggan', 'alamat_pembeli', 'tanggal_pembelian', 'no_telepon_pembeli', 'total_pembelian')->where('no_invoice', $request->no_invoice)->get();
        if (sizeof($data) == 0) {
            return redirect()->back()->with('errors', 'Maaf, Data tidak ditemukan, silahkan masukkan dengan benar !!');
        } else {
            foreach ($data as $datas) {
                $invoice = $datas->no_invoice;
                $id = $datas->id_transaksi;
                $nama = $datas->nama_pelanggan;
                $alamat = $datas->alamat_pembeli;
                $tanggal = Carbon::parse($datas->tanggal_pembelian)->isoFormat('DD-MM-YYYY');
                $telepon = $datas->no_telepon_pembeli;
                $total_beli = $datas->total_pembelian;
            }
            return view('pages.kasir.lihatInfoGaransiKasirHasil', compact('invoice', 'id', 'nama', 'alamat', 'tanggal', 'telepon', 'total_beli'));
        }
    }



    public function coba()
    {
        $dataMerk = Barang::select('nama_merk', 'tipe_barang')->join('merk_barang', 'merk_barang.id_merk', '=', 'barang.merk_id')
            ->where('id_barang', '=', 36)->first();

        $replace = preg_replace('/\s+/', '_', $dataMerk->tipe_barang);
        return $replace;
    }
}
