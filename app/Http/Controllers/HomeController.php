<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

use App\Pkl\Traits\Convert;
use App\Model\Transaksi;
class HomeController extends Controller
{
    use Convert;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    // public function indexOfAdmin(Request $request) dashboard admin
    public function indexOfDashboard()
    {
        $dataHari = Carbon::now()->Format('d', 'Asia/Jakarta');        
        $dataBulan = Carbon::now()->Format('m', 'Asia/Jakarta');
        $dataTahun = Carbon::now()->Format('Y', 'Asia/Jakarta');

        $hasilHari = Transaksi::select('total_harga')->whereDay('tanggal_pembelian', '=', $dataHari)->whereMonth('tanggal_pembelian', '=', $dataBulan)->whereYear('tanggal_pembelian', '=', $dataTahun)
        ->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('total_harga');

        $hasilBulan = Transaksi::select('total_harga')->whereMonth('tanggal_pembelian', '=', $dataBulan)->whereYear('tanggal_pembelian', '=', $dataTahun)->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('total_harga');

        $hasilTahun = Transaksi::select('total_harga')->whereYear('tanggal_pembelian', '=', $dataTahun)->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('total_harga');
        
        $jumlahTransak = Transaksi::all()->count();
        $tahun = Carbon::now()->Format('Y', 'Asia/Jakarta');
        $hari =  Carbon::now()->isoFormat('dddd');
        $bulan = Carbon::now()->isoFormat('MMMM');
        
        $data = $this->getAllData();     

        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.dashboardAdmin', compact('data','hasilBulan', 'hasilHari', 'hasilTahun', 'jumlahTransak', 'tahun' , 'hari', 'bulan'));
        }else{
            return view('pages.kasir.dashboardKasir', compact('data','hasilBulan', 'hasilHari', 'hasilTahun', 'jumlahTransak', 'tahun' , 'hari', 'bulan'));
        }   


        
    }

    public function getAllData(){
        $tahun = Carbon::now()->Format('Y', 'Asia/Jakarta');        
        // $data= Transaksi::where('tanggal_pembelian','like',$tahun.'%')->join('orders', 'transaksi_id', '=', 'id_transaksi')->sum('total_harga');
        $data = Transaksi::where('tanggal_pembelian','like',$tahun.'%')->get();
        $bulan=['January'=>0,'February'=>0,'March'=>0,'April'=>0,'May'=>0,'June'=>0,'July'=>0,'August'=>0
                ,'September'=>0,'October'=>0,'November'=>0,'December'=>0,];
        foreach ($data as $item) {
            $tempBulan=date('F', strtotime($item->tanggal_pembelian));
            $bulan[$tempBulan]=$bulan[$tempBulan]+1;
        }
        
        return ($bulan);
    }
    
}
   
    
    

