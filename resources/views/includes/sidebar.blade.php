<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
        <span class="brand-text font-weight-light">عالم الابتكار</span>
    </a>

    <!-- Sidebar -->
    <div
        class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-rtl os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
        <div class="os-resize-observer-host">
            <div class="os-resize-observer observed" style="left: auto; right: 0px;"></div>
        </div>
        <div class="os-size-auto-observer" style="height: calc(100% + 1px); float: right;">
            <div class="os-resize-observer observed"></div>
        </div>
        <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 206px;"></div>
        <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible os-viewport-native-scrollbars-overlaid"
                style="overflow-y: scroll; bottom: 0px; left: 0px;">
                <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 text-center">
                        <div class="info">
                            <span class="d-block text-white">أهلا {{ auth()->user()->name }}</span>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                            data-accordion="false">
                            @if (auth()->user()->users_mangement == 1)
                                <li class="nav-item has-treeview {{ request()->is('users*') ? 'menu-open' : '' }}">
                                    <a href="#" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                                        <i class="nav-icon fa-solid fa-user"></i>
                                        <p>
                                            المستخدمين
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('users.index') }}"
                                                class="nav-link {{ request()->is('users') || request()->is('users/*/edit') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>قائمة المستخدمين</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('users.create') }}"
                                                class="nav-link {{ request()->is('users/create') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>اضافة مستخدم</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if (auth()->user()->add_sections_courses == 1)
                                <li
                                    class="nav-item has-treeview {{ request()->is('section*') || request()->is('mangement*') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ request()->is('section*') || request()->is('mangement*') ? 'active' : '' }}">
                                        <i class="nav-icon fa-solid fa-door-open"></i>
                                        <p>
                                            الاقسام و التخصصات
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('section.index') }}"
                                                class="nav-link {{ request()->is('section') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>الاقسام الدراسية</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ route('mangement.index') }}"
                                                class="nav-link {{ request()->is('mangement') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>الاقسام الادارية</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                            @if (auth()->user()->add_students == 1 ||
                                    auth()->user()->stop_students == 1 ||
                                    auth()->user()->student_marksheet_create == 1 ||
                                    auth()->user()->student_marksheet_see == 1)
                                <li
                                    class="nav-item has-treeview {{ request()->is('student*') || request()->is('grade*') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ request()->is('student*') || request()->is('grade*') ? 'active' : '' }}">
                                        <i class="nav-icon fa-solid fa-graduation-cap"></i>
                                        <p>
                                            شؤون الطلبة
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('student.select_section') }}"
                                                class="nav-link {{ request()->is('student/select_section/form') || request()->is('student') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>قائمة الطلبة</p>
                                            </a>
                                        </li>
                                        @if (auth()->user()->add_students == 1)
                                            <li class="nav-item">
                                                <a href="{{ route('student.create') }}"
                                                    class="nav-link {{ request()->is('student/create') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>اضافة طالب</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (auth()->user()->student_marksheet_create == 1)
                                            <li class="nav-item">
                                                <a href="{{ route('grade.old_grade_sheet_form') }}"
                                                    class="nav-link {{ request()->is('grade/old_grade_sheet_form') || request()->is('grade/old_grade_sheet*') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>كشف درجات الطلبة</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (auth()->user()->grade_equation == 1)
                                            <li class="nav-item">
                                                <a href="{{ route('student.grade_equation_section_select_form') }}"
                                                    class="nav-link {{ request()->is('student/grade_equation*') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>معادلة للطلبة</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (auth()->user()->show_graduated == 1)
                                            <li class="nav-item">
                                                <a href="{{ route('student.graduated_students') }}"
                                                    class="nav-link {{ request()->is('student/graduated/students*') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>الخريجين</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif
                            @if (auth()->user()->add_employee == 1 || auth()->user()->employee_salary_create == 1)
                                <li
                                    class="nav-item has-treeview {{ request()->is('employee*') || request()->is('teacher*') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ request()->is('employee*') || request()->is('teacher*') ? 'active' : '' }}">
                                        <i class="nav-icon fa-solid fa-user-tie"></i>
                                        <p>
                                            الشئون الادارية
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (auth()->user()->add_employee == 1)
                                            <li class="nav-item">
                                                <a href="{{ route('employee.index') }}"
                                                    class="nav-link {{ request()->is('employee') || request()->is('employee/salary_create*') || request()->is('employee/*/edit') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>الموظفين</p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="{{ route('teacher.index') }}"
                                                    class="nav-link {{ request()->is('teacher') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>المدرسين</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            @if (auth()->user()->treasury_main == 1 || auth()->user()->student_inroll == 1)
                                <li class="nav-item has-treeview {{ request()->is('treasury*') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ request()->is('treasury*') ? 'active' : '' }}">
                                        <i class="nav-icon fa-solid fa-money-bill"></i>
                                        <p>
                                            الشئون المالية
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (auth()->user()->treasury_main)
                                            <li class="nav-item">
                                                <a href="{{ route('treasury.index') }}"
                                                    class="nav-link {{ request()->is('treasury') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>القائمة الرئيسية</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (auth()->user()->student_inroll)
                                            <li class="nav-item">
                                                <a href="{{ route('treasury.select_season_and_section') }}"
                                                    class="nav-link {{ request()->is('treasury/select/season_and_section') || request()->is('treasury/season_and_section/student_enroll*') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>الاقساط الدراسية</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            @if (auth()->user()->new_students == 1 ||
                                    auth()->user()->student_inrollment == 1 ||
                                    auth()->user()->employee_salary_see == 1 ||
                                    auth()->user()->treasury_all_report == 1)
                                <li class="nav-item has-treeview {{ request()->is('reports*') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ request()->is('reports*') ? 'active' : '' }}">
                                        <i class="nav-icon fa-solid fa-list"></i>
                                        <p>
                                            تقارير
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        @if (auth()->user()->student_marksheet_see == 1)
                                            <li class="nav-item">
                                                <a href="{{ route('reports.season_resault_search_form') }}"
                                                    class="nav-link {{ request()->is('reports/season_resault_search/form') || request()->is('reports/season_resault_search*') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>نتائج الفصل الدراسي</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (auth()->user()->new_students)
                                            <li class="nav-item">
                                                <a href="{{ route('reports.students_inroll_form') }}"
                                                    class="nav-link {{ request()->is('reports/students_inroll_form') || request()->is('reports/students_inroll*') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>كشوفات الطلبة</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (auth()->user()->student_inrollment)
                                            <li class="nav-item">
                                                <a href="{{ route('reports.student_payments_form') }}"
                                                    class="nav-link {{ request()->is('reports/student_payments_form') || request()->is('reports/student_payments*') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>كشوفات تجديد القيد</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (auth()->user()->employee_salary_see)
                                            <li class="nav-item">
                                                <a href="{{ route('reports.employee_season_salary_form') }}"
                                                    class="nav-link {{ request()->is('reports/employee_season_salary*') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>كشوفات المرتبات</p>
                                                </a>
                                            </li>
                                        @endif
                                        @if (auth()->user()->treasury_all_report)
                                            <li class="nav-item">
                                                <a href="{{ route('reports.account_statement_form') }}"
                                                    class="nav-link {{ request()->is('reports/account_statement*') ? 'active' : '' }}">
                                                    <i class="far fa-circle nav-icon"></i>
                                                    <p>كشف حساب الخزينة</p>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                            @endif

                            @if (auth()->user()->mark_sheet_hide || auth()->user()->season_colse_open)
                                <li class="nav-item has-treeview {{ request()->is('settings*') ? 'menu-open' : '' }}">
                                    <a href="#"
                                        class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                                        <i class="nav-icon fa-solid fa-gear"></i>
                                        <p>
                                            الاعدادات
                                            <i class="right fas fa-angle-left"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{ route('settings.index') }}"
                                                class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p>القائمة الرئيسية</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif

                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
                <div class="os-scrollbar-handle" style="height: 19.2737%; transform: translate(0px);"></div>
            </div>
        </div>
        <div class="os-scrollbar-corner"></div>
    </div>
    <!-- /.sidebar -->
</aside>
