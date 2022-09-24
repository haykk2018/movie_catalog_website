<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog Movie Site</title>
</head>
<body>
<div>
    <form action="/admin/category/{{$category->id}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <p><input name="name" id="name" value="{{$category->name}}" type="text"/></p>
          <P>
            <button type="submit">save</button>
        </P>
    </form>
</div>
<hr>
</body>
</html>
