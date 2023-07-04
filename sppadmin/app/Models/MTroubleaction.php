<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MTroubleaction extends Model
{

    use HasFactory;
    protected $table = 'troubleaction';

    #kalau kolom primary keynya bernama id, maka baris dibawah ini boleh diisi, dan boleh juga tidak buat
    protected $primaryKey = 'id';
    public $timestamps = false;
    // In Laravel 6.0+ make sure to also set $keyType
    //protected $keyType = 'string';

    protected $guarded = [];
    public function gettrouble()
    {
        return $this->belongsTo(MTrouble::class, 'trouble_id', 'id');
    }
    public function getuser()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }

}
