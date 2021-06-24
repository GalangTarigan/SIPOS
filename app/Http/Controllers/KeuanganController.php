<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Orders;
use App\Model\Transaksi;
use App\Model\Tagihan;
use App\Pkl\Traits\Convert;
use Illuminate\Support\Carbon;
use App\Model\Catatan_Laba_rugi;
use DateTime;

class KeuanganController extends Controller{
    use Convert;
    public function showLaporanPenjualanFilter() //untuk yang pertama bagian filter
    {
        return view('pages.admin.laporanPenjualanFilter');
    }

    public function showLaporanPenjualanHasil(Request $request) //untuk setelah difilter
    { 
        $mulai = $request->tanggalMulai;
        $selesai = $request->sampaiTanggal;
        return view('pages.admin.laporanPenjualanHasil', compact('mulai', 'selesai'));
    }

    public function showLaporanLabaRugiFilter(Request $request){               
        return view('pages.admin.laporanLabaRugiFilter');
    }

    public function showLaporanLabaRugiHasil(Request $request){       
        $dataBulan = $request->date_start;
        $dataTahun = $request->year_start;

        $modalPerBulan = Catatan_Laba_rugi::select('biaya_modal')
        ->whereMonth('tanggal_transaksi_laba_rugi', '=', $request->date_start)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $request->year_start)
        ->sum('biaya_modal');

