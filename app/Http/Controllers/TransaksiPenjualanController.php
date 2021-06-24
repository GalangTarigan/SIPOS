<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Orders;
use App\Model\Transaksi;
use App\Model\Barang;
use App\Pkl\Traits\Convert;
use Illuminate\Support\Carbon;
use App\Model\Catatan_Laba_rugi;


class TransaksiPenjualanController extends Controller{

    use Convert;
    public function showFormKasir()
    {
        $tanggal = Carbon::now()->Format('dmy', 'Asia/Jakarta');
        $jumlah = Transaksi::all()->count()+1;
        $invoice = '0'.$jumlah. '-'. $tanggal;

        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.kasirPenjualan', compact('invoice'));            
        }else{
            return view('pages.kasir.kasirPenjualan-kasir', compact('invoice'));            
        } 
    }

    public function listBarang(){
        $data = Barang::select('nama_kategori','nama_merk', 'tipe_barang', 'nama_sales', 'jumlah', 'modal', 'jual', 'id_barang')
        ->join('kategori_barang', 'kategori_barang.id_kategori', '=', 'barang.kategori_id')
        ->join('sales', 'sales.id_sales', '=', 'barang.sales_id')
        ->join('merk_barang', 'merk_barang.id_merk', '=', 'barang.merk_id')->where('jumlah', '>', 0)->get();
        return $data;
    }

    public function addOrders(Request $request)
    {
    // dd($request);
    // add to db transaksi dah berhasil        
    $transaction = new Transaksi;
    $transaction->no_invoice = $request->no_invoice;
    $transaction->tanggal_pembelian = $this->convertToTimeStamps($request->tanggal_beli);
    $transaction->nama_pelanggan = $request->nama_pelanggan;
    $transaction->alamat_pembeli = $request->alamat;
    $transaction->no_telepon_pembeli = $request->no_telepon;
    $transaction->total_pembelian = $request->total_pembelian;
    $transaction->users_id = auth()->user()->id;
    $transaction->waktu_dibuat = Carbon::now()->Format('Y-m-d H:i:s', 'Asia/Jakarta');
    $transaction->save();

    $catatan_laba_rugi = new Catatan_Laba_rugi();
    $catatan_laba_rugi->transaksi_id = $transaction->id_transaksi;
    $catatan_laba_rugi->biaya_modal = $request->total_modal_semua;
    $catatan_laba_rugi->pendapatan = $request->total_pembelian;
    $catatan_laba_rugi->laba_transaksi = $request->total_pembelian - $request->total_modal_semua;
    $catatan_laba_rugi->keterangan = "Total modal dari transaksi penjualan dengan No.Invoice ". $request->no_invoice ." A/N ". $request->nama_pelanggan. "";
    $catatan_laba_rugi->tanggal_transaksi_laba_rugi = $this->convertToTimeStamps($request->tanggal_beli);
    $catatan_laba_rugi->save();

    foreach($request->orders as $data){
            $orders = new orders;
            $orders->barang_id = $data['itemId'];
            $orders->transaksi_id = $transaction->id_transaksi;
            $orders->kategori_barang = $data['kategori_barang'];
            $orders->merk_barang_beli = $data['merk'];
            $orders->tipe_barang_beli = $data['tipe'];
            $orders->harga_barang_beli = $data['harga'];
            $orders->jumlah_barang_beli = $data['jumlah'];
            $orders->total_harga = $data['totalHarga'];
            $orders->modal_barang_beli = $data['modal'];
            $tanggal = $this->convertToTimeStamps($request->tanggal_beli);
            $orders->batas_garansi = Carbon::parse($tanggal)->addYears(1)->Format('Y-m-d H:i:s', 'Asia/Jakarta');;
            $orders->save();
            
            // update jumlah stock barang pada db barang            
            $jumlah_stock = Barang::select('jumlah')->where('id_barang', $data['itemId'])->first()->jumlah;
            Barang::where('id_barang', $data['itemId'])->update([
                    "jumlah" => $jumlah_stock - $data['jumlah']
                    ]);
        }
        return response()->json('success');       
    }
    

    //history transaksi
    public function showHistoryTransaksi(){
        
        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.historyTransaksi');            
        }else{
            return view('pages.kasir.historyTransaksiKasir');            
        } 
    }

    //history transaksi success
    public function showHistoryTransaksiSuccess(){

        
        if (auth()->user()->hasAdminRole()) {
            return redirect()->route('historyKasir')->with('success', 'Transaksi Baru berhasil dilakukan');            
        }else{
            return redirect()->route('historyKasir-kasir')->with('success', 'Transaksi Baru berhasil dilakukan');
        } 
    }

    //untuk tabel dari yang ada dihalaman history transaksi
    public function dataHistoryTransaksi(){
        $data = Transaksi::select('no_invoice', 'nama_pelanggan', 'tanggal_pembelian', 'alamat_pembeli', 'no_telepon_pembeli', 'waktu_dibuat',
        'total_pembelian', 'id_transaksi')->join('orders', 'transaksi_id', '=', 'id_transaksi')->distinct('transaksi_id')->orderBy('waktu_dibuat' ,'DESC')->get();
        return $data;
    }

    public function detailHistoryTransaksi(Request $request){
    $data = Transaksi::select('no_invoice', 'nama_pelanggan', 'alamat_pembeli', 'tanggal_pembelian', 'no_telepon_pembeli', 'waktu_dibuat',
    'total_pembelian', 'id_transaksi', 'nama_lengkap', 'kategori_barang', 'merk_barang_beli', 'tipe_barang_beli', 'harga_barang_beli', 'jumlah_barang_beli', 'total_harga')
    ->join('orders', 'transaksi_id', '=', 'id_transaksi')->join('users', 'id', '=', 'users_id')
    ->where('id_transaksi', '=', $request->id_transaksi)->get();
        return $data;
    }

    public function printTransaksi(Request $request){
        $dataPelanggan = Transaksi::select('no_invoice', 'nama_pelanggan', 'alamat_pembeli', 'tanggal_pembelian', 'no_telepon_pembeli', 'waktu_dibuat',
        'total_pembelian', 'id_transaksi', 'nama_lengkap')
        ->join('users', 'id', '=', 'users_id')->where('no_invoice', '=', $request->no_invoice)->firstOrFail();
        $id_transak = $dataPelanggan->id_transaksi;
        $dataBarangBeli = Orders::select('kategori_barang', 'merk_barang_beli', 'tipe_barang_beli', 'harga_barang_beli', 
        'jumlah_barang_beli', 'total_harga')->where('transaksi_id', '=', $id_transak)->get();
        return view('print.transaksi-penjualan', compact('dataPelanggan', 'dataBarangBeli'));
        
    }

   public function coba(){
    $tanggal = Carbon::now()->Format('dmy', 'Asia/Jakarta');
    $jumlah = Transaksi::all()->count();
    $dataBarangBeli = '0'.$jumlah. '-'. $tanggal;
        return $dataBarangBeli;
   }



// =====================================buat kasir ==================================================================================================================

    

}
