<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImagesController extends Controller
{

    public function index()
    {
        //
    }

    public function thumb($locale, $img, $width, $height) {
        if ($item = Image::find($img)) {
            $url = $item->getThumb($width, $height);
        }else{
            $url = 'images/nothumb.jpg';
        }
        $fp = fopen($url, 'rb');
        header("Content-Type: image/png");
        header("Content-Length: " . filesize($url));
        fpassthru($fp);
    }

}
