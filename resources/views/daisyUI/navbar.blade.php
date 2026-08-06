{{-- <div class="navbar bg-base-100 shadow-sm  " data-theme="dark"> --}}
{{-- <div class="navbar sticky top-0 z-[888] bg-base-100 shadow-sm" data-theme="dark"> --}}
<div class="navbar fixed top-[6.2rem] z-[995] left-1/2 -translate-x-1/2 w-[75%] hidden lg:flex m-0 p-0 ">

    <div class="navbar-start">

    </div>
    <div class="navbar-center hidden lg:flex w-full h-full">
        {{-- <ul class="menu menu-horizontal px-1"> --}}
        <ul
            class="menu menu-horizontal dropdown-content z-1 w-full h-full
            bg-gradient-to-r from-emerald-600/75 to-emerald-900
            {{-- border-b-4 border-green-900 rounded-2xl rounded-box --}}
            justify-center-safe items-center-safe 
            ">
            {{-- <li><a class="nav-parent" href='/'>{{ __('adminlte::landingpage.home') }}</a></li> --}}



            {{-- about us --}}
            <li class="relative group/main font-bold text-black">
                <div class="nav-parent">
                    {{ __('adminlte::landingpage.aboutus') }}
                    <svg class="ml-2 w-4 h-4 transform group-hover/main:rotate-180 transition-transform duration-200"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.194l3.71-3.965a.75.75 0 111.08 1.04l-4.25 4.54a.75.75 0 01-1.08 0l-4.25-4.54a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <ul class="navmenu">
                    <li><a href={{ localizedRoute('aboutus') }}>{{ __('adminlte::landingpage.aboutcompany') }}</a></li>
                    <li><a href={{ localizedRoute('management') }}>{{ __('adminlte::landingpage.management') }}</a></li>
                    <li><a href={{ localizedRoute('visionIndex') }}>{{ __('adminlte::landingpage.ourvision') }}</a></li>
                    <li><a href={{ route('lang.switch', 'ar') }}>{{ __('adminlte::landingpage.futurePlans') }}</a></li>
                    <li><a href={{ route('lang.switch', 'ar') }}>{{ __('adminlte::landingpage.socialResponsibility') }}</a></li>
                    <li><a href={{ route('lang.switch', 'ar') }}>{{ __('adminlte::landingpage.prizesAndCertificates') }}</a></li>
                </ul>
            </li>
            {{-- <li class="relative group/main font-bold text-black">
                <div class="nav-parent">
                    <div>{{ __('adminlte::landingpage.aboutus') }} </div>
                    <ul class="menu menu-sm  start-[100%] dropdown-content bg-base-100 z-1 w-100 px-2  rounded-ee-4xl">
                        <li><a href={{ localizedRoute('aboutus') }}>{{ __('adminlte::landingpage.aboutcompany') }}</a>
                        </li>
                        <li><a href={{ localizedRoute('management') }}>{{ __('adminlte::landingpage.management') }}</a>
                        </li>
                        <li><a href={{ localizedRoute('visionIndex') }}>{{ __('adminlte::landingpage.ourvision') }}</a>
                        </li>
                    </ul>
                </div>
            </li> --}}



            {{-- sales and marketing --}}
            <li class="relative group/main font-bold text-black">
                <div class="nav-parent">
                    {{ __('adminlte::landingpage.salesAndMarketing') }}
                    <svg class="w-4 h-4 transform group-hover/main:rotate-180 transition-transform duration-200"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.194l3.71-3.965a.75.75 0 111.08 1.04l-4.25 4.54a.75.75 0 01-1.08 0l-4.25-4.54a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <ul class="navmenu">
                    <li> <a href="/products" class="nav-child">{{ __('adminlte::landingpage.100hadrami') }}</a> </li>
                    <li> <a href="/products" class="nav-child">{{ __('adminlte::landingpage.products') }}</a> </li>
                    {{-- sub sub menu --}}
                    {{-- <li class="relative group/submain">
                        <!-- Dropdown submain menu  -->
                        <div class="nav-subparent ">
                            {{ __('adminlte::landingpage.branches') }}
                            <svg class="ml-2 w-4 h-4 transform group-hover/submain:rtl:rotate-90 group-hover/submain:ltr:-rotate-90 transition-transform duration-200"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.194l3.71-3.965a.75.75 0 111.08 1.04l-4.25 4.54a.75.75 0 01-1.08 0l-4.25-4.54a.75.75 0 01.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>

                        <!-- Sub submain menu -->
                        <ul class="navsubmenu">
                            <li><a href="/branches/north" class="nav-child">فرع الشمال</a></li>
                            <li><a href="/branches/south" class="nav-child">فرع الجنوب</a></li>
                            <li><a href="/branches/east" class="nav-child">فرع الشرق</a></li>
                            <li><a href="/branches/west" class="nav-child">فرع الغرب</a></li>
                        </ul>
                    </li> --}}

                    <li> <a href="/support" class="nav-child">{{ __('adminlte::landingpage.customerservice') }}</a>
                    </li>
                    <li><a href="/feedback"
                            class="nav-child">{{ __('adminlte::landingpage.suggestionsAndComplaints') }}</a></li>
                </ul>
            </li>



            {{-- human resources --}}
            <li class="relative group/main font-bold text-black">
                <div class="nav-parent">
                    {{ __('adminlte::landingpage.humanResources') }}
                    <svg class="w-4 h-4 transform group-hover/main:rotate-180 transition-transform duration-200"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.194l3.71-3.965a.75.75 0 111.08 1.04l-4.25 4.54a.75.75 0 01-1.08 0l-4.25-4.54a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <ul class="navmenu">
                    <li> <a href="/products" class="nav-child">{{ __('adminlte::landingpage.employeesAdvantages') }}</a> </li>
                    <li> <a href="/products" class="nav-child">{{ __('adminlte::landingpage.jobApplication') }}</a> </li>
                    <li> <a href="/products" class="nav-child">{{ __('adminlte::landingpage.askForVisit') }}</a> </li>
                    <li> <a href="/products" class="nav-child">{{ __('adminlte::landingpage.askForTraining') }}</a> </li>
                    <li><a href="/feedback" class="nav-child">{{ __('adminlte::landingpage.suggestionsAndComplaints') }}</a></li>
                </ul>
            </li>




            {{-- Media Center --}}
            <li class="relative group/main font-bold text-black">
                <div class="nav-parent">
                    {{ __('adminlte::landingpage.mediaCenter') }}
                    <svg class="w-4 h-4 transform group-hover/main:rotate-180 transition-transform duration-200"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.23 7.21a.75.75 0 011.06.02L10 11.194l3.71-3.965a.75.75 0 111.08 1.04l-4.25 4.54a.75.75 0 01-1.08 0l-4.25-4.54a.75.75 0 01.02-1.06z"
                            clip-rule="evenodd" />
                    </svg>
                </div>

                <ul class="navmenu">
                    <li> <a href="/products" class="nav-child">{{ __('adminlte::landingpage.newsAndActivities') }}</a> </li>
                    {{-- <li> <a href="/products" class="nav-child">{{ __('adminlte::landingpage.activities') }}</a> </li> --}}
                    <li> <a href="/products" class="nav-child">{{ __('adminlte::landingpage.photosAndVideos') }}</a> </li>
                    <li> <a href="/products" class="nav-child">{{ __('adminlte::landingpage.documents') }}</a> </li>
                    <li><a href="/feedback" class="nav-child">{{ __('adminlte::landingpage.suggestionsAndComplaints') }}</a></li>
                </ul>
            </li>
            {{-- contact us --}}
            <li><a class="nav-parent" href={{ route('lang.switch', 'ar') }}>{{ __('adminlte::landingpage.sustainableDevelopment') }}</a></li>
            <li><a class="nav-parent" href={{ route('lang.switch', 'ar') }}>{{ __('adminlte::landingpage.contactus') }}</a></li>
        </ul>
    </div>
    <div class="navbar-end">
        <ul class="menu menu-horizontal px-1">
            {{-- <li>
          <details>
            <summary>LA</summary>
            <ul class="p-2">
                <li><a href={{ route('lang.switch', 'en') }}>English</a></li>
                <li><a href={{ route('lang.switch', 'ar') }}>العربية</a></li>
            </ul>
          </details>
        </li> --}}
        </ul>
        {{-- <input type="checkbox" value="dark" class="toggle theme-controller" /> --}}
    </div>
</div>
{{-- <script>
    details.addEventListener("hover", (event) => {
        if (details.open) {
        } else {
        }
    });
</script> --}}
