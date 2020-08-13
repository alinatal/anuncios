@foreach($list as $name => $link)
    <li class="{{($navbar) ? 'nav-item' : ''}} @if(request()->is(str_replace('/','',$link).'*')) active @endif">
        <a class="{{($navbar) ? 'nav-link' : 'text-white text-decoration-none'}}" href="{{ $link }}">
            @if($bullet)<i class="fa fa-angle-double-right"></i> @endif{{$name}}
        </a>
    </li>
@endforeach
