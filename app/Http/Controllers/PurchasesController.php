<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\PurchaseRequest;
use App\Models\Purchases;
use App\Models\Services;
use Illuminate\Http\Request;

class PurchasesController extends Controller
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
        return view('admin.purchases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        dd($request->all());
        $purchase = new Purchases();
        $purchase->fill($request->all());
        $purchase->date = new \DateTime();
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchases::where('id', $id)->with(['servicePurchase', 'pricePurchase', 'tutor'])->first();
        return view('admin.purchases.edit', ['purchase' => $purchase]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PurchaseRequest $request, $id)
    {
        $purchase = Purchases::where('id', $id)->first();
        $purchase->fill($request->all());
        $purchase->save();
        return redirect()->route('finance.purchase')->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Purchases::destroy($id);
        return redirect()->route('finance.purchase')->with(['color' => 'green', 'message' => 'Deletado com sucesso!']);
    }
}
