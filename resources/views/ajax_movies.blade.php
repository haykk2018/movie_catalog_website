@if(!isset($movies) || $movies->count()==0)
    There are no movie.
@else
@foreach($movies as $movie)
    <div class="w3-quarter">
        <a href="movie/{{$movie->id}}">
            <img src="{{$movie->img_src ?  url($movie->img_src): URL::asset('images/blank.jpg')}}" style="width:100%"></a>
        <h3>{{$movie->title}}</h3>
        <p>{{$movie->short_description}}</p>
        <P> Genre Category:
            @foreach($movie->categories as $category)
                <a href="#">{{$category->name}}</a>
            @endforeach
        </P>
    </div>
@endforeach
@endif



