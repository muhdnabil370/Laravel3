<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            index
        </h2>
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center pt-9 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        Support Ticket List
    </div>

    <div class=" flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">

            @foreach ($tickets as $items)
            <div class=" flex justify-between py-4">
                <a href="{{ route('ticket.show' , $items->id) }}">{{ $items->title }}</a>
                <p>{{ $items->created_at->diffForHumans() }}</p>
            </div>
            @endforeach

        </div>


    </div>


</x-app-layout>
