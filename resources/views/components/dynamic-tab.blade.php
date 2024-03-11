<!-- dynamic-nav-tabs.blade.php -->

<div class="nav nav-tabs bg-light pt-2 px-2">
    @foreach($tabs as $tab)
        <div>
            @if($tab['route'])
                <a href="{{ route($tab['route']) }}" class="text-capitalize nav-link{{ $tab['activeTab'] ? ' active' : '' }}{{ $tab['route'] ? ' px-4 fw-bold' : '' }}">
                    {{ $tab['label'] }}
                </a>
            @else
                <button class="text-capitalize nav-link{{ $tab['activeTab'] ? ' active' : '' }}{{ $tab['route'] ? ' px-4 fw-bold' : '' }}">
                    {{ $tab['label'] }}
                </button>
            @endif
        </div>
    @endforeach
</div>
