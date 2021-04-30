<?php

namespace App\Http\Controllers;

use App\Donos;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DonosRequest as DonosRequest;

class DonosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donos = Donos::select('id', 'nome', 'telefone', 'cpf')->get();
        return view('admin.donos.index', ['donos' => $donos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.donos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonosRequest $request)
    {
        $donos = new Donos();
        $donos->fill($request->all());
        $donos->save();
        return redirect()->route('tutores.index', ['tutore' => $donos->id])->with(['color' => 'green', 'message' => 'Cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donos = Donos::where('id', $id)->with(['animaisDono'])->first();

        return view('admin.donos.show', ['tutore' => $donos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $donos = Donos::where('id', $id)->first();
        return view('admin.donos.edit', ['tutore' => $donos]);
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
        $donos = Donos::where('id', $id)->first();
        $donos->fill($request->all());
        $donos->save();

        return redirect()->route('tutores.index', ['tutore' => $donos->id])->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect()->back()->with(['color' => 'orange', 'message' => 'Função desabilitada.']);
//
//        Donos::find($id)->delete();
//        return redirect()->route('tutores.index')->with(['color' => 'green', 'message' => 'Tutor deletado.']);
    }
}
