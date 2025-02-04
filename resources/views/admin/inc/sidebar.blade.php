  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/home')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" target="_blank" href="{{url('/')}}">
          <i class="bi bi-house-door"></i>
          <span>Visit Site</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/admin/user')}}">
          <i class="bi bi-people"></i>
          <span>Customer</span>
        </a>
      </li><!-- End Setting Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Category</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/admin/category/create')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
          <li>
            <a href="{{url('/admin/category')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>

        </ul>
      </li><!-- End Department Nav -->

     
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-box"></i><span>Product</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/admin/product/create')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
          <li>
            <a href="{{url('/admin/product')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>

        </ul>
      </li><!-- End Subject Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-images"></i><span>Slider</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/admin/slider/create')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
          <li>
            <a href="{{url('/admin/slider')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
        </ul>
      </li><!-- End NotiCouponce Nav -->
      <li class="nav-item">
        <a class="nav-link " href="{{url('/admin/order')}}">
          <i class="bi bi-receipt"></i>
          <span>Sales</span>
        </a>
      </li><!-- End Sales Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Report</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="report-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/admin/report/buying-product')}}">
              <i class="bi bi-circle"></i><span>Buying Product</span>
            </a>
          </li>
          <li>
            <a href="{{url('/admin/report/product-stock')}}">
              <i class="bi bi-circle"></i><span>Stock</span>
            </a>
          </li>
          {{-- <li>
            <a href="{{url('/admin/report/buying-product')}}">
              <i class="bi bi-circle"></i><span>Buying Product</span>
            </a>
          </li> --}}

        </ul>
      </li><!-- End Report Nav -->

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-person"></i><span>Report</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          
          <li>
            <a href="{{url('/admin/stock')}}">
              <i class="bi bi-circle"></i><span>Stock</span>
            </a>
          </li>
        </ul>
      </li><!-- End Teacher Nav --> --}}


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-Page" data-bs-toggle="collapse" href="#">
          <i class="bi bi-card-text"></i><span>Page</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-Page" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/admin/page/create')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
          <li>
            <a href="{{url('/admin/page')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>

        </ul>
      </li><!-- End Page Nav -->
   
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#review-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-images"></i><span>Gallary</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="review-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/admin/review/create')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
          <li>
            <a href="{{url('/admin/review')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>
        </ul>
      </li><!-- End Review Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#delivery-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-truck"></i><span>Delivery</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="delivery-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('/admin/delivery-cost/create')}}">
              <i class="bi bi-circle"></i><span>Add</span>
            </a>
          </li>
          <li>
            <a href="{{url('/admin/delivery-cost')}}">
              <i class="bi bi-circle"></i><span>List</span>
            </a>
          </li>

        </ul>
      </li><!-- End Department Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('/admin/setting')}}">
          <i class="bi bi-gear"></i>
          <span>Setting</span>
        </a>
      </li><!-- End Setting Page Nav -->



    </ul>

  </aside><!-- End Sidebar-->
