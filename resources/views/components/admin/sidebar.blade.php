<div class="sidebar-body">
    <ul class="nav">
      <li class="nav-item nav-category">Main</li>
      <li class="nav-item">
        <a href="/" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item nav-category">web apps</li>

      @if (Auth::guard('web')->user()->hasPermissionTo('add.room'))
        
      @endif
      {{-- guest house --}}
      @if( auth()->guard('web')->user()->hasRole('super admin') )
      <li class="nav-item">
        <a href="{{ route('all-guest-house') }}" class="nav-link">
          <i class="link-icon" data-feather="map-pin"></i>
          <span class="link-title">Manage Guest House</span>
        </a>
      </li>
      @endif

      @if( auth()->guard('web')->user()->hasRole('admin') )
      {{-- rooms --}}
      <li class="nav-item">
        <a href="{{ route('guest-house-admin-rooms') }}" class="nav-link">
          <i class="link-icon" data-feather="home"></i>
          <span class="link-title">Manage Rooms</span>
        </a>
      </li>
      {{-- room rate --}}
      <li class="nav-item">
        <a href="{{ route('room-rates') }}" class="nav-link">
          <i class="link-icon" data-feather="dollar-sign"></i>
          <span class="link-title">Manage Room Rates</span>
        </a>
      </li>
      {{-- features --}}
      <li class="nav-item">
        <a href="{{ route('guest-house-room-features') }}" class="nav-link">
          <i class="link-icon" data-feather="gift"></i>
          <span class="link-title">Manage Room Features</span>
        </a>
      </li>
      {{-- reservations --}}
      <li class="nav-item">
        <a href="{{ route('all-reservations') }}" class="nav-link">
          <i class="link-icon" data-feather="briefcase"></i>
          <span class="link-title">Manage Reservations</span>
        </a>
      </li>
      {{-- utils --}}
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#extras" role="button" aria-expanded="false" aria-controls="extras">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">Extras</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="extras">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('room-category-price') }}" class="nav-link">Manage Room Category</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('bed-categories') }}" class="nav-link">Manage Bed Category</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/compose.html" class="nav-link">Compose</a>
            </li>
          </ul>
        </div>
      </li>
      @endif
      {{-- email --}}
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#emails" role="button" aria-expanded="false" aria-controls="emails">
          <i class="link-icon" data-feather="mail"></i>
          <span class="link-title">Email</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="emails">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="pages/email/inbox.html" class="nav-link">Inbox</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/read.html" class="nav-link">Read</a>
            </li>
            <li class="nav-item">
              <a href="pages/email/compose.html" class="nav-link">Compose</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a href="pages/apps/chat.html" class="nav-link">
          <i class="link-icon" data-feather="message-square"></i>
          <span class="link-title">Chat</span>
        </a>
      </li>
      <li class="nav-item nav-category">Components</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#subUsers" role="button" aria-expanded="false" aria-controls="users">
          <i class="link-icon" data-feather="user"></i>
          <span class="link-title">Manage User</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="subUsers">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('all-sub-users') }}" class="nav-link">All Users</a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">User Logs</a>
            </li>
          </ul>
        </div>
      </li>
      
      <li class="nav-item nav-category">Pages</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#settings" role="button" aria-expanded="false" aria-controls="settings">
          <i class="link-icon" data-feather="settings"></i>
          <span class="link-title">Settings</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="settings">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="Super admin, db room categories" class="nav-link">All Guest Houses</a>
            </li>
            <li class="nav-item">
              <a href="guest house admin's categories only" class="nav-link">Add Guest Houses</a>
            </li>
            <li class="nav-item">
              <a href="extra page for add room category" class="nav-link">Add Room Categories</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">Docs</li>
      <li class="nav-item">
        <a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
          <i class="link-icon" data-feather="hash"></i>
          <span class="link-title">Documentation</span>
        </a>
      </li>
    </ul>
  </div>