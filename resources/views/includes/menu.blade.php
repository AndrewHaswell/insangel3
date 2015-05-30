<div id="navigation">
    <ul id="menu">
        @foreach ($navigation as $title => $link)

            @if (is_string($link))
                <li><a href="{{$link}}">{{$title}}</a></li>
            @else
                <li><a href="#">{{$title}}</a>
                    <ul class="sub-menu">
                        @foreach ($link as $subtitle => $sublink)
                            <li><a href="{{$sublink}}">{{$subtitle}}</a></li>
                        @endforeach
                    </ul>
            @endif
        @endforeach

    </ul>
</div>