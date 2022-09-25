<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $all_movies = Movie::paginate(2);
        return view('admin/all_movies', ['movies' => $all_movies]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'short_description' => 'max:250',
            'file' => 'required|mimes:img,png,jpg,jpeg,bmp|max:2048'
        ]);
        if ($validator->fails()) {
            return redirect('admin/movie/create')->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();

        $movie = $this->fillData(['title', 'short_description'], new Movie(), $validated);

        //store file and get its path
        $img_src = $this->storeFile('file', $request);

        $movie->img_src = $img_src;
        $movie->save();
        // if new movie have category, we are refreshing that can do attach (it is possible if movie stored and his id defined)
        if ($request->category) {
            $movie->refresh();
            $movie->categories()->attach($request->category);
            $movie->save();
        }

        return redirect('admin');
    }

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            //if necessary to be unique (code 'Rule::unique('movies')->ignore($id)' for update action, for create(store) only 'unique' enough
            //'title' => ['required', Rule::unique('movies')->ignore($id),'max:50'],
            'title' => ['required', 'max:50'],
            'short_description' => ['max:250'],
            'file' => 'mimes:img,png,jpg,jpeg,bmp|max:2048'
        ]);
        if ($validator->fails()) {
            $redirectLink = 'admin/movie/' . $id . '/edit';
            return redirect($redirectLink)->withErrors($validator)->withInput();
        }
        $validated = $validator->validated();

        $movie = Movie::find($id);
        $movie = $this->fillData(['title', 'short_description'], $movie, $validated);

        if ($request->hasFile('file')) {
            $img_src = $this->storeFile('file', $request);
            $movie->img_src = $img_src;
        }
        if ($request->category) {
            $movie->categories()->detach();
            $movie->categories()->attach($request->category);
        }
        $movie->save();
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

    protected function fillData(array $fields, Movie $data, $request): Movie
    {
        foreach ($fields as $v) {
            if (isset($request[$v])) {
                $data[$v] = $request[$v];
            }
        }
        return ($data);
    }
    protected function storeFile(string $fileField, $request): bool|string
    {
        $fileName = time() . '_' . $request->$fileField->getClientOriginalName();
        $img_src = $request->file($fileField)->storeAs('uploads', $fileName, 'public');
        return $img_src;
    }
}
