<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Styles -->
    <title>@yield('title') | Pro4Home</title>
    <link rel="shortcut icon" href="{{asset('be_assets')}}/images/log.jpeg">
    @yield('more-meta')
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fa/css/font-awesome.min.css') }}">
    <link href="{{asset('be_assets/css/toastr.css') }}" rel="stylesheet" type="text/css" id="app-stylesheet"/>


    @livewireStyles
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=658862321a7f810014082c20&product=inline-share-buttons&source=platform" async="async"></script>

    <style type="text/css">

         .st-btn[data-network='sharethis'] {
             background-color: transparent !important;
         }

         .st-btn.st-remove-label {
             min-width: 20px !important;
         }
    </style>
    <style>
        input{
            height: 51px;
        }
    </style>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4MK72NJ8ZG"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-4MK72NJ8ZG');
    </script>
</head>
<body >
<header class="">
    <div class="bg-white ">
        <nav class=" border-b border-gray-200">
            <x-container class=" flex flex-wrap items-center justify-between py-4">
                <a href="{{route('home')}}" class="flex items-start">
                    <x-logo.white/>
                </a>
                <button data-collapse-toggle="navbar-dropdown" type="button"
                        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-secondary rounded-lg lg:hidden "
                        aria-controls="navbar-dropdown" aria-expanded="false">
                    <svg class="w-6 h-6 text-secondary" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M1 1h15M1 7h15M1 13h15"></path>
                    </svg>
                </button>
                {{-- Desktop Menu--}}
                <div class="hidden w-full lg:block md:w-auto  absolute lg:relative ">
                    <ul class="flex md:p-0  flex-col  font-medium p-4 mt-4 border rounded-lg lg:flex-row  md:mt-0 md:border-0">
                        <li class=" border-b-4 border-transparent">
                            <a href="{{ route('workers') }}"
                               class=" flex h-full items-center font-bold py-5  px-4  hover:text-orange">For Workers </a>
                        </li>
                        <li class=" border-b-4 border-transparent   ">
                            <a href="{{ route('download') }}" class="flex h-full items-center font-bold py-5  px-4 hover:text-orange  hover:text-orange-500"> Download</a>
                        </li>
                        <li class=" border-b-4 border-transparent   ">
                            <a href="{{ route('features') }}" class="flex h-full items-center font-bold py-5  px-4 hover:text-orange hover:text-orange-500"> Features</a>
                        </li>
                        <li class=" border-b-4 border-transparent  ">
                            <x-dropdown width="w-72 shadow-lg" position="absolute">
                                <x-slot name="trigger">
                                    <div class="flex py-5 px-4 cursor-pointer hover:text-orange font-bold justify-between items-center">
                                        <span class="mr-2 hover:text-orange"> About</span> <img
                                            src="{{asset('images/dropdown-arrow.svg')}}"/>
                                    </div>
                                </x-slot>
                                <x-slot name="content" class="bg-white">
                                    <ul class="py-2 px-4 text-sm bg-white " aria-labelledby="dropdownLargeButton">
                                        <li class=" py-4 border-b "><a href="{{route('about')}}" class="hover:text-orange">About Pro4home</a></li>
                                        <li class=" py-4 border-b "><a href="{{route('about.team')}}" class="hover:text-orange">Meet the Team</a></li>
                                        <li class="py-4"><a href="{{route('about.blog')}}" class="hover:text-orange">Our Blog</a></li>
                                    </ul>
                                </x-slot>
                            </x-dropdown>
                        </li>
                        <li class=" border-b-4 border-transparent   ">
                            <a href="{{ route('faqs') }}" class="flex h-full items-center font-bold py-5 hover:text-orange  px-4 hover:text-orange-500"> FAQs</a>
                        </li>
                        <li class=" border-b-4 border-transparent ">
                            <a href="{{route('contact')}}" class="flex h-full items-center font-bold py-5  hover:text-orange px-4  "> Contact</a>
                        </li>

                        <li class=" border-b-4 border-transparent   ">
                            <x-dropdown width="w-72 shadow-lg" position="absolute">
                                <x-slot name="trigger">
                                    <div class="flex py-5 px-4 cursor-pointer hover:text-orange   justify-between items-center">
                                        <span class="mr-2  " > ENG</span> <img
                                            src="{{asset('images/dropdown-arrow.svg')}}"/>
                                    </div>
                                </x-slot>
                                <x-slot name="content">
                                    <ul class="py-2 text-sm text-white" aria-labelledby="dropdownLargeButton">
                                        {{-- About us commes here --}}
                                    </ul>
                                </x-slot>
                            </x-dropdown>
                        </li>

                    </ul>
                </div>

                {{--Mobile Menu--}}
                <div class="hidden w-72  text-white absolute top-0 bottom-0 bg-secondary shadow-xl -ml-4 "
                     id="navbar-dropdown">
                    <div class="p-4">
                        <a href="{{route('home')}}" class="flex items-center mb-5">
                            <x-logo.white/>
                        </a>
                    </div>

                    <ul class="flex flex-col font-medium md:p-0">
                        <li class="">
                            <a href="{{ route('workers') }}" class="px-5 py-4 block text-white"> For Workers</a>
                        </li>
                        <li>
                            <a href="{{ route('download') }}" class="px-5 py-4 block text-white "> Download</a>
                        </li>
                        <li>
                            <a href="{{ route('features') }}" class="px-5 py-4 block text-white "> Features</a>
                        </li>
                        <li class="px-5 py-4 block text-white">
                            <x-dropdown width="w-68" position="relative">
                                <x-slot name="trigger">
                                    <div class="flex justify-between items-center">
                                        <span class="mr-2"> About</span> <img
                                            src="{{asset('images/dropdown-arrow.svg')}}"/>
                                    </div>
                                </x-slot>
                                <x-slot name="content">
                                    <ul class="py-2 text-sm text-white" aria-labelledby="dropdownLargeButton">
                                        <li class=" mb-3 "><a href="{{route('about')}}" class="hover:text-orange">About Pro4home</a></li>
                                        <li class=" mb-3 "><a href="{{route('about.team')}}" class="hover:text-orange">Meet the Team</a></li>
                                        <li><a href="{{route('about.blog')}}" class="hover:text-orange">Our Blog</a></li>
                                    </ul>
                                </x-slot>
                            </x-dropdown>
                        </li>
                        <li>
                            <a href="{{route('faqs')}}" class="px-5 py-4 block text-white ">FAQs</a>
                        </li>

                        <li>
                            <a href="{{route('contact')}}" class="px-5 py-4 block text-white ">Contact</a>
                        </li>
                        <li class="px-5 py-4 block text-white">
                            <x-dropdown width="w-68" position="relative">
                                <x-slot name="trigger">
                                    <div class="flex justify-between items-center">
                                        <span class="mr-2"> ENG</span> <img
                                            src="{{asset('images/dropdown-arrow.svg')}}"/>
                                    </div>
                                </x-slot>
                                <x-slot name="content">
                                    <ul class="py-2 text-sm text-white" aria-labelledby="dropdownLargeButton">
                                    </ul>
                                </x-slot>
                            </x-dropdown>
                        </li>
                    </ul>
                </div>

                <div class="hidden">
                <div class="hidden">
{{--                    <x-button class="hidden lg:block">--}}
{{--                        <img src="{{asset('images/search.svg')}}"/>--}}
{{--                    </x-button>--}}
                </div>

            </x-container>
        </nav>
    </div>

