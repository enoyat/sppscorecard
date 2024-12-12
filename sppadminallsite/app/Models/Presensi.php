<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensi';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];
    public function mekanik()
    {
        return $this->belongsTo(MMekanik::class, 'idmekanik', 'id');
    }
    public function getgambar(){
        return $this->hasMany(MDokumenpresensi::class,'idaction','id');
    }


}
