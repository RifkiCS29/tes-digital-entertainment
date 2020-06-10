<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Video;
use File;


class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = Video::latest();

        if (request()->q != '') {
            $video = $video->where('title', 'LIKE', '%' . request()->q . '%');
        }
        $video = $video->paginate(5);
        return view('videos.index', compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required',
            'file' => 'required|mimes:x-flv,mp4|max:51200' 
        ]);

        //JIKA FILENYA ADA
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            $filename = time() . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads', $filename);

            $video = Video::create([
                'title' => $request->title,
                'slug' => $request->title,
                'description' => $request->description,
                'file' => $filename, 
            ]);

            return redirect(route('videos.index'))->with(['success' => 'Video Baru Ditambahkan']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $video = Video::find($id); 
        return view('videos.edit', compact('video')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'required',
            'file' => 'nullable|mimes:x-flv,mp4|max:51200'
        ]);

        $video = Video::find($id);
        $filename = $video->file;
    
        //JIKA ADA FILE GAMBAR YANG DIKIRIM
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            //MAKA UPLOAD FILE TERSEBUT
            $file->storeAs('public/uploads', $filename);
            //DAN HAPUS FILE GAMBAR YANG LAMA
            File::delete(storage_path('app/public/uploads/' . $video->file));
        }

        $video->update([
            'title' => $request->title,
            'slug' => $request->title,
            'description' => $request->description,
            'file' => $filename,
        ]);
        return redirect(route('videos.index'))->with(['success' => 'Data Video Diperbaharui']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::find($id); 
        File::delete(storage_path('app/public/uploads/' . $video->file));
        $video->delete();
        return redirect(route('videos.index'))->with(['success' => 'Video Sudah Dihapus']);
    }
}
