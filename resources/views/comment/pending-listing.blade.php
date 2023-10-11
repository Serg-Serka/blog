<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pending comments') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach($comments as $comment)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2>{{$comment['name']}}, {{$comment['created_at']}} by {{$comment['email']}}</h2>
                        <div>
                            <p class="mt-1 text-sm text-gray-600">
                                {{$comment['body']}}
                            </p>
                        </div>
                        <br/>


                        <div class="mt-6 flex ">
                            <button
                                type="button"
                                onclick="window.location = '{{ route("posts.show", $comment['post_id']) }}'"
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                            >
                                View Post
                            </button>

                                <form method="post" action="{{route('comments.approve')}}">
                                    @csrf
                                    @method('patch')
                                    <input type="hidden" name="comment_id" value="{{$comment['id']}}">
                                    <x-primary-button class="ml-3">
                                        Approve
                                    </x-primary-button>

                                </form>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>


