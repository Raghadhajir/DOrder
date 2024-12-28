<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="#">
                    <div class="brand-logo"><img class="logo" src="{{ asset('app-assets/images/logo/logo.png') }}" />
                    </div>
                    <h2 class="brand-text mb-0">Derrbni Order</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i
                        class="bx bx-x d-block d-xl-none font-medium-4 primary"></i><i
                        class="toggle-icon bx bx-disc font-medium-4 d-none d-xl-block primary"
                        data-ticon="bx-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation"
            data-icon-style="lines">
            <li class=" navigation-header"><span>DOrder</span>
            </li>
            <!-- الصفحة الرئيسية -->
            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title"
                        data-i18n="Dashboard"></span></a>
                <ul class="menu-content">
                    <li class="active"><a href="{{route('mainpage')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="eCommerce">main page</span></a>

                    </li>
                </ul>
            </li>
            <br>
            <br>
            @if (auth::user()->type === "admin")


                    <!-- city -->
                    <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><i
                                class="menu-livicon" data-icon="desktop"></i><span class="menu-title"
                                data-i18n="Dashboard">city</span></a>
                        <ul class="menu-content">
                            <li class="active"><a href="{{route('showcities')}}"><i class="bx bx-right-arrow-alt"></i><span
                                        class="menu-item" data-i18n="eCommerce">show cities</span></a>
                            </li>
                            <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><span
                                        class="menu-title" data-i18n="Dashboard">manage</span></a>
                                <ul class="menu-content">
                                    <li class="active"><a href="{{route('addcity')}}"><i class="bx bx-right-arrow-alt"></i><span
                                                class="menu-item" data-i18n="eCommerce">add city</span></a>
                                    </li>
                                    <li class="active"><a href="{{route('deletedcity')}}"><i
                                                class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                                data-i18n="eCommerce">city trash</span></a>
                                    </li>


                                </ul>
                            </li>
                    </li>

                </ul>
                </li>



                <br>
                <br>
            @endif
        <!-- area -->
        <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><i
                    class="menu-livicon" data-icon="desktop"></i><span class="menu-title"
                    data-i18n="Dashboard">area</span></a>
            <ul class="menu-content">
                <li class="active"><a href="{{route('showareas')}} "><i class="bx bx-right-arrow-alt"></i><span
                            class="menu-item" data-i18n="eCommerce">show areas</span></a>
                </li>
                @if (auth::user()->type === "admin")


                    <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><span
                                class="menu-title" data-i18n="Dashboard">manage</span></a>
                        <ul class="menu-content">
                            <li class="active"><a href="{{route('addarea')}}"><i class="bx bx-right-arrow-alt"></i><span
                                        class="menu-item" data-i18n="eCommerce">add area</span></a>
                            </li>
                            <li class="active"><a href="{{route('deletedarea')}}"><i class="bx bx-right-arrow-alt"></i><span
                                        class="menu-item" data-i18n="eCommerce">area trash</span></a>
                            </li>

                        </ul>
                    </li>
                @endif
            </ul>
        </li>
        <br>
        <br>
        @if (auth::user()->type === "admin")


            <!-- addadmin -->
            <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><i
                        class="menu-livicon" data-icon="desktop"></i><span class="menu-title"
                        data-i18n="Dashboard">admin</span></a>
                <ul class="menu-content">
                    <li class="active"><a href="{{route('showadmins')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="eCommerce">show admins</span></a>
                    </li>
                    <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><span
                                class="menu-title" data-i18n="Dashboard">manage</span></a>
                        <ul class="menu-content">
                            <li class="active"><a href="{{route('showaddadmin')}} "><i
                                        class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">add
                                        admin</span></a>
                            </li>
                            <li class="active"><a href="{{route('adminnotactive')}} "><i
                                        class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">not
                                        active admins</span></a>
                            </li>


                        </ul>
                    </li>
                </ul>
            </li>
            <br>
            <br>
        @endif
        @if (auth::user()->type === "admin")


            <!-- monitor -->
            <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><i
                        class="menu-livicon" data-icon="desktop"></i><span class="menu-title"
                        data-i18n="Dashboard">monitor</span></a>
                <ul class="menu-content">
                    <li class="active"><a href="{{route('showmonitors')}}"><i class="bx bx-right-arrow-alt"></i><span
                                class="menu-item" data-i18n="eCommerce">show monitors</span></a>
                    </li>
                    <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><span
                                class="menu-title" data-i18n="Dashboard">manage</span></a>
                        <ul class="menu-content">
                            <li class="active"><a href="{{route('showaddmonitor')}}"><i
                                        class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">add
                                        monitor</span></a>
                            </li>
                            <li class="active"><a href="{{route('monitornotactive')}} "><i
                                        class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">not
                                        active monitors</span></a>
                            </li>


                        </ul>
                    </li>
                </ul>
            </li>
            <br>
            <br>
        @endif
        <!-- packages -->
        <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><i
                    class="menu-livicon" data-icon="desktop"></i><span class="menu-title"
                    data-i18n="Dashboard">package</span></a>
            <ul class="menu-content">
                <li class="active"><a href="{{route('showpackage')}} "><i class="bx bx-right-arrow-alt"></i><span
                            class="menu-item" data-i18n="eCommerce">show packages</span></a>
                </li>
                @if (auth::user()->type === "admin")


                    <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><span
                                class="menu-title" data-i18n="Dashboard">manage</span></a>
                        <ul class="menu-content">
                            <li class="active"><a href="{{route('showaddpackage')}}"><i
                                        class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">add
                                        package</span></a>
                            </li>


                        </ul>
                    </li>
                @endif
            </ul>
        </li>
        <br>
        <br>
        <!-- delivary -->
        <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><i
                    class="menu-livicon" data-icon="desktop"></i><span class="menu-title"
                    data-i18n="Dashboard">delivary</span></a>
            <ul class="menu-content">
                <li class="active"><a href="{{route('showdeliveries')}}"><i class="bx bx-right-arrow-alt"></i><span
                            class="menu-item" data-i18n="eCommerce">show delivaries</span></a>
                </li>
                <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><span
                            class="menu-title" data-i18n="Dashboard">manage</span></a>
                    <ul class="menu-content">
                        <li class="active"><a href="{{route('showadddelivery')}}"><i
                                    class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">add
                                    delivary man</span></a>
                        </li>
                        <li class="active"><a href="{{route('delivernotactive')}} "><i
                                    class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">not
                                    active delivaries</span></a>
                        </li>


                    </ul>
                </li>
            </ul>
        </li>
        <br>
        <br>
        <!-- customer -->

        <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><i
                    class="menu-livicon" data-icon="desktop"></i><span class="menu-title"
                    data-i18n="Dashboard">customer</span></a>
            <ul class="menu-content">
                <li class="active"><a href="{{route('showcustomer')}}"><i class="bx bx-right-arrow-alt"></i><span
                            class="menu-item" data-i18n="eCommerce">show customers</span></a>
                </li>
                <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><span
                            class="menu-title" data-i18n="Dashboard">manage</span></a>
                    <ul class="menu-content">
                        <li class="active"><a href="{{route('showaddcustomer')}}"><i
                                    class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">add
                                    customer</span></a>
                        </li>
                        <li class="active"><a href="{{route('customernotactive')}} "><i
                                    class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">not
                                    active customers</span></a>
                        </li>

                    </ul>
                    <!-- <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><span
                            class="menu-title" data-i18n="Dashboard">manage</span></a>
                    <ul class="menu-content">
                        <li class="active"><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                    data-i18n="eCommerce">show delivaries</span></a>
                        </li>
                        <li><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                    data-i18n="Analytics">edit delivary</span></a>
                        </li> -->

            </ul>
        </li>
        <!-- </ul>
        </li> -->
        <br>
        <br>
        <!-- order -->

        <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><i
                    class="menu-livicon" data-icon="desktop"></i><span class="menu-title"
                    data-i18n="Dashboard">order</span></a>
            <ul class="menu-content">
                <li class="active"><a href="{{route('showorders')}}"><i class="bx bx-right-arrow-alt"></i><span
                            class="menu-item" data-i18n="eCommerce">show orders</span></a>
                </li>
                <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><span
                            class="menu-title" data-i18n="Dashboard">manage</span></a>
                    <ul class="menu-content">
                        <li class="active"><a href="{{route('showaddorder')}}"><i
                                    class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">add
                                    order </span></a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><span
                            class="menu-title" data-i18n="Dashboard">manage</span></a>
                    <ul class="menu-content">
                        <li class="active"><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                    data-i18n="eCommerce">show delivaries</span></a>
                        </li>
                        <li><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                                    data-i18n="Analytics">edit delivary</span></a>
                        </li> -->


        </li>
        <!-- </ul>
        </li> -->
        <br>
        <br>
        <!-- setting -->
        <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><i
                    class="menu-livicon" data-icon="desktop"></i><span class="menu-title"
                    data-i18n="Dashboard">setting</span></a>
            <ul class="menu-content">
                <li class="active"><a href="{{route('showworktime')}}"><i class="bx bx-right-arrow-alt"></i><span
                            class="menu-item" data-i18n="eCommerce">working hours</span></a>
                </li>
                @if (auth::user()->type === "admin")


                    <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><span
                                class="menu-title" data-i18n="Dashboard">manage</span></a>
                        <ul class="menu-content">
                            <li class="active"><a href="{{route('showaddworktime')}}"><i
                                        class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">add
                                        work time</span></a>
                            </li>


                        </ul>
                    </li>
                @endif
            </ul>
        </li>
        <br>
        <br>

        <!-- support -->
        <li class=" nav-item"><a href="../../../html/rtl/vertical-menu-template-semi-dark/index.html"><i
                    class="menu-livicon" data-icon="desktop"></i><span class="menu-title"
                    data-i18n="Dashboard">support</span></a>
            <ul class="menu-content">
                <li class="active"><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                            data-i18n="eCommerce">recommend</span></a>
                </li>
                <li class="active"><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item"
                            data-i18n="eCommerce">rating</span></a>
                </li>
            </ul>
        </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
