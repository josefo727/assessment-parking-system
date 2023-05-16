<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class RecordController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('records.index');
    }
}