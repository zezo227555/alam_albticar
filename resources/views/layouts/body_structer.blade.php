<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

    @include('includes.head')

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">

        @include('includes.navbar')

        @include('includes.sidebar')

        <main class="app-main p-3">
            @include('components.content_header')

            @yield('content')

        </main>
        @include('includes.footer')
    </div>

    @yield('section_modals')

    @include('includes.foot')

    @yield('costome_section_scripts')
</body>

</html>
