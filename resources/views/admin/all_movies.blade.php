<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/js/app.js'])
    <title>Catalog Movie Site</title>
</head>
<body class="container">
<h2 style="text-align: center">Manage Movie Catalog </h2>
<div class="row">
    <div class="col-2"></div>
    <div class="col">
        @if(!isset($movies) || $movies->count()==0)
            There are no movies.
        @else
            @foreach($movies as $movie)
                <div>
                    <div>{{$movie->title}}</div>
                    <div>{{$movie->short_description}}</div>
                    <div><img width="450" high="600"
                              src="{{$movie->img_src ?  url($movie->img_src): URL::asset('images/blank.jpg')}}" alt=""
                              width="" height=""></div>
                    {{--  categories  --}}
                    <div>
                        @foreach($movie->categories as $category)
                            <p>Category: {{$category->name}}</p>
                        @endforeach
                    </div>
                    {{--      end categories  --}}
                    <P>
                    <form action="/admin/movie/{{$movie->id}}" method="POST" enctype="multipart/form-data">
                        @method('DELETE')
                        @csrf
                        <a class="btn btn-primary" href="movie/{{$movie->id}}">show</a>
                        <a class="btn btn-primary" href="/admin/movie/{{$movie->id}}/edit/">edit</a>
                        <button type="submit" class="btn btn-primary">delete</button>
                    </form>
                    </P>
                </div>
            @endforeach
        @endif
        <hr>
        <p><a class="btn btn-primary" href="/admin/movie/create">new movie</a>
            <a class="btn btn-primary" href="/admin/category/create">new category</a>
            <a class="btn btn-primary" href="/admin/categories">categories</a>
            <br>
            {{ $movies->links('pagination::bootstrap-5') }}
    </div>
    <div class="col-2"></div>

</div>
</body>
</html>
