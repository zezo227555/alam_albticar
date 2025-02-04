<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand"><a href="#" class="brand-link">
            <img src="{{ asset('images/logo_hige.svg') }}" width="33" height="33" alt="Logo"
                class="brand-image opacity-75 shadow">
            <span class="brand-text fw-light">عالم الابتكار</span>
    </div>
    <div class="sidebar-wrapper">
        <nav class="mt-3">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                @if (auth()->user()->users_mangement == 1)
                    <li class="nav-item {{ request()->is('users*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ request()->is('users*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-user"></i>
                            <p>
                                المستخدمين
                                <i class="nav-arrow bi bi-chevron-right"></i>
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
                                <i class="nav-arrow bi bi-chevron-right"></i>
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
                                <i class="nav-arrow bi bi-chevron-right"></i>
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
                                        class="nav-link {{ request()->is('grade/old_grade_sheet_form') || request()->is('grade/old_grade_sheet*') ? 'active' : '' }} {{ request()->is('grade/group_grade_sheet*') ? 'active' : '' }}">
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
                                <i class="nav-arrow bi bi-chevron-right"></i>
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
                        <a href="#" class="nav-link {{ request()->is('treasury*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-money-bill"></i>
                            <p>
                                الشئون المالية
                                <i class="nav-arrow bi bi-chevron-right"></i>
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
                        <a href="#" class="nav-link {{ request()->is('reports*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-list"></i>
                            <p>
                                تقارير
                                <i class="nav-arrow bi bi-chevron-right"></i>
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
                        <a href="#" class="nav-link {{ request()->is('settings*') ? 'active' : '' }}">
                            <i class="nav-icon fa-solid fa-gear"></i>
                            <p>
                                الاعدادات
                                <i class="nav-arrow bi bi-chevron-right"></i>
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
    </div>
</aside>
