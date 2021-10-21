@php
    $stock_recs = get_posts(array(
        'posts_per_page'	=> -1,
        'post_type'	=> 'stock-recommendation',
        'meta_query' => array(
            array(
            'key' => 'select_related_company', // name of custom field
            'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
            'compare' => 'LIKE'
            )
        )
    ));
@endphp

@if( $stock_recs )
<h2>Recommendations</h2>
  <ul>

  @foreach( $stock_recs as $stock_rec )

    <li>
      <a href="{{ get_permalink( $stock_rec->ID ) }}">{{ get_the_title( $stock_rec->ID ) }}</a>
    </li>

  @endforeach

  </ul>

@endif