<?php

namespace App\Http\Controllers;

use App\Repositories\BlogPostRepository;
use Illuminate\Http\Request;

class SiteController extends Controller
{

    public function index()
    {
        $blogPostRepository = app(BlogPostRepository::class);
        $items = $blogPostRepository->getAllWithPaginator(12);
        return view('site.bestpages', ['items'=>$items]);
    }
}
