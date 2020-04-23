<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "transaksi";
    protected $primaryKey = "id";
    protected $fillable = ['id_petugas', 'id_pembeli', 'tgl_transaksi'];
    public $timestamps = false;

    public function Petugas(){
        return $this->belongsTo('App\Petugas', 'id_petugas');
    }
    public function Pembeli(){
        return $this->belongsTo('App\Pembeli', 'id_pembeli');
    }
    public function Detail(){
        return $this->HasMany('App\Detail', 'id');
    }

}
