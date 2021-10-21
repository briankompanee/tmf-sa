@php
    $term = get_field('select_stock_symbol');
    $company_symbol = $term->name;

    $route_1 = 'quote/';
    $response_body_1 = App\load_request( $route_1, $company_symbol);
    $api_json_objects_1 = json_decode( $response_body_1, true );

    $route_2 = 'profile/';
    $response_body_2 = App\load_request( $route_2, $company_symbol);
    $api_json_objects_2 = json_decode( $response_body_2, true );

@endphp

@if ( $api_json_objects_1 )
    @foreach ( $api_json_objects_1 as $api_json_object_1 )

        @php
            $company_price = $api_json_object_1['price'];
            $company_price_change = $api_json_object_1['change'];
            $company_price_change_percentage = $api_json_object_1['changesPercentage'];
        @endphp

    @endforeach

@endif

@if ($api_json_objects_2)
    @foreach ( $api_json_objects_2 as $api_json_object_2 )

        @php
            $company_name = $api_json_object_2['companyName'];
            $company_logo = $api_json_object_2['image'];
            $company_description = $api_json_object_2['description'];
            $company_range = $api_json_object_2['range'];
            $company_beta = $api_json_object_2['beta'];
            $company_volAvg = $api_json_object_2['volAvg'];
            $company_mktCap = $api_json_object_2['mktCap'];
            $company_lastDiv = $api_json_object_2['lastDiv'];
        @endphp

    @endforeach
@endif

<article @php post_class('row') @endphp>
    <div class="col-md-8">
        <header>

            @if ( $api_json_objects_2 && $company_logo )
                <img class="img-fluid" src="{{ $company_logo }}" alt="{{ $company_name .'logo' }}" />
            @endif

            <h1 class="entry-title">{!! get_the_title() !!}</h1>

            </header>
        <div class="entry-content">

            @if ( $api_json_objects_2 && $company_description )
                <div class="company-description">{{ $company_description }}</div>
            @endif

            @php 
                the_content()
            @endphp

        </div>
    </div>
    <div class="col-md-4">
        
        @if ( $api_json_objects_1 || $api_json_objects_2 )
        
        <div class="sidebar_info text-center">
            <div class="text-left">
                @if ( $company_price )
                    <div><span class="font-weight-bold">Price:&nbsp;</span>{{ $company_price }}</div>
                @endif

                @if ( $company_price_change )
                    <div><span class="font-weight-bold">Price Change:&nbsp;</span>{{ $company_price_change }}</div>
                @endif

                @if ( $company_price_change_percentage )
                    <div><span class="font-weight-bold">Price Change in	&#37;:&nbsp;</span>{{ $company_price_change_percentage }}&#37;</div>
                @endif

                @if ( $company_range )
                    <div><span class="font-weight-bold">52 Week Range:&nbsp;</span>{{ $company_range }}</div>
                @endif

                @if ( $company_beta )
                    <div><span class="font-weight-bold">Beta:&nbsp;</span>{{ $company_beta }}</div>
                @endif
                
                @if ( $company_volAvg )
                    <div><span class="font-weight-bold">Volume Avg:&nbsp;</span>{{ $company_volAvg }}</div>
                @endif

                @if ( $company_beta )
                    <div><span class="font-weight-bold">Beta:&nbsp;</span>{{ $company_beta }}</div>
                @endif

                @if ( $company_mktCap )
                    <div><span class="font-weight-bold">Market Capitalisation:&nbsp;</span>{{ $company_mktCap }}</div>
                @endif

                @if ( $company_lastDiv) 
                    @php
                        $company_lastDiv_available = $company_lastDiv;
                    @endphp
                @else
                    @php
                        $company_lastDiv_available = 'N/A';
                    @endphp
                @endif
                    <div><span class="font-weight-bold">Last Diviend:&nbsp;</span>{{ $company_lastDiv_available }}</div>
            </div>
        </div>

        @else
            <p class="alert alert-warning" role="alert">API is unavailable at the moment.</p>
        @endif
    
    </div>
    <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
    </footer>
    @php comments_template('/partials/comments.blade.php') @endphp
</article>

@if ( !is_paged() )
    @include('partials/section-related-stock-recs')
@endif

@include('partials/section-related-news')