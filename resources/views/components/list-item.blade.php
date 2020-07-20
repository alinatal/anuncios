@foreach($list as $name => $link)
    <li class="{{($navbar) ? 'nav-item' : ''}} {{(\Request::is($link)) ? 'active' : '' }}">
        <a class="{{($navbar) ? 'nav-link' : 'text-white text-decoration-none'}}" href="{{ $link }}">
            @if($bullet)<i class="fa fa-angle-double-right"></i> @endif{{$name}}
        </a>
    </li>
@endforeach

<li class="nav-item">
    <a class="text-white text-decoration-none" href="{{ $link }}">
        <i class="fa fa-angle-double-right"></i> {{$name}}
    </a>
</li>
