<?php

namespace App\Http\Controllers;

use App\Services;
use App\Prices;
use App\Http\Requests\Admin\ServicesRequest as ServicesRequest;
use App\Http\Requests\Admin\PricesRequest as PricesRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Config\Definition\Exception\Exception;

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
        $services = Services::select('id', 'name', 'description', 'renew', 'credit_days', 'status')->get();
        return view('admin.service.index', ['services' => $services]);
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
        $service = Services::where('id', $id)->first();
        return view('admin.service.edit', ['service'=>$service]);
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
        try {
//            Services::find($id)->delete();
            return back()->with(['color' => 'green', 'message' => 'Serviço deletado.']);
        } catch (Exception $exception) {
            return back()->with(['color' => 'red', 'message' => 'Erro ao deletar serviço']);
        }
    }

    public function get()
    {
        //
    }

    public function search(Request $request)
    {
        $services = Services::orderby('name', 'asc')->select(['id', 'name'])->where('name', 'like', $request->servicesSearch . '%')->latest();
        $response = array();
        foreach ($services as $service) {
            $response[] = array("value" => $service->id, "label" => $service->name);
        }
        echo json_encode($response);
    }
}
