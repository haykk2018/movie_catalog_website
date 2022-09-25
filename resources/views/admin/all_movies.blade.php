<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog Movie Site</title>
</head>
<body>
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
            <button type="submit">delete</button>
        </form>
        </P>
    </div>
    <hr>
@endforeach
<p><a href="/admin/movie/create">new</a></p>
<hr>
</body>
</html>
