<!--begin::Sidebar-->
    <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
        <!--begin::Main-->
        <div class="d-flex flex-column justify-content-between h-100 hover-scroll-overlay-y my-2 d-flex flex-column" id="kt_app_sidebar_main" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_main" data-kt-scroll-offset="5px">
            <!--begin::Sidebar menu-->
            <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="flex-column-fluid menu menu-sub-indention menu-column menu-rounded menu-active-bg mb-7">
                <!--begin:Menu item-->
                <div class="menu-item d-none">
                    <!--begin:Menu link-->
                    <a href="{{ url('dashboard') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-chart fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Dashboards</span>
                    </a>
                    <!--end:Menu link-->
                </div>
                <!--end:Menu item-->
                <!-- begin::custom -->
                <div class="menu-item">
                    <a href="{{ url('users') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-user fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Users</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ url('ads') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-rectangle-ad fs-1"></i>
                        </span>
                        <span class="menu-title">Advertisment</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ url('ebrosure') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-clipboard-list fs-1"></i>
                        </span>
                        <span class="menu-title">eBrosure</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ url('type_of_interest') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-map-location-dot fs-1"></i>
                        </span>
                        <span class="menu-title">Type of Interest</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ url('category_type_of_interest') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-map-location-dot fs-1"></i>
                        </span>
                        <span class="menu-title">Category Type of Interest</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ url('destination') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-location-dot fs-1"></i>
                        </span>
                        <span class="menu-title">Destination</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ url('event') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-calendar-day fs-1"></i>
                        </span>
                        <span class="menu-title">Event</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ url('term_and_conditions') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-book fs-1"></i>
                        </span>
                        <span class="menu-title">Term & Conditions</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a href="{{ url('reviews') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-book fs-1"></i>
                        </span>
                        <span class="menu-title">Reviews</span>
                    </a>
                </div>
                <!-- <div class="menu-item">
                    <a href="{{ url('review') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-star fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Rating & Review</span>
                    </a>
                </div> -->
                <!-- <div class="menu-item">
                    <a href="{{ url('dashboard') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-clock-rotate-left fs-1"></i>
                        </span>
                        <span class="menu-title">History</span>
                    </a>
                </div> -->
                <!-- end::custom -->
                <!--begin:Menu item-->
                <!-- <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-rescue fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Help</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link" href="https://preview.keenthemes.com/html/saul-html-pro/docs/getting-started/changelog" target="_blank">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Changelog v1.0.0</span>
                            </a>
                        </div>
                    </div>
                </div> -->
                <!--end:Menu item-->
            </div>
            <!--end::Sidebar menu-->
        </div>
        <!--end::Main-->
    </div>
<!--end::Sidebar-->