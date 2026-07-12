<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MSitename;
use Illuminate\Http\Request;

class UserSiteController extends Controller
{
    public function index()
    {
        $mechanics = User::where('roles_id', 3)
            ->with('sites')
            ->get();

        return view('usersite.index', compact('mechanics'));
    }

    public function create()
    {
        $mechanics = User::where('level', 3)->get();
        $sites = MSitename::orderBy('namasite')->get();

        return view('usersite.create', compact('mechanics', 'sites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'site_id' => 'required|array'
        ]);

        $user = User::findOrFail($request->user_id);

        $user->sites()->sync($request->site_id);

        return redirect()->route('usersite.index')
            ->with('success', 'Otorisasi berhasil disimpan');
    }

    public function edit(User $usersite)
    {
        $mechanics = User::where('roles_id', 3)->get();

        $sites = MSitename::kategori('sitename')->orderby('namasitename')->get();

        $selected = $usersite->sites->pluck('id')->toArray();

        return view(
            'usersite.edit',
            compact(
                'usersite',
                'mechanics',
                'sites',
                'selected'
            )
        );
    }

    public function update(Request $request, User $usersite)
    {
        $usersite->sites()->sync($request->site_id);

        return redirect()->route('usersite.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(User $usersite)
    {
        $usersite->sites()->detach();

        return back()->with('success', 'Otorisasi dihapus');
    }
}
