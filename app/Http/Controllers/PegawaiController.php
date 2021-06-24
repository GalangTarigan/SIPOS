<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\AddPegawaiRequest;
use App\User;
use Auth;

class PegawaiController extends Controller{


    public function formAddPegawai(){
        return view('pages.admin.tambahPegawai');
    }

    public function addPegawai(AddPegawaiRequest $request){ //menambah pegawai baru
        // dd($request);
        $user = new User();
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->alamat = $request->alamat;
        $user->no_telepon = $request->no_telepon;
        $user->role = $request->posisi_pegawai;
        $user->verified = 1;
        $user->save();
        return redirect()->route('showPegawai')->with('success', 'Pegawai Baru berhasil ditambah');
    }

    public function showPegawai(){
        
        if (auth()->user()->hasAdminRole()) {            
            return view('pages.admin.daftarPegawai');
        }else{
            return view('pages.kasir.daftarPegawai-kasir');
        } 
    }

    public function showPegawaiSuccess(){
        return redirect()->route('showPegawai')->with('success', 'Pegawai berhasil diubah');
    }

    public function deletePegawaiSuccess(){
        return redirect()->route('showPegawai')->with('success', 'Pegawai berhasil dihapus');
    }

    
    public function listPegawai(Request $request){
        $data = User::select('nama_lengkap','email','no_telepon', 'role', 'id' , 'alamat')->where('id', '!=',Auth::user()->id)->get();
        foreach ($data as $key){
                if ($key->role == 'default'){
                    $key->posisi = 'Pegawai Biasa';
                }elseif ($key->role == 'kasir'){
                    $key->posisi = 'Kasir';
                }else{
                    $key->posisi = 'Admin';
                }
        }
        return $data;
    }

    public function deletePegawai(Request $request){
        User::where('id', $request->id)->delete();
        return response()->json([
            'status' => true,
            'data' => 'Teknisi berhasil dihapus!!!',
        ]);
    }

    public function showEditPegawai(Request $request){

        $userProfile = User::where('id', $request->id)->first();
        
            if ($userProfile->role == 'default'){
                $userProfile->posisi = 'Pegawai Biasa';
            }elseif ($userProfile->role == 'kasir'){
                $userProfile->posisi = 'Kasir';
            }else{
                $userProfile->posisi = 'Admin';
            }
        
        // return $userProfile;
        return view('pages.admin.editPegawai', compact('userProfile'));
    }

    public function editPegawai(Request $request){
        
        if(!empty( $request->posisi_pegawai)){
            // echo($request->user_id);
            User::where('id', $request->user_id)->update([
                "no_telepon" => $request->no_telepon,
                "alamat" => $request->alamat,
                "role" => $request->posisi_pegawai,
            ]);
        }else{
            // echo('data posisi ga ada bang');
            User::where('id', $request->user_id)->update([
                "no_telepon" => $request->no_telepon,
                "alamat" => $request->alamat,
            ]);
        }
        return redirect()->route('showPegawai')->with('success', 'Pegawai berhasil diubah');    

    }

    public function detailPegawaiStatusAdmin(Request $request){
        $userProfile = User::select('nama_lengkap', 'email', 'no_telepon', 'alamat', 'foto')->where('id', $request->name)->get();
        return view('pages.admin.detailPegawaiStatusAdmin')->with('data', $userProfile);
    }




    public function coba(Request $request){
        dd($request);
    }
}