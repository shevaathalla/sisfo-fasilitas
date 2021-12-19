<?php

namespace App\Http\Controllers;

use App\Laboratorium;
use Illuminate\Http\Request;

class LaboratoriumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laboratoria = Laboratorium::all();

        return view('pages.laboratorium.index', compact('laboratoria'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Laboratorium::create([
            "name" => $request->name,
            "status" => "available"
        ]);

        return redirect()->route("laboratorium.index")->with('success', 'Data laboratorium berhasil dibuat');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Laboratorium  $laboratorium
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Laboratorium $laboratorium)
    {
        Laboratorium::where('id', $laboratorium->id)->update([
            "name" => $request->name,
            "status" => $request->status
        ]);

        return redirect()->route("laboratorium.index")->with('success', "Data laboratorium {$laboratorium->name} berhasil dibuat");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Laboratorium  $laboratorium
     * @return \Illuminate\Http\Response
     */
    public function destroy(Laboratorium $laboratorium)
    {
        $temp = $laboratorium;
        Laboratorium::destroy($laboratorium->id);

        return redirect()->route("laboratorium.index")->with('success', "Data laboratorium {$temp->name} berhasil dihapus");
    }
}
