<style>
    .main-sidebar {
        width: 220px;
        transition: width 0.3s ease;
    }

    .main-sidebar .brand-link {
        font-size: 1rem;
        text-align: center;
    }

    .sidebar .nav-link {
        background-color: #343a40;
        border-radius: 0.5rem;
        margin-bottom: 12px;
        padding: 12px 10px;
        color: #fff;
        transition: background-color 0.3s ease;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
        background-color: #495057;
        color: #fff;
    }

    .sidebar .nav-icon {
        margin-right: 8px;
    }

    .content-wrapper {
        margin-left: 220px !important;
        transition: margin-left 0.3s ease;
    }

    @media (max-width: 768px) {
        .main-sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        .main-sidebar.active {
            transform: translateX(0);
        }
        .content-wrapper {
            margin-left: 0 !important;
        }
    }
</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">



    <!-- Sidebar -->
    <div class="sidebar p-3">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.home') ? 'active' : '' }}" href="{{ route('admin.home') }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>
                        <span>{{ trans('global.dashboard') }}</span>
                    </a>
                </li>

                @can('patient_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.patients.index') }}" class="nav-link {{ request()->is('admin/patients') || request()->is('admin/patients/*') ? 'active' : '' }}">
                            <i class="fas fa-user-injured nav-icon"></i>
                            <span>{{ trans('cruds.patient.title') }}</span>
                        </a>
                    </li>
                @endcan

                @can('diagnosis_access')
                    <li class="nav-item">
                        <a href="{{ route('admin.diagnoses.index') }}" class="nav-link {{ request()->is('admin/diagnoses') || request()->is('admin/diagnoses/*') ? 'active' : '' }}">
                            <i class="fas fa-stethoscope nav-icon"></i>
                            <span>{{ trans('cruds.diagnosis.title') }}</span>
                        </a>
                    </li>
                @endcan

                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a href="{{ route('profile.password.edit') }}" class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}">
                                <i class="fas fa-key nav-icon"></i>
                                <span>{{ trans('global.change_password') }}</span>
                            </a>
                        </li>
                    @endcan
                @endif

                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <span>{{ trans('global.logout') }}</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <!-- /.sidebar -->
</aside>