</header>


{{$slot}}


<footer class="bg-white  relative z-10 mt-16">
    <hr class="border-secondary-100 w-full" />
    <div class="mx-auto w-full max-w-screen-xl pb-10 lg:pb-0  ">
        <!-- ====== Footer Section Start -->
        
        <div class="container px-6 lg:px-auto">
            
            <div class="flex flex-wrap  md:divide-x divide-secondary-100">
                <div class="w-full px-4 pt-16 sm:w-2/3 lg:w-3/12">
                    <div class="w-full ">
                        <a href="javascript:void(0)" class="inline-block max-w-[160px]">
                            <h1 class="text-xl font-bold text-secondary-2 dark:text-white mb-9">
                                <span class="text-secondary">Pro</span><span class="text-orange">4</span><span
                                    class="text-secondary">Home</span>
                            </h1>
                        </a>
                        <p class="text-base text-body-color  mb-7">
                            Lorem ipsum dolor sit amet
                            consectetur. Sit ac feugiat
                            lectus ac habitant ullamcorper
                            neque lacus nulla. Risus
                            euismod tellus fermentum
                            malesuada auctor id morbi vitae.
                            Pellentesque elit
                        </p>
                    </div>
                </div>
                <div class="w-full px-4 sm:w-1/2 lg:w-3/12">
                    <div class="w-full pb-8  pt-16">
                        <h4 class="text-lg font-bold text-secondary-2  mb-9">
                            ABOUT US
                        </h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{route('about')}}"
                                    class="inline-block text-base leading-loose text-body-color hover:text-orange ">
                                    About Pro4Home
                                </a>
                            </li>
                            <li>
                                <a href="{{route('about.team')}}"
                                    class="inline-block text-base leading-loose text-body-color hover:text-orange ">
                                    Our Team
                                </a>
                            </li>
                            <li>
                                <a href="{{route('about.blog')}}"
                                    class="inline-block text-base leading-loose text-body-color hover:text-orange ">
                                    Our Blogs
                                </a>
                            </li>
                            <li>
                                <a href="{{route('terms')}}"
                                    class="inline-block text-base leading-loose text-body-color hover:text-orange ">
                                    Terms of Use
                                </a>
                            </li>
                            <li>
                                <a href="{{route('pnf')}}"
                                    class="inline-block text-base leading-loose text-body-color hover:text-orange ">
                                    Privacy Policy
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="w-full px-4 sm:w-1/2 lg:w-3/12">
                    <div class="w-full pb-8  pt-16">
                        <h4 class="text-lg font-bold text-secondary-2  mb-9">
                            Support
                        </h4>
                        <ul class="space-y-3">
                            <li>
                                <a href="{{route('faqs')}}"
                                    class="inline-block text-base leading-loose text-body-color hover:text-orange ">
                                    FAQ
                                </a>
                            </li>
                            <li>
                                <a href="{{route('contact')}}"
                                    class="inline-block text-base leading-loose text-body-color hover:text-orange ">
                                    Contact
                                </a>
                            </li>
                        </ul>
                        <h4 class="text-lg font-bold text-secondary-2 mt-3  mb-9">
                            Connect with Us
                        </h4>
                        <div class="flex mt-4 sm:justify-center sm:mt-0 md:justify-start">
                            <a href="#" class="text-gray-500 hover:text-gray-900  ms-5">
                                <img src="{{ asset('/images/img_homepage/facebook.svg') }}" alt="">
                                <span class="sr-only">GitHub account</span>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-gray-900  ms-5">
                                <img src="{{ asset('/images/img_homepage/x.svg') }}" alt="">
                                <span class="sr-only">Dribbble account</span>
                            </a>
                            <a href="#" class="text-gray-500 hover:text-gray-900  ms-5">
                                <img src="{{ asset('/images/img_homepage/youtube.svg') }}" alt="">
                                <span class="sr-only">Dribbble account</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full px-4 sm:w-1/2 lg:w-3/12">
                    <div class="w-full pb-8 pt-16">
                        <h4 class="text-lg font-semibold text-dark dark:text-white mb-9">
                            <span class="text-secondary">Download Pro</span><span class="text-orange">4</span><span
                                class="text-secondary">Home</span>
                        </h4>
                        <ul class="space-y-3 flex flex-row lg:flex-col items-center gap-4">
                            <li class="flex items-center">
                                <a href="javascript:void(0)"
                                    class=" text-base leading-loose text-body-color hover:text-orange ">
                                    <img src="{{ asset('images/img_homepage/appstore12.png') }}" alt="">

                                </a>
                            </li>
                            <li class="flex items-center" >
                                <a href="javascript:void(0)"
                                    class=" text-base leading-loose text-body-color hover:text-orange ">
                                    <img src="{{ asset('images/img_homepage/playstore.png') }}" alt="">
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ====== Footer Section End -->
    <div class=" py-4 bg-secondary border-t-2 border-t-secondary-2">
        <x-container class="mx-auto flex items-center justify-center w-full max-w-screen-xl">
                <span class="text-sm text-light ">Pro4Home. Copyright 2024 . All Rights Reserved.
            </span>
        </x-container>

    </div>

</footer>


@livewireScripts
<!-- Scripts -->
<script src="{{asset('be_assets')}}/js/vendor.min.js"></script>
<script src="{{asset('be_assets/js/toastr.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script>
    $(function () { //ready

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "hideDuration": "1000",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        Livewire.on('success', message => {
            toastr.success(message);
        })

        @if(session()->has('success'))
        toastr.success('{{session()->get("success")}}');
        @endif

        @if(session()->has('error'))
        toastr.error('{{session()->get("error")}}');
        @endif

        Livewire.on('error', message => {
            toastr.error(message);

        })

    });
</script>

</body>
</html>
