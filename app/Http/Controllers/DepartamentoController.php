<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;
use Illuminate\Support\Facades\DB;
class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departamento = DB::table('tb_departamento')
        -> join('tb_pais','tb_departamento.pais_codi','=','tb_pais.pais_codi')
        -> select('tb_departamento.*',"tb_pais.pais_nomb")
        -> get();
        
        return view('departamento.index',['departamentos' => $departamento]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $pais = DB::table('tb_pais')
        ->orderBy('pais_nomb')
        ->get();
        return view('departamento.new', ['pais' => $pais]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $departamento = new Departamento();
        $departamento->depa_nomb = $request->name;
        $departamento->pais_codi = $request->code;
        $departamento->save();

        $departamento = DB::table('tb_departamento')
        -> join('tb_pais','tb_departamento.pais_codi','=','tb_pais.pais_codi')
        -> select('tb_departamento.*',"tb_pais.pais_nomb")
        -> get();
        
        return view('departamento.index',['departamentos' => $departamento]);
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
        $departamento = Departamento::find($id);
        $pais = DB::table('tb_pais')
        ->orderBy('pais_nomb')
        ->get();

        return view('departamento.edit',['departamento' => $departamento, 'pais' => $pais]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $departamento = Departamento::find($id);
        $departamento->depa_nomb = $request->name;
        $departamento->pais_codi = $request->code;
        $departamento->save();

        $departamento = DB::table('tb_departamento')
        -> join('tb_pais','tb_departamento.pais_codi','=','tb_pais.pais_codi')
        -> select('tb_departamento.*',"tb_pais.pais_nomb")
        -> get();
        
        return view('departamento.index',['departamentos' => $departamento]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $departamento = Departamento::find($id);
        $departamento->delete();
        
        $departamento = DB::table('tb_departamento')
        -> join('tb_pais','tb_departamento.pais_codi','=','tb_pais.pais_codi')
        -> select('tb_departamento.*',"tb_pais.pais_nomb")
        -> get();
        
        return view('departamento.index',['departamentos' => $departamento]);
    }
}
