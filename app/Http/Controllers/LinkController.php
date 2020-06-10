<?php

namespace App\Http\Controllers;

use App\Link;
use Str;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function index()
    {
        return view('link');
    }


    public function shorten(Request $request)
    {
        $request->validate([
            'original_link' => 'required|url'
        ]);

        $token = Str::random(8);
        $short_link = \URL::to('/') . '/' . $token;

        $link = new Link();
        $link->original_link = $request->get('original_link');
        $link->short_link = $short_link;
        $link->save();

        return redirect()->route('link')->with('short_link', $short_link);
    }


    public function directLink($token)
    {
        $short_link = \URL::to('/') . '/' . $token;
        $link = Link::where('short_link', '=', $short_link)->firstOrFail();

        return redirect($link->original_link);
    }
}
