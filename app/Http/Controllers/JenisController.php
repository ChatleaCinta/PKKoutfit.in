<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Jenis;
use Auth;

class JenisController extends Controller
{
    public function index($id){
        $jenis=DB::table('jenis')
        ->where('jenis.id',$id)
        ->get();
        return response()->json($jenis); 
}
public function store(Request $req){
    if(Auth::user()->level=="admin"){
    $validator = Validator::make($req->all(),
    [
        'nama_jenis' => 'required',
        'harga' => 'required',
        'stok' => 'required'
    ]);
    if($validator->fails()){
        return Response()->json($validator->errors()->toJson(),400);
    }

    $simpan = Jenis::create([
        'nama_jenis' => $req->nama_jenis,
        'harga' => $req->harga,
        'stok' => $req->stok
    ]);
    $status = 1;
    $message = "Data jenis baju berhasil ditambahkan";
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
public function update($id, Request $req)
{
    if(Auth::user()->level=="admin"){
    $validator=Validator::make($req->all(),
    [
        'nama_jenis' => 'required',
        'harga' => 'required',
        'stok' => 'required'
    ]);
    if($validator->fails()){
        return Response()->json($validator->errors()->toJson(),400);
    }
    $ubah=Jenis::where('id',$id)->update([
        'nama_jenis' => $req->nama_jenis,
        'harga' => $req->harga,
        'stok' => $req->stok
    ]);
    $status = 1;
    $message = "Data jenis baju berhasil diubah";
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
    $data = Jenis::get();
    $count = $data->count();
    $jenis = array();
    foreach ($data as $d){

        $jenis[] = array(
            'id' => $d->id,
            'nama_jenis' => $d->nama_jenis,
            'harga' => $d->harga,
            'stok' => $d->stok
        );
    }
    return Response()->json(compact('jenis','count'));
}
public function destroy($id)
{
    if(Auth::user()->level=="admin"){
    $hapus=Jenis::where('id',$id)->delete();
    $status = 1;
    $message = "Data jenis baju berhasil dihapus";
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
