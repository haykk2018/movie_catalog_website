<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function showAllMovies(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $all_movies = Movie::all();
        return view('all_movies', ['movies' => $all_movies]);
    }

    public function showMovie(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $movie = Movie::findOrFail($id);
        return view('movie', ['movie' => $movie]);
    }
}
