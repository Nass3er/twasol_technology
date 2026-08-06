<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

class ContactUsController extends Controller
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
    private $path = "landingPage.contact-us.";

    public function index()
    {
        try{
            $pageId = 7;
            $page = Page::findOrFail($pageId);
            $contactDetails = Post::where("page_id", $page->id)->where('active', true)
            ->with(['postDetail' => function ($query) {
                $query->orderBy('order', 'asc'); // descending
            }])
            ->get();
            $map = Post::where("page_id", 8)
                        ->where("category_id", 13)
                        ->where("active",true)
                        ->with('postDetail')
                        ->orderBy('order')
                        ->firstOrFail();

        }catch(Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        return view($this->path . "contact-us", compact('contactDetails', 'page','map'));
    }
    //
}
