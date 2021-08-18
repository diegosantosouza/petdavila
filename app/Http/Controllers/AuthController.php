<?php

namespace App\Http\Controllers;

use App\Anamnese;
use App\Animal;
use App\Registros;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function chartmeses()
    {
        $charts1 = Registros::whereDate('entrada', '>=', $this->dataoperador(-12))->select(['animal_id', 'entrada'])->get();
//        $mesesCount=array();
//
//        foreach ($charts1 as $date){
//            if (date('m-Y', strtotime($date->entrada)) != end($mesesCount)){
//                $mesesCount[]= date('m-Y', strtotime($date->entrada));
//            }
//
//        }
//        $data = json_encode($mesesCount, JSON_FORCE_OBJECT);
//        dd($data);
        return $charts1;
    }

    public function dataoperador($date)
    {
        $operador = date("Y-m-d", strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . $date . "month"));
        return $operador;

    }

    public function dashboard()
    {
        $agora = Registros::where('saida', null)->count();
        $hoje = Registros::whereDate('entrada', '=', date('Y-m-d'))->count();
        $mes = Registros::whereYear('entrada', '=', date("Y"))->whereMonth('entrada', '=', date("m"))->count();
        $registros = Registros::latest()->take(50)->with(['registrosAnimal', 'tutorAnimal'])->get();


        return view('admin.dashboard', ['agora' => $agora, 'hoje' => $hoje, 'mes' => $mes, 'registros' => $registros]);

    }

    public function showLoginForm()
    {
        if (Auth::check() === true) {
            return redirect()->route('admin');
        }
        $versao = env('APP_VERSION');
        $desenvolvedor = env('APP_DEVELOPER');
        return view('admin.formLogin', ['versao' => $versao, 'desenvolvedor' => $desenvolvedor]);
    }

    public function login(Request $request)
    {

        if (in_array('', $request->only('email', 'password'))) {
            $json['message'] = $this->message->error('Informe todos os dados para efetuar o login')->render();
            return response()->json($json);
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $json['message'] = $this->message->error('Informe um e-mail válido')->render();
            return response()->json($json);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $json['redirect'] = route('admin');
            return response()->json($json);
        }

        if (!Auth::attempt($credentials)) {
            $json['message'] = $this->message->error('Usuário e senha não conferem')->render();
            return response()->json($json);
        }

//        $this->authenticated($request->getClientIp());

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin');
    }
}
