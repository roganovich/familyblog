<?php

namespace App\Http\Middleware;
use App;
use Config;
use Session;
use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $locale = $request->segment(1);    # get local form url
        if(strpos($request->getPathInfo(),'assets') != false){
            return $next($request);
        }
        //check locale in languages allowed list
        if(in_array($locale,Config::get('app.locales'))){
            App::setLocale($locale);                 # set local $locale
        }else{
            $url = $request->url();
            if (count($request->segments()) > 1) {
                $url =  str_replace(parse_url($url)['path'], '/ru'.parse_url($url)['path'], $url) ;
            } else {
                $url =  '/ru' ;
            }
            return redirect($url);
        }

        return $next($request);                  # continue
    }


}
