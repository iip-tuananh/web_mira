
@if ($paginator->hasPages())

    <div class="th-pagination text-center pt-50">
        <ul>
            @if (!$paginator->onFirstPage())
                <li><a href="{{ $paginator->previousPageUrl() }}"><i class="far fa-arrow-left"></i></a></li>
            @endif

                @foreach ($elements as $element)
                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li><a href="#" class="active">{{ $page }}</a></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())

                    <li><a href="{{ $paginator->nextPageUrl() }}"><i class="far fa-arrow-right"></i></a></li>

                @endif


        </ul>
    </div>
@endif

