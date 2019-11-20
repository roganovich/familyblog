<?php

namespace App\Http\Controllers;

use Encore\Admin\Facades\Admin;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Moderate extends Controller
{
    private $layout = 'layouts.moderate';

    public function __construct(Request $request) {
        parent::__construct($request);
    }
}
