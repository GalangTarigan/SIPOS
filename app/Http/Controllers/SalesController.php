<?php

namespace App\Http\Controllers;
use App\Model\Barang;
use App\Model\Barang_Return;
use App\Model\Catatan_Laba_rugi;
use App\Model\Dokumentasi_Bukti_Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Sales;
use App\Model\Tagihan;
use App\Pkl\Traits\Convert;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Model\Dokumentasi_Tagihan;


class SalesController extends Controller{
    
    use Convert;
    //halaman daftar sales
    public function showSales(){
        return view('pages.admin.daftarSales');
    }

    public function listSales(Request $request){
        $sales = Sales::all();
        return $sales;
    }

    public function deleteSales(Request $request){
        // Sales::where('id_sales', '=', $request->id_sales)->delete();
        // return response()->json([
        //     'status' => true,
        //     'data' => 'Sales berhasil dihapus!!!',
        // ]);

        //cek ada tidak barang dari sales itu
        $data1 = Barang::select('keterangan_barang')->where('sales_id', '=', $request->id_sales)->first();

        //cek ada tidak barang return
        $data2 = Barang_Return::join('barang', 'barang.id_barang', '=', 'barang_return.barang_id')
        ->where('sales_id', '=', $request->id_sales)->first();
        
        //cek ada atau tidak tagihan sales
        $data3 = Tagihan::select('status_pembayaran')->where('status_pembayaran', '=', 'Belum Dibayar')
        ->where('sales_id', '=', $request->id_sales)->first();

        //cek ketika gagal dihapus
        if($data1 != null || $data2 != null || $data3 != null){
            return response()->json([
                'status' => false,
                'data' => 'Silahkan cek Daftar Tagihan Sales, Daftar Barang Baru atau Daftar Barang Return sales',
            ]);
        }else{
            Sales::where('id_sales', '=', $request->id_sales)->delete();
            return response()->json([
                'status' => true,
                'data' => 'Sales berhasil dihapus!!!',
            ]);
        }

    }

    
    public function deleteSalesSuccess(){
        return redirect()->route('showSales')->with('success', 'Sales telah berhasil dihapus');
    }

      
    // public function deleteSalesGagal(){
    //     return redirect()->route('showSales')->with('errors', 'Sales gagal dihapus, silahkan cek daftar tagihan sales, daftar barang dan daftar barang return sales');
    // }

    public function coba(){
        $data = Tagihan::select('status_pembayaran')
        ->where('status_pembayaran', '=', 'Belum Dibayar')
        ->where('sales_id', '=', 6)->first();
        if($data != null){
            // echo "data tagihan ada";
            return $data;
            
        }else{
            echo "data tagihan tidak ada";
            // return $data;
        }
        // return $data;
    }

    public function formEditSales(Request $request){
        $data_sales= Sales::where('id_sales', $request->id_sales)->first();
        return view('pages.admin.editSales', compact('data_sales'));
    }

    public function editSales(Request $request){
        Sales::where('id_sales', $request->id_sales)->update([
        "nama_perusahaan" => $request->nama_perusahaan,
        "nama_sales" => $request->nama_sales,
        "no_telepon" => $request->no_telepon,
        "alamat" => $request->alamat,
        "nama_no_rekening" => $request->nama_no_rekening,
        "product" => $request->product
        ]);
        return redirect()->route('showSales')->with('success', 'Data sales berhasil diubah');
        
    }

    //menampilkan halaman detail sales
    public function showDetailSales(Request $request){
        $data_sales = Sales::select('id_sales', 'nama_sales', 'no_telepon', 'nama_perusahaan', 'alamat', 'product', 'nama_no_rekening')
        ->where('id_sales', $request->data)->first();
        // return compact('data_sales');
        return view('pages.admin.detailSales', compact('data_sales'));
        
    }

    public function dataTabelDetailSales(Request $request){
        $data = Tagihan::select('id_tagihan', 'nama_sales', 'no_faktur','tanggal_faktur', 'jatuh_tempo', 'jumlah_tagihan', 'status_pembayaran')
        ->join('sales', 'id_sales', '=', "sales_id")
        ->where('sales_id', $request->id)->where('status_pembayaran', 'Belum Dibayar')->get();
        foreach ($data as $row){
            $docs = Dokumentasi_Tagihan::select('nama_file_tagihan')->where("tagihan_id", "=", $row->id_tagihan)->get();
            $row->picture_urls = $docs;
        }
        return $data;
    }

