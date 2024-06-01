<div class="sidebar-body">
    <ul class="nav">
      {{-- <li class="nav-item nav-category">Main</li> --}}
      <li class="nav-item">
        <a href="/" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">Main</li>

      @if (Auth::guard('web')->user()->hasPermissionTo('add.room'))
        
      @endif
      {{-- guest house --}}
      @if( auth()->guard('web')->user()->hasRole('super admin') )
      <li class="nav-item">
        <a href="{{ route('all-guest-house') }}" class="nav-link">
          <i class="link-icon" data-feather="home"></i>
          <span class="link-title">Manage Guest House</span>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ route('all-sub-users') }}" class="nav-link">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Manage Users</span>
        </a>
      </li>
      @endif  

      @if( auth()->guard('web')->user()->hasRole('admin') )
      {{-- rooms --}}
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#extras" role="button" aria-expanded="false" aria-controls="extras">
          <i class="link-icon" data-feather="home"></i>
          <span class="link-title">Manage Rooms</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="extras">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('guest-house-admin-rooms') }}" class="nav-link">All Rooms</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('room-category-price') }}" class="nav-link">Room Category</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('bed-categories') }}" class="nav-link">Bed Category</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('guest-house-room-features') }}" class="nav-link">Room Features</a>
            </li>
          </ul>
        </div>
      </li>
      @endif
      {{-- reservations --}}
      @if (Auth::guard('web')->user()->hasPermissionTo('add.reservation') )
      <li class="nav-item">
        <a href="{{ route('all-reservations') }}" class="nav-link">
          <i class="link-icon" data-feather="briefcase"></i>
          <span class="link-title">Manage Reservations</span>
        </a>
      </li>
      @endif
      @if( auth()->guard('web')->user()->hasRole('admin') )
      {{-- transaction --}}
      <li class="nav-item">
        <a href="{{ route('transaction') }}" class="nav-link">
          <i class="link-icon" data-feather="briefcase"></i>
          <span class="link-title">Manage Transactions</span>
        </a>
      </li>
      {{-- bills --}}
      <li class="nav-item">
        <a href="{{ route('all-bills') }}" class="nav-link">
          <i class="link-icon" data-feather="credit-card"></i>
          <span class="link-title">Manage Bills</span>
        </a>
      </li>
      {{-- receipt --}}
      <li class="nav-item">
        <a href="{{ route('all-receipts') }}" class="nav-link">
          <i class="link-icon" data-feather="trello"></i>
          <span class="link-title">Manage Receipts</span>
        </a>
      </li>
      {{-- payments --}}
      <li class="nav-item">
        <a href="{{ route('all-payments') }}" class="nav-link">
          <i class="link-icon" data-feather="dollar-sign"></i>
          <span class="link-title">Manage Payments</span>
        </a>
      </li>
      @endif
      
      @if( auth()->guard('web')->user()->hasRole('admin') )
      <li class="nav-item nav-category">Config</li>
      <li class="nav-item">
        <a href="{{ route('guest-house-config') }}" class="nav-link">
          <i class="link-icon" data-feather="settings"></i>
          <span class="link-title">Guest House Setting</span>
        </a>
      </li>
      @endif

      @if( auth()->guard('web')->user()->hasRole('admin') )
      <li class="nav-item">
        <a href="{{ route('all-sub-users') }}" class="nav-link">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Manage Users</span>
        </a>
      </li>
      @endif

      @if( auth()->guard('web')->user()->hasRole('super admin') )
      <li class="nav-item nav-category">Logs</li>
      <li class="nav-item">
        <a href="{{ route('guest-house-config') }}" class="nav-link">
          <i class="link-icon" data-feather="database"></i>
          <span class="link-title">Guest Logs</span>
        </a>
      </li>
      @endif
    </ul>
  </div>