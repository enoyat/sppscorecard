<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class MPhysical extends Model
{

    use HasFactory;
    protected $table = 'physicalavailable';

    #kalau kolom primary keynya bernama id, maka baris dibawah ini boleh diisi, dan boleh juga tidak buat
    protected $primaryKey = 'id';
    public $incrementing  = false;
    public $timestamps    = false;
    // In Laravel 6.0+ make sure to also set $keyType
    //protected $keyType = 'string';

    protected $guarded = [];
    public function getcbu()
    {
        return $this->belongsTo(MSitename::class, 'idcbu', 'id');
    }
    public function getregion()
    {
        return $this->belongsTo(MSitename::class, 'idregion', 'id');
    }
    public function getsitename()
    {
        return $this->belongsTo(MSitename::class, 'idsitename', 'id');
    }
    public function getforklifttype()
    {
        return $this->belongsTo(MForklifttype::class, 'idforklifttype', 'id');
    }
    public function getunit()
    {
        return $this->belongsTo(MUnit::class, 'kdunit', 'kdunit');
    }

    public function getPlanUnitKerjaAttribute()
    {
        return Carbon::createFromFormat(
            'Y-m',
            $this->periode
        )->daysInMonth
             *
            24
             *
            60;
    }
    public function getTotalBreakdownAttribute()
    {
        return MTroubleaction::where('periode', $this->periode)
            ->where('kdunit', $this->kdunit)
            ->sum('lapsetime');
    }
    public function getTotalBackupAttribute()
{
    return MTroubleaction::where('periode',$this->periode)
        ->where('kdunit',$this->kdunit)
        ->sum('backup_minutes');
}
    public function getTotalWorkingAttribute()
    {
        return
        $this->planunitkerja
         -
        $this->totalbreakdown
        + $this->totalbackup;

    }
    public function getPaforkliftAttribute()
    {
        if ($this->planunitkerja == 0) {
            return 0;
        }

        return round(

            (
                $this->totalworking
                /
                $this->planunitkerja
            ) * 100

            , 2);
    }

}