    public function showDaftarTagihanLunas(Request $request){
        $data_sales = Sales::select('id_sales', 'nama_sales')
        ->where('id_sales', $request->data)->first();
        return view('pages.admin.daftarTagihanLunas', compact('data_sales'));
    }

    public function dataTabelTagihanLunas(Request $request){
        $data = Tagihan::select('id_tagihan', 'nama_sales', 'tanggal_faktur', 'jatuh_tempo', 'jumlah_tagihan', 'status_pembayaran', 'tanggal_dibayar', 'metode_pembayaran')
        ->join('sales', 'id_sales', '=', "sales_id")
        ->where('sales_id', $request->id)->where('status_pembayaran', 'Sudah Dibayar')->get();
        return $data;
    }

    public function showDetailTagihanLunas(Request $request){
        $data = Tagihan::select('id_sales', 'nama_sales', 'tanggal_faktur', 'jatuh_tempo', 'jumlah_tagihan', 'status_pembayaran', 'tanggal_dibayar', 'metode_pembayaran')
        ->join('sales', 'id_sales', '=', "sales_id")
        ->where('id_tagihan', $request->data)->first();
        
        $lolo = $data->tanggal_faktur;
        $lili = $data->jatuh_tempo;
        $lulu = $data->tanggal_dibayar;
        
        $data_tanggal = Carbon::parse($lolo)->isoFormat('DD-MMMM-YYYY'); 
        $data_tempo = Carbon::parse($lili)->isoFormat('DD-MMMM-YYYY'); 
        $data_tgl_dibayar = Carbon::parse($lili)->isoFormat('DD-MMMM-YYYY'); 
        $dokumentasi_tagihan = Dokumentasi_Tagihan::where('tagihan_id', $request->data)->get();
        $dokumentasi_transfer = Dokumentasi_Bukti_Transfer::where('tagihan_id', $request->data)->get();
        return view('pages.admin.detailTagihanLunas', compact('data', 'dokumentasi_tagihan', 'data_tgl_dibayar', 'dokumentasi_transfer','data_tanggal', 'data_tempo'));
        }


    // menampilkan halaman detail tagihan
    public function showDetailTagihan(Request $request){
        $data = Tagihan::select('id_sales','nama_perusahaan', 'no_faktur','nama_sales', 'tanggal_faktur', 'jatuh_tempo', 'jumlah_tagihan', 'status_pembayaran')
        ->join('sales', 'id_sales', '=', "sales_id")
        ->where('id_tagihan', $request->data)->first();
        
        $lolo = $data->tanggal_faktur;
        $lili = $data->jatuh_tempo;
        
        $data_tanggal = Carbon::parse($lolo)->isoFormat('DD-MMMM-YYYY'); 
        $data_tempo = Carbon::parse($lili)->isoFormat('DD-MMMM-YYYY'); 
        $dokumentasi = Dokumentasi_Tagihan::where('tagihan_id', $request->data)->get();
        return view('pages.admin.detailTagihanSales', compact('data', 'dokumentasi', 'data_tanggal', 'data_tempo'));
        // return $dokumentasi;
        
    }

    public function getImageTagihanLunas(Request $request)
    {
        $directory= storage_path('app\public\dokumentasi\bukti_transfer\\'. $request->nama_file);
        $file = File::get($directory);
        $type = File::mimeType($directory);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }


