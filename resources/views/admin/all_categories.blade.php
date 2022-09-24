<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog Movie Site</title>
</head>
<body>
@foreach($categories as $category)
    <p>
        <input type="text" name="category" id="category" value="{{$category->name}}"/>
    <form action="/admin/category/{{$category->id}}" method="POST" enctype="multipart/form-data">
        @method('DELETE')
        @csrf
        <button type="submit">delete</button>
    </form>
    </p>
@endforeach
</body>
</html>
