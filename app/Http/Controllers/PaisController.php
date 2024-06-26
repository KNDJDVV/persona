<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pais = DB::table('tb_pais')
        -> select('tb_pais.*',"tb_pais.pais_capi")
        -> get();
        
        return view('pais.index',['pais' => $pais]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pais = DB::table('tb_pais')
        ->orderBy('pais_codi')
        ->get();
        return view('pais.new', ['pais' => $pais]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pais = new Pais();
        $pais->pais_codi = $request->code;
        $pais->pais_nomb = $request->name;
        $pais->save();

        $pais = DB::table('tb_pais')
        -> select('tb_pais.*',"tb_pais.pais_capi")
        -> get();
        
        return view('pais.index',['pais' => $pais]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pais = Pais::find($id);
        $pais->delete();
        
        $pais = DB::table('tb_pais')
        -> get();
        
        return view('pais.index',['pais' => $pais]);
    }
}
