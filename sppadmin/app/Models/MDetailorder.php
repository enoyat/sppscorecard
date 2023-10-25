<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MDetailorder extends Model
{

    use HasFactory;
    protected $table = 'detailorder';

    #kalau kolom primary keynya bernama id, maka baris dibawah ini boleh diisi, dan boleh juga tidak buat
    protected $primaryKey = 'iddetailorder';
    public $incrementing = false;
    public $timestamps = false;
    // In Laravel 6.0+ make sure to also set $keyType
    //protected $keyType = 'string';
    public function getorder(){
        return $this->belongsTo(MOrder::class,'noorder','noorder');
    }
    public function getsparepart(){
        return $this->belongsTo(MSparepart::class,'codepart','codepart');
    }

}
