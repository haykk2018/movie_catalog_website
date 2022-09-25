<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog Movie Site</title>
    @vite(['resources/js/app.js'])
</head>
<body class="container">
<a href="/admin" class="btn btn-primary">Home Admin</a>
<br>
<div class="row">
    <div class="col"></div>
    <div class="col">
        @foreach($categories as $category)
            <p>
                <input type="text" name="category" id="category" value="{{$category->name}} " readonly/>
            <form action="/admin/category/{{$category->id}}" method="POST" enctype="multipart/form-data">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-primary">delete</button>
                <a href="/admin/category/{{$category->id}}/edit/" class="btn btn-primary">edit</a>

            </form>
            </p>
        @endforeach
    </div>
    <div class="col"></div>
    <br>
    <hr>
    <p><a class="btn btn-primary" href="/admin/category/create">new category</a></p>
</div>
</body>
</html>
