<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ url('assets/backend/images/logo-sm-dark.png') }}" alt="logo-sm-dark" height="26">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ url('assets/backend/images/logo-dark.png') }}" alt="logo-dark" height="24">
                    </span>
                </a>

                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ url('assets/backend/images/logo-sm-light.png') }}" alt="logo-sm-light" height="26">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ url('assets/backend/images/logo-light.png') }}" alt="logo-light" height="24">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                </div>
            </form>


        </div>

        <div class="d-flex">



            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    @if($unreadCount > 0)
                    <span class="noti-dot"></span> <!-- Show dot if there are unread notifications -->
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small"> View All</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <!-- item-->
                        @foreach($notifications as $notification)
                        @php
                        // Get user from the notification's data
                        $user = \App\Models\User::find($notification->data['user_id']);
                        @endphp

                        <a href="{{ route('admin.notification.show', $notification->id) }}" class="text-reset notification-item">
                            <div class="d-flex">
                                @if($notification->data['type'] == 'order')
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="ri-shopping-cart-line"></i>
                                        <!-- <i class="ri-checkbox-circle-line"></i> -->
                                    </span>
                                </div>
                                @elseif($notification->data['type'] == 'designer_application')
                                @if($user->image != null)
                                <img src="{{ url('storage/'.$user->image) }}"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                @else
                                <img src="{{ $user->getUrlfriendlyAvatar($size=400) }}"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                @endif
                                @endif

                                <div class="flex-1">
                                    <h6 class="mb-1">{{ $notification->data['message'] }}</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> {{ $notification->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ url('assets/backend/images/users/avatar-2.jpg') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">Adam</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="ri-wallet-2-line align-middle me-1"></i> My Wallet</a>
                    <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end mt-1">11</span><i class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock screen</a>
                    <div class="dropdown-divider"></div>

                    <!-- logout -->
                    <livewire:backend.auth.logout />

                </div>
            </div>
        </div>
    </div>
</header>