<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catalog Movie Site</title>
</head>
<body>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{--for file upload--}}
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <strong>{{ $message }}</strong>
    </div>
@endif
<div>
    <form action="/admin/movie" method="POST" enctype="multipart/form-data">
        @csrf
        <p><input name="title" id="title" value="" type="text"></p>
        <p>
    <textarea name="short_description" id="short_description">
    </textarea></p>
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
        <p> <input type="file" name="file" class="custom-file-input" id="chooseFile"></p>
        <P>
            <button type="submit">save</button>
        </P>
    </form>
</div>
<hr>
</body>
</html>
