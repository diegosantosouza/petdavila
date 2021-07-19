<?php

namespace App\Http\Controllers;

use App\Donos;
use App\Financeiro;
use App\Http\Requests\Admin\FinanceiroRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(FinanceiroRequest $request)
    {
        $valor = Financeiro::create($request->all());
        $donos = Donos::where('id', $request->donos_id)->first();
        return redirect()->route('tutores.edit', ['tutore' => $donos->id])->with(['color' => 'green', 'message' => 'Registrado com sucesso!']);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tutor = Donos::where('id', $id)->with('financeiroDono')->first();
        $conta = 0;
        foreach ($tutor->financeiroDono as $financeiro) {
            $conta += $financeiro->operador . $financeiro->valor;
        }

        return view('admin.donos.financeiro', ['tutore' => $tutor, 'conta' => $conta]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
