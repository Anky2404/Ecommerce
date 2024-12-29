<header>
    <div class="container-wrap">
        <div class="row-wrap">

            <div class="col5">
                <div class="head-menus">
                    <ul>
                        <li>
                            <a href="{{route('user.home')}}">Home</a>
                        </li>
                        <li>
                            <a href="{{route('user.about')}}">About</a>
                        </li>
                        <li>
                            <a href="{{route('user.shop')}}">Shop</a>
                        </li>

                        <li>
                            <a href="{{route('user.contact')}}">Contact</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col5">
                <div class="logo">
                    <a href="{{route('user.home')}}">Fashion<span>Craze</span></a>
                </div>
            </div>
            <div class="col2">
                <div class="dropdown">
                    <div class="user-icon">
                    <i class="fa-regular fa-user"></i>
                    <span>Oliver Jones</span>

                    </div>
                    <div class="drop-content">
                    <ul class="head-left-menu">
                        <li><a href="{{route('user.orders')}}">Orders</a></li>
                        <li><a href="{{route('user.profile')}}">Profile</a></li>
                        <li><a href="{{route('user.cart')}}">Cart <i class="fa-solid fa-cart-shopping"></i></a></li>
                        <li><a href="{{route('user.login-page')}}">Logout <i class="fa-solid fa-right-to-bracket"></i></a></li>
                    </ul>
                    </div>

                </div>



            </div>

        </div>

       

    </div>
</header>