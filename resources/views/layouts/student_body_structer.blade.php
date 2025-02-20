<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>

    @include('includes.head')

    <style>
        .accordion-button::after {
            margin-left: 0;
        }
    </style>

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">

    <div class="app-wrapper">

        @include('includes.student_navbar')

        @include('includes.student_sidebar')

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
