<?php

namespace App\Http\Controllers;

use App\Animais;
use App\Donos;
use App\Http\Requests\Admin\RegistroRequest;
use App\Registros;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RegistrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function observacoes()
    {
        $buscas = Registros::where('observacoes', '!=', null)->with(['registrosAnimal', 'tutorAnimal'])->latest()->take(100)->get();
        return view('admin.registros.observacoes', ['buscas'=>$buscas]);
    }

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
            $buscas = Registros::whereYear('entrada', '=', date("Y"))->whereMonth('entrada', '=', $request->mes)->with(['registrosAnimal', 'tutorAnimal'])->get();
            return view('admin.registros.relatorios', ['buscas' => $buscas, 'mes' => $request->mes]);
        }

        if ($request->ano) {
            $buscas = Registros::whereYear('entrada', '=', $request->ano)->with(['registrosAnimal', 'tutorAnimal'])->get();
            return view('admin.registros.relatorios', ['buscas' => $buscas, 'ano' => $request->ano]);
        }

        if (($request->data_inicio) || ($request->data_termino)) {
            $request->validate([
                'data_inicio' => 'required'
            ]);
            if (empty($request->data_termino)) {
                $request->data_termino = date('d/m/Y');
            }
            $buscas = Registros::where('entrada', '>=', $this->convertStringToDate($request->data_inicio))->where('saida', '<=', $this->convertStringToDate($request->data_termino))->orWhere('saida', null)->with(['registrosAnimal', 'tutorAnimal'])->get();
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
//            $tutor = Donos::where('id', $request->tutor_id)->with(['animaisDono', 'registrosTutor'])->first();
            if (!empty($request->animal_id)) {
                $tutor = Donos::where('id', $request->tutor_id)->first();
                $buscas = Registros::where('animal_id', $request->animal_id)->where('entrada', '>=', $this->convertStringToDate($request->data_inicio))->where('entrada', '<=', $this->convertStringToDate($request->data_termino))->with(['registrosAnimal', 'tutorAnimal'])->get();
                return view('admin.registros.tutor', ['tutor' => $tutor, 'buscas' => $buscas, 'inicio' => $request->data_inicio, 'termino' => $request->data_termino]);
            }
            $tutor = Donos::where('id', $request->tutor_id)->first();
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
        $registros = Registros::whereYear('entrada', '=', date('Y'))->with(['registrosAnimal', 'tutorAnimal', 'animalCategoria'])->latest()->take(500)->get();
        return view('admin.registros.index', ['registros' => $registros]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $date = Carbon::now();
//        $date = $this->diaria('2021-06-12 07:46:00', '2021-06-17 05:46:19');
        $reg = Registros::where('saida', null)->with(['registrosAnimal', 'tutorAnimal'])->get();
        foreach ($reg as $registros) {
            $cont = $registros->diaria($registros->entrada, $date);
            $registros->daycare = $cont->daycare;
            $registros->nightcare = $cont->nightcare;
            $registros->fds = $cont->fds;
        }
        return view('admin.registros.create', ['reg' => $reg]);
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
            $date = Carbon::now();
            $cont = $registro->diaria($registro->entrada, $date);

            $registro->saida = new \DateTime();
            $registro->daycare = $cont->daycare;
            $registro->nightcare = $cont->nightcare;
            $registro->fds = $cont->fds;
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
        if (Auth::user()->admin == 1) {
            $registro = Registros::where('id', $id)->with(['registrosAnimal', 'tutorAnimal'])->first();
            return view('admin.registros.edit', ['registro' => $registro]);
        }

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
        dd($request->all());
        if (Auth::user()->admin == 1) {
            $registro = Registros::where('id', $id)->first();
            $registro->fill($request->all());
            $registro->entrada = str_replace('T', ' ', $request->entrada);
//            $registro->entrada = \DateTime::createFromFormat('d/m/Y H:i', $request->entrada);
            if (!empty($registro->saida)) {
                $registro->saida = str_replace('T', ' ', $request->saida);
//                $registro->saida = \DateTime::createFromFormat('d/m/Y H:i', $request->saida);
            }

            $cont = $registro->diaria($registro->entrada, $registro->saida);
            $registro->daycare = $cont->daycare;
            $registro->nightcare = $cont->nightcare;
            $registro->fds = $cont->fds;

            $registro->save();
            return redirect()->back()->with(['color' => 'green', 'message' => 'Editado com sucesso.']);
        }

        $registro = Registros::where('id', $id)->first();
        $registro->observacoes = $request->observacoes;
        $registro->save();

        return redirect()->route('registros.create')->with(['color' => 'green', 'message' => 'Observação criada.']);


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
