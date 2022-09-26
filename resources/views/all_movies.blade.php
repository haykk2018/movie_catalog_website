<x-movie.header>
    @foreach($categories as $category)
        <a href="#" onclick="w3_close(),showMoViesByCategory('{{$category->name}}')"
           class="w3-bar-item w3-button">{{$category->name}}</a>
    @endforeach
</x-movie.header>
<x-movie.content>
    <div id="movies" class="w3-row-padding w3-padding-16 w3-center">
        @if(!isset($movies) || $movies->count()==0)
            There are no movie.
        @else
        @foreach($movies as $movie)
            <div class="w3-quarter">
                <a href="movie/{{$movie->id}}"><img
                        src="{{$movie->img_src ?  url($movie->img_src): URL::asset('images/blank.jpg')}}"
                        style="width:100%"></a>
                <h3>{{$movie->title}}</h3>
                <p>{{$movie->short_description}}</p>
                <P> Genre Category:
                    @foreach($movie->categories as $category)
                        <a href="#" onclick="showMoViesByCategory('{{$category->name}}')">{{$category->name}}</a>
                    @endforeach
                </P>
            </div>
        @endforeach
        @endif
    </div>
    <div id="pagination" >{{ $movies->links() }}</div>
</x-movie.content>
<x-movie.footer>
    @foreach($categories as $category)
        <a href="#" onclick="showMoViesByCategory('{{$category->name}}')"><span class="w3-tag w3-black w3-margin-bottom">{{$category->name}}</span></a>
    @endforeach
</x-movie.footer>
