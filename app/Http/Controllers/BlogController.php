<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Show listing according to params
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request) : View
    {
        $posts = DB::table('posts');

        if (!empty($request->input('title'))) {
            $posts->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if (!empty($request->input('body'))) {
            $posts->where('body', 'like', '%' . $request->input('body') . '%');
        }

        if (!empty($request->input('email'))) {
            $posts->where('user_id', User::where('email', $request->input('email'))->first()->id);
        }

        if (!empty($request->input('dateFrom'))) {
            $posts->whereDate('created_at', '>=', Carbon::createFromDate($request->input('dateFrom')));
        }

        if (!empty($request->input('dateTo'))) {
            $posts->whereDate('created_at', '<=', Carbon::createFromDate($request->input('dateTo')));
        }

        $posts = $posts->paginate(10);

        return view('post.listing', ['posts' => $posts]);
    }
}
