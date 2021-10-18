<header class="banner">
  <div class="container p-0">
    <nav class="navbar navbar-expand-lg">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
      </button>

      @if( isset( $acf_options->header_logo ) )

        <a class="navbar-brand" href="{{ home_url('/') }}" title="{{ get_bloginfo('name', 'display') }}">
          <img class="logo d-print-none" src="{{ $acf_options->header_logo}}" alt="{{ get_bloginfo('name', 'display') }}">
        </a>

      @else

         <a class="navbar-brand" href="{{ home_url('/') }}" title="{{ get_bloginfo('name', 'display') }}"><h1 class="no_logo">{{ get_bloginfo('name', 'display') }}</h1></a>

      @endif

      @if( isset( $acf_options->show_tagline ) && $acf_options->show_tagline == "Yes")

        <div class="tagline d-none d-lg-block">{{ get_bloginfo('description', 'display') }}</div>
        <span class="inner-banner vertical-line d-none d-lg-block"></span>

      @endif

      <div id="navbarToggler" class="collapse navbar-collapse">

        @if( has_nav_menu( 'primary_navigation' ) )

          {!! wp_nav_menu( $primary_menu ) !!}

        @endif

        <div class="d-flex justify-content-md-end nav-search">
          {!! get_search_form( false ) !!}
        </div>
      </div>
    </nav>
  </div>
</header>