        $pemasukanPerBulan = Catatan_Laba_rugi::select('pendapatan')
        ->whereMonth('tanggal_transaksi_laba_rugi', '=', $request->date_start)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $request->year_start)
        ->sum('pendapatan');

        $labaPerBulan = $pemasukanPerBulan - $modalPerBulan;
        
        $jumlahTransak = Catatan_Laba_rugi::whereMonth('tanggal_transaksi_laba_rugi', '=', $request->date_start)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $request->year_start)->count();
        $tahun = $request->year_start;

        $dateObj   = Carbon::createFromFormat('!m', $dataBulan);        
        $bulan = $dateObj->isoFormat('MMM', 'Asia/Jakarta');
        $judulBulan = $dateObj->isoFormat('MMMM', 'Asia/Jakarta');

        return view('pages.admin.laporanLabaRugiHasil', compact('judulBulan','modalPerBulan', 'pemasukanPerBulan', 'labaPerBulan', 'dataBulan', 'jumlahTransak', 'tahun' , 'bulan'));

    }

    public function listDataLabaRugi(Request $request){
        $data = Catatan_Laba_rugi::whereMonth('tanggal_transaksi_laba_rugi', '=', $request->date_start)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $request->year_start)
        ->orderBy('tanggal_transaksi_laba_rugi' ,'DESC')->get();
        return $data;
    }

    public function showLaporanPengeluaranFilter(){
        return view('pages.admin.laporanPengeluaranFilter');
    }


    public function showLaporanPengeluaranHasil(Request $request){
        $dataBulan = $request->date_start;
        $dataTahun = $request->year_start;

        
        $hasilBulan = Catatan_Laba_rugi::select('biaya_modal')
        ->whereMonth('tanggal_transaksi_laba_rugi', '=', $dataBulan)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $dataTahun)
        ->where('transaksi_id', '=', null)
        ->sum('biaya_modal');

        $hasilTahun = Catatan_Laba_rugi::select('biaya_modal')
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $dataTahun)
        ->where('transaksi_id', '=', null)
        ->sum('biaya_modal');
        
        $jumlahTransak = Catatan_Laba_rugi::whereMonth('tanggal_transaksi_laba_rugi', '=', $request->date_start)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $request->year_start)
        ->where('transaksi_id', '=', null)->count();
        
        $dateObj   = Carbon::createFromFormat('!m', $dataBulan);        
        $bulan = $dateObj->isoFormat('MMM', 'Asia/Jakarta');
        $namaBulan = $dateObj->isoFormat('MMMM', 'Asia/Jakarta');
        

        return view('pages.admin.laporanPengeluaranHasil', compact('dataBulan', 'hasilBulan', 'hasilTahun', 'jumlahTransak', 'dataTahun' , 'namaBulan'));
    }


    public function showFormTambahTransaksiKeluar(){
        return view('pages.admin.tambahTransaksiKeluar');
    }

    
    public function listLaporanPenjualan(Request $request){ 
        $mulai = $this->convertToTimeStamps($request->tanggal);
        $selesai = $this->convertToTimeStamps($request->sampai);
        $data = Transaksi::select('no_invoice', 'tanggal_pembelian', 'nama_pelanggan', 'total_pembelian', 'nama_lengkap', 'harga_barang_beli', 'modal_barang_beli')
        ->join('users', 'id', '=', 'users_id')->join('orders', 'id_transaksi', '=', 'transaksi_id')
        ->whereBetween('tanggal_pembelian', [$mulai, $selesai])->distinct('id_transaksi')
        ->get();

        $result = [];
        foreach($data as $row) {
            if (empty($result[$row->nama_pelanggan])) {
                $result[$row->nama_pelanggan] = $row;
            } else {
                $result[$row->nama_pelanggan]->modal_barang_beli += $row->modal_barang_beli;
            }
        }

        $result_array = array_values($result);
        foreach($result_array as $row) {
            $row->laba = $row->total_pembelian - $row->modal_barang_beli;
        }
        
        return $result_array;
    }

    public function listTransaksiKeluar(Request $request){
        // dd($request);
        // $dataBulan = Carbon::now()->Format('m', 'Asia/Jakarta');
        $data = Catatan_Laba_rugi::select('keterangan', 'biaya_modal', 'tanggal_transaksi_laba_rugi')
        ->whereMonth('tanggal_transaksi_laba_rugi', '=', $request->month_start)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $request->year_start)
        ->where('transaksi_id', '=', null)
        ->orderBy('tanggal_transaksi_laba_rugi' ,'DESC')->get();
        return $data;
    }

    public function addTransaksiKeluar(Request $request){
        $data = new Catatan_Laba_rugi();
        $data->keterangan = $request->keterangan;
        $data->biaya_modal = $request->jumlah_pengeluaran;
        $data->tanggal_transaksi_laba_rugi = Carbon::now()->Format('Y-m-d H:i:s', 'Asia/Jakarta');
        $data->save();
        return redirect()->back()->with('success', 'Transaksi Baru berhasil ditambahkan');
        // return redirect()->route('daftarTransaksiKeluar')->with('success', 'Transaksi Baru berhasil ditambahkan');        
    }

    public function printLaporanLabaRugi(Request $request){
        $dataBulan = $request->date_start;
        $dataTahun = $request->year_start;

        $modalPerBulan = Catatan_Laba_rugi::select('biaya_modal')
        ->whereMonth('tanggal_transaksi_laba_rugi', '=', $request->date_start)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $request->year_start)
        ->sum('biaya_modal');

        $pemasukanPerBulan = Catatan_Laba_rugi::select('pendapatan')
        ->whereMonth('tanggal_transaksi_laba_rugi', '=', $request->date_start)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $request->year_start)
        ->sum('pendapatan');

        $labaPerBulan = $pemasukanPerBulan - $modalPerBulan;
        
        $jumlahTransak = Catatan_Laba_rugi::whereMonth('tanggal_transaksi_laba_rugi', '=', $request->date_start)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $request->year_start)->count();
        $tahun = $request->year_start;

        $dateObj   = Carbon::createFromFormat('!m', $dataBulan);        
        $bulan = $dateObj->isoFormat('MMM', 'Asia/Jakarta');
        $judulBulan = $dateObj->isoFormat('MMMM', 'Asia/Jakarta');

        $data = Catatan_Laba_rugi::whereMonth('tanggal_transaksi_laba_rugi', '=', $request->date_start)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $request->year_start)
        ->orderBy('tanggal_transaksi_laba_rugi' ,'DESC')->get();

        return view('print.laporan-laba-rugi', compact('data', 'judulBulan','modalPerBulan', 'pemasukanPerBulan', 'labaPerBulan', 'dataBulan', 'jumlahTransak' ,'dataTahun' ,'bulan'));
    }


    public function pirntLaporanPenjualan(Request $request){
        $mulai = $this->convertToTimeStamps($request->tanggal);
        $selesai = $this->convertToTimeStamps($request->sampai);
        $tanggal1 = $request->tanggal;
        $tanggal2 = $request->sampai;
        $data = Transaksi::select('no_invoice', 'tanggal_pembelian', 'nama_pelanggan', 'total_pembelian', 'nama_lengkap', 'harga_barang_beli', 'modal_barang_beli')
        ->join('users', 'id', '=', 'users_id')->join('orders', 'id_transaksi', '=', 'transaksi_id')
        ->whereBetween('tanggal_pembelian', [$mulai, $selesai])        
        ->get();
        $totalBeli = Transaksi::select('total_pembelian')->whereBetween('tanggal_pembelian', [$mulai, $selesai])
        ->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('total_pembelian');
        $totalModal = Transaksi::select('modal_barang_beli')->whereBetween('tanggal_pembelian', [$mulai, $selesai])
        ->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('modal_barang_beli');
        $totalLaba = $this->calculateLaba($mulai, $selesai);

        $result = [];
        foreach($data as $row) {
            if (empty($result[$row->nama_pelanggan])) {
                $result[$row->nama_pelanggan] = $row;
            } else {
                $result[$row->nama_pelanggan]->modal_barang_beli += $row->modal_barang_beli;
            }
        }

        $result_array = array_values($result);
        foreach($result_array as $row) {
            $row->laba = $row->total_pembelian - $row->modal_barang_beli;
        }

        return view('print.laporan-penjualan', compact('tanggal1', 'tanggal2', 'result_array', 'totalBeli','totalModal', 'totalLaba'));
    }

    public function calculateLaba($mulai, $selesai){
        $totalBeli = Transaksi::select('total_harga')->whereBetween('tanggal_pembelian', [$mulai, $selesai])->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('total_harga');
        $totalModal = Transaksi::select('modal_barang_beli')->whereBetween('tanggal_pembelian', [$mulai, $selesai])->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('modal_barang_beli');
        $hasil = $totalBeli - $totalModal;
        return $hasil;
    }


    public function printLaporanPengeluaran(Request $request){
        $dataBulan = $request->month_start;
        $dataTahun = $request->year_start;
        
        $dateObj   = Carbon::createFromFormat('!m', $dataBulan);        
        $judulBulan = $dateObj->isoFormat('MMMM', 'Asia/Jakarta');

        $data = Catatan_Laba_rugi::select('keterangan', 'biaya_modal', 'tanggal_transaksi_laba_rugi')
        ->whereMonth('tanggal_transaksi_laba_rugi', '=', $request->month_start)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $request->year_start)
        ->where('transaksi_id', '=', null)
        ->orderBy('tanggal_transaksi_laba_rugi' ,'DESC')->get();

        $totalBiayaKeluar = Catatan_Laba_rugi::select('biaya_modal')
        ->whereMonth('tanggal_transaksi_laba_rugi', '=', $request->month_start)
        ->whereYear('tanggal_transaksi_laba_rugi', '=', $request->year_start)
        ->where('transaksi_id', '=', null)
        ->sum('biaya_modal');

        return view('print.laporan-pengeluaran', compact('judulBulan', 'dataTahun', 'data', 'totalBiayaKeluar'));
    }



    public function showStatistik(){
        $dataHari = Carbon::now()->Format('d', 'Asia/Jakarta');      
        $dataBulan = Carbon::now()->Format('m', 'Asia/Jakarta');
        $dataTahun = Carbon::now()->Format('Y', 'Asia/Jakarta');


        $hasilHari = Transaksi::select('total_harga')->whereDay('tanggal_pembelian', '=', $dataHari)->whereMonth('tanggal_pembelian', '=', $dataBulan)
        ->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('total_harga');
        $modalHari = Transaksi::select('modal_barang_beli')->whereDay('tanggal_pembelian', '=', $dataHari)->whereMonth('tanggal_pembelian', '=', $dataBulan)
        ->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('modal_barang_beli');
        $labaHari = $hasilHari - $modalHari;

        $hasilBulan = Transaksi::select('total_harga')->whereMonth('tanggal_pembelian', '=', $dataBulan)->whereYear('tanggal_pembelian', '=', $dataTahun)
        ->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('total_harga');
        $modalBulan = Transaksi::select('modal_barang_beli')->whereMonth('tanggal_pembelian', '=', $dataBulan)->whereYear('tanggal_pembelian', '=', $dataTahun)
        ->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('modal_barang_beli');
        $labaBulan = $hasilBulan - $modalBulan;

        $hasilTahun = Transaksi::select('total_harga')->whereYear('tanggal_pembelian', '=', $dataTahun)
        ->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('total_harga');
        $modalTahun = Transaksi::select('modal_barang_beli')->whereYear('tanggal_pembelian', '=', $dataTahun)
        ->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('modal_barang_beli');
        $labaTahun = $hasilTahun - $modalTahun;

        $jumlahTransakTahun = Transaksi::whereYear('tanggal_pembelian', '=', $dataTahun)->count();
        $jumlahTransakBulan = Transaksi::whereMonth('tanggal_pembelian', '=', $dataBulan)->whereYear('tanggal_pembelian', '=', $dataTahun)->count();
        $dataStatsHari = Carbon::now()->isoFormat('DD-MM-Y');

        $bulan = Carbon::now()->isoFormat('MMM');
        $hari = Carbon::now()->isoFormat('dddd');

        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.statistikPenjualan', compact('hari','bulan','jumlahTransakTahun','jumlahTransakBulan','dataStatsHari','hasilBulan', 'hasilHari', 'hasilTahun', 'labaHari', 'labaBulan', 'labaTahun', 'dataTahun'));                     
        }else{
            return view('pages.kasir.statistikPenjualan-kasir', compact('hari','bulan','jumlahTransakTahun','jumlahTransakBulan','dataStatsHari','hasilBulan', 'hasilHari', 'hasilTahun', 'labaHari', 'labaBulan', 'labaTahun', 'dataTahun'));                     
        } 

    }

    public function barStatsTahun(Request $request)
    { 
        
        $lala = DB::select("SELECT month(tanggal_pembelian) as bulan_pembelian, SUM( total_pembelian ) AS total_pembelian FROM transaksi WHERE year(tanggal_pembelian) = ".$request->date_start." GROUP BY month(tanggal_pembelian)");
        $lulu = DB::select("SELECT month(created_at) as bulan_pembelian, SUM( modal_barang_beli ) AS modal_barang_beli FROM orders WHERE year(created_at) = ".$request->date_start." GROUP BY month(created_at)");
        $result = array();
        $monthNumberToNameMap = ['1'=>'January', '2'=>'February','3'=>'March','4'=>'April','5'=>'May','6'=>'June','7'=>'July','8'=>'August',
        '9'=>'September','10'=>'October','11'=>'November','12'=>'December'];
        foreach($lala as $row){
            $result[$monthNumberToNameMap[strval($row->bulan_pembelian)]]['total_pembelian'] = $row->total_pembelian;
        }
        foreach($lulu as $row){
            $selectedRow = $result[$monthNumberToNameMap[strval($row->bulan_pembelian)]];
            $laba = $selectedRow['total_pembelian'] - $row->modal_barang_beli;
            $result[$monthNumberToNameMap[strval($row->bulan_pembelian)]]['laba'] = $laba;
        }
        return $result;
        
    }

    public function barStatsHari(Request $request)
    {
        // $from = Carbon::createFromFormat('Y-m-d H:i;s',  $this->convertToTimeStamps($request->date_start), 'Asia/Jakarta');
        $from = $this->convertToTimeStamps($request->date_start);
        $to = $this->convertToTimeStamps($request->date_end);
        $judulMulai = Carbon::parse($from)->isoFormat('DD-MM-Y');
        $judulSelesai = Carbon::parse($to)->isoFormat('DD-MM-Y');
        // $from = Carbon::createFromFormat('Y-m-d H:i:s', $this->convertToTimeStamps($request->date_start), 'Asia/Jakarta');
        // $to = Carbon::createFromFormat('Y-m-d H:i:s', $this->convertToTimeStamps($request->date_end), 'Asia/Jakarta');
        $data = Transaksi::select('total_harga', 'modal_barang_beli', 'tanggal_pembelian', 'id_transaksi')->join('orders', 'transaksi_id', '=', 'id_transaksi')
        ->whereBetween('tanggal_pembelian', [$from, $to])->distinct('tanggal_pembelian')->get();
        $subjek = array();
        $total_harga = array();
        $total_laba = array();
        $result = [];
        foreach ($data as $datas) {            
            if (empty($result[$datas->tanggal_pembelian])) {
                $result[$datas->tanggal_pembelian] = $datas;

            } else {
                $result[$datas->tanggal_pembelian]->total_harga += $datas->total_harga;
                $result[$datas->tanggal_pembelian]->modal_barang_beli += $datas->modal_barang_beli;
            }            
        }
            $result_array = array_values($result);
            foreach($result_array as $row){
                $row->laba = $row->total_harga - $row->modal_barang_beli;                
            }
            $hasil = array_values($result_array);
            
            foreach($hasil as $row){
                $temp_subjek = Carbon::parse($row->tanggal_pembelian)->isoFormat('dddd DD-MM-Y');
                $temp_total = $row->total_harga;
                $temp_laba = $row->laba;
                array_push($subjek, $temp_subjek);
                array_push($total_harga, $temp_total);
                array_push($total_laba, $temp_laba);
            }
        return compact('subjek', 'total_harga', 'total_laba', 'judulMulai', 'judulSelesai');
        // return compact('from', 'to');
    }



    

}

