<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Socialite;

class HomeController extends Controller
{

    public function index()
    {

        return Redirect::to('login/GTR1234');
    }

    public function download()
    {
        return View::make('admin.content.cliente.download');
    }

    public function download2()
    {
        return View::make('admin.content.cliente.download2');
    }

    public function download3()
    {
        return View::make('admin.content.cliente.download3');
    }

    public function download4()
    {
        return View::make('admin.content.cliente.download4');
    }

    public function download5()
    {
        return View::make('admin.content.cliente.download5');
    }

    public function download6()
    {
        return View::make('admin.content.cliente.download6');
    }

    public function download7()
    {
        return View::make('admin.content.cliente.download7');
    }

    public function login($token)
    {
        $accesso = DB::select('SELECT * from ditta where token = \'GTR1234\' ');
        if (sizeof($accesso) > 0) {
            session(['ditta' => $accesso[0]->token]);
            session()->save();
                return Redirect::to('cliente/index');

        } else {
            return View::make('autorization');
        }

    }

}
