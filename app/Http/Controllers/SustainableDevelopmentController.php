<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;

class SustainableDevelopmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

     private $pageId = 2;
     private $path = "landingPage.sustainable-development.";
    public function index()
    {
        $pageId = 6;
        $page = Page::find($pageId);
        $posts = Post::where("page_id", $page->id)->get();
        return view($this->path."sustainable-development", compact('posts', 'page'));
    }
    //
}
