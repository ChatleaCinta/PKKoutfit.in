<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Pembeli;
use Auth;


class PembeliController extends Controller
{
    public function index($id){
        $pembeli=DB::table('pembeli')
        ->where('pembeli.id',$id)
        ->get();
        return response()->json($pembeli); 
}
    public function store(Request $req){
    if(Auth::user()->level=="admin"){
    $validator = Validator::make($req->all(),
    [
        'nama_pembeli' => 'required',
        'alamat' => 'required',
        'telp' => 'required',
        'username' => 'required',
        'foto' => 'required'
    ]);
    if($validator->fails()){
        return Response()->json($validator->errors()->toJson(),400);
    }

    $simpan = Pembeli::create([
        'nama_pembeli' => $req->nama_pembeli,
        'alamat' => $req->alamat,
        'telp' => $req->telp,
        'username' => $req->username,
        'foto' => $req->foto
    ]);
    $status = 1;
    $message = "Data pembeli berhasil ditambahkan";
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
        'nama_pembeli' => 'required',
        'alamat' => 'required',
        'telp' => 'required',
        'username' => 'required',
        'foto' => 'required'
    ]);
    if($validator->fails()){
        return Response()->json($validator->errors()->toJson(),400);
    }
    $ubah=Pembeli::where('id',$id)->update([
        'nama_pembeli' => $req->nama_pembeli,
        'alamat' => $req->alamat,
        'telp' => $req->telp,
        'username' => $req->username,
        'foto' => $req->foto
    ]);
    $status = 1;
    $message = "Data pembeli berhasil diubah";
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
    $data = Pembeli::get();
    $count = $data->count();
    $pembeli = array();
    foreach ($data as $d){

        $pembeli[] = array(
            'id' => $d->id,
            'nama_pembeli' => $d->nama_pembeli,
            'alamat' => $d->alamat,
            'telp' => $d->telp,
            'username' => $d->username,
            'foto' => $d->foto
        );
    }
    return Response()->json(compact('pembeli','count'));
}
public function destroy($id)
{
    if(Auth::user()->level=="admin"){
    $hapus=Pembeli::where('id',$id)->delete();
    $status = 1;
    $message = "Data pembeli berhasil dihapus";
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
