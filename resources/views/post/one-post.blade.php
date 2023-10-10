<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post['title'] }}
        </h2>
        <br/>
        <p>
            {{$post['body']}}
        </p>
        <br/>
        <h4>{{$post['created_at']}} by {{$userName}}</h4>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            Comments:
            @foreach($comments as $comment)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2><b>{{$comment['name']}}</b></h2>
                        <br/>
                        <p>
                            {{$comment['body']}}
                        </p>
                        <br/>
                        <h4>{{$comment['created_at']}} by {{$comment['email']}}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
