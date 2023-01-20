<!-- Page Sidebar -->
            <div class="page-sidebar">
                <a class="logo-box" href="index.html">
                    <span>ecaps</span>
                    <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
                    <i class="icon-close" id="sidebar-toggle-button-close"></i>
                </a>
                <div class="page-sidebar-inner">
                    <div class="page-sidebar-menu">
                        <ul class="accordion-menu">
                            <li class="active-page">
                                <a href="{{url('admin')}}">
                                    <i class="menu-icon icon-home4"></i><span>Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('adminClients.index')}}">
                                    <i class="menu-icon icon-flash_on"></i><span>Clients({{$clients->count()}})</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('adminOrders.index') }}">
                                    <i class="menu-icon icon-code"></i><span>Orders({{$orders->count()}})</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{url('admin/messages')}}">
                                    <i class="menu-icon icon-code"></i><span>Messages({{$messages->count()}})</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('promos.index') }}">
                                    <i class="menu-icon icon-code"></i><span>Promotions({{$promos->count()}})</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{url('admin/blacklists')}}">
                                    <i class="menu-icon icon-code"></i><span>Blacklists({{$blacklists->count()}})</span>
                                </a>
                            </li>
                        <!--   
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="menu-icon icon-code"></i><span>Albums</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="form-elements.html">Elements</a></li>
                                </ul>
                            </li>
                          -->  
                            
                            
                            <li class="menu-divider"></li>
                            
                        </ul>
                    </div>
                </div>
            </div><!-- /Page Sidebar -->