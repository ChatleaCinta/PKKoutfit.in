<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    protected $table = "jenis";
    protected $primaryKey = "id";
    protected $fillable = ['nama_jenis', 'harga', 'stok'];
    public $timestamps = false;

    public function Jenis(){
        return $this->HasMany('App/Jenis','id');
    }

}
