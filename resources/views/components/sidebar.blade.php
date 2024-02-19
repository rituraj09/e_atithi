<div class="sidebar-body">
    <div class="nav-item p-2 m-auto">
      {{ auth()->user()->roles[0]->name }}
  </div>
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
      @if( auth()->guard('web')->user()->hasRole('super admin') )
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#guestHouse" role="button" aria-expanded="false" aria-controls="houses">
          <i class="link-icon" data-feather="home"></i>
          <span class="link-title">Guest House</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="guestHouse">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('all-guest-house') }}" class="nav-link">All Guest Houses</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('add-guest-house') }}" class="nav-link">Add Guest Houses</a>
            </li>
          </ul>
        </div>
      </li>
      @endif


      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#roomCategories" role="button" aria-expanded="false" aria-controls="category">
          <i class="link-icon" data-feather="home"></i>
          <span class="link-title">Room Category</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="roomCategories">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('guest-house-admin-add-room-category') }}" class="nav-link">All Room Categories</a>
            </li>
            <li class="nav-item">
              <a href="guest house admin's categories only" class="nav-link">Our Room Categories</a>
            </li>
            <li class="nav-item">
              <a href="extra page for add room category" class="nav-link">Add Room Categories</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#rooms" role="button" aria-expanded="false" aria-controls="rooms">
          <i class="link-icon" data-feather="home"></i>
          <span class="link-title">Rooms</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="rooms">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('guest-house-admin-rooms') }}" class="nav-link">All Rooms</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('guest-house-admin-add-room') }}" class="nav-link">Add Rooms</a>
            </li>
            <li class="nav-item">
              <a href="simultaneous room features" class="nav-link">Room Config</a>
            </li>
          </ul>
        </div>
      </li>
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
          <span class="link-title">Sub Users</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="subUsers">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="{{ route('all-sub-users') }}" class="nav-link">All Sub Users</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('add-sub-users') }}" class="nav-link">Add Sub User</a>
            </li>
            <li class="nav-item">
              <a href="extra page for add room category" class="nav-link">Add Room Categories</a>
            </li>
          </ul>
        </div>
      </li>
      
      
      <li class="nav-item nav-category">Pages</li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#settings" role="button" aria-expanded="false" aria-controls="settings">
          <i class="link-icon" data-feather="sliders"></i>
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