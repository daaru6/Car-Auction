@extends('Frontend.layouts.app',['page_title' => $data['page_title']])

@section('content')

<div class="sidebar-menu-container" id="sidebar-menu-container">

    <div class="sidebar-menu-push">

        <div class="sidebar-menu-overlay"></div>

        <div class="sidebar-menu-inner">


            
            @include('Frontend.layouts.nav')



            <div class="slider">
                <div class="fullwidthbanner-container">
                    <div class="fullwidthbanner">
                        <ul>
                            <li class="first-slide" data-transition="fade" data-slotamount="10" data-masterspeed="300">
                                <img src="{{URL::asset("frontassets/images/supercar-wallpapers-bugatti-3.jpg")}}" data-fullwidthcentering="on" alt="slide">
                                <div class="tp-caption first-line lft tp-resizeme start" data-x="center" data-hoffset="0" data-y="160" data-speed="1000" data-start="200" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0">Creative Portfolio</div>
                                <div class="tp-caption second-line lfb tp-resizeme start" data-x="center" data-hoffset="0" data-y="210" data-speed="1000" data-start="800" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0">Best site for vehicle</div>
                                <div class="tp-caption third-line lfb tp-resizeme start" data-x="center" data-hoffset="0" data-y="280" data-speed="1000" data-start="800" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0">We belong to and <em>help members</em> of several car clubs</div>
                                <div class="tp-caption slider-thumb sfb tp-resizeme start container hidden-xs hidden-sm" data-x="center" data-hoffset="0" data-y="460" data-speed="1000" data-start="2200" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0">
                                    <div class="col-md-4">
                                        <a href="single-list.html"><div class="thumb-item">
                                            <div class="top-content">
                                                <span>RS55,000</span>
                                                <div class="span-bg"></div>
                                                <h2>2015 bmw 328i touring</h2>
                                            </div>
                                            <div class="down-content">
                                                <p>Sed te idque graecis. Vel ne libris erer<br> dolores, mel graece mel viveo</p>
                                                <img src="http://dummyimage.com/60x60/cccccc/fff.jpg" alt="">	
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="single-list.html"><div class="thumb-item">
                                            <div class="top-content">
                                                <span>RS30,000</span>
                                                <div class="span-bg"></div>
                                                <h2>vencer sarthe 2015 </h2>
                                            </div>
                                            <div class="down-content">
                                                <p>Sed te idque graecis. Vel ne libris erer<br> dolores, mel graece mel viveo</p>
                                                <img src="http://dummyimage.com/60x60/cccccc/fff.jpg" alt="">	
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="single-list.html"><div class="thumb-item">
                                            <div class="top-content">
                                                <span>RS45,000</span>
                                                <div class="span-bg"></div>
                                                <h2>CLS63 AMG S-Model 4MATIc</h2>
                                            </div>
                                            <div class="down-content">
                                                <p>Sed te idque graecis. Vel ne libris erer<br> dolores, mel graece mel viveo</p>
                                                <img src="http://dummyimage.com/60x60/cccccc/fff.jpg" alt="">	
                                            </div>
                                        </div></a>
                                    </div>
                                </div>
                            </li>
                            <li class="first-slide" data-transition="fade" data-slotamount="10" data-masterspeed="300">
                                <img src="{{URL::asset("frontassets/images/NGzwTao.jpg")}}" data-fullwidthcentering="on" alt="slide">
                                <div class="tp-caption first-line lft tp-resizeme start" data-x="center" data-hoffset="0" data-y="160" data-speed="1000" data-start="200" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0">Welcome to Auction</div>
                                <div class="tp-caption second-line lfb tp-resizeme start" data-x="center" data-hoffset="0" data-y="210" data-speed="1000" data-start="800" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0">Find your dream car</div>
                                <div class="tp-caption third-line lfb tp-resizeme start" data-x="center" data-hoffset="0" data-y="280" data-speed="1000" data-start="800" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0">Visit <em>car listing</em> page, to see all cars</div>
                                <div class="tp-caption slider-thumb sfb tp-resizeme start container hidden-xs hidden-sm" data-x="center" data-hoffset="0" data-y="460" data-speed="1000" data-start="2200" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0">
                                    <div class="col-md-4">
                                        <a href="single-list.html"><div class="thumb-item">
                                            <div class="top-content">
                                                <span>RS55,000</span>
                                                <div class="span-bg"></div>
                                                <h2>2015 bmw 328i touring</h2>
                                            </div>
                                            <div class="down-content">
                                                <p>Sed te idque graecis. Vel ne libris erer<br> dolores, mel graece mel viveo</p>
                                                <img src="http://dummyimage.com/60x60/cccccc/fff.jpg" alt="">	
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="single-list.html"><div class="thumb-item">
                                            <div class="top-content">
                                                <span>RS30,000</span>
                                                <div class="span-bg"></div>
                                                <h2>vencer sarthe 2015 </h2>
                                            </div>
                                            <div class="down-content">
                                                <p>Sed te idque graecis. Vel ne libris erer<br> dolores, mel graece mel viveo</p>
                                                <img src="http://dummyimage.com/60x60/cccccc/fff.jpg" alt="">	
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="single-list.html"><div class="thumb-item">
                                            <div class="top-content">
                                                <span>RS45,000</span>
                                                <div class="span-bg"></div>
                                                <h2>CLS63 AMG S-Model 4MATIc</h2>
                                            </div>
                                            <div class="down-content">
                                                <p>Sed te idque graecis. Vel ne libris erer<br> dolores, mel graece mel viveo</p>
                                                <img src="http://dummyimage.com/60x60/cccccc/fff.jpg" alt="">	
                                            </div>
                                        </div></a>
                                    </div>
                                </div>
                            </li>
                            <li class="first-slide" data-transition="fade" data-slotamount="10" data-masterspeed="300">
                                <img src="{{URL::asset("frontassets/images/beautiful-car-background.jpeg")}}" data-fullwidthcentering="on" alt="slide">
                                <div class="tp-caption first-line lft tp-resizeme start" data-x="center" data-hoffset="0" data-y="160" data-speed="1000" data-start="200" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0">More opportunities</div>
                                <div class="tp-caption second-line lfb tp-resizeme start" data-x="center" data-hoffset="0" data-y="210" data-speed="1000" data-start="800" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0">Put your car on sale</div>
                                <div class="tp-caption third-line lfb tp-resizeme start" data-x="center" data-hoffset="0" data-y="280" data-speed="1000" data-start="800" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0">Find used cars on <em>recent cars</em> page</div>
                                <div class="tp-caption slider-thumb sfb tp-resizeme start container hidden-xs hidden-sm" data-x="center" data-hoffset="0" data-y="460" data-speed="1000" data-start="2200" data-easing="Power4.easeOut" data-splitin="none" data-splitout="none" data-elementdelay="0" data-endelementdelay="0">
                                    <div class="col-md-4">
                                        <a href="single-list.html"><div class="thumb-item">
                                            <div class="top-content">
                                                <span>RS55,000</span>
                                                <div class="span-bg"></div>
                                                <h2>2015 bmw 328i touring</h2>
                                            </div>
                                            <div class="down-content">
                                                <p>Sed te idque graecis. Vel ne libris erer<br> dolores, mel graece mel viveo</p>
                                                <img src="http://dummyimage.com/60x60/cccccc/fff.jpg" alt="">	
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="single-list.html"><div class="thumb-item">
                                            <div class="top-content">
                                                <span>RS30,000</span>
                                                <div class="span-bg"></div>
                                                <h2>vencer sarthe 2015 </h2>
                                            </div>
                                            <div class="down-content">
                                                <p>Sed te idque graecis. Vel ne libris erer<br> dolores, mel graece mel viveo</p>
                                                <img src="http://dummyimage.com/60x60/cccccc/fff.jpg" alt="">	
                                            </div>
                                        </div></a>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="single-list.html"><div class="thumb-item">
                                            <div class="top-content">
                                                <span>RS45,000</span>
                                                <div class="span-bg"></div>
                                                <h2>CLS63 AMG S-Model 4MATIc</h2>
                                            </div>
                                            <div class="down-content">
                                                <p>Sed te idque graecis. Vel ne libris erer<br> dolores, mel graece mel viveo</p>
                                                <img src="http://dummyimage.com/60x60/cccccc/fff.jpg" alt="">	
                                            </div>
                                        </div></a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div id="cta-1">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Owners of salvage-title <em>vehicles</em> will encounter some unique issues.</p>
                            <div class="advanced-button">
                                <a href="listing-right.html">See all cars<i class="fa fa-car"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <section class="why-us">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="left-content">
                                <div class="heading-section">
                                    <h2>Why choose us?</h2>
                                    <span>Vivamus gravida magna massa in cursus mi vehicula at. Nunc sem quam suscipit</span>
                                    <div class="line-dec"></div>
                                </div>
                                <div class="services">
                                    <div class="col-md-6">
                                        <div class="service-item">
                                            <i class="fa fa-bar-chart-o"></i>
                                            <div class="tittle">
                                                <h2>Results of Drivers</h2>
                                            </div>
                                            <p>Integer nec posuere metus, at feugiat. Sed sodales venenat malesuada.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="service-item">
                                            <i class="fa fa-gears"></i>
                                            <div class="tittle">
                                                <h2>upgrades performance</h2>
                                            </div>
                                            <p>Integer nec posuere metus, at feugiat. Sed sodales venenat malesuada.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="service-item second-row">
                                            <i class="fa fa-pencil"></i>
                                            <div class="tittle">
                                                <h2>product sellers</h2>
                                            </div>
                                            <p>Integer nec posuere metus, at feugiat. Sed sodales venenat malesuada.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="service-item second-row last-service">
                                            <i class="fa fa-wrench"></i>
                                            <div class="tittle">
                                                <h2>Fast Service</h2>
                                            </div>
                                            <p>Integer nec posuere metus, at feugiat. Sed sodales venenat malesuada.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="right-img">
                                <img src="{{URL::asset("frontassets/images/th.jpg")}}" alt="">
                                <div class="img-bg"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="featured-listing">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="heading-section-2 text-center">
                                <h2>Featured Cars Listing</h2>
                                <span>Vivamus gravida magna massa in cursus mi vehicula at. Nunc sem quam suscipit</span>
                                <div class="dec"><i class="fa fa-car"></i></div>
                                <div class="line-dec"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="featured-cars">
                            <div class="featured-item col-md-15 col-sm-6">
                                <img src="http://dummyimage.com/310x210/cccccc/fff.jpg" alt="">
                                <div class="down-content">
                                    <a href="single-list.html"><h2>Mercedes Amg 6.3</h2></a>
                                    <span>52,000</span>
                                    <div class="light-line"></div>
                                    <p>Donec eu nullas sapien pretium volutpat vel quis turpis. Donec vel risus lacinia euismod urna vel fringilla justo.</p>
                                    <div class="car-info">
                                        <ul>
                                            <li><i class="icon-gaspump"></i>Diesel</li>
                                            <li><i class="icon-car"></i>Sport</li>
                                            <li><i class="icon-road2"></i>12,000</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-item col-md-15 col-sm-6">
                                <img src="http://dummyimage.com/310x210/cccccc/fff.jpg" alt="">
                                <div class="down-content">
                                    <a href="single-list.html"><h2>vw golf VII GTI</h2></a>
                                    <span>30,000</span>
                                    <div class="light-line"></div>
                                    <p>Donec eu nullas sapien pretium volutpat vel quis turpis. Donec vel risus lacinia euismod urna vel fringilla justo.</p>
                                    <div class="car-info">
                                        <ul>
                                            <li><i class="icon-gaspump"></i>Diesel</li>
                                            <li><i class="icon-car"></i>Sport</li>
                                            <li><i class="icon-road2"></i>12,000</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-item col-md-15 col-sm-6">
                                <img src="http://dummyimage.com/310x210/cccccc/fff.jpg" alt="">
                                <div class="down-content">
                                    <a href="single-list.html"><h2>mercedes amg gt</h2></a>
                                    <span>65,000</span>
                                    <div class="light-line"></div>
                                    <p>Donec eu nullas sapien pretium volutpat vel quis turpis. Donec vel risus lacinia euismod urna vel fringilla justo.</p>
                                    <div class="car-info">
                                        <ul>
                                            <li><i class="icon-gaspump"></i>Diesel</li>
                                            <li><i class="icon-car"></i>Sport</li>
                                            <li><i class="icon-road2"></i>12,000</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-item col-md-15 col-sm-6">
                                <img src="http://dummyimage.com/310x210/cccccc/fff.jpg" alt="">
                                <div class="down-content">
                                    <a href="single-list.html"><h2>bmw m4 430D</h2></a>
                                    <span>64,000</span>
                                    <div class="light-line"></div>
                                    <p>Donec eu nullas sapien pretium volutpat vel quis turpis. Donec vel risus lacinia euismod urna vel fringilla justo.</p>
                                    <div class="car-info">
                                        <ul>
                                            <li><i class="icon-gaspump"></i>Diesel</li>
                                            <li><i class="icon-car"></i>Sport</li>
                                            <li><i class="icon-road2"></i>12,000</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="featured-item col-md-15 hidden-sm">
                                <img src="http://dummyimage.com/310x210/cccccc/fff.jpg" alt="">
                                <div class="down-content">
                                    <a href="single-list.html"><h2>audi a6 s-line</h2></a>
                                    <span>48,000</span>
                                    <div class="light-line"></div>
                                    <p>Donec eu nullas sapien pretium volutpat vel quis turpis. Donec vel risus lacinia euismod urna vel fringilla justo.</p>
                                    <div class="car-info">
                                        <ul>
                                            <li><i class="icon-gaspump"></i>Diesel</li>
                                            <li><i class="icon-car"></i>Sport</li>
                                            <li><i class="icon-road2"></i>12,000</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



            <section class="clients">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="owl-demo">
                                <div class="item">
                                    <img src="{{URL::asset("frontassets/images/client-1.png")}}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{URL::asset("frontassets/images/client-2.png")}}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{URL::asset("frontassets/images/client-3.png")}}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{URL::asset("frontassets/images/client-4.png")}}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{URL::asset("frontassets/images/client-5.png")}}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{URL::asset("frontassets/images/client-6.png")}}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{URL::asset("frontassets/images/client-3.png")}}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{URL::asset("frontassets/images/client-2.png")}}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{URL::asset("frontassets/images/client-1.png")}}" alt="">
                                </div>
                                <div class="item">
                                    <img src="{{URL::asset("frontassets/images/client-4.png")}}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>

    </div>

    @include('Frontend.layouts.footer')
    @include('Frontend.layouts.mobile-nav')


</div>


@endsection