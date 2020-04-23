<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Barang;
use App\Jenis;
use Auth;

class BarangController extends Controller
{
    public function index($id){
        if(Auth::user()->level=="admin"){
          $barang=DB::table('barang')
          ->join('jenis','jenis.id','=','barang.id_jenis')
          ->select('barang.id','barang.merk','jenis.nama_jenis','barang.ukuran',
            'barang.foto','barang.keterangan')
          ->where('barang.id',$id)
          ->get();
          return response()->json($barang);
        }
    }
    public function store(Request $req){
        if(Auth::user()->level=="admin"){
        $validator = Validator::make($req->all(),
        [
            'id_jenis' => 'required',
            'merk' => 'required',
            'ukuran' => 'required',
            'foto' => 'required',
            'keterangan' => 'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson(),400);
        }

        $simpan = Barang::create([
            'id_jenis' => $req->id_jenis,
            'merk' => $req->merk,
            'ukuran' => $req->ukuran,
            'foto' => $req->foto,
            'keterangan' => $req->keterangan
        ]);
        $status = 1;
        $message = "Data barang berhasil ditambahkan";
        if($simpan){
            return Response()->json(compact('status', 'message'));
        }else {
            return Response()->json(['status'=> 0]);
        }
    }
    else {
        return response()->json(['status'=>'anda bukan admin']);
    }
}
    public function update($id,Request $req)
    {
        if(Auth::user()->level=="admin"){
        $validator=Validator::make($req->all(),
        [
            'id_jenis' => 'required',
            'merk' => 'required',
            'ukuran' => 'required',
            'foto' => 'required',
            'keterangan' => 'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $ubah=Barang::where('id',$id)->update([
            'id_jenis' => $req->id_jenis,
            'merk' => $req->merk,
            'ukuran' => $req->ukuran,
            'foto' => $req->foto,
            'keterangan' => $req->keterangan
        ]);
        $status = 1;
        $message = "Data barang berhasil diubah";
        if($ubah){
            return Response()->json(compact('status', 'message'));
        }else {
            return Response()->json(['status'=> 0]);
        }
    }
    else {
        return response()->json(['status'=>'anda bukan admin']);
    }
}
public function show(){
    $data=DB::table('barang')
    ->join('jenis','jenis.id','=','barang.id_jenis')
    ->select('barang.id','barang.merk','jenis.nama_jenis','barang.ukuran')
    ->get();
    $count=$data->count();
    $status=1;
    return response()->json(compact('data','status','count'));
  }
    public function destroy($id)
    {
        if(Auth::user()->level=="admin"){
        $hapus=Barang::where('id',$id)->delete();
        $status = 1;
        $message = "Data barang berhasil dihapus";
        if($hapus){
            return Response()->json(compact('status', 'message'));
        }else {
            return Response()->json(['status'=> 0]);
        }
    }
    else {
        return response()->json(['status'=>'anda bukan admin']);
    }
    }

}
