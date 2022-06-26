<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\RecurrencesRequest;
use App\Models\Recurrences;
use App\Models\Services;
use Illuminate\Http\Request;

class RecurrencesController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.recurrence.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RecurrencesRequest $request)
    {
        $purchase = new Recurrences();
        $purchase->fill($request->all());
        $purchase->save();
        return redirect()->route('finance.purchase')->with(['color' => 'green', 'message' => 'Cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recurrence = Recurrences::where('id', $id)->with(['service', 'tutor'])->first();
        return view('admin.recurrence.show', ['recurrence'=>$recurrence]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recurrence = Recurrences::where('id', $id)->with(['service', 'tutor'])->first();
        return view('admin.recurrence.edit', ['recurrence' => $recurrence]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RecurrencesRequest $request, $id)
    {
        $purchase = Recurrences::where('id', $id)->first();
        $purchase->fill($request->all());
        $purchase->save();
        return redirect()->route('finance.recurrence')->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Recurrences::destroy($id);
        return redirect()->route('finance.recurrence')->with(['color' => 'green', 'message' => 'Deletado com sucesso!']);
    }
}
