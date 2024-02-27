<div class="d-flex justify-content-between mb-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          @if ( $prev )
            <li class="breadcrumb-item"><a href="#">{{ $prev }}</a></li>
          @endif
          <li class="breadcrumb-item active" aria-current="page">{{ $title }}</li>
        </ol>
    </nav>
    {{-- <h6 class="card-title my-auto">{{ $title }}</h6> --}}
    <a href="{{ URL::previous() }}" class="d-none btn btn-sm btn-outline-secondary">
        <span class="mdi mdi-arrow-left"></span>
        back
    </a>
</div>