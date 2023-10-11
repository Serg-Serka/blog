<x-app-layout>

<x-slot name="header">
    <div class="mt-6 flex justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </div>
</x-slot>

    <div class="p-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <table>
                <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Is admin</th>
                    <th>Registered at</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($users->toArray()['data'] as $user)
                        <tr class="table-row">
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>@if($user->is_admin) Yes @else No @endif</td>
                            <td>{{$user->created_at}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$users->render()}}
        </div>
    </div>
</x-app-layout>
