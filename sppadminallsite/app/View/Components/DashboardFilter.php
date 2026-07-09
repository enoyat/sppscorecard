<?php
namespace App\View\Components;

use App\Models\MSitename;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class DashboardFilter extends Component
{
    public $showPeriode;
    public $showCBU;
    public $showRegion;
    public $showSite;
    public $showForklift;

    public $cbu;
    public $region;
    public $sitename;

    public function __construct(
        $showPeriode = false,
        $showCBU = true,
        $showRegion = true,
        $showSite = true,
        $showForklift = false
    ) {

        $this->showPeriode  = $showPeriode;
        $this->showCBU      = $showCBU;
        $this->showRegion   = $showRegion;
        $this->showSite     = $showSite;
        $this->showForklift = $showForklift;

        $this->cbu = MSitename::member(Session::get('kdcustomer'))
            ->kategori('cbu')
            ->get();

        $this->region = MSitename::where('parentid', Session::get('runidcbu'))
            ->kategori('region')
            ->get();

        $this->sitename = MSitename::where('parentid', Session::get('runidregion'))
            ->kategori('sitename')
            ->get();
    }

    public function render()
    {
        return view('components.dashboard-filter');
    }
}