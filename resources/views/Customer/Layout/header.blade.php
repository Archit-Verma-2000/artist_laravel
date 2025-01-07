<header id="myHeader" class="header_section">
		<div class="mid_menu_header">
			<div class="container">
				<div class="row">
					<div class="col-3">
						<div class="header_logo">
							<a href="index.php">
								<img src="{{asset('Customer/images/logo.png')}}" alt="Logo" /></a>
						</div>
					</div>
					<div class="col-9 text-left menus">
						<div class="header_navigation">
							<div id="mySidenavs" class="sidenavs">
								<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
								<ul class="menu_navigation">
									<li class=""><a href="{{route('index')}}" class="active">Home</a>
									</li>
									<li><a href="products.php">Products </a></li>
                                    <li><a href="{{route('login')}}">Login</a></li>
                                    <li><a href="{{route('register')}}">Register</a></li>
								</ul>
							</div>
                            <div class="last-mains">
									<form action="#">
										<input type="text" name="" id="" placeholder="Search">
										<label for="">
											<img src="{{asset('Customer/images/Button.png')}}" alt="">
										</label>
									</form>
									
								</div>
							<div class="icons">
								<a href="" class="carts ">
									<img src="{{asset('Customer/images/cart.png')}}" alt="" class="">
									<!-- <img src="{{asset('Customer/images/cart-w.png')}}" alt="" class="mobile"> -->
								</a>
							</div>
							<span class="toggle_menu" onclick="openNav()"><i class="fa fa-bars"></i></span>
						</div>
					</div>

				</div>
				</di v>
			</div>
	</header>