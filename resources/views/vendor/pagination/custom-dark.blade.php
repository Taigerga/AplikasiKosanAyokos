@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation">
        <ul class="flex items-center space-x-2">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="px-3 py-1.5 border-2 border-black bg-gray-200 text-gray-500 font-black cursor-not-allowed">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" 
                       class="px-3 py-1.5 border-2 border-black bg-white text-black font-black shadow-[2px_2px_0px_#000] hover:bg-yellow-400 hover:shadow-[3px_3px_0px_#000] transition-all">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li>
                        <span class="px-3 py-1.5 text-gray-600 font-black">...</span>
                    </li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span class="px-3 py-1.5 bg-yellow-400 border-2 border-black text-black font-black shadow-[2px_2px_0px_#000]">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" 
                                   class="px-3 py-1.5 border-2 border-black bg-white text-black font-black shadow-[2px_2px_0px_#000] hover:bg-yellow-400 hover:shadow-[3px_3px_0px_#000] transition-all">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" 
                       class="px-3 py-1.5 border-2 border-black bg-white text-black font-black shadow-[2px_2px_0px_#000] hover:bg-yellow-400 hover:shadow-[3px_3px_0px_#000] transition-all">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            @else
                <li>
                    <span class="px-3 py-1.5 border-2 border-black bg-gray-200 text-gray-500 font-black cursor-not-allowed">
                        <i class="fas fa-chevron-right"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
