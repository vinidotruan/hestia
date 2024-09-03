<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        return view('client');
    }
}
