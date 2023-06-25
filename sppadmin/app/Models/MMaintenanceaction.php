<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMaintenanceaction extends Model
{

    use HasFactory;
    protected $table = 'maintenanceaction';

    #kalau kolom primary keynya bernama id, maka baris dibawah ini boleh diisi, dan boleh juga tidak buat
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    // In Laravel 6.0+ make sure to also set $keyType
    //protected $keyType = 'string';

    protected $guarded = [];
    public function getmaintenance() //getmaintenance itu nama fungsi yang akan dipanggil di view
    {
        return $this->belongsTo(MMaintenance::class, 'idmaintenance', 'id');
    }
   

}
