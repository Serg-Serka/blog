<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My comments') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($comments as $comment)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2>{{$comment['name']}}, {{$comment['created_at']}}</h2>
                        <div>
                            <p class="mt-1 text-sm text-gray-600">
                                {{$comment['body']}}
                            </p>
                        </div>
                            <button
                                type="button"
                                onclick="window.location = '{{ route("posts.show", $comment['post_id']) }}'"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >
                                View Post
                            </button>
                        </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>


