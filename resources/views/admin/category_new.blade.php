<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog Movie Site</title>
</head>
<body>
<div>
    <form action="/admin/category" method="POST">
        @csrf
        <p><input name="name" id="name" value="" type="text"/></p>
        <p>
        <P>
            <button type="submit">save</button>
        </P>
    </form>
</div>
</body>
</html>
