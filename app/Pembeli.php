<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $table = "pembeli";
    protected $primaryKey = "id";
    protected $fillable = ['nama_pembeli', 'alamat', 'telp', 'username', 'foto'];
    public $timestamps = false;

    public function Pembeli(){
    return $this->HasMany('App/Pembeli','id');
}
}