// pengeluaran yang lama dan akan dirubah

// public function showLaporanPengeluaranFilter() //untuk yang pertama bagian filter
    // {
    //     return view('pages.admin.laporanPengeluaranFilter');
    // }

    // public function showLaporanPengeluaranHasil(Request $request) //untuk setelah difilter
    // { 
    //     $mulai = $request->tanggalMulai;
    //     $selesai = $request->sampaiTanggal;
    //     return view('pages.admin.laporanPengeluaranHasil', compact('mulai', 'selesai'));
    // }

    // public function listLaporanPengeluaran(Request $request){
    //     $mulai = $this->convertToTimeStamps($request->tanggal);
    //     $selesai = $this->convertToTimeStamps($request->sampai);
    //     $data = Tagihan::select('id_tagihan', 'nama_sales', 'tanggal_faktur', 'jatuh_tempo', 'status_pembayaran', 
    //     'tanggal_dibayar', 'metode_pembayaran', 'jumlah_tagihan')
    //     ->join('sales', 'id_sales', '=', 'sales_id')->where('status_pembayaran', '=', 'Sudah Dibayar')
    //     ->whereBetween('tanggal_dibayar', [$mulai, $selesai])->get();
    //     return $data;
        
    // }

// public function printLaporanPengeluaran(Request $request){
//     $mulai = $this->convertToTimeStamps($request->tanggal);
//     $selesai = $this->convertToTimeStamps($request->sampai);
//     $tanggal1 = $request->tanggal;
//     $tanggal2 = $request->sampai;
//     $data = Tagihan::select('id_tagihan', 'nama_sales', 'tanggal_faktur', 'jatuh_tempo', 'status_pembayaran', 
//     'tanggal_dibayar', 'metode_pembayaran', 'jumlah_tagihan')
//     ->join('sales', 'id_sales', '=', 'sales_id')->where('status_pembayaran', '=', 'Sudah Dibayar')
//     ->whereBetween('tanggal_dibayar', [$mulai, $selesai])->get();
//     $total_pengeluaran = Tagihan::select('jumlah_tagihan')->where('status_pembayaran', '=', 'Sudah Dibayar')
//     ->whereBetween('tanggal_dibayar', [$mulai, $selesai])->sum('jumlah_tagihan');

//     return view('print.laporan-pengeluaran', compact('tanggal1', 'tanggal2','data', 'total_pengeluaran'));
// }

