<style>
    .main-sidebar {
        width: 220px;
        transition: transform 0.3s ease;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 1040;
    }

    .content-wrapper {
        margin-left: 220px;
        transition: margin-left 0.3s ease;
    }

    @media (max-width: 768px) {
        .main-sidebar {
            transform: translateX(-100%);
        }

        .main-sidebar.active {
            transform: translateX(0);
        }

        .content-wrapper {
            margin-left: 0;
        }

        .content-wrapper.shifted {
            margin-left: 220px;
        }
    }
    .main-sidebar {
        width: 220px;
        transition: transform 0.3s ease;
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        z-index: 1040;
    }

    .content-wrapper {
        margin-left: 220px;
        transition: margin-left 0.3s ease;
    }

    @media (max-width: 768px) {
        .main-sidebar {
            transform: translateX(-100%);
        }

        .main-sidebar.active {
            transform: translateX(0);
        }

        .content-wrapper {
            margin-left: 0;
        }

        .content-wrapper.shifted {
            margin-left: 220px;
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
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggleBtn = document.getElementById('toggleSidebar');
            const sidebar = document.querySelector('.main-sidebar');
            const content = document.querySelector('.content-wrapper');

            toggleBtn?.addEventListener('click', function () {
                sidebar.classList.toggle('active');
                content.classList.toggle('shifted');
            });
        });
    </script>

    <!-- /.sidebar -->
</aside>
