<?php

namespace App\Http\Controllers;

use App\Model\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Model\Barang_Return;
use App\Model\Kategori_Barang;
use App\Pkl\Traits\Convert;
use Faker\Provider\Base;
use Illuminate\Support\Facades\Response;


class BarangReturnController extends Controller
{

    use Convert;
    //halaman daftar barang return
    public function indexBarangReturn()
    {
        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.daftarBarangReturn');        
        }else{
            return view('pages.kasir.daftarBarangReturn-kasir');        
        } 

    }

    public function listBarangReturn()
    {
        $barang_return = Barang_Return::select('id_barang_return', 'nama_merk','no_seri', 'tipe_barang', 'nama_kategori', 'kerusakan', 'jumlah_return', 'nama_sales', 'status', 'tanggal_pengambilan')
            ->join('barang', 'barang.id_barang', '=', 'barang_return.barang_id')
            ->join('merk_barang', 'merk_barang.id_merk', '=', 'barang.merk_id')
            ->join('sales', 'sales.id_sales', '=', 'barang.sales_id')
            ->join('kategori_barang', 'kategori_barang.id_kategori', '=', 'barang.kategori_id')
            ->get();
        return $barang_return;
    }

    public function deleteBarangReturn(Request $request)
    {
    //  dd($request);
    $data = Barang_Return::select('status')->where('id_barang_return', '=', $request->barang_return)->get();
    $data2 = Barang_Return::select('jumlah_return', 'barang_id')->where('id_barang_return', '=', $request->barang_return)->get();
        
        if ($data[0]->status == 'Sudah Selesai' ) {
            // dd($data);
            $jumlah = $this->jumlah_barang($data2[0]->barang_id);
            Barang_Return::where('id_barang_return', '=', $request->barang_return)->delete();
            Barang::where('id_barang', $data2[0]->barang_id)->update([
                "jumlah" =>  $data2[0]->jumlah_return +  $jumlah
                ]);
            return response()->json([
                'status' => true,
                'data' => 'Barang berhasil dihapus!!!',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => 'Status Barang belum Selesai!!!',
            ]);
        }
    }

    public function coba(){
        $data = Barang_Return::select('status')->where('id_barang_return', '=', 44)->get();
        return $data[0];
    }

    public function deleteBarangReturnSuccess(){

        if (auth()->user()->hasAdminRole()) {
            return redirect()->route('showDaftarBarangReturn')->with('success', 'Barang Return Baru berhasil dihapus');
        }else{
            return redirect()->route('showDaftarBarangReturn-kasir')->with('success', 'Barang Return Baru berhasil dihapus');
        }
    }

    //form tambah barang return
    public function indexTambahBarangReturn()
    {
        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.tambahBarangReturn');
            
        }else{
            return view('pages.kasir.tambahBarangReturn-kasir');
        }

    }

    public function getKategoriBarang(){
        $kategori = Kategori_Barang::select('nama_kategori', 'id_kategori')->get();
        return response()->json([
            'status' => "success",
            'data' => $kategori
        ]);
    }

    public function getDaftarMerk(Request $request)
    {
        $merk = Barang::select('id_merk','nama_merk')
        ->join('merk_barang', 'merk_barang.id_merk', '=', 'barang.merk_id')
        ->where('kategori_id', '=', $request->id_kategori)->distinct('merk')->get();
        return response()->json([
            'status' => "success",
            'data' => $merk
        ]);
    }

    public function getTipeBarang(Request $request)
    {
        $result = Barang::select('tipe_barang', 'id_barang')->where('merk_id', '=', $request->merk)->get();
        return response()->json([
            'status' => "success",
            'data' => $result
        ]);
    }

    public function getMaxBarang(Request $request)
    {
        $jumlah = Barang::select('jumlah', 'nama_sales')
        ->join('sales', 'id_sales', '=', 'sales_id')
        ->where('id_barang', '=', $request->id_barang)->get();
        // dd($request);
        return response()->json([
            'status' => "success",
            'data' => $jumlah
        ]);
    }


    public function addBarangReturn(Request $request)
    {
        // dd($request->jumlah_barang);
        $barang_return = new Barang_Return();
        $barang_return->barang_id = $request->id_barang;
        $barang_return->kerusakan = $request->kerusakan;
        $barang_return->status = $request->status_barang;
        $barang_return->no_seri = $request->no_seri;
        $barang_return->jumlah_return = $request->jumlah_barang;
        if ($request->tanggal_barang_return == null) {
            $barang_return->tanggal_pengambilan = NULL;
        } else {
            $barang_return->tanggal_pengambilan = $this->convertToTimeStamps($request->tanggal_barang_return);
        }
        $barang_return->save();

        $jumlah = $this->jumlah_barang($request->id_barang);
        Barang::where('id_barang', $request->id_barang)->update([
            "jumlah" => $jumlah - $request->jumlah_barang,
            ]);
            
        if (auth()->user()->hasAdminRole()) {
            return redirect()->route('showDaftarBarangReturn')->with('success', 'Barang Return Baru berhasil ditambah');
        }else{
            return redirect()->route('showDaftarBarangReturn-kasir')->with('success', 'Barang Return Baru berhasil ditambah');
        }
    }

    public function jumlah_barang($id_barang)
    {
        $barang = Barang::select('jumlah')->where('id_barang', $id_barang)->get();
        return $barang[0]->jumlah;
    }

    //form edit barang return
    public function showFormEditReturn (Request $request){
        $data = Barang_Return::select('barang_id','id_barang_return','nama_merk', 'status', 'nama_kategori','no_seri', 'tipe_barang', 'nama_sales', 'jumlah', 'jumlah_return', 'kerusakan', 'tanggal_pengambilan')
        ->where('id_barang_return', $request->barangReturn)
        ->join('barang', 'barang.id_barang', '=', 'barang_return.barang_id')
        ->join('sales', 'sales.id_sales', '=', 'barang.sales_id')
        ->join('kategori_barang', 'kategori_barang.id_kategori', '=', 'barang.kategori_id')
        ->join('merk_barang', 'merk_barang.id_merk', '=', 'barang.merk_id')
        ->first();

        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.editBarangReturn', compact('data'));            
        }else{
            return view('pages.kasir.editBarangReturn-kasir', compact('data'));
        }

    }


    public function editBarangReturn (Request $request){
        // dd($request);    
        if($request->status_barang === "Sudah Selesai") {
            Barang_Return::where('id_barang_return', $request->id_barang_return)->update([
                "kerusakan" => $request->kerusakan,
                "no_seri" => $request->no_seri,
                "status" => $request->status_barang,
                ]);
            
            // edit barang baru // Sudah ditest bagus
            $jumlah = $this->jumlah_barang($request->barang_id);
            Barang::where('id_barang', $request->barang_id)->update([
                "jumlah" => $jumlah + $request->jumlah_saat_ini,
                ]);
        }
        // cek kalau semua kosong //dah bagus
        elseif(empty($request->tanggal_barang_return) &&  empty($request->jumlah_barang_tambah) && empty($request->jumlah_barang_kurang) ){
            // echo " Semua kosongggggg";
            Barang_Return::where('id_barang_return', $request->id_barang_return)->update([
                "kerusakan" => $request->kerusakan,
                "no_seri" => $request->no_seri,
                "status" => $request->status_barang,  // bisa jadi status nya jadi langsung selesai karna barang nya sudah diperbaiki
                ]);
        }
        // cek hanya data tanggal yang terisi atau ada // belum di test
        elseif(!empty($request->tanggal_barang_return) &&  empty($request->jumlah_barang_tambah) && empty($request->jumlah_barang_kurang) ) {
            // echo "hanya data tanggal yang ada";
            Barang_Return::where('id_barang_return', $request->id_barang_return)->update([
                "kerusakan" => $request->kerusakan,
                "no_seri" => $request->no_seri,
                "status" => $request->status_barang,
                "tanggal_pengambilan" => $this->convertToTimeStamps($request->tanggal_barang_return),
                ]);
        }
        //cek kalau hanya data jumlah tambah barang return yang diisi
        elseif(empty($request->tanggal_barang_return) &&  !empty($request->jumlah_barang_tambah) && empty($request->jumlah_barang_kurang) ) {
            // echo "hanya data jumlah barang tambah ada";
            // edit barang return // sudah bagus 
            Barang_Return::where('id_barang_return', $request->id_barang_return)->update([
                "kerusakan" => $request->kerusakan,
                "no_seri" => $request->no_seri,
                "jumlah_return" => $request->jumlah_saat_ini + $request->jumlah_barang_tambah,
                ]);
            
            // edit barang baru // Sudah ditest bagus
            $jumlah = $this->jumlah_barang($request->barang_id);
            Barang::where('id_barang', $request->barang_id)->update([
                "jumlah" => $jumlah - $request->jumlah_barang_tambah,
                ]);
            

        }
        //cek kalau hanya data jumlah kurangi barang return yang diisi
        elseif(empty($request->tanggal_barang_return) &&  empty($request->jumlah_barang_tambah) && !empty($request->jumlah_barang_kurang) ) {
            // echo "hanya data jumlah barang kurang ada";
            // edit barang return // sudah bagus 
            Barang_Return::where('id_barang_return', $request->id_barang_return)->update([
                "kerusakan" => $request->kerusakan,
                "no_seri" => $request->no_seri,
                "jumlah_return" => $request->jumlah_saat_ini - $request->jumlah_barang_kurang,
                ]);
            
            // edit barang baru // Sudah ditest bagus
            $jumlah = $this->jumlah_barang($request->barang_id);
            Barang::where('id_barang', $request->barang_id)->update([
                "jumlah" => $jumlah + $request->jumlah_barang_kurang,
                ]);

        }
        //cek kalau data tanggal dan jumlah tambah barang return yang ada
        elseif(!empty($request->tanggal_barang_return) &&  !empty($request->jumlah_barang_tambah) && empty($request->jumlah_barang_kurang) ) {
            // echo "data tanggal dan jumlah barang tambah ada";
            // edit barang return // sudah bagus 
            Barang_Return::where('id_barang_return', $request->id_barang_return)->update([
                "kerusakan" => $request->kerusakan,
                "no_seri" => $request->no_seri,
                "status" => $request->status_barang,
                "tanggal_pengambilan" => $this->convertToTimeStamps($request->tanggal_barang_return),
                "jumlah_return" => $request->jumlah_saat_ini + $request->jumlah_barang_tambah,
                ]);
            
            // edit barang baru // Sudah ditest bagus
            $jumlah = $this->jumlah_barang($request->barang_id);
            Barang::where('id_barang', $request->barang_id)->update([
                "jumlah" => $jumlah - $request->jumlah_barang_tambah,
                ]);
        }
        //cek kalau data tanggal dan jumlah kurang barang return yang ada
        elseif(!empty($request->tanggal_barang_return) &&  empty($request->jumlah_barang_tambah) && !empty($request->jumlah_barang_kurang) ) {
            // echo "data tanggal dan jumlah barang kurang ada";
            // edit barang return // sudah bagus 
            Barang_Return::where('id_barang_return', $request->id_barang_return)->update([
                "kerusakan" => $request->kerusakan,
                "no_seri" => $request->no_seri,
                "status" => $request->status_barang,
                "tanggal_pengambilan" => $this->convertToTimeStamps($request->tanggal_barang_return),
                "jumlah_return" => $request->jumlah_saat_ini - $request->jumlah_barang_kurang,
                ]);
            
            // edit barang baru // Sudah ditest bagus
            $jumlah = $this->jumlah_barang($request->barang_id);
            Barang::where('id_barang', $request->barang_id)->update([
                "jumlah" => $jumlah + $request->jumlah_barang_kurang,
                ]);
        }
        if (auth()->user()->hasAdminRole()) {
            return redirect()->route('showDaftarBarangReturn')->with('success', 'Data Barang Return berhasil diubah');
        }else{
            return redirect()->route('showDaftarBarangReturn-kasir')->with('success', 'Data Barang Return berhasil diubah');
        }
    }
    
}

