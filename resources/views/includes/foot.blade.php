<script src="{{ asset('dist/js/jquery.js') }}"></script>
<script src="{{ asset('dist/js/overlayscrollbar.js') }}"></script>

<script src="{{ asset('dist/js/popper.js') }}"></script>

<script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script>
    const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
    const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
    };
    document.addEventListener("DOMContentLoaded", function() {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
            sidebarWrapper &&
            typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
            OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                scrollbars: {
                    theme: Default.scrollbarTheme,
                    autoHide: Default.scrollbarAutoHide,
                    clickScroll: Default.scrollbarClickScroll,
                },
            });
        }
    });
</script>

<script>
    // Color Mode Toggler
    (() => {
        "use strict";

        const storedTheme = localStorage.getItem("theme");

        const getPreferredTheme = () => {
            if (storedTheme) {
                return storedTheme;
            }

            return window.matchMedia("(prefers-color-scheme: dark)").matches ?
                "dark" :
                "light";
        };

        const setTheme = function(theme) {
            if (
                theme === "auto" &&
                window.matchMedia("(prefers-color-scheme: dark)").matches
            ) {
                document.documentElement.setAttribute("data-bs-theme", "dark");
            } else {
                document.documentElement.setAttribute("data-bs-theme", theme);
            }
        };

        setTheme(getPreferredTheme());

        const showActiveTheme = (theme, focus = false) => {
            const themeSwitcher = document.querySelector("#bd-theme");

            if (!themeSwitcher) {
                return;
            }

            const themeSwitcherText = document.querySelector("#bd-theme-text");
            const activeThemeIcon = document.querySelector(".theme-icon-active i");
            const btnToActive = document.querySelector(
                `[data-bs-theme-value="${theme}"]`
            );
            const svgOfActiveBtn = btnToActive.querySelector("i").getAttribute("class");

            for (const element of document.querySelectorAll("[data-bs-theme-value]")) {
                element.classList.remove("active");
                element.setAttribute("aria-pressed", "false");
            }

            btnToActive.classList.add("active");
            btnToActive.setAttribute("aria-pressed", "true");
            activeThemeIcon.setAttribute("class", svgOfActiveBtn);
            const themeSwitcherLabel = `${themeSwitcherText.textContent} (${btnToActive.dataset.bsThemeValue})`;
            themeSwitcher.setAttribute("aria-label", themeSwitcherLabel);

            if (focus) {
                themeSwitcher.focus();
            }
        };

        window
            .matchMedia("(prefers-color-scheme: dark)")
            .addEventListener("change", () => {
                if (storedTheme !== "light" || storedTheme !== "dark") {
                    setTheme(getPreferredTheme());
                }
            });

        window.addEventListener("DOMContentLoaded", () => {
            showActiveTheme(getPreferredTheme());

            for (const toggle of document.querySelectorAll("[data-bs-theme-value]")) {
                toggle.addEventListener("click", () => {
                    const theme = toggle.getAttribute("data-bs-theme-value");
                    localStorage.setItem("theme", theme);
                    setTheme(theme);
                    showActiveTheme(theme, true);
                });
            }
        });
    })();
</script>

{{-- data table 2 --}}
<script src="{{ asset('plugins/data_table_exporting/jquery.js') }}"></script>
<script src="{{ asset('plugins/data_table_exporting/data_table.js') }}"></script>
<script src="{{ asset('plugins/data_table_exporting/data_table_buttons.js') }}"></script>
<script src="{{ asset('plugins/data_table_exporting/data_table_buttons_html5.js') }}"></script>
<script src="{{ asset('plugins/data_table_exporting/data_table_buttons_print.js') }}"></script>
<script src="{{ asset('plugins/data_table_exporting/Stuk-jszip-2ceb998/dist/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/data_table_exporting/colVis.js') }}"></script>

{{-- sweet alert 2 --}}
<script src="{{ asset('plugins/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
{{-- select 2 --}}
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

{{-- Icons --}}
<script src="{{ asset('dist/js/fa.all.min.js') }}"></script>


<script>
    $(function() {
        $('.select2').select2({
            theme: 'bootstrap4',
            language: {
                noResults: function() {
                    return 'لا يوجد';
                }
            }

        });
    });
</script>

<script>
    $('#datatable').DataTable({
        dom: '<"row mb-2"<"col-sm-6"f><"col-sm-6 text-right"B>>' +
            't' +
            "<'row mt-2'<'col-sm-7'p>>",
        buttons: [
            'excel',
            'print',
            {
                extend: 'colvis',
                text: 'اظهار - اخفاء'
            },
        ],
        language: {
            search: "بحث:",
        },
        paging: true,
        pageLength: 50
    });
</script>

@yield('data_tabel_altered')

<script>
    $('.delete_button').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: 'هل انت متأكد من أنك تريد حذف السجل ؟',
            text: 'لا يمكن التراجع عن عملية الحذف',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'نعم قم بالحذف',
            cancelButtonText: 'الغاء',
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('.form_delete').submit();
            }
        });
    });
</script>

@if (session()->has('success'))
    <script>
        Swal.fire({
            position: "center",
            icon: "success",
            title: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@if (session()->has('info'))
    <script>
        Swal.fire({
            position: "center",
            icon: "question",
            title: "{{ session('info') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@if (session()->has('error'))
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif

@if ($errors->any())
    <script>
        Swal.fire({
            position: "center",
            icon: "error",
            title: "حدث خطأ",
            showConfirmButton: false,
            timer: 1500
        });
    </script>
@endif
