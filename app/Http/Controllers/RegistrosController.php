<?php

namespace App\Http\Controllers;

use App\Animais;
use App\Donos;
use App\Http\Requests\Admin\RegistroRequest;
use App\Registros;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


class RegistrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private function convertStringToDate(?string $param)
    {
        if (empty($param)) {
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d');
    }

    public function gerar(Request $request)
    {
        if ($request->mes) {
            $buscas = Registros::whereYear('entrada', '=', date("Y"))->whereMonth('entrada', '=', $request->mes)->get();
            return view('admin.registros.relatorios', ['buscas' => $buscas, 'mes' => $request->mes]);
        }

        if ($request->ano) {
            $buscas = Registros::whereYear('entrada', '=', $request->ano)->get();
            return view('admin.registros.relatorios', ['buscas' => $buscas, 'ano' => $request->ano]);
        }

        if (($request->data_inicio) || ($request->data_termino)) {
            $request->validate([
                'data_inicio' => 'required'
            ]);
            if (empty($request->data_termino)) {
                $request->data_termino = date('d/m/Y');
            }
            $buscas = Registros::where('entrada', '>=', $this->convertStringToDate($request->data_inicio))->where('saida', '<=', $this->convertStringToDate($request->data_termino))->orWhere('saida', null)->get();
            return view('admin.registros.relatorios', ['buscas' => $buscas, 'inicio' => $request->data_inicio, 'termino' => $request->data_termino]);

        }
    }

    public function relatoriosTutor(Request $request)
    {
        if (($request->data_inicio) || ($request->data_termino)) {
            $request->validate([
                'data_inicio' => 'required'
            ]);
            if (empty($request->data_termino)) {
                $request->data_termino = date('d/m/Y');
            }
            $tutor = Donos::where('id', $request->tutor_id)->first();
            if (!empty($request->animal_id)) {
                $animal = Animais::where('id', $request->animal_id)->first();
                $buscas = $animal->animalRegistros()->where('entrada', '>=', $this->convertStringToDate($request->data_inicio))->where('entrada', '<=', $this->convertStringToDate($request->data_termino))->get();
                return view('admin.registros.tutor', ['tutor' => $tutor, 'buscas' => $buscas, 'inicio' => $request->data_inicio, 'termino' => $request->data_termino]);
            }
            $buscas = $tutor->registrosTutor()->where('entrada', '>=', $this->convertStringToDate($request->data_inicio))->where('entrada', '<=', $this->convertStringToDate($request->data_termino))->get();
            return view('admin.registros.tutor', ['tutor' => $tutor, 'buscas' => $buscas, 'inicio' => $request->data_inicio, 'termino' => $request->data_termino]);
        }
    }

    public function relatorios()
    {
        return view('admin.registros.relatorios');
    }

    public function index()
    {
        $registros = Registros::whereYear('entrada', '=', date('Y'))->get();;
        return view('admin.registros.index', ['registros' => $registros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $registros = Registros::where('saida', null)->get();
        return view('admin.registros.create', ['registros' => $registros]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistroRequest $request)
    {

        $animal = Animais::where('id', $request->animal_id)->first();
        if ($animal == false) {
            return redirect()->back()->with(['color' => 'orange', 'message' => 'Entrada não efetuada, ID inválido.']);
        }

        if ($animal->id == true) {
            $registro = Registros::where('animal_id', $animal->id)->latest()->first();

            if ($registro == null || (!empty($registro->saida))) {
                $novoreg = new Registros();
                $novoreg->fill($request->all());
                $novoreg->entrada = new \DateTime();
                $novoreg->save();
                return redirect()->route('registros.create')->with(['animal' => $animal, 'color' => 'green', 'message' => 'Entrada efetuada.']);
            }

//            $hoje = new \DateTime();
//            $entrada = new \DateTime($registro->entrada);
//            $diferenca = $entrada->diff($hoje);
//        dd($diferenca);
//            if ($diferenca->i < 10) {
//                Registros::find($registro->id)->delete();
//                return redirect()->route('registros.create')->with(['animal' => $animal, 'color' => 'orange', 'message' => 'Registro deletado.']);
//            }

//            if ($diferenca->i > 10) {
            $registro->saida = new \DateTime();
            $registro->save();
            return redirect()->route('registros.create')->with(['animal' => $animal, 'color' => 'green', 'message' => 'Saída efetuada.']);
//            }
        }
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
        var_dump($request->all(), $id);
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
