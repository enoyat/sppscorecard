<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MMekanik extends Model
{

    use HasFactory;
    protected $table = 'mekanik';

    #kalau kolom primary keynya bernama id, maka baris dibawah ini boleh diisi, dan boleh juga tidak buat
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    // In Laravel 6.0+ make sure to also set $keyType
    //protected $keyType = 'string';

    protected $guarded = [];
    public function getsitename()
    {
        return $this->belongsTo(MSitename::class,'idsitename','id');
    }
}
