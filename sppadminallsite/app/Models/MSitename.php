<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MSitename extends Model
{

    use HasFactory;
    protected $table = 'sitename';

    #kalau kolom primary keynya bernama id, maka baris dibawah ini boleh diisi, dan boleh juga tidak buat
    protected $primaryKey = 'id';
    public $incrementing = false;
    public $timestamps = false;
    // In Laravel 6.0+ make sure to also set $keyType
    //protected $keyType = 'string';

    protected $guarded = [];

    public function parent()
    {
        return $this->belongsTo($this, 'parentid','id');
    }
    public function children()
    {
        return $this->hasMany($this, 'parentid','id');
    }

    public function getcbu()
    {
        return $this->belongsTo(Msitename::class,'idregion','id');
    }
    public function getregion()
    {
        return $this->belongsTo(Msitename::class,'idregion','id');
    }
    public function scopeMember($query, $kdcustomer)
    {
        return $query->where('kdcustomer', $kdcustomer);
    }
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
    public function users()
    {
        return $this->hasMany(User::class, 'idsitename');
    }

}
