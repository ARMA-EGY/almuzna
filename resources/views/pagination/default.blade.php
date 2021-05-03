    
    
    @if ($paginator['lastPage'] > 1)
        <ul style="display: inline-block;float: none;width: auto;">
            <li class="prev {{ ($paginator['currentPage'] == 1) ? ' disabled' : '' }}">
                <a href="{{ $paginator['url'] }}?page=1"></a>
            </li>
            @for ($i = 1; $i <= $paginator['lastPage']; $i++)
                <li class="{{ ($paginator['currentPage'] == $i) ? ' current' : '' }}">
                    <a href="{{ $paginator['url'] }}?page={{$i}}">{{ $i }}</a>
                </li>
            @endfor
            <li class="next {{ ($paginator['currentPage'] == $paginator['lastPage']) ? ' disabled' : '' }}">
                <a href="{{ $paginator['url'] }}?page={{$paginator['currentPage']+1}}" ></a>
            </li>
        </ul>
    @endif