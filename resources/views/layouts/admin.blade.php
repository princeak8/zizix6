@include('inc.admin.header')

    <!-- Page Container -->
    <div class="page-container">
        @include('inc.admin.sidebar')
        @yield('content')

   @include('inc.admin.footer')

   @yield('js')

   </div><!-- /Page Container -->