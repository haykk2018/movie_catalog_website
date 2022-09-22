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
        <div><img src="{{$movie->img_src ?? URL::asset('images/blank.jpg')}}" alt="" width="" height=""></div>
        <div>
            @foreach($movie->categories as $category)
                <p>Category: {{$category->name}}</p>
            @endforeach
        </div>
        {{--      end categories  --}}
        <hr>
    </div>
@endforeach
</body>
</html>
