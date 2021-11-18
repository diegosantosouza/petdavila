<?php

namespace App\Http\Controllers;

use App\Services;
use App\Prices;
use App\Http\Requests\Admin\ServicesRequest as ServicesRequest;
use App\Http\Requests\Admin\PricesRequest as PricesRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicesRequest $request)
    {
        $today = new \DateTime();

        $service = new Services();
        $service->fill($request->all());
        $service->save();

        $price = new Prices();
        $price->fill(["service_id" => $service->id, "value" => $request->get("price"), "start" => $today]);
        $price->save();

        return redirect()->route('service.index', ['id' => $service->id])->with(['color' => 'green', 'message' => 'Cadastrado com sucesso!']);
    }

    public function index()
    {
        return view('admin.service.index');
    }

    public function show($id)
    {
        return view('admin.service.show', ['id' => $id]);
    }

    public function create()
    {
        return view('admin.service.create');
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

    public function get()
    {
        //
    }
}
