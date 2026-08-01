<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MPhysical;
use App\Models\MUnit;

class GeneratePhysical extends Command
{
    protected $signature = 'physical:generate';

    protected $description = 'Generate data Physical setiap awal bulan';

    public function handle()
    {
        $periode = now()->format('Y-m');

        $jumlahHari = now()->daysInMonth;

        $planMenit = $jumlahHari * 24 * 60;

        $units = MUnit::where('flag_aktif', 'Y')->get();

        foreach ($units as $unit) {

            $cek = MPhysical::where('periode', $periode)
                ->where('kdunit', $unit->kdunit)
                ->exists();

            if (!$cek) {

                MPhysical::create([

                    'periode'          => $periode,

                    'kdunit'           => $unit->kdunit,

                    'idcbu'            => $unit->idcbu,

                    'idregion'         => $unit->idregion,

                    'idsitename'       => $unit->idsitename,

                    'harikerja'        => $jumlahHari,

                    'planunitkerja'    => $planMenit,

                    'totalbreakdown'   => 0,

                    'totalbackup'      => 0,

                    'totaljamkerja'    => $planMenit,

                    'paforklift'       => 100

                ]);

            }

        }

        $this->info('Generate Physical berhasil.');
    }
}