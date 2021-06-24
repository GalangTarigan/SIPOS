<?php

namespace App\Http\Controllers;

use App\Model\Catatan_Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pkl\Traits\Convert;
use Faker\Provider\Base;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Model\Dokumentasi_Barang_Service;
use App\Model\Catatan_Laba_rugi;
use Carbon\Carbon;
use App\Http\Requests\EditBarangServiceRequest;

class BarangServiceController extends Controller
{
    use Convert;
    public function showTambahBarangService (){
        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.tambahBarangService');            
        }else{
            return view('pages.kasir.tambahBarangService-kasir');
        }   

    }

    public function addBarangService(Request $request){
        $data = new Catatan_Service;
        $data->nama_pelanggan = $request->nama_pelanggan;
        $data->no_telepon = $request->no_telepon;
        $data->jenis_barang = $request->jenis_barang;
        $data->permasalahan = $request->permasalahan;
        $data->kelengkapan = $request->kelengkapan;
        $data->lokasi_barang = $request->lokasi_barang;
        $data->status_barang = "Belum Selesai";        
        $data->users_id = auth()->user()->id;
        $data->save();
         
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
                $new_name = 'Barang_Service_atas_nama'.$request->nama_pelanggan.'_jenis_'. $request->jenis_barang . '_'. $rand . '.' . $photo->getClientOriginalExtension();
                $directory = 'dokumentasi/barang_service' . '/' . $new_name;
                Storage::disk('public')->put($directory, File::get($photo));
                // $uuid = (string)Uuid::generate();
                Dokumentasi_Barang_Service::create([
                    'nama_file_service' => $new_name,
                    'service_id' => $data->id_service
                ]);
                
                array_push($images_dir, $directory);
            }

            
            if (auth()->user()->hasAdminRole()) {
                return redirect()->route('showDaftarBarangService')->with('success', 'Barang service baru berhasil ditambahkan.');  
            }else{
                return redirect()->route('showDaftarBarangService-kasir')->with('success', 'Barang service baru berhasil ditambahkan.');  
            } 

        }
        // baru dibuat
        else {
            if (auth()->user()->hasAdminRole()) {
                return redirect()->route('showDaftarBarangService')->with('success', 'Barang service baru berhasil ditambahkan.');  
            }else{
                return redirect()->route('showDaftarBarangService-kasir')->with('success', 'Barang service baru berhasil ditambahkan.');  
            } 
        }
    }

    //show halaman daftar service
    public function showDaftarService(){
        $tahun = Carbon::now()->Format('Y', 'Asia/Jakarta');
        $totalService = Catatan_Service::all()->count();
        $hasilGagal = Catatan_service::where('status_barang', '=', 'Tidak dapat diperbaiki')
        ->whereYear('created_at', '=', $tahun)->count();
        $hasilBelumAmbil = Catatan_Service::where('status_barang', '=', 'Selesai, Belum diambil')
        ->whereYear('created_at', '=', $tahun)->count();
        $hasilLunas = Catatan_Service::where('status_barang', '=', 'Selesai')
        ->whereYear('created_at', '=', $tahun)->count();

        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.daftarBarangService', compact('tahun', 'totalService', 'hasilGagal', 'hasilBelumAmbil', 'hasilLunas'));                
        }else{
            return view('pages.kasir.daftarBarangService-kasir', compact('tahun', 'totalService', 'hasilGagal', 'hasilBelumAmbil', 'hasilLunas'));                
        } 
    }

    //datatable pada halaman daftar service
    public function getAllDataService(Request $request){
        $data = Catatan_Service::orderBy('created_at' ,'DESC')->get();
        return $data;
    }

    public function showEditBarangService(Request $request){
        $data = Catatan_Service::where('id_service', $request->data)->first();
        $dokumentasi = Dokumentasi_Barang_Service::where('service_id', $request->data)->get();


        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.editBarangService', compact('data', 'dokumentasi'));
        }else{
            return view('pages.kasir.editBarangService-kasir', compact('data', 'dokumentasi'));
        } 
        
    }

    public function getImageBarangService(Request $request){
        $directory= storage_path('app\public\dokumentasi\barang_service\\'. $request->nama_file);
        $file = File::get($directory);
        $type = File::mimeType($directory);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

    public function editBarangService(Request $request){

        if(!empty($request->lokasi_barang) && !empty($request->status_barang) && $request->status_barang == "Tidak dapat diperbaiki"){
            // echo "Lokasi berisi, status = tidak dapat diperbaiki";
            Catatan_Service::where('id_service', $request->id_service)->update([
                "nama_pelanggan" => $request->nama_pelanggan,
                "no_telepon" => $request->no_telepon,
                "jenis_barang" => $request->jenis_barang,
                "permasalahan" => $request->permasalahan,
                "kelengkapan" => $request->kelengkapan,
                "lokasi_barang" => $request->lokasi_barang,
                "status_barang" => $request->status_barang,
                "note_tidak_bisa_diperbaiki"=> $request->note,
                "users_id" => auth()->user()->id,
            ]);

        }elseif(!empty($request->lokasi_barang) && !empty($request->status_barang) && $request->status_barang == "Selesai, Belum diambil"){
        // echo "Lokasi berisi, status = selesai, belum diambil"; 
            Catatan_Service::where('id_service', $request->id_service)->update([
                "nama_pelanggan" => $request->nama_pelanggan,
                "no_telepon" => $request->no_telepon,
                "jenis_barang" => $request->jenis_barang,
                "permasalahan" => $request->permasalahan,
                "kelengkapan" => $request->kelengkapan,
                "lokasi_barang" => $request->lokasi_barang,
                "status_barang" => $request->status_barang,
                "total_biaya_service" => $request->total_biaya_service,
                "modal_biaya_service" => $request->modal_biaya_service,
                "status_pembayaran" => "Belum dibayar",
                "users_id" => auth()->user()->id,
                ]);
            
        }
        elseif(!empty($request->lokasi_barang) && !empty($request->status_barang) && $request->status_barang == "Selesai"){
        // echo "Lokasi berisi, status = selesai atau lunas"; 
            Catatan_Service::where('id_service', $request->id_service)->update([
                "nama_pelanggan" => $request->nama_pelanggan,
                "no_telepon" => $request->no_telepon,
                "jenis_barang" => $request->jenis_barang,
                "permasalahan" => $request->permasalahan,
                "kelengkapan" => $request->kelengkapan,
                "lokasi_barang" => $request->lokasi_barang,
                "status_barang" => $request->status_barang,
                "total_biaya_service" => $request->total_biaya_service,
                "modal_biaya_service" => $request->modal_biaya_service,
                "status_pembayaran" => $request->status_pembayaran,
                "users_id" => auth()->user()->id,
                ]);

            // untuk db catatan laba rugi
            $data = new Catatan_Laba_rugi();
            $data->service_id = $request->id_service;
            $data->keterangan = "Perbaikan barang service, " . $request->jenis_barang . " A/N " . $request->nama_pelanggan;
            $data->biaya_modal = $request->modal_biaya_service;
            $data->pendapatan = $request->total_biaya_service;
            $data->laba_transaksi = $request->total_biaya_service - $request->modal_biaya_service;
            $data->tanggal_transaksi_laba_rugi = Carbon::now()->Format('Y-m-d H:i:s', 'Asia/Jakarta');
            $data->save();
        }
        elseif(empty($request->lokasi_barang) && !empty($request->status_barang) && $request->status_barang == "Tidak dapat diperbaiki"){
            // echo "Lokasi tidak berisi, status = tidak dapat diperbaiki"; 
            Catatan_Service::where('id_service', $request->id_service)->update([
                "nama_pelanggan" => $request->nama_pelanggan,
                "no_telepon" => $request->no_telepon,
                "jenis_barang" => $request->jenis_barang,
                "permasalahan" => $request->permasalahan,
                "kelengkapan" => $request->kelengkapan,
                "status_barang" => $request->status_barang,
                "note_tidak_bisa_diperbaiki"=> $request->note,
                "users_id" => auth()->user()->id,
            ]);
        }
        elseif(empty($request->lokasi_barang) && !empty($request->status_barang) && $request->status_barang == "Selesai, Belum diambil"){
            // echo "Lokasi tidak berisi, status = selesai, belum diambil";
            Catatan_Service::where('id_service', $request->id_service)->update([
                "nama_pelanggan" => $request->nama_pelanggan,
                "no_telepon" => $request->no_telepon,
                "jenis_barang" => $request->jenis_barang,
                "permasalahan" => $request->permasalahan,
                "kelengkapan" => $request->kelengkapan,        
                "status_barang" => $request->status_barang,
                "total_biaya_service" => $request->total_biaya_service,
                "modal_biaya_service" => $request->modal_biaya_service,
                "status_pembayaran" => "Belum dibayar",
                "users_id" => auth()->user()->id,
                ]); 
        }
        elseif(empty($request->lokasi_barang) && !empty($request->status_barang) && $request->status_barang == "Selesai"){
        // echo "Lokasi tidak berisi, status = selesai, atau lunas"; 
            Catatan_Service::where('id_service', $request->id_service)->update([
                "nama_pelanggan" => $request->nama_pelanggan,
                "no_telepon" => $request->no_telepon,
                "jenis_barang" => $request->jenis_barang,
                "permasalahan" => $request->permasalahan,
                "kelengkapan" => $request->kelengkapan,
                "status_barang" => $request->status_barang,
                "total_biaya_service" => $request->total_biaya_service,
                "modal_biaya_service" => $request->modal_biaya_service,
                "status_pembayaran" => $request->status_pembayaran,
                "users_id" => auth()->user()->id,
                ]);

            // untuk db catatan laba rugi
            $data = new Catatan_Laba_rugi();
            $data->service_id = $request->id_service;
            $data->keterangan = "Perbaikan barang service, " . $request->jenis_barang . " A/N " . $request->nama_pelanggan;
            $data->biaya_modal = $request->modal_biaya_service;
            $data->pendapatan = $request->total_biaya_service;
            $data->laba_transaksi = $request->total_biaya_service - $request->modal_biaya_service;
            $data->tanggal_transaksi_laba_rugi = Carbon::now()->Format('Y-m-d H:i:s', 'Asia/Jakarta');
            $data->save();
        }

        elseif(!empty($request->lokasi_barang)){
            // echo "hanya lokasi barang yang diisi";
            Catatan_Service::where('id_service', $request->id_service)->update([
                "nama_pelanggan" => $request->nama_pelanggan,
                "no_telepon" => $request->no_telepon,
                "jenis_barang" => $request->jenis_barang,
                "permasalahan" => $request->permasalahan,
                "kelengkapan" => $request->kelengkapan,
                "lokasi_barang" => $request->lokasi_barang,
                "users_id" => auth()->user()->id,
            ]);
        }
        else {
            // echo "status dan lokasi kosong semua";
            Catatan_Service::where('id_service', $request->id_service)->update([
                "nama_pelanggan" => $request->nama_pelanggan,
                "no_telepon" => $request->no_telepon,
                "jenis_barang" => $request->jenis_barang,
                "permasalahan" => $request->permasalahan,
                "kelengkapan" => $request->kelengkapan,
                "users_id" => auth()->user()->id,
                ]);
        }

    if (auth()->user()->hasAdminRole()) {
        return redirect()->route('showDaftarBarangService')->with('success', 'Barang service berhasil diubah.');                
    }else{
        return redirect()->route('showDaftarBarangService-kasir')->with('success', 'Barang service berhasil diubah.');                
    }     

    }


    public function showDetailBarangService(Request $request){
        $data = Catatan_Service::where('id_service', $request->data)->first();
        $dokumentasi = Dokumentasi_Barang_Service::where('service_id', $request->data)->get();


        if (auth()->user()->hasAdminRole()) {
            return view('pages.admin.detailBarangService', compact('data', 'dokumentasi'));
        }else{
            return view('pages.kasir.detailBarangService-kasir', compact('data', 'dokumentasi'));
        } 

    }

    public function deleteCatatanService(Request $request){
        Catatan_Service::where('id_service', $request->data)->delete();
        return response()->json([
            'status' => true,
            'data' => 'Teknisi berhasil dihapus!!!',
        ]);
    }

    public function showDaftarSuccess(){
        
        if (auth()->user()->hasAdminRole()) {
            return redirect()->route('showDaftarBarangService')->with('success', 'Barang service telah berhasil dihapus.');    
        }else{
            return redirect()->route('showDaftarBarangService-kasir')->with('success', 'Barang service telah berhasil dihapus.');    
        } 

    }

    public function printStrukService(Request $request){
        $dataTable = Catatan_Service::where('id_service', $request->id)->get();
        return view('print.struk-service', compact('dataTable'));
    }


} //end



  // Catatan_Service::where('id_service', $request->id_service)->update([
        //     "nama_pelanggan" => $request->nama_pelanggan,
        //     "no_telepon" => $request->no_telepon,
        //     "jenis_barang" => $request->jenis_barang,
        //     "permasalahan" => $request->permasalahan,
        //     "kelengkapan" => $request->kelengkapan,
        //     "lokasi_barang" => $request->lokasi_barang,
        //     "status_barang" => $request->status_barang,
        //     "users_id" => auth()->user()->id,
        //     ]);