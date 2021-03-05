<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class ErrorController
 * @package App\Http\Controllers
 */
class ErrorController extends Controller
{
    /**
     * ErrorController constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return Application|Factory|View
     */
    public function error404()
    {
        return view('error404');
    }
}
