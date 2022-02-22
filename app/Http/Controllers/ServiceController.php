<?php

namespace App\Http\Controllers;

use App\Helpers\Transform;
use App\Http\Requests\Admin\ServicesRequest as ServicesRequest;
use App\Models\Prices;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $query = "SELECT a.id, a.name, a.description, a.renew, a.credit_days, a.status, b.value
        FROM service a
        LEFT JOIN price b ON a.id = b.service_id
        AND b.start = (SELECT MAX(c.start) FROM price c WHERE a.id = c.service_id)";

        $service_with_price = DB::select(DB::raw($query));

        return view('admin.service.index', ['services' => $service_with_price]);
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
        $prices = Prices::where('service_id', $id)->get();
        return view('admin.service.edit', ['service' => $service, 'prices' => $prices]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServicesRequest $request, $id)
    {
        $today = new \DateTime();

        $service = Services::where('id', $id)->first();
        $service->fill($request->all());
        $service->save();

        $newPrice = Transform::convertStringToDouble($request->get("price"));
        if ($request->old_price != $newPrice) {
            $price = new Prices();
            $price->fill(["service_id" => $service->id, "value" => intval($request->get("price")), "start" => $today]);
            $price->save();
        }

        return redirect()->route('service.index', ['id' => $id])->with(['color' => 'green', 'message' => 'Modificado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return back()->with(['color' => 'green', 'message' => 'Serviço desabilitado.']);
    }

    public function search(Request $request)
    {
        $services = Services::orderby('name', 'asc')->where([
            ['name', 'like', $request->servicesSearch . '%'],
            ['status', 'active'],
        ])->with('priceService')->limit(5)->get();
        $response = array();
        foreach ($services as $service) {
            $response[] = array("value" => $service->id, "label" => $service->name, "service" => $service, "price" => $service->priceService()->latest('created_at')->first());
        }
        echo json_encode($response);
    }
}
