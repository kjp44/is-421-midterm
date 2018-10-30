<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('includes.head')

<body>
    <div id="app">
        @include('includes.menu')

            <main>
                @yield('content')
            </main>

    </div>
</body>
<footer>
    @include('includes.jsfooter')
    @include('includes.footer')
</footer>

</html>