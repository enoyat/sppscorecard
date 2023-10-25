<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MOrder extends Model
{

    use HasFactory;
    protected $table = 'orders';

    #kalau kolom primary keynya bernama id, maka baris dibawah ini boleh diisi, dan boleh juga tidak buat
    protected $primaryKey = 'noorder';
    public $incrementing = false;
    public $timestamps = false;
    // In Laravel 6.0+ make sure to also set $keyType
    //protected $keyType = 'string';
    public function getdetailorder(){
        return $this->hasMany(MDetailorder::class,'noorder','noorder');
    }
    public function getmekanik(){
        return $this->belongsTo(MUser::class,'email','email');
    }
    public function getaccsite(){
        return $this->belongsTo(MUser::class,'emailaccsite','email');
    }
    public function getaccho(){
        return $this->belongsTo(MUser::class,'emailaccho','email');
    }
    public function getaccgudang(){
        return $this->belongsTo(MUser::class,'emailaccgudang','email');
    }
    public function scopeStatus($query,$status){
        return $query->where('f_status',$status);
    }
    public function getsitename(){
        return $this->belongsTo(MSitename::class,'idsitename','id');
    }


}
