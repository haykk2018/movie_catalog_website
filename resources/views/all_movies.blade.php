<x-movie.header>
    @foreach($categories as $category)
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button">{{$category->name}}</a>
    @endforeach
</x-movie.header>
<x-movie.content>
    <div class="w3-row-padding w3-padding-16 w3-center" id="food">
    @foreach($movies as $movie)
        <div class="w3-quarter">
            <img src="{{$movie->img_src ?  url($movie->img_src): URL::asset('images/blank.jpg')}}" style="width:100%">
            <h3>{{$movie->title}}</h3>
            <p>{{$movie->short_description}}</p>
            <P> Genre Category:
            @foreach($movie->categories as $category)
                <a href="#">{{$category->name}}</a>
            @endforeach
            </P>
        </div>
    @endforeach
    </div>
    {{ $movies->links() }}
</x-movie.content>
<x-movie.footer>
    @foreach($categories as $category)
        <a href="#"><span class="w3-tag w3-black w3-margin-bottom">{{$category->name}}</span></a>
    @endforeach
</x-movie.footer>
