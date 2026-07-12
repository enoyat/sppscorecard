<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usersites extends Model
{
    use HasFactory;
    protected $table = 'user_sites';
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function site()
    {
        return $this->belongsTo(MSitename::class);
    }
}
