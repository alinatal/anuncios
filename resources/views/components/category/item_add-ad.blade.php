<li>
    <a href="{{($category->isLeaf()) ? route($route, $category) : '#'}}" class="btn btn-block mt-2 text-decoration-none text-left" style="background-color: #0D4E60; color: white" >
        <span class="ml-2">{{$category->name}}</span>
    </a>

    @if($category->children->count())
        <ul>
            @foreach($category->children as $category)
                @include('components.category.item_add-ad', ['route' => $route, 'category' => $category])
            @endforeach

{{--            @each('components.category.item_add-ad', $category->children, 'category')--}}
        </ul>
    @endif
</li>
