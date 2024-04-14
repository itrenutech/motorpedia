<div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li>
                                <a href="#" class="waves-effect">
                                    <i class="bx bx-calendar"></i>
                                    <span key="t-calendar">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript: void(0);" class="has-arrow waves-effect">
                                    <i class="bx bx-layer"></i>
                                    <span key="t-ecommerce">Brand</span>
                                </a>
                                <ul class="sub-menu" aria-expanded="false">
                                    <li><a href="{{route('brand.create')}}" key="t-products">Add Brand</a></li>
                                    <li><a href="{{route('brand.index')}}" key="t-orders">Active Brand</a></li>
                                    <li><a href="{{route('brand.inactive')}}" key="t-customers">Inactive Brand</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
