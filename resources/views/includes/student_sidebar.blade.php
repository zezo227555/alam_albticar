<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand"><a href="#" class="brand-link">
            <img src="{{ asset('images/logo_hige.svg') }}" width="33" height="33" alt="Logo"
                class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">عالم الابتكار</span>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-3">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <li class="nav-item {{ request()->is('users*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                        <i class="nav-icon fa-solid fa-user"></i>
                        <p>
                            بيانات الطالب
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('student.get_student_season_resault_form') }}"
                                class="nav-link {{ request()->is('users') }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>نتيجة الطالب</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
