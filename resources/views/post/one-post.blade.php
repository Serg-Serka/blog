<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    @auth
        @include('layouts.navigation')
    @endauth
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            @if($error)
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Sorry, something went wrong, we can not retrieve selected post.
                    </h2>
            @else
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ $post['title'] }}
                    </h2>
                    <br/>
                    <p>
                        {{$post['body']}}
                    </p>
                    <br/>
                    <h4>{{$post['created_at']}} by {{$userName}}</h4>
            @endif
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                        Add comment:
                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl">
                                <form method="post" action="{{route('comments.store')}}">
                                    <input type="hidden" value="{{$post['id']}}" name="post_id">
                                    @csrf
                                    @method('put')

                                    <x-input-label for="name" value="{{ __('Title') }}"/>

                                    <x-text-input
                                        id="name"
                                        name="name"
                                        class="mt-1 block w-3/4"
                                    />

                                    <x-input-label for="body" value="{{ __('Body') }}" />
                                    <textarea
                                        id="body"
                                        name="body"
                                        class="mt-1 block w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>

                                    @unless(\Illuminate\Support\Facades\Auth::check())
                                        <x-input-label for="email" value="{{ __('Email') }}"/>

                                        <x-text-input
                                            id="email"
                                            name="email"
                                            class="mt-1 block w-3/4"
                                        />
                                    @endunless
                                    <br/>
                                    <x-primary-button>
                                        {{ __('Add comment') }}
                                    </x-primary-button>
                                </form>
                            </div>
                        </div>

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
        </div>
    </header>
</div>
</body>
</html>


