{{--
@foreach($categories as $category)
    <li>
        <a href="{{route('ads.create', ['category'=>$category->id])}}" class="btn btn-block btn-success mt-2 text-decoration-none text-left" >
            <span class="ml-2">{{$category->name}}</span>
        </a>

    @if($category->children->count())
        <ul>
            @include ('tree', ['categories' => $category->children])
        </ul>
    @endif
    </li>
@endforeach
--}}

<li>
    <a href="{{route('ads.create', ['category'=>$category->id])}}" class="btn btn-block btn-success mt-2 text-decoration-none text-left" >
        <span class="ml-2">{{$category->name}}</span>
    </a>

    @if($category->children->count())
        <ul>
            @each('tree', $category->children, 'category')
        </ul>
    @endif
</li>
