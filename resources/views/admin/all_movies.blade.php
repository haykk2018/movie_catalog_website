<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/js/app.js'])
    <title>Catalog Movie Site</title>
</head>
<body>
<h2>Movie catalog Admin parth</h2>
@if(isset($movies) || empoty($movies))
    there are no movie
@else
@foreach($movies as $movie)
    <div>
        <div>{{$movie->title}}</div>
        <div>{{$movie->short_description}}</div>
        <div><img src="{{$movie->img_src ?  url($movie->img_src): URL::asset('images/blank.jpg')}}" alt="" width="" height=""></div>
        {{--  categories  --}}
        <div>
            @foreach($movie->categories as $category)
                <p>Category: {{$category->name}}</p>
            @endforeach
        </div>
        {{--      end categories  --}}
        <P>
            <a href="/admin/movie/{{$movie->id}}/edit/">edit</a>
        <form action="/admin/movie/{{$movie->id}}" method="POST" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-primary">delete</button>
        </form>
        </P>
    </div>
@endforeach
@endif
<hr>
<p><a class="btn btn-primary" href="/admin/movie/create">new movie</a>
<a class="btn btn-primary" href="/admin/category/create">new category</a></p>
<br>
</body>
</html>
