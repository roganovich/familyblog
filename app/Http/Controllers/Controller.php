<?php

namespace App\Http\Controllers;

use Encore\Admin\Facades\Admin;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    private $layout = 'layouts.moderate';
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $locale;
    protected $auth;

    public function __construct(Request $request)
    {
        $this->auth = Admin::user();
        $this->locale = app()->getLocale();
        $this->share();
    }

    /**
     * shere
     *
     * @return void
     */
    private function share()
    {
        View::share([
            'locale' => $this->locale,
            'auth' => $this->auth,
            'layout'=>$this->layout,
        ]);
    }
}
