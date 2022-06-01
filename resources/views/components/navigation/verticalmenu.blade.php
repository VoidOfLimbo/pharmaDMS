<ul class="mt-12">
    {{-- Formatted menu item dashboard --}}
    <x-navigation.nav-menu-item href="{{ route('dashboard') }}" :active="request()->routeIs('/dashboard')">

        {{-- path for dashboard svg --}}
        <x-slot name="icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-grid" width="18" height="18"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z"></path>
                <rect x="4" y="4" width="6" height="6" rx="1"></rect>
                <rect x="14" y="4" width="6" height="6" rx="1"></rect>
                <rect x="4" y="14" width="6" height="6" rx="1"></rect>
                <rect x="14" y="14" width="6" height="6" rx="1"></rect>
            </svg>
        </x-slot>

        {{-- corresponding text --}}
        {{ __('Dashboard') }}

        {{-- !!! | make it dynamic later | !!! --}}

        {{-- <x-slot name="changes"> 5 </x-slot> --}}
    </x-navigation.nav-menu-item>
</ul>
