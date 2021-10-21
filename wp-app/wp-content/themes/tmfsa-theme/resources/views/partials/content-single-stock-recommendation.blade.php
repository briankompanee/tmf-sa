@php
    $term = get_field('select_stock_symbol');
    $company_symbol = $term->name;
    $route = 'profile/';
    $response_body = App\load_request( $route, $company_symbol);
    $api_json_objects = json_decode( $response_body, true );
@endphp

@if ( $api_json_objects )
    @foreach ( $api_json_objects as $api_json_object )

        @php
            $company_name = $api_json_object['companyName'];
            $company_logo = $api_json_object['image'];
            $company_description = $api_json_object['description'];
            $company_exchange = $api_json_object['exchange'];
            $company_industry = $api_json_object['industry'];
            $company_sector = $api_json_object['sector'];
            $company_ceo = $api_json_object['ceo'];
            $company_website = $api_json_object['website'];
        @endphp

    @endforeach

@endif

<article @php post_class('row') @endphp>
    <div class="col-md-7">

        <header>
            <h1 class="entry-title">{!! get_the_title() !!}</h1>
            @include('partials/entry-meta')
        </header>

        <div class="entry-content">
            
            @php 
                the_content()
            @endphp

        </div>
    </div>
    <div class="col-md-5">
        @if ( $api_json_objects || $api_json_objects )
            
        <div class="sidebar_info text-center">

            @if ( $company_logo )
                <img class="img-fluid logo" src="{{ $company_logo }}" alt="{{ $company_name .'logo' }}" />
            @endif

            @if ( $company_name )
                <h3>{{ $company_name }}</h3>
            @endif
            
            <div class="text-left">

                @if ( $company_exchange )
                    <div><span class="font-weight-bold">Exchange:&nbsp;</span>{{ $company_exchange }}</div>
                @endif

                @if ( $company_description )
                    <div><span class="font-weight-bold">Description:&nbsp;</span>{{ $company_description }}</div>
                @endif

                @if ( $company_industry )
                    <div><span class="font-weight-bold">Industry:&nbsp;</span>{{ $company_industry }}</div>
                @endif

                @if ( $company_sector )
                    <div><span class="font-weight-bold">Sector:&nbsp;</span>{{ $company_sector }}</div>
                @endif
                
                @if ( $company_ceo )
                    <div><span class="font-weight-bold">CEO:&nbsp;</span>{{ $company_ceo }}</div>
                @endif

                @if ( $company_website )
                    <div><span class="font-weight-bold">Website:&nbsp;</span><a href="{{ $company_website }}" target="_blank">{{ $company_website }}</a></div>
                @endif

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
