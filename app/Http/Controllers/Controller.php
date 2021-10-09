<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Route;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, ApiResponse;

    public function index()
    {
        $name = substr(Route::currentRouteName(), strpos(Route::currentRouteName(), '.') + 1);

        if (substr_count($name, '.')) $name = substr($name, 0, strrpos($name, '.'));
        else if (strpos($name, '.') !== false) $name = substr($name, 0, strpos($name, '.'));
        $name = ((strpos($name, '.') !== false) ? $name . $name : $name);
        return (request()->ajax() ? view("home.components.${name}.${name}") : view("home.pages.${name}.${name}"));
    }

    public function create()
    {
        $name = substr(Route::currentRouteName(), strpos(Route::currentRouteName(), '.') + 1);
        if (substr_count($name, '.') >= 2) $name = substr($name, 0, strrpos($name, '.'));
        return (request()->ajax() ? view("home.components.${name}") : view("home.pages.${name}"));
    }

    public function show($id, Request $request)
    {
        $name = substr(Route::currentRouteName(), strpos(Route::currentRouteName(), '.') + 1);
        if (substr_count($name, '.') >= 2) $name = substr($name, 0, strrpos($name, '.'));
        $view = (request()->ajax() ? view("home.components.${name}") : view("home.pages.${name}"));
        if (method_exists($this, 'showData')) $view->with('data', $this->showData($id, $request));
        return $view;
    }
}
