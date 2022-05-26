
<script>
       var icommerce = {
        currentLocale: '',
        currencySymbolLeft:"",
        currencySymbolRight:"$",
        curremcyCode:"",
        curremcyValue:"",
        url:"{{url('/')}}"


    };

      @if(Module::has('Icommerce'))
        window.Laravel = {!! json_encode([
        
        'user' => Auth::user(),
        'router'    =>[
                'products_index'   => route('api.icommerce.products.index'),
              
            ],
            
        'trans' => [
            'search'    =>[
                'see_all'   =>  trans('icommerce::common.search.see_all'),
                'no_results'=>  trans('icommerce::common.search.no_results'),
            ],
            'must_login' => trans('icommerce::wishlists.alerts.must_login'),
            'cart'       => [
                'add_cart'   =>  trans('icommerce::products.alerts.add_cart'),
                'no_add_cart'   =>  trans('icommerce::products.alerts.no_add_cart'),
            ],
            'wishlist'  => [
                'add'                   =>  trans('icommerce::wishlists.alerts.add'),
                'product_in_wishlist'   =>  trans('icommerce::wishlists.alerts.product_in_wishlist'),
                'item'                  =>  trans('icommerce::cart.table.item'),
                'no_item'               =>  trans('icommerce::wishlists.messages.no_item'),
                'unit_price'            =>  trans('icommerce::cart.table.unit_price'),
                'picture'               =>  trans('icommerce::cart.table.picture'),
                'delete'                =>  trans('icommerce::wishlists.alerts.delete'),
            ],
            'wishlists'  => [
                'add'                   =>  trans('icommerce::wishlists.alerts.add'),
                'product_in_wishlist'   =>  trans('icommerce::wishlists.alerts.product_in_wishlist'),
                'item'                  =>  trans('icommerce::cart.table.item'),
                'no_item'               =>  trans('icommerce::wishlists.messages.no_item'),
                'unit_price'            =>  trans('icommerce::cart.table.unit_price'),
                'picture'               =>  trans('icommerce::cart.table.picture'),
                'delete'                =>  trans('icommerce::wishlists.alerts.delete'),
            ]
        ]
    ]) !!}
    @endif
</script>

<style>
    :root {
        --primary: {!! setting("isite::brandPrimary") !!};
        --secondary: {!! setting("isite::brandSecondary") !!};
        --success: {!! setting("isite::brandPositive") !!};
        --info: {!! setting("isite::brandInfo") !!};
        --warning: {!! setting("isite::brandWarning")  !!};
        --danger: {!! setting("isite::brandNegative") !!};
        --dark: {!! setting("isite::brandDark")  !!};
        /*--font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";*/
        /*--font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;*/
    }
</style>