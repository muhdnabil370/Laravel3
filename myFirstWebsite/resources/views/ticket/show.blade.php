<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            show
        </h2>
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center pt-9 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        Support Ticket List
    </div>

    <div class=" flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">

            <div class=" flex justify-between py-4">
                <p>{{ $ticket->description }}</p>
                <p>{{ $ticket->created_at->diffForHumans() }}</p>

                @if ($ticket->attachment)
                    <a href="{{ '/storage/' . $ticket->attachment }}" target="_blank"> Attachment</a>
                @endif
            </div>
            <div class="flex justify-between">
                <div class="flex">

                    <a href="{{ route('ticket.edit', $ticket->id) }}">
                        <x-primary-button>Edit</x-primary-button>
                    </a>

                    <form class="ml-3" action="{{ route('ticket.destroy', $ticket->id) }}" method="POST" >
                        @method('delete')
                        @csrf

                        <x-primary-button>Delete</x-primary-button>

                    </form>
                </div>
                {{-- @if (auth()->user()->isAdmin) --}}
                    <div class="flex ml-4">
                        <form action="{{ route('ticket.update', $ticket->id) }}" method="post">
                            @method('patch')
                            @csrf

                            <input type="hidden" name="status" value="resolved">
                            <x-primary-button>Approve</x-primary-button>
                        </form>


                        <form class="ml-3" action="{{ route('ticket.update', $ticket->id) }}" method="POST" >
                            @method('patch')
                            @csrf

                            <input type="hidden" name="status" value="rejected">
                            <x-primary-button>Reject</x-primary-button>

                        </form>
                    </div>
                {{-- @else --}}
                    <p>Status: {{ $ticket->status }}</p>
                {{-- @endif --}}

            </div>


        </div>


    </div>


</x-app-layout>
