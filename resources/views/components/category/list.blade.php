<nav class="my-menu">
    <ul class="@if($accordion)my-nav w-100 @else list-group list-group-flush  m-0 p-0 @endif">
{{--        @if($accordion)--}}
{{--            @each('components.category.item_add-ad', $data, 'category')--}}
            @foreach($categories as $category)
                    @include('components.category.item_add-ad', ['route' => $route, 'category' => $category])
            @endforeach
{{--        @else--}}
{{--            <style>--}}
{{--                .list-group-collapse li > ul li:first-child {--}}
{{--                border-top-left-radius: 0;--}}
{{--                border-top-right-radius: 0;--}}
{{--                }--}}

{{--                .list-group-collapse li > ul {--}}
{{--                margin-left: -16px;--}}
{{--                margin-right: -16px;--}}
{{--                margin-bottom: -11px;--}}
{{--                }--}}
{{--            </style>--}}
{{--            @each('components.category.item_show', $categories, 'category')--}}
{{--        @endif--}}
    </ul>
</nav>

@if($accordion)
    @section('styles')
        <link rel="stylesheet" href="/css/mgaccordion.css" />
    @endsection

    @section('scripts')
        <script src="/js/mgaccordion.js"></script>
        <script src="/js/mgaccordion_categories.js"></script>
    @endsection
@endif
