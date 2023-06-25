<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMaintenance extends Model
{

    use HasFactory;
    protected $table = 'maintenance';

    #kalau kolom primary keynya bernama id, maka baris dibawah ini boleh diisi, dan boleh juga tidak buat
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    // In Laravel 6.0+ make sure to also set $keyType
    //protected $keyType = 'string';

    protected $guarded = [];
    public function getcbu(){
        return $this->belongsTo(MCbu::class,'idcbu','id');
    }
    public function getregion(){
        return $this->belongsTo(MRegion::class,'idregion','id');
    }   
    public function getsitename(){
        return $this->belongsTo(MSitename::class,'idsitename','id');
    }
    public function getmaintenanceaction() //getmaintenanceaction itu nama fungsi yang akan dipanggil di view
    {
        return $this->hasMany(MMaintenanceaction::class, 'idmaintenance', 'id');
    }
    public function getunit() //getunit itu nama fungsi yang akan dipanggil di view
    {
        return $this->belongsTo(MUnit::class, 'idunit', 'id');
    }    
}