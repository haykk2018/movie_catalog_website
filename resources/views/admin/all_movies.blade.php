<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog Movie Site</title>
</head>
<body>
@foreach($movies as $movie)
    <div>        {{--  categories  --}}

        <div>{{$movie->title}}</div>
        <div>{{$movie->short_description}}</div>
        <div>
            @foreach($movie->categories as $category)
                <p>Category: {{$category->name}}</p>
            @endforeach
        </div>
        {{--      end categories  --}}
        <P>
            <a href="/admin/movie/{{$movie->id}}/edit/">edit</a>
            <a href="/admin/movie/create">new</a>
        <form action="/admin/movie/{{$movie->id}}" method="POST" enctype="multipart/form-data">
            @method('DELETE')
            @csrf
{{--            <input name="id" id="id" value="{{$movie->id}}" type="number">--}}
            <button type="submit">delete</button>
        </form>
        </P>
    </div>
    <hr>
@endforeach
</body>
</html>
