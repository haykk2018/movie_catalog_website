@if ($paginator->hasPages())
    <div class="w3-center w3-padding-32">
        <div class="w3-bar">
            <a href="{{ $paginator->previousPageUrl() }}" class="w3-bar-item w3-button w3-hover-black">«</a>
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a href="{{ $url }}" class="w3-bar-item w3-black w3-button">{{ $page }}</a>
                            {{--                            <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>--}}
                        @else
                            <a href="{{ $url }}" class="w3-bar-item w3-button w3-hover-black">{{ $page }}</a>
                            {{--                            <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>--}}

                        @endif
                    @endforeach
                @endif
            @endforeach
            <a href="{{ $paginator->nextPageUrl() }}" class="w3-bar-item w3-button w3-hover-black">»</a>
        </div>
    </div>
@endif
