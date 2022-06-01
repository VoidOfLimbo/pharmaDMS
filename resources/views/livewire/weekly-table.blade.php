<x-table.master-table>

    <x-slot name="tableoptions">
        <div class="block px-6 rounded-lg shadow-lg bg-white mb-3">
            <div class="flex flex-row justify-center md:justify-between flex-wrap mb-3 p-2 gap-4">
                <div class="flex flex-col items-center">
                    <select wire:model="perpage" name="perpage" id="perpage" class="form-control my-2">
                        @for ($id = 5; $id <= 25; $id += 5)
                            <option value="{{ $id }}">
                                {{ $id }}{{ __(' Carehomes') }}
                            </option>
                        @endfor
                    </select>
                </div>

                <div class="flex flex-col items-center">
                    @php
                        $monthCounter->day = 1;
                    @endphp
                    <select wire:model="month" name="months" id="filterMonths" class="form-control my-2">

                        @for ($id = 1; $id <= 12; $id++)
                            @php
                                $monthCounter->month = $id;
                            @endphp

                            <option value="{{ $id }}">
                                {{ $monthCounter->monthName }}
                            </option>
                        @endfor
                    </select>
                </div>

                @php
                    $monthCounter->month = $today->month;
                @endphp

                <div class="flex justify-center" role="group">
                    @for ($id = 1; $id <= $monthCounter->daysInMonth; $id += 7)
                        <div aria-current="page" class="cursor-pointer inline-block my-2">
                            <input wire:model="byWeek" class="hidden form-check-input" type="radio"
                                name="inlineRadioOptions" id="currentWeek{{ $id }}"
                                value="{{ $monthCounter->startOfWeek() }}">
                            <label
                                class="label-checked:bg-lime-200 bg-lime-500 inline-block px-6 py-2.5 w-full h-full form-check-label inline-block text-black font-bold cursor-pointer"
                                for="currentWeek{{ $id }}">{{ $monthCounter->startOfWeek()->isoFormat('Do MMM') }}</label>
                        </div>
                        @php
                            $monthCounter->addDays(7);
                        @endphp
                    @endfor

                </div>
                {{-- <div class="flex flex-col items-center">
                    <label for="filterStatus"> {{ __('Status ') }} </label>
                    <select wire:model="byStatus" name="status" id="filterStatus" class="form-control">
                        <option value=""> {{ __('All') }} </option>
                        @foreach ($status as $id => $name)
                            <option value="{{ $id }}">
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="flex md:grow flex-col items-center">
                    <label for="searchFilter"> {{ __('Search ')}} </label>
                    <input type="text" wire:model.debounce.350ms="search" name="searchText" id="searchFilter" class="form-control w-full">
                </div>
                <div class="flex flex-col items-center">
                    <label for="filterOrder"> {{ __('Order By ')}} </label>
                    <select wire:model="orderBy" name="resultOrder" id="filterOrder" class="form-control">
                        <option value="id">{{ __('Carehome Id')}}</option>
                        <option value="name">{{ __('Carehome Name')}}</option>
                        <option value="status_id"> {{ __('Carehome Status')}}</option>
                    </select>
                </div>
                <div class="flex flex-col items-center">
                    <label for="filterSort"> {{ __('Sort By ')}} </label>
                    <select wire:model="sortBy" name="resultSort" id="filterSort" class="form-control">
                        <option value="asc">{{ __('Ascending')}}</option>
                        <option value="desc"> {{ __('Descending')}}</option>
                    </select>
                </div> --}}
            </div>
        </div>
    </x-slot>

    <x-slot name="tableheaders">
        <th scope="col" class="px-6 py-3">
            {{ __('Name') }}
        </th>
        <th scope="col" class="px-6 py-3">
            {{ __('Current Stage') }}
        </th>
        <th scope="col" class="px-6 py-3">
            {{ __('Delivery By') }}
        </th>
        <th scope="col" class="px-6 py-3">
            {{ __('Notes') }}
        </th>
        <th scope="col" class="px-6 py-3">

        </th>
    </x-slot>

    <x-slot name="tablecontents">
        @foreach ($carehomes as $carehome)
            <tr class="whitespace-nowrap text-sm text-gray-900">
                <td class="px-6 py-4">
                    {{ $carehome->name }}
                </td>

                <td class="px-6 py-4">
                    {{ $carehome->carehomestages->stage_name }}
                </td>

                <td class="px-6 py-4">
                    @php
                        $deliveryOn = new Carbon\Carbon($carehome->delivery_date);
                    @endphp
                    {{ $deliveryOn->isoformat('dddd Do MMM') }}
                </td>

                <td class="px-6 py-4 break-all truncate max-w-sm">
                    {{ $carehome->stageslogs->Notes }}
                </td>
                <td class="px-6 py-4"  wire:key="event-bind-{{ \Illuminate\Support\Str::random() }}">

                    <a class="px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg  focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out"
                        data-bs-toggle="offcanvas" href="#detailPannel" role="button"
                        aria-controls="detailPannel"
                        wire:key="event-bind-{{ \Illuminate\Support\Str::random() }}"
                        wire:click="setCurrentCarehome({{$carehome->id}})"
                        >
                        {{ __('More...') }}
                    </a>

                    <div class="mx-auto offcanvas offcanvas-end fixed bottom-0 flex flex-col max-w-full bg-white invisible bg-clip-padding shadow-sm outline-none transition duration-300 ease-in-out text-gray-700 top-0 right-0 border-none w-1/3"
                        tabindex="-1" id="detailPannel" aria-labelledby="detailPannelLabel">
                        <div class="offcanvas-header flex items-center justify-between p-4">
                            <h5 class="offcanvas-title mb-0 leading-normal font-semibold" id="detailPannelLabel">
                                {{ __('View and Edit') }} {{ $currentCarehome }}</h5>
                            <button type="button"
                                class="btn-close box-content w-4 h-4 p-2 -my-5 -mr-2 text-black border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                                data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body flex-grow p-4 overflow-y-auto bg-slate-800 h-screen">
                            <div class="">
                                <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
                                    <div class="flex flex-col">
                                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                                    <table class="min-w-full divide-y divide-gray-200 w-full">
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('ID') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->id }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('Name') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->name }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('Current Status') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->carehomestages->stage_name }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('Total Residents') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->total_patients  }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('Week') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->week }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('RxIN') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->stageslogs->RxIN }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('RxENDORSED') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->stageslogs->RxENDORSED }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('RxBIODOSED') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->stageslogs->RxBIODOSED }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('PICKED') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->stageslogs->PICKED }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('PODDED') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->stageslogs->PODDED }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('CHECKED') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->stageslogs->CHECKED }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('FINALCHECKED') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->stageslogs->FINALCHECKED }}
                                                            </td>
                                                        </tr>
                                                        <tr class="border-b">
                                                            <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                {{ __('DELIVERED') }}
                                                            </th>
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                                                {{ $carehome->stageslogs->DELIVERED }}
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>

    <x-slot name="paginate">
        <div class="mt-10 w-full {{ $carehomes->hasPages() ? 'bg-white' : 'bg-slate' }} px-5 py-2 rounded">
            {{ $carehomes->onEachSide(1)->links() }}
        </div>
    </x-slot>



</x-table.master-table>
