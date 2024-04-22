<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MPenalty extends Model
{

    use HasFactory;
    protected $table = 'penalty';

    #kalau kolom primary keynya bernama id, maka baris dibawah ini boleh diisi, dan boleh juga tidak buat
    protected $primaryKey = 'idpenalty';
    public $timestamps = false;
    protected $guarded = [];

    public function getcbu(){
        return $this->belongsTo(MSitename::class,'idcbu','id');
    }
    public function getregion(){
        return $this->belongsTo(MSitename::class,'idregion','id');
    }
    public function getsitename(){
        return $this->belongsTo(MSitename::class,'idsitename','id');
    }
    public function getunit(){
        return $this->belongsTo(MUnit::class,'kdunit','kdunit');
    }
    // In Laravel 6.0+ make sure to also set $keyType
    //protected $keyType = 'string';

}
