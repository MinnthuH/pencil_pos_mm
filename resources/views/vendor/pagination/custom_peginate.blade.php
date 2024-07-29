@if ($paginator->hasPages())

    <ul class="pagination pagination-rounded justify-content-end mb-3">

        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                    <span aria-hidden="true">«</span>
                    <span class="visually-hidden">Previous</span>
                </a>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    aria-label="@lang('pagination.previous')">«</a>
            </li>
        @endif

        {{-- Loop through the pagination elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @else
                        <li><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"
                    aria-label="@lang('pagination.next')">»</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span aria-hidden="true">»</span>
            </li>
        @endif

    </ul>

@endif



{{-- <li class="page-item">
            <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                <span aria-hidden="true">«</span>
                <span class="visually-hidden">Previous</span>
            </a>
        </li> --}}


{{-- <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
        <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
        <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li> --}}

{{-- <li class="page-item">
            <a class="page-link" href="javascript: void(0);" aria-label="Next">
                <span aria-hidden="true">»</span>
                <span class="visually-hidden">Next</span>
            </a>
        </li> --}}
