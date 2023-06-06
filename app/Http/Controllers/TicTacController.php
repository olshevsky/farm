<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class TicTacController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('TicTac/Index');
    }
}
