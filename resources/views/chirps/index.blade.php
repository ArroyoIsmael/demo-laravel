<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Chirps') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                      <form method="POST" action="{{ route('chirps.store')}}">
                        @csrf
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            {{__('Your message')}}
                        </label>
                        <textarea id="message" name="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-transparent dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="{{__('Write your thoughts here...')}}">{{ old('message')}}</textarea>
                        <x-input-error class="mt-3" :messages="$errors->get('message')"></x-input-error>

                        <x-primary-button class="mt-4">Enviar</x-primary-button>
                    </form>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($chirps as $chirp)
                        <li class="pb-3 sm:pb-4 ml-2 mb-2 pt-2">
                            <div class="flex items-center space-x-4 rtl:space-x-reverse">
                                <div class="flex-shrink-0">
                                    <svg class="h6 w-6 text-gray-600 dark:text-gray-400 -scale-x-100" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-6 h-6">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="flex gap-2">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $chirp->user->name}}
                                        </p>
                                        <p class="text-xs text-gray-500 truncate dark:text-gray-400">
                                            {{ $chirp->created_at->format('Y-m-d g:i:a')}}
                                        </p>

                                        @if($chirp->created_at != $chirp->updated_at)
                                            <small class="text-xs text-gray-500 truncate dark:text-gray-400">
                                                &middot; {{ __('Edited')}}
                                            </small>
                                        @endif

                                        @can('update', $chirp)
                                            <x-dropdown>
                                                <x-slot name="trigger">
                                                    <button><svg class="w-5 h-5 text-gray-500 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                                    </svg>
                                                    </button>
                                                </x-slot>
                                                <x-slot name="content">
                                                    <x-dropdown-link :href="route('chirps.edit', $chirp)">
                                                        {{__('Editar Chip')}}
                                                    </x-dropdown-link>
                                                    <form method="POST"  action="{{ route('chirps.destroy', $chirp)}}">
                                                        @csrf @method('DELETE')
                                                        <x-dropdown-link
                                                            :href="route('chirps.destroy', $chirp)"
                                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                                            {{__('Eliminar Chip')}}
                                                        </x-dropdown-link>
                                                    </form>

                                                </x-slot>

                                            </x-dropdown>
                                        @endcan



                                    </div>

                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $chirp->message}}
                                    </p>




                                </div>
                            </div>
                        </li>
                    @endforeach

                </ul>

            </div>
        </div>
    </div>
</x-app-layout>
