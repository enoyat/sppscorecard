<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'ticket';
    protected $primaryKey = 'id';
    protected $guarded = [];
    function getuser(){
        return $this->belongsTo(User::class,'userid','id');
    }
    function scopeNull($query){
        return $query->where('parentid',null);
    }

}
