<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $locale;

    public function __construct(Request $request)
    {
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
        ]);
    }
}
