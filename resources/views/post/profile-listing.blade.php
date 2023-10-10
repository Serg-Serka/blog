<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My posts') }}
        </h2>

        <x-primary-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'create-post')"
        >
            Create new post!
        </x-primary-button>
        <x-modal name="create-post" focusable>
            <form method="post" action="{{ route('posts.create') }}" class="p-6">
                @csrf
                @method('put')

                <div class="mt-6">
                    <x-input-label for="title" value="{{ __('Title') }}"/>

                    <x-text-input
                        id="title"
                        name="title"
                        class="mt-1 block w-3/4"
                    />

                    <x-input-label for="body" value="{{ __('Body') }}"/>
                    <textarea
                        id="body"
                        name="body"
                        class="mt-1 block w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    </textarea>

                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-primary-button class="ml-3">
                        {{ __('Save changes') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @foreach ($posts as $post)
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        @include('post.profile-one-post')
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

