<div>
    <div class="mx-auto py-10 sm:px-6 lg:px-8">
        <div class="block mb-8" id="filterbar">
            @if ($tableoptions)
                {{ $tableoptions }}
            @endif
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="border-separate border border-slate-500 min-w-full divide-y divide-gray-200 w-full">
                            <thead>
                            <tr class="text-lg border-5 bg-gray-200 text-left text-gray-700 uppercase tracking-wider">
                                {{ $tableheaders }}
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                {{ $tablecontents }}
                            </tbody>
                        </table>
                    </div>
                    @if($paginate)
                        {{ $paginate }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
{{$slot}}
