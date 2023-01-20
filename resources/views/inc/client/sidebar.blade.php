<!--/sidebar-menu-->
				<div class="sidebar-menu">
					<header class="logo">
					<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="/zizix6/client"> <span id="logo"> <h1>ZIZIX6</h1></span> 
					<!--<img id="logo" src="" alt="Logo"/>--> 
				  </a> 
				</header>
			<div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
			<!--/down-->
							<div class="down">	
									  <a href="index.html"><img src="{{env('APP_STORAGE')}}/images/no_img.png"></a>
									  <a href="index.html"><span class=" name-caret">{{$client->name}}</span></a>
									 <p>Zizix6 Client</p>
									<ul>
									<!--
									<li><a class="tooltips" href="index.html"><span>Profile</span><i class="lnr lnr-user"></i></a></li>
									
									<li><a class="tooltips" href="index.html"><span>Settings</span><i class="lnr lnr-cog"></i></a></li>
									-->
										<li><a class="tooltips" href="{{env('APP_URL')}}client/logout"><span>Log out</span><i class="lnr lnr-power-switch"></i></a></li>
										</ul>
									</div>
							   <!--//down-->
                           <div class="menu">
									<ul id="menu" >
										<li><a href="/zizix6/client"><i class="fa fa-tachometer"></i> <span>My Dashboard</span></a></li>
										
										<li><a href="/zizix6/client/concluded"><i class="fa fa-tachometer"></i> <span>Concluded Orders</span></a></li>
										<li></li>
										<li><a href="/zizix6"><i class="fa fa-tachometer"></i> <span>ZIZIX6 HOME</span></a></li>
								  </ul>
								</div>
							  </div>
							  <div class="clearfix"></div>		
							</div>