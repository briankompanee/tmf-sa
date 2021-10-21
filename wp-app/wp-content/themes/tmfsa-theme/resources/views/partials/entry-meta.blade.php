<time class="updated" datetime="{{ get_post_time('c', true) }}">{{ get_the_date() }}</time>
<p class="byline author vcard">
    {{ __('By', 'sage') }} <a href="{{ get_author_posts_url(get_the_author_meta('ID')) }}" rel="author" class="fn">
        {{ get_the_author() }}
  </a>
</p>

@php
    $post_type  = get_post_type();
@endphp

@if ( $post_type != 'post' )

    @php
        $term       = get_field('select_stock_symbol');
        $parent_id  = $term->parent;
        $parent_term = get_term_by('term_taxonomy_id', $parent_id, $post_type);
    @endphp

    @if( $term || $parent_term )
        <p class="ticker-symbol"><span class="font-weight-bold">Symbol:&nbsp;</span>{{$parent_term->name}}:{{$term->name}}</p>
    @endif

@endif
