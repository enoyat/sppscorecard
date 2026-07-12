<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MUnitout extends Model
{

    use HasFactory;
    protected $table = 'unitout';

    #kalau kolom primary keynya bernama id, maka baris dibawah ini boleh diisi, dan boleh juga tidak buat
    protected $primaryKey = 'idmutation';
    // In Laravel 6.0+ make sure to also set $keyType
    //protected $keyType = 'string';

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
    public function getcbuasal(){
        return $this->belongsTo(MSitename::class,'idcbuasal','id');
    }
    public function getregionasal(){
        return $this->belongsTo(MSitename::class,'idregionasal','id');
    }
    public function getsitenameasal(){
        return $this->belongsTo(MSitename::class,'idsitenameasal','id');
    }
    public function getunit(){
        return $this->belongsTo(MUnit::class,'kdunit','kdunit');
    }

}
