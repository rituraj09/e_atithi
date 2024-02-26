<nav class="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        <span>e</span>Atithi 
        <span>
            @if (auth()->user()->roles[0]->name === 'admin' || auth()->user()->roles[0]->name === 'super admin')
                admin
            @endif
        </span>
      </a>
      <div class="sidebar-toggler not-active">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <x-sidebar/>
  </nav>