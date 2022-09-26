<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/js/app.js'])
    <title>Catalog Movie Site</title>
</head>
<body class="container">
<a href="/admin" class="btn btn-primary">Home Admin</a>
<a class="btn btn-primary" href="/admin/categories">categories</a>
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row">
    <div class="col"></div>
    <div class="col">
        <form class="mx-auto" action="/admin/category" method="POST">
            @csrf
            <p>category name:</p>
            <p><input class="form-control" name="name" id="name" value="" type="text"/></p>
            <p>
            <P>
                <button class="btn-primary btn" type="submit">save</button>
            </P>
        </form>
    </div>
    <div class="col">
        <!-- Authentication -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-primary" style="float: right">logout</button>
        </form>
    </div>
</div>
</body>
</html>
