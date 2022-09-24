<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog Movie Site</title>
</head>
<body>
<div>
    <form action="/admin/movie/{{$movie->id}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <input name="id" id="id" value="{{$movie->id}}" type="number">
        <p><input name="title" id="title" value="{{$movie->title}}" type="text"/></p>
        <p>
    <textarea name="short_description" id="short_description">
        {{$movie->short_description}}
    </textarea></p>
        <p>
        <div><img src="{{$movie->img_src ?? URL::asset('images/blank.jpg')}}" alt="" width="" height=""></div>
        </p>
        {{--  categories  --}}
        <p>
        <div>
            <p><label for="categories">Choose a categories:</label></p>

            <select name="category[]" id="categories" multiple>
                @foreach($categories as $category)
                    <option value="{{$category->id}}" @if(false)selected @endif
                    @if($movie->categories->contains($category)) selected @endif> {{$category->name}}</option>
                @endforeach
            </select>
        </div>
        </p>
        {{--      end categories  --}}
        <P>
            <button type="submit">save</button>
        </P>
    </form>
</div>
<hr>
</body>
</html>