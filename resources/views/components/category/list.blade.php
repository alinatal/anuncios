<nav class="my-menu">
    <ul class="my-nav w-100">
        @each('components.category.item', $categories, 'category')
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
