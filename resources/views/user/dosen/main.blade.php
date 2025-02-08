@include('components.admin.header')
<body class="flex flex-col min-h-screen bg-gray-50">
    <div class="flex flex-col min-h-screen w-full overflow-x-hidden">
        @include('components.admin.navbar')

        <main class="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @yield('content')
        </main>

        @include('components.admin.footer')
    </div>
</body>
</html>
