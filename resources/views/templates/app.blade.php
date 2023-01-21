<!DOCTYPE html>
<html lang="en" data-footer="true">

@include('templates.header')

<body>
    <div id="root">
        @include('templates.navbar')

        <main>
            @yield('content')
        </main>
        @include('templates.footer')
    </div>

    @include('templates.theme-settings')

    @include('templates.search')

    @include('templates.script')
</body>

</html>
