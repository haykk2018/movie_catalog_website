<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\isEmpty;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $all_movies = Movie::all();
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
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:50',
            'short_description' => 'max:250'
        ]);
        if ($validator->fails()) {
            return redirect('admin/movie/create')
                ->withErrors($validator)
                ->withInput();
        }
        $validated = $validator->validated();
        $movie = $this->fillData(['title', 'short_description'], new Movie(), $validated);
        $movie->save();
        if($request->category){
            $movie->refresh();
            $movie->categories()->attach($request->category);
            $movie->save();
        }

        return redirect('admin');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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
        $validator =Validator::make($request->all(), [
            //if necessary to be unique (code 'Rule::unique('movies')->ignore($id)' for update action, for create(store) only 'unique' enough
            //'title' => ['required', Rule::unique('movies')->ignore($id),'max:50'],
            'title' => ['required','max:50'],
            'short_description'=>[]
        ]);
        if ($validator->fails()) {
            $redirectLink = 'admin/movie/'.$id.'/edit';
            return redirect($redirectLink)
                ->withErrors($validator)
                ->withInput();
        }
        $validated = $validator->validated();
        $movie = Movie::find($id);
        $movie = $this->fillData(['title', 'short_description'], $movie, $validated);
        if($request->category) {
            $movie->categories()->detach();
            $movie->categories()->attach($request->category);
            $movie->save();
        }
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

    protected function fillData($fields, $data, $request)
    {
        foreach ($fields as $v) {
            //echo'====================='.$v.'==================<br>'.$request->$v;
            if (isset($request[$v])) {
                $data[$v] = $request[$v];
                // echo'=======================================<br>'.$data[$v];
            }
        }
        return ($data);
    }
}