    public function getImageTagihan(Request $request)
    {
        $directory= storage_path('app\public\dokumentasi\tagihan\\'. $request->nama_file);
        $file = File::get($directory);
        $type = File::mimeType($directory);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function showFormEditStatusTagihan(Request $request){
        $data = Tagihan::select('id_tagihan','nama_sales', 'tanggal_faktur', 'jatuh_tempo', 'jumlah_tagihan','id_sales', 'no_faktur')
        ->join('sales', 'id_sales', '=', "sales_id")
        ->where('id_tagihan', $request->data)->first();
        $lolo = $data->tanggal_faktur;
        $lili = $data->jatuh_tempo;
        $dokumentasi = Dokumentasi_Tagihan::where('tagihan_id', $request->data)->get();
        $data_tanggal = Carbon::parse($lolo)->isoFormat('DD-MMMM-YYYY'); 
        $data_tempo = Carbon::parse($lili)->isoFormat('DD-MMMM-YYYY'); 
        return view('pages.admin.editStatusTagihanSales', compact('data', 'data_tanggal', 'data_tempo', 'dokumentasi'));
    }

    // untuk bayar tagihan sales
    public function editTagihanStatus(Request $request){
        
        Tagihan::where('id_tagihan', $request->id_tagihan)->update([
            "status_pembayaran" => "Sudah Dibayar",
            "metode_pembayaran" => $request->status,
            "tanggal_dibayar" => $this->convertToTimeStamps($request->tanggal_bayar)
        ]);

        $pengeluaran = new Catatan_Laba_rugi();
        $pengeluaran->tagihan_id = $request->id_tagihan;
        $pengeluaran->biaya_modal = $request->jumlah_tagihan;
        $pengeluaran->tanggal_transaksi_laba_rugi = $this->convertToTimeStamps($request->tanggal_bayar);
        $pengeluaran->keterangan = "Pembayaran tagihan sales A/N ".$request->nama_sales.". Nomor faktur - ". $request->no_faktur;
        $pengeluaran->save();

        $data_tanggal = Carbon::createFromFormat('d/m/Y', $request->tanggal_bayar)->format('d-m-Y');         
        // add foto tagihan to db
        if ($request->hasFile('images')) {
            $images_dir = array();
            if (count($request->images) > 5) {
                return response()->json([
                    'success' => false,
                    'data' => 'Jumlah foto maksimal 5'
                ]);
            }
            foreach ($request->file('images') as $image) {
                $photo = $image;
                $rand = substr(uniqid('', true), -5);
                $new_name = 'Bukti_transfer_Sales_'.$request->nama_sales.'_Tanggal_'. $data_tanggal . '_'. $rand . '.' . $photo->getClientOriginalExtension();
                $directory = 'dokumentasi/bukti_transfer' . '/' . $new_name;
                Storage::disk('public')->put($directory, File::get($photo));
                // $uuid = (string)Uuid::generate();
                Dokumentasi_Bukti_Transfer::create([
                    'nama_file_transfer' => $new_name,
                    'tagihan_id' => $request->id_tagihan
                ]);
                
                array_push($images_dir, $directory);
            }
            return redirect()->route('showDaftarTagihanLunas', ['data' => $request->id_sales])->with('success', 'Tagihan telah berhasil dibayarkan, silahkan cek tabel daftar tagihan dibawah');
        }
        //kalau ga ada gambar maka
        else {
            // kalau ga ada gambar
            return redirect()->route('showDaftarTagihanLunas', ['data' => $request->id_sales])->with('success', 'Tagihan telah berhasil dibayarkan, silahkan cek tabel daftar tagihan dibawah');
        }
    }   

    //halaman form tambah sales
    public function formAddSales(){
        return view('pages.admin.tambahSales');
    }

    public function addSales(Request $request){
        $sales = new Sales();
        $sales->nama_perusahaan = $request->nama_perusahaan;
        $sales->nama_sales = $request->nama_sales;
        $sales->no_telepon = $request->no_telepon;
        $sales->alamat = $request->alamat;
        $sales->nama_no_rekening = $request->nama_no_rekening;
        $sales->product = $request->product;
        $sales->save();
        return redirect()->route('showSales')->with('success', 'Sales Baru berhasil ditambahkan');
    }

    //untuk menampilkan halaman menambahkan tagihan baru
    public function formTagihanSales(){
        return view('pages.admin.tambahTagihanSales');
    }

    public function listPerusahaan(){
        $perusahaan = Sales::select('id_sales','nama_perusahaan', 'nama_sales')->get();
        return response()->json([
            'status' => "success",
            'data' => $perusahaan
        ]);
    }

    public function getNamaSales(Request $request){
        $data = Sales::select('nama_sales')->where('id_sales', $request->id)->get();
        return response()->json([
            'status' => "success",
            'data' => $data
        ]);
    }

    // untuk dihalaman cari sales 
    public function salesTagihanBelumLunas(Request $request){
        $sales = Tagihan::select('nama_perusahaan', 'nama_sales')
        ->join('sales', 'sales.id_sales', '=', 'tagihan.sales_id')
        ->where('status_pembayaran', '=', 'Belum Dibayar')->get();
        return response()->json([
            'status' => "success",
            'data' => $sales
        ]);
    }

    public function getDaftarNoFaktur(Request $request)
    {
        $merk = Tagihan::select('no_faktur', 'id_tagihan')->join('sales', 'sales.id_sales' ,'=', 'sales_id')
        ->where('nama_perusahaan', '=', $request->nama_perusahaan)
        ->where('status_pembayaran', '=', 'Belum Dibayar')
        ->get();
        return response()->json([
            'status' => "success",
            'data' => $merk
        ]);
    }

    public function tambahTagihanSales(Request $request){

        $data = new Tagihan;
        $data->status_pembayaran = "Belum Dibayar";
        $data->no_faktur = $request->no_faktur;
        $data->tanggal_faktur = $this->convertToTimeStamps($request->tanggal_faktur);
        // $jatuh_tempo = Carbon::parse($request->tanggal_faktur)->addMonths(3)->isoFormat('YYYY-MM-DD'); 
        $data->jatuh_tempo =  Carbon::createFromFormat('d/m/Y', $request->tanggal_faktur)->addMonths(3)->format('Y-m-d');          
        $data->jumlah_tagihan = $request->jumlah_tagihan;
        $data->sales_id = $request->id_sales;
        $data->users_id = auth()->user()->id;        
        $data->save();
        
        $dataNama = Carbon::createFromFormat('d/m/Y', $request->tanggal_faktur)->format('d-m-y');        
    
        // add foto tagihan to db
        if ($request->hasFile('images')) {
            $images_dir = array();
            if (count($request->images) > 5) {
                return response()->json([
                    'success' => false,
                    'data' => 'Jumlah foto maksimal 5'
                ]);
            }
            foreach ($request->file('images') as $image) {
                $photo = $image;
                $rand = substr(uniqid('', true), -5);
                $new_name = 'Tagihan_Sales_'.$request->nama_sales.'_Tanggal_'. $dataNama . '_'. $rand . '.' . $photo->getClientOriginalExtension();
                $directory = 'dokumentasi/tagihan' . '/' . $new_name;
                Storage::disk('public')->put($directory, File::get($photo));
                // $uuid = (string)Uuid::generate();
                Dokumentasi_Tagihan::create([
                    'nama_file_tagihan' => $new_name,
                    'tagihan_id' => $data->id_tagihan
                ]);
                
                array_push($images_dir, $directory);
            }

            return redirect()->back()->with('success', 'Tagihan Baru berhasil ditambah');
            // return response()->json([
            //     'success' => true,
            //     'data' => "succes",
            //     'directory' => $images_dir
            // ]);

        }
        // baru dibuat
        else {
            return response()->json([
                'danger' => false,
                'data' => 'Harap masukkan foto'
            ]);
        }
    }

    public function showCariTagihanSales(){
        return view('pages.admin.bayarTagihanSales');
    }

    public function listSeluruhTagihanSales(){
        $data = Tagihan::select('id_tagihan', 'nama_sales', 'no_faktur','tanggal_faktur', 'jatuh_tempo', 'jumlah_tagihan', 'status_pembayaran')
        ->join('sales', 'id_sales', '=', "sales_id")
        ->where('status_pembayaran', 'Belum Dibayar')->get();
        foreach ($data as $row){
            $docs = Dokumentasi_Tagihan::select('nama_file_tagihan')->where("tagihan_id", "=", $row->id_tagihan)->get();
            $row->picture_urls = $docs;
        }
        return $data;
    }


    // menampilkan halaman bayar tagihan sales namun dari menu side bar, ketika kita cari dulu nama sales sama no fakturnya
    public function showDetailTagihanSales(Request $request){
        $data = Tagihan::select('id_tagihan','nama_sales', 'tanggal_faktur', 'jatuh_tempo', 'jumlah_tagihan','id_sales', 'no_faktur')
        ->join('sales', 'id_sales', '=', "sales_id")
        ->where('id_tagihan', $request->no_faktur)->first();
        $lolo = $data->tanggal_faktur;
        $lili = $data->jatuh_tempo;
        $dokumentasi = Dokumentasi_Tagihan::where('tagihan_id', $request->no_faktur)->get();
        $data_tanggal = Carbon::parse($lolo)->isoFormat('DD-MMMM-YYYY'); 
        $data_tempo = Carbon::parse($lili)->isoFormat('DD-MMMM-YYYY'); 
        return view('pages.admin.BayarTagihanStatusSales', compact('data', 'data_tanggal', 'data_tempo', 'dokumentasi'));
    }

    // public function coba(){
    //     $data = Tagihan::select('nama_sales', 'no_faktur')
    //     ->join('sales', 'sales.id_sales', '=', 'tagihan.sales_id')
    //     ->where('status_pembayaran', '=', 'Belum Dibayar')->get();
    //     return $data;
    // }

}