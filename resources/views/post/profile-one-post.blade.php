<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{$post['title']}}
        </h2>
    </header>

    <div>
        <p class="mt-1 text-sm text-gray-600">
            {{$post['body']}}
        </p>
    </div>

    @auth
    <div class="flex items-center gap-4">
        <x-primary-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'post-{{$post['id']}}-update')">
            {{ __('Edit') }}
        </x-primary-button>
        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-post-{{$post['id']}}-deletion')">
            {{ __('Delete') }}
        </x-danger-button>
        <x-modal name="confirm-post-{{$post['id']}}-deletion" focusable>
            <form method="post" action="{{ route('posts.delete') }}" class="p-6">
                <input type="hidden" value="{{$post['id']}}" name="post_id">
                @csrf
                @method('delete')
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete this post?') }}
                </h2>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('Delete Post') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
        <x-modal name="post-{{$post['id']}}-update" focusable>
            <form method="post" action="{{ route('posts.update') }}" class="p-6">
                <input type="hidden" value="{{$post['id']}}" name="post_id">
                @csrf
                @method('patch')

                <div class="mt-6">
                    <x-input-label for="title" value="{{ __('Title') }}"/>

                    <x-text-input
                        id="title"
                        name="title"
                        class="mt-1 block w-3/4"
                        value="{{$post['title']}}"
                    />

                    <x-input-label for="body" value="{{ __('Body') }}" />
                    <textarea
                        id="body"
                        name="body"
                        class="mt-1 block w-3/4 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        {{$post['body']}}
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

    </div>
    @endauth


</section>

