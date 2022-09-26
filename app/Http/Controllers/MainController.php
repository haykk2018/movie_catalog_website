<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;

class MainController extends Controller
{

    public function showAllMovies(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $all_movies = Movie::paginate(4);
        $categories = Category::all();
        return view('all_movies', ['movies' => $all_movies, 'categories' => $categories]);
    }

    public function showMovie(int $id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $movie = Movie::findOrFail($id);
        $categories = Category::all();
        return view('movie', ['movie' => $movie, 'categories' => $categories]);
    }

    public function showMoViesByCategory($categoryName)
    {
        $movies = Movie::whereHas('categories', function ($q) use ($categoryName) {
            $q->where('name', '=', $categoryName);
        })->get();
        return view('ajax_movies', ['movies' => $movies]);
    }

    public function showMoViesByTitleAndCategory($title, $categoryName)
    {
        if ($categoryName != 'empty') {
            $movies = Movie::whereTitle($title)->whereHas('categories', function ($q) use ($categoryName) {
                $q->where('name', '=', $categoryName);
            })->get();
        } else {
            $movies = Movie::whereTitle($title)->get();
        }
        return view('ajax_movies', ['movies' => $movies]);
    }
}
