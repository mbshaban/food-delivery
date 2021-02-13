<!DOCTYPE html>
<html lang="da">

@include('website/include/head')
<body id="kt_body"
      class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed aside-enabled aside-static page-loading">


<div id="kt_header_mobile" class="header-mobile header-mobile-fixed">
    <!--begin::Logo-->
    <a href="index.html">
        <img alt="Logo" src="{{ asset('media/logos/logo-letter-1.png')}}"
             class="logo-default max-h-30px"/>
    </a>
    <!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <button class="btn p-0 burger-icon rounded-0 burger-icon-left" id="kt_aside_tablet_and_mobile_toggle">
            <span></span>
        </button>
        <button class="btn btn-hover-text-primary p-0 ml-3" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24"/>
								<path
                                    d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3"/>
								<path
                                    d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                    fill="#000000" fill-rule="nonzero"/>
							</g>
						</svg>
                        <!--end::Svg Icon-->
					</span>
        </button>
    </div>
    <!--end::Toolbar-->
</div>

<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
            @include('website/include/sidebar')
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">

            @include('website/include/header')

            @yield('content')

            @include('website/include/footer')
        </div>
    </div>
</div>


<!-- begin::Notifications Panel-->
<div id="kt_quick_notifications" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between mb-10">
        <h3 class="font-weight-bold m-0">Notifications
            <small class="text-muted font-size-sm ml-2">24 New</small></h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_notifications_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Nav-->
        <div class="navi navi-icon-circle navi-spacer-x-0">
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon-bell text-success icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">5 new user generated report</div>
                        <div class="text-muted">Reports based on sales</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon2-box text-danger icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">2 new items submited</div>
                        <div class="text-muted">by Grog John</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon-psd text-primary icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">79 PSD files generated</div>
                        <div class="text-muted">Reports based on sales</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon2-supermarket text-warning icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">$2900 worth producucts sold</div>
                        <div class="text-muted">Total 234 items</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon-paper-plane-1 text-success icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">4.5h-avarage response time</div>
                        <div class="text-muted">Fostest is Barry</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon-safe-shield-protection text-danger icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">3 Defence alerts</div>
                        <div class="text-muted">40% less alerts thar last week</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon-notepad text-primary icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">Avarage 4 blog posts per author</div>
                        <div class="text-muted">Most posted 12 time</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon-users-1 text-warning icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">16 authors joined last week</div>
                        <div class="text-muted">9 photodrapehrs, 7 designer</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon2-box text-info icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">2 new items have been submited</div>
                        <div class="text-muted">by Grog John</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon2-download text-success icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">2.8 GB-total downloads size</div>
                        <div class="text-muted">Mostly PSD end AL concepts</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon2-supermarket text-danger icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">$2900 worth producucts sold</div>
                        <div class="text-muted">Total 234 items</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon-bell text-primary icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">7 new user generated report</div>
                        <div class="text-muted">Reports based on sales</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link rounded">
                    <div class="symbol symbol-50 symbol-circle mr-3">
                        <div class="symbol-label">
                            <i class="flaticon-paper-plane-1 text-success icon-lg"></i>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold font-size-lg">4.5h-avarage response time</div>
                        <div class="text-muted">Fostest is Barry</div>
                    </div>
                </div>
            </a>
            <!--end::Item-->
        </div>
        <!--end::Nav-->
    </div>
    <!--end::Content-->
</div>
<!-- end::Notifications Panel-->


@include('website/include/script')

</body>
</html>

