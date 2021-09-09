@include('layouts.partials.title')
<body>
    <div id="app">
        @include('layouts.partials.head')
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
