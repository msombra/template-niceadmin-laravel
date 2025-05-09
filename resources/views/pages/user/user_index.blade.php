<x-layout pagetitle="Lista de Usuários">

    {{-- Botão de Add Novo Usuário --}}
    <div class="text-end mb-4">
        <a href="{{ route('user.create') }}" class="btn btn-sm btn-primary shadow-sm">Adicionar Novo Usuário</a>
    </div>

    @if (session('error_delete'))
        <div class="alert alert-danger fs-13 text-center">
            <b>{{ session('error_delete') }}</b>
        </div>
    @endif

    {{-- Tabela --}}
    <table id="userTable" class="table table-hover text-nowrap text-center datatable" style="width: 100%; cursor: default;">
        <thead>
            <tr>
                <th class="text-center order-by">ID</th>
                <th class="text-center">Nome</th>
                <th class="text-center">Email</th>
                <th class="text-center">Tipo</th>
                <th class="text-center">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="text-start">{{ $user->id }}</td>
                    <td class="txt-wrap">{{ $user->name }}</td>
                    <td class="txt-wrap">{{ $user->email }}</td>
                    <td class="txt-wrap">{{ $user->nivel }}</td>
                    <td class="class-center">
                        @can('super_user')
                            <x-button.actions route="user" :data-id="$user->id" />
                        @endcan
                        @if (Auth::user()->nivel === 'admin' && $user->nivel !== 'super')
                            <x-button.actions route="user" :data-id="$user->id" />
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Plugins --}}
    @include('includes.datatable')
    @include('includes.toasts')

</x-layout>
