<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{

    public function showAllMovies(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $all_movies = Movie::paginate(4);
        $categories = Category::all();
        return view('all_movies', ['movies' =>  $all_movies,'categories' => $categories]);
    }

    public function showMovie(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $movie = Movie::findOrFail($id);
        return view('movie', ['movie' => $movie]);
    }
}
