<div class="h-screen fixed z-50" id="sideNav">
    {{-- menu for pc devices or larger tablet devices --}}
    <div class="w-64 fixed top-0 left-0 bottom-0 bg-slate-900 shadow h-full flex-col justify-between hidden md:flex">

        {{-- actual navigation content --}}
        <div class="px-8">
            @if(isset($logo))
                {{-- logo goes here --}}
                {{ $logo }}
            @endif
            <main>
                {{$slot}}
            </main>
        </div>
    </div>
</div>
