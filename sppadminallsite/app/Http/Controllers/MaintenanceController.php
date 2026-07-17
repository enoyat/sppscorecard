<?php

namespace App\Http\Controllers;

use App\Models\MDokumenmaintenance;
use App\Models\MMaintenance;
use App\Models\MMaintenanceaction;
use App\Models\MSitename;
use App\Models\MUnit;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MaintenanceController extends Controller {

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */

    public function index() {
        $sitename    = MSitename::member( Session::get( 'kdcustomer' ) )->kategori( 'sitename' )->get();
        $cbu         = MSitename::member( Session::get( 'kdcustomer' ) )->kategori( 'cbu' )->get();
        $maintenance = MUnit::where( 'idsitename', Session::get( 'runidsitename' ) )->get();
        return view( 'maintenance.index', compact( 'maintenance', 'cbu', 'sitename' ) );
    }

    public function create() {
        $cbu = MSitename::member( Session::get( 'kdcustomer' ) )->kategori( 'cbu' )->get();
        return view( 'maintenance.create', compact( 'cbu' ) );
    }

    public function destroy( Request $request ) {
        try {
            $id = $request->id;
            MMaintenance::where( 'id', '=', $id )->delete();

            return redirect()->route( 'maintenance.index' );
        } catch ( QueryException $ex ) {
            return redirect()->route( 'maintenance.index' );
        }
    }

    public function lang( $locale ) {
        if ( $locale ) {
            App::setLocale( $locale );
            Session::put( 'lang', $locale );
            Session::save();
            return redirect()->back()->with( 'locale', $locale );
        } else {
            return redirect()->back();
        }
    }

    public function listdokumen( $id ) {
        $dokumenmaintenance = MDokumenmaintenance::where( 'idaction', $id )->get();
        return view( 'maintenance.listdokumen', compact( 'dokumenmaintenance', 'id' ) );
    }

    public function dokumendestroy( Request $request ) {
        try {
            $id   = $request->id;
            $data = MDokumenmaintenance::where( 'id', '=', $id )->first();
            $file = $data->filename;

            $file = public_path( 'assets/inventory/' . $file );

            if ( File::exists( $file ) ) {
                File::delete( $file );
            }

            // $path = public_path() . '/assets/inventory/' . $file;
            // unlink( $path );
            MDokumenmaintenance::where( 'id', '=', $id )->delete();
            return redirect()->back();
        } catch ( QueryException $ex ) {
            return redirect()->back();
        }
    }

    public function listaction( $id ) {

        $listactions = MMaintenanceaction::where( 'kdunit', $id )->get();
        return view( 'maintenance.listaction', compact( 'listactions' ) );
    }

    public function listactionall() {
        $listactions = MMaintenanceaction::join( 'unit', 'unit.kdunit', '=', 'maintenanceaction.kdunit' )
        ->where( 'unit.idsitename', Session::get( 'runidsitename' ) )
        ->get();

        return view( 'maintenance.listaction', compact( 'listactions' ) );
    }

    public function actiondestroy( Request $request ) {
        try {
            $id = $request->id;
            MMaintenanceaction::where( 'id', '=', $id )->delete();
            return redirect()->back();
        } catch ( QueryException $ex ) {
            return redirect()->back();
        }
    }

    public function formstatus( Request $request ) {
        $id  = $request->id;
        $aid = $request->aid;
        if ( $request->aid == 'spp' ) {
            $maintenance = MMaintenanceaction::find( $id );
            return view( 'maintenance.formstatus', compact( 'maintenance', 'aid' ) );
        } else {
            $maintenance = MMaintenanceaction::find( $id );
            return view( 'maintenance.formstatuscustomer', compact( 'maintenance', 'aid' ) );
        }
    }

    public function updatestatus( Request $request ) {

        $id  = $request->id;
        $aid = $request->aid;
        if ( $request->aid == 'spp' ) {
            $request->validate( [
                'statusspp' => 'required',
            ] );
            $statusspp              = $request->statusspp;
            $maintenance            = MMaintenanceaction::find( $id );
            $maintenance->statusspp = $statusspp;
            $maintenance->save();
        } else {
            $request->validate( [
                'statuscustomer' => 'required',
            ] );
            $statuscustomer              = $request->statuscustomer;
            $maintenance                 = MMaintenanceaction::find( $id );
            $maintenance->statuscustomer = $statuscustomer;
            $maintenance->save();
        }

        return redirect()->back();
    }

    public function formaction( Request $request ) {
        $maintenance = MMaintenanceaction::findOrFail( $request->id );

        return view(
            'maintenance.formaction',
            compact( 'maintenance' )
        );
    }

    public function formcreate( Request $request ) {
        $units = MUnit::where( 'idsitename', Session::get( 'runidsitename' ) )->get();
        $mechanics = User::where( 'roles_id', '3' )->where( 'kdcustomer', Session::get( 'kdcustomer' ) )->get();

        return view(
            'maintenance.formcreate',
            compact( 'units', 'mechanics' )
        );
    }

    public function createstore( Request $request ) {
        $request->validate( [
            'kdunit' => 'required',
            'iduser' => 'required|exists:users,id',
            'shift' => 'required',
            'hm' => 'numeric',
            'actionplan' => 'nullable|string',
            'sparepart' => 'nullable|string',
            'tanggalmulai' => 'required',
            'tanggalakhir' => 'required',
        ] );

        MMaintenanceaction::create( [
            'kdunit'        => $request->kdunit,
            'iduser'        => $request->iduser,
            'shift'         => $request->shift,
            'hm'            => $request->hm,
            'actionplan'    => $request->actionplan,
            'sparepart'     => $request->sparepart,
            'tanggalmulai'  => $request->tanggalmulai,
            'tanggalakhir'  => $request->tanggalakhir,
            'statusspp' => $request->statusspp,
            'statusmekanik' => $request->statusmekanik,
            'statuscustomer' => $request->statuscustomer,
        ] );

        return redirect()->back()->with( 'success', 'Data maintenance berhasil ditambahkan.' );
    }

    public function actionupdate( Request $request, MMaintenanceaction $maintenance ) {
        $request->validate( [
            'shift'        => 'required',
            'hm'           => 'required|numeric',
            'actionplan'   => 'required',
            'sparepart'    => 'nullable',
            'tanggalmulai' => 'required',
            'tanggalakhir' => 'nullable',
        ] );

        $maintenance->update( [

            'shift'        => $request->shift,

            'hm'           => $request->hm,

            'actionplan'   => $request->actionplan,

            'sparepart'    => $request->sparepart,

            'tanggalmulai' => $request->tanggalmulai,

            'tanggalakhir' => $request->tanggalakhir,
            'statusspp' => $request->statusspp,
            'statusmekanik' => $request->statusmekanik,
            'statuscustomer' => $request->statuscustomer,

        ] );

        return redirect()
        ->route( 'maintenance.listactionall' )
        ->with( 'success', 'Data berhasil diperbarui.' );
    }

    public function dokumenstore( Request $request ) {
        $request->validate( [

            'description' => 'required',

            'images'      => 'required',

            'images.*'    => 'image|mimes:jpg,jpeg,png,webp|max:4096',

        ] );

        foreach ( $request->file( 'images' ) as $image ) {

            $filename = time() . '_' . Str::random( 5 ) . '.' . $image->extension();

            $image->move(
                public_path( 'assets/inventory' ),
                $filename
            );

            MDokumenmaintenance::create( [

                'idaction'   => $request->maintenance_id,

                'keterangan' => $request->description,

                'filename'   => $filename,

            ] );
        }

        return back()->with(
            'success',
            'Foto berhasil diupload.'
        );
    }
}