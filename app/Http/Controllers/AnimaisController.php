<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Donos;
use App\Models\Animais;
use App\Support\Cropper;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AnimaisRequest;
use Illuminate\Support\Facades\Storage;

class AnimaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $animais = Animais::with(['donosAnimal','categoriaAnimal'])->get();
        return view('admin.animais.index', ['animais'=>$animais]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Donos $id)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimaisRequest $request)
    {
        $animais = Animais::create($request->all());
        if (!empty($request->file('foto'))) {
            $animais->foto = $request->file('foto')->storeAs('animais/' . $animais->id, $request->file('foto')->getClientOriginalName());
            $animais->save();
        }
        return redirect()->route('tutores.index', ['tutore' => $animais->id])->with(['color' => 'green', 'message' => 'Cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $animal = Animais::where('id', $id)->with(['donosAnimal','animalRegistros', 'categoriaAnimal'])->first();
        return view('admin.animais.show', ['animal'=>$animal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animal = Animais::where('id', $id)->with(['categoriaAnimal'])->first();
        $categorias = Categorias::all();
        return view('admin.animais.edit', ['animal' => $animal, 'categorias'=>$categorias]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $animal = Animais::where('id', $id)->first();
        if (!empty($request->file('foto'))) {
            Storage::delete($animal->foto);
            Cropper::flush($animal->foto);
            $animal->foto = '';
        }
        $animal->fill($request->all());

        if (!empty($request->file('foto'))) {
            Storage::delete($animal->foto);

            $animal->foto = $request->file('foto')->storeAs('animal/' . $animal->id, $request->file('foto')->getClientOriginalName());
        }

        $animal->save();
        return redirect()->route('animais.index', ['animai' => $animal->id])->with(['color' => 'green', 'message' => 'Atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Animais::destroy($id);
        return redirect()->route('animais.index')->with(['color' => 'green', 'message' => 'Animal deletado.']);
    }
}
