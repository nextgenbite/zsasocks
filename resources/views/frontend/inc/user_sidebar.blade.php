<div class="sidebar sidebar--style-3 no-border stickyfill p-0">
    <div class="widget mb-0">
        <div class="widget-profile-box text-center p-3">
            <img src="{{ asset(auth()->user()->avatar ?? 'images/user.png') }}" class="image rounded-circle">
            <div class="name">{{ $data->name }}</div>
            <p class="text-warning text-bold ">  <i class="la la-dollar"></i>My {{ isset($settings['point_name']) ? $settings['point_name'] : 'point'}}: {{auth()->user()->points}}</p>
        </div>
        <div class="sidebar-widget-title py-3">
            <span>Menu</span>
        </div>
        <div class="widget-profile-menu py-3">
            <ul class="categories categories--style-3">
                <li>
                    <a href="/dashboard" class="{{ Route::is('dashboard') ? 'active' : '' }}">
                        <i class="la la-dashboard"></i>
                        <span class="category-name">
                            Dashboard
                        </span>
                    </a>
                </li>

                <li>
                    <a href="/purchase-history" class="{{ Route::is('purchase.history') ? 'active' : '' }}">
                        <i class="la la-file-text"></i>
                        <span class="category-name">
                            Purchase History </span>
                    </a>
                </li>
      
                {{-- <li>
                    <a href="/sent-refund-reuest" class="">
                        <i class="la la-file-text"></i>
                        <span class="category-name">
                            Sent Refund Request
                        </span>
                    </a>
                </li> --}}
                <li>
                    <a href="/profile" class="{{ Route::is('profile') ? 'active' : '' }}">
                        <i class="la la-user"></i>
                        <span class="category-name">
                            Manage Profile
                        </span>
                    </a>
                </li>
                {{-- <li>
                    <a href="/coin" class="{{ Route::is('coin') ? 'active' : '' }}">
                        <i class="la la-dollar"></i>
                        <span class="category-name">
                            My {{ isset($settings['point_name']) ? $settings['point_name'] : 'point' }}
                        </span>
                    </a>
                </li> --}}


             
            </ul>
        </div>
    </div>
</div>