<li>

    <a href="{{($category->isLeaf()) ? route('ads.create', ['category'=>$category->id]) : '#'}}" class="btn btn-block btn-success mt-2 text-decoration-none text-left" >
        <span class="ml-2">{{$category->name}}</span>
    </a>

    @if($category->children->count())
        <ul>
            @each('components.category.item_add-ad', $category->children, 'category')
        </ul>
    @endif
</li>
