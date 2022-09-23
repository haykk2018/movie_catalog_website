<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Barryvdh\Debugbar\Facades\Debugbar;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_movies = Movie::all();
        return view('admin/all_movies', ['movies' => $all_movies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movie = new Movie();
        $categories = Category::all();
        return view('admin/movie_new', ['movie' => $movie, 'categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $movie = new Movie();
        $movie->title = $request->title;
        $movie->short_description = $request->short_description;
        $movie->save();
        $movie->refresh();
        $movie->categories()->attach($request->category);
        $movie->save();
        return redirect('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(int $id): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $movie = Movie::findOrFail($id);
        $categories = Category::all();
        return view('admin/movie_edit', ['movie' => $movie, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $movie = Movie::find($request->id);
        $movie->title = $request->title;
        $movie->short_description = $request->short_description;
        $movie->categories()->detach();
        $movie->categories()->attach($request->category);
        $movie->save();
//        $movie = [];
//        $movie['id']= $request->id;
//        $movie['title'] = '"'.$request->title. '"';
//        $movie['short_description'] = '"'.$request->short_description. '"';
//        Movie::where('id', $movie['id'])->update($movie);
        return redirect('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(int $id): \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
    {
        Movie::findOrFail($id)->delete();
        return redirect('admin');
    }
}
