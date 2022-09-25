<x-movie.header>
    @foreach($categories as $category)
        <a href="#" onclick="w3_close()" class="w3-bar-item w3-button">{{$category->name}}</a>
    @endforeach
</x-movie.header>
<x-movie.content>
    <div class="w3-row-padding w3-padding-16 w3-center">
        <p>
        <h2>{{$movie->title}}</h2></p>
        <P><img height="600" src="{{$movie->img_src ?  url($movie->img_src): URL::asset('images/blank.jpg')}}">
        </P>
        <P>
        <div>{{$movie->short_description}}</div>
        </P>
        {{--  categories  --}}
        <div>
            @foreach($movie->categories as $category)
                <p>Category: {{$category->name}}</p>
            @endforeach
        </div>
        {{--      end categories  --}}
        </p>
    </div>
</x-movie.content>

<x-movie.footer>
    @foreach($categories as $category)
        <a href="#"><span class="w3-tag w3-black w3-margin-bottom">{{$category->name}}</span></a>
    @endforeach
</x-movie.footer>
