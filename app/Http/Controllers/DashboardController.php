<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    function index(Request $request) {
        $ss = $request->session()->get('loginSession');

        if(isset($ss)){
            $main = 'admin.includes.main';
            return view('admin.index', [
                'main' => $main,
                'nameModule' => '',
                'ssId' => $ss['id']
            ]);
        }
        else{
            return view('admin.error403');
        }
    }
}
