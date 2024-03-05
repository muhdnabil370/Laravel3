<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            ticket create
        </h2>
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center pt-9 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        created new support ticket
    </div>

    <div class=" flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">

            <form method="POST" action="{{ route('ticket.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div>
                    <x-input-label for="title" :value="('Title')" />
                    <x-text-input placeholder="input title" id="title" class="block mt-1 w-full" type="text" name="title" :value="old('title')"  autofocus />
                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                </div>

                <!-- Description -->
                <div class="mt-4">
                    <x-input-label for="description" :value="('Description')" />
                    <x-textarea placeholder="write the description" name="description" id="description" />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <!-- Attachrment -->
                <div class="mt-4">
                    <x-input-label for="attachment" :value="('Attachment')" />
                    <x-file-input     id="attachment" name="attachment" type="file"/>
                    <x-input-error :messages="$errors->get('attachment')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        Create
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>


</x-app-layout>
