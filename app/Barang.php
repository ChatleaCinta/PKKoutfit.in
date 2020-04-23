<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = "barang";
    protected $primaryKey = "id";
    protected $fillable = ['id_jenis', 'merk', 'ukuran', 'foto', 'keterangan'];
    public $timestamps = false;

    public function Barang(){
    return $this->HasMany('App/Barang','id');
    }
    public function Jenis() {
        return $this->belongsTo('App/Jenis', 'id_jenis');
    }

}
