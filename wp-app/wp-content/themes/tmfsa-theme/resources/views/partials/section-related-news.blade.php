@php
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

  $args = array(
    'post_type'	      => 'news',
    'posts_per_page'  => 10,
    'order'           => 'ASC',
    'paged'           => $paged,
    'meta_query'      => array(
        array(
        'key'     => 'select_related_company', // name of custom field
        'value'   => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
        'compare' => 'LIKE'
        )
    )
  );

  $the_query = new WP_Query( $args );
@endphp

@if( $the_query->have_posts() )
<div class="row">
  <div class="col">
  <h2>Other Coverage</h2>
    <ul>

      @while( $the_query->have_posts() ) @php $the_query->the_post() @endphp


        <li>
          <a href="{{ the_permalink() }}">{{ the_title() }}</a>
        </li>

      @endwhile

    </ul>

    @include('partials/section-pagination')
  
@endif

@php wp_reset_query(); @endphp