<li class="list-group-item border-0 m-0 p-0">
    <a href="{{route('category.show', ['category'=>$category->slug])}}" class="" >
        <span class="ml-2">{{$category->name}}</span>
    </a>

    @if($category->children->count())
        <ul class="list-group list-group-flush border-0 m-2 p-1">
            @each('components.category.item_show', $category->children, 'category')
        </ul>
    @endif
</li>
