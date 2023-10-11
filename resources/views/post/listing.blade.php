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
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Posts') }}
                </h2>

                <x-primary-button
                    x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'filter-posts')"
                >
                    Filtering
                </x-primary-button>
                <x-modal name="filter-posts" focusable>
                    <form method="get" action="{{ route('blog') }}" class="p-6">

                        <div class="mt-6">
                            <x-input-label for="title" value="{{ __('Title contains') }}"/>

                            <x-text-input
                                id="title"
                                name="title"
                                class="mt-1 block w-3/4"
                            />

                            <x-input-label for="body" value="{{ __('Body contains') }}"/>
                            <textarea
                                id="body"
                                name="body"
                                class="mt-1 block w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>

                            <x-input-label for="email" value="{{ __('Authors email') }}"/>

                            <x-text-input
                                id="email"
                                name="email"
                                class="mt-1 block w-3/4"
                            />

                            <x-input-label for="dateFrom" value="{{ __('From') }}" />
                            <input
                                id="dateFrom"
                                name="dateFrom"
                                type="date"
                                class="mt-1 block w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            />

                            <x-input-label for="dateTo" value="{{ __('To') }}" />
                            <input
                                id="dateTo"
                                name="dateTo"
                                type="date"
                                class="mt-1 block w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            />

                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-primary-button class="ml-3">
                                {{ __('Apply filters') }}
                            </x-primary-button>
                        </div>
                    </form>
                </x-modal>
            </div>
        </header>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                @foreach ($posts->toArray()['data'] as $post)
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            <header>
                                <h2 class="text-lg font-medium text-gray-900">
                                    {{$post->title}}
                                </h2>
                            </header>

                            <div>
                                <p class="mt-1 text-sm text-gray-600">
                                    {{$post->body}}
                                </p>
                            </div>
                            <button
                                type="button"
                                onclick="window.location = '{{ route("posts.show", $post->id) }}'"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >
                                View Post
                            </button>
                        </div>
                    </div>
                @endforeach

                {{$posts->render()}}
            </div>
        </div>
    </div>
</body>
</html>

