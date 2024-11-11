 <!--begin::Sidebar-->
 <div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
     <!--begin::Logo-->
     <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
         <!--begin::Logo image-->
         <a href="index.html">
             <img alt="Logo" src="{{ asset('admin-assets/media/logos/default-dark.svg') }}"
                 class="h-25px app-sidebar-logo-default" />
             <img alt="Logo" src="{{ asset('admin-assets/media/logos/default-small.svg') }}"
                 class="h-20px app-sidebar-logo-minimize" />
         </a>
         <!--end::Logo image-->
         <!--begin::Sidebar toggle-->
         <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
             <i class="ki-duotone ki-black-left-line fs-3 rotate-180">
                 <span class="path1"></span>
                 <span class="path2"></span>
             </i>
         </div>
         <!--end::Sidebar toggle-->
     </div>
     <!--end::Logo-->
     <!--begin::sidebar menu-->
     <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
         <!--begin::Menu wrapper-->
         <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper">
             <!--begin::Scroll wrapper-->
             <div id="kt_app_sidebar_menu_scroll" class="scroll-y my-5 mx-3" data-kt-scroll="true"
                 data-kt-scroll-activate="true" data-kt-scroll-height="auto"
                 data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
                 data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
                 data-kt-scroll-save-state="true">
                 <!--begin::Menu-->
                 <div class="menu menu-column menu-rounded menu-sub-indention fw-semibold fs-6"
                     id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                     <!-- Begin: Menu item -->
                     <div data-kt-menu-trigger="click"
                         class="menu-item {{ request()->is('dashboard') ? 'here show' : '' }} menu-accordion">
                         <!-- Begin: Menu link -->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-element-11 fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                     <span class="path4"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Dashboards</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!-- End: Menu link -->
                         <!-- Begin: Menu sub -->
                         <div class="menu-sub menu-sub-accordion">
                             <!-- No sub-items needed -->
                         </div>
                         <!-- End: Menu sub -->
                     </div>
                     <!-- End: Menu item -->
                     <!-- Begin: Menu item -->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!-- Begin: Menu link -->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-address-book fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Websites</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!-- End: Menu link -->
                         <!-- Begin: Menu sub -->
                         <div class="menu-sub menu-sub-accordion">
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('get-website') ? 'active' : '' }}"
                                     href="{{ route('get-website') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">All Websites</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('add-website') ? 'active' : '' }}"
                                     href="{{ route('add-website') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Add Website</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                         </div>
                         <!-- End: Menu sub -->
                     </div>
                     <!-- End: Menu item -->
                     <!-- Begin: Menu item -->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!-- Begin: Menu link -->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-address-book fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Categories</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!-- End: Menu link -->
                         <!-- Begin: Menu sub -->
                         <div class="menu-sub menu-sub-accordion">
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('get-category') ? 'active' : '' }}"
                                     href="{{ route('get-category') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">All Categories</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('add-category') ? 'active' : '' }}"
                                     href="{{ route('add-category') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Add Category</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                         </div>
                         <!-- End: Menu sub -->
                     </div>
                     <!-- End: Menu item -->
                     <!-- Begin: Menu item -->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!-- Begin: Menu link -->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-address-book fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Plans</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!-- End: Menu link -->
                         <!-- Begin: Menu sub -->
                         <div class="menu-sub menu-sub-accordion">
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('get-plan') ? 'active' : '' }}"
                                     href="{{ route('get-plan') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">All Plans</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('add-plan') ? 'active' : '' }}"
                                     href="{{ route('add-plan') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Add Plan</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                         </div>
                         <!-- End: Menu sub -->
                     </div>
                     <!-- End: Menu item -->
                     <!-- Begin: Menu item -->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!-- Begin: Menu link -->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-address-book fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Subscriptions</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!-- End: Menu link -->
                         <!-- Begin: Menu sub -->
                         <div class="menu-sub menu-sub-accordion">
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('get-subscription') ? 'active' : '' }}"
                                     href="{{ route('get-subscription') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">All Subscriptions</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('add-subscription') ? 'active' : '' }}"
                                     href="{{ route('add-subscription') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Add Subscription</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                         </div>
                         <!-- End: Menu sub -->
                     </div>
                     <!-- End: Menu item -->
                     <!-- Begin: Menu item -->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!-- Begin: Menu link -->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-address-book fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Plan Details</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!-- End: Menu link -->
                         <!-- Begin: Menu sub -->
                         <div class="menu-sub menu-sub-accordion">
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('get-plan-detail') ? 'active' : '' }}"
                                     href="{{ route('get-plan-detail') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">All Plan Detail</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('add-plan-detail') ? 'active' : '' }}"
                                     href="{{ route('add-plan-detail') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Add Plan Details</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                         </div>
                         <!-- End: Menu sub -->
                     </div>
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!-- Begin: Menu link -->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-address-book fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Companies</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!-- End: Menu link -->
                         <!-- Begin: Menu sub -->
                         <div class="menu-sub menu-sub-accordion">
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('get-company') ? 'active' : '' }}"
                                     href="{{ route('get-company') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">All Companies</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('add-company') ? 'active' : '' }}"
                                     href="{{ route('add-company') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Add Company</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                         </div>
                         <!-- End: Menu sub -->
                     </div>
                     <!-- End: Menu item -->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!-- Begin: Menu link -->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-address-book fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Staffs</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!-- End: Menu link -->
                         <!-- Begin: Menu sub -->
                         <div class="menu-sub menu-sub-accordion">
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('get-staff') ? 'active' : '' }}"
                                     href="{{ route('get-staff') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">All Staffs</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('add-staff') ? 'active' : '' }}"
                                     href="{{ route('add-staff') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Add Staff</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                         </div>
                         <!-- End: Menu sub -->
                     </div>
                     <!-- End: Menu item -->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!-- Begin: Menu link -->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-address-book fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Bookings</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!-- End: Menu link -->
                         <!-- Begin: Menu sub -->
                         <div class="menu-sub menu-sub-accordion">
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('get-booking') ? 'active' : '' }}"
                                     href="{{ route('get-booking') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">All Bookings</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                             <!-- Begin: Menu item -->
                             <div class="menu-item">
                                 <!-- Begin: Menu link -->
                                 <a class="menu-link {{ request()->url() == route('add-booking') ? 'active' : '' }}"
                                     href="{{ route('add-booking') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Add Booking</span>
                                 </a>
                                 <!-- End: Menu link -->
                             </div>
                             <!-- End: Menu item -->
                         </div>
                         <!-- End: Menu sub -->
                     </div>
                     <!-- End: Menu item -->
                     <!--begin:Menu item-->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!--begin:Menu link-->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-element-plus fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                     <span class="path4"></span>
                                     <span class="path5"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Users</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!--end:Menu link-->
                         <!--begin:Menu sub-->
                         <div class="menu-sub menu-sub-accordion">
                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <!--begin:Menu link-->
                                 <a class="menu-link" href="{{ route('get-user') }}">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">All Users</span>
                                 </a>
                                 <!--end:Menu link-->
                             </div>
                             <!--end:Menu item-->
                         </div>
                         <!--end:Menu sub-->
                     </div>
                     <!--end:Menu item-->
                     <!--begin:Menu item-->
                     <!--begin:Menu item-->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!--begin:Menu link-->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-abstract-39 fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Social</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!--end:Menu link-->
                         <!--begin:Menu sub-->
                         <div class="menu-sub menu-sub-accordion">
                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <!--begin:Menu link-->
                                 <a class="menu-link" href="pages/social/feeds.html">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Feeds</span>
                                 </a>
                                 <!--end:Menu link-->
                             </div>
                             <!--end:Menu item-->
                         </div>
                         <!--end:Menu sub-->
                     </div>
                     <!--end:Menu item-->
                     <!--begin:Menu item-->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!--begin:Menu link-->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-bank fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Blog</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!--end:Menu link-->
                         <!--begin:Menu sub-->
                         <div class="menu-sub menu-sub-accordion menu-active-bg">
                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <!--begin:Menu link-->
                                 <a class="menu-link" href="pages/blog/home.html">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Blog Home</span>
                                 </a>
                                 <!--end:Menu link-->
                             </div>
                             <!--end:Menu item-->
                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <!--begin:Menu link-->
                                 <a class="menu-link" href="pages/blog/post.html">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Blog Post</span>
                                 </a>
                                 <!--end:Menu link-->
                             </div>
                             <!--end:Menu item-->
                         </div>
                         <!--end:Menu sub-->
                     </div>
                     <!--end:Menu item-->
                     <!--begin:Menu item-->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!--begin:Menu link-->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-chart-pie-3 fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                 </i>
                             </span>
                             <span class="menu-title">FAQ</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!--end:Menu link-->
                         <!--begin:Menu sub-->
                         <div class="menu-sub menu-sub-accordion menu-active-bg">
                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <!--begin:Menu link-->
                                 <a class="menu-link" href="pages/faq/classic.html">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">FAQ Classic</span>
                                 </a>
                                 <!--end:Menu link-->
                             </div>
                             <!--end:Menu item-->
                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <!--begin:Menu link-->
                                 <a class="menu-link" href="pages/faq/extended.html">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">FAQ Extended</span>
                                 </a>
                                 <!--end:Menu link-->
                             </div>
                             <!--end:Menu item-->
                         </div>
                         <!--end:Menu sub-->
                     </div>
                     <!--end:Menu item-->
                     <!--begin:Menu item-->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!--begin:Menu link-->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-bucket fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                     <span class="path4"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Pricing</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!--end:Menu link-->
                         <!--begin:Menu sub-->
                         <div class="menu-sub menu-sub-accordion menu-active-bg">
                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <!--begin:Menu link-->
                                 <a class="menu-link" href="pages/pricing.html">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Column Pricing</span>
                                 </a>
                                 <!--end:Menu link-->
                             </div>
                             <!--end:Menu item-->
                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <!--begin:Menu link-->
                                 <a class="menu-link" href="pages/pricing/table.html">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Table Pricing</span>
                                 </a>
                                 <!--end:Menu link-->
                             </div>
                             <!--end:Menu item-->
                         </div>
                         <!--end:Menu sub-->
                     </div>
                     <!--end:Menu item-->
                     <!--begin:Menu item-->
                     <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                         <!--begin:Menu link-->
                         <span class="menu-link">
                             <span class="menu-icon">
                                 <i class="ki-duotone ki-call fs-2">
                                     <span class="path1"></span>
                                     <span class="path2"></span>
                                     <span class="path3"></span>
                                     <span class="path4"></span>
                                     <span class="path5"></span>
                                     <span class="path6"></span>
                                     <span class="path7"></span>
                                     <span class="path8"></span>
                                 </i>
                             </span>
                             <span class="menu-title">Careers</span>
                             <span class="menu-arrow"></span>
                         </span>
                         <!--end:Menu link-->
                         <!--begin:Menu sub-->
                         <div class="menu-sub menu-sub-accordion">
                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <!--begin:Menu link-->
                                 <a class="menu-link" href="pages/careers/list.html">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Careers List</span>
                                 </a>
                                 <!--end:Menu link-->
                             </div>
                             <!--end:Menu item-->
                             <!--begin:Menu item-->
                             <div class="menu-item">
                                 <!--begin:Menu link-->
                                 <a class="menu-link" href="pages/careers/apply.html">
                                     <span class="menu-bullet">
                                         <span class="bullet bullet-dot"></span>
                                     </span>
                                     <span class="menu-title">Careers Apply</span>
                                 </a>
                                 <!--end:Menu link-->
                             </div>
                             <!--end:Menu item-->
                         </div>
                         <!--end:Menu sub-->
                     </div>
                     <!--end:Menu item-->
                 </div>
                 <!--end::Menu-->
             </div>
             <!--end::Scroll wrapper-->
         </div>
         <!--end::Menu wrapper-->
     </div>
     <!--end::sidebar menu-->
 </div>
 <!--end::Sidebar-->
