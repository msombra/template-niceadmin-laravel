<x-layout pagetitle="Editar Usuário">

    {{-- ===== FORM ===== --}}
    <x-form.form-layout action="user.update" :data-id="$user->id" route-list="user.index">

        {{-- Nome --}}
        <x-form.input :value="$user->name" label="Nome" name="name" type="text" col="5" />

        {{-- Email --}}
        <x-form.input :value="$user->email" label="Email" name="email" type="text" col="4" placeholder="example@rms.adv.br" />

        {{-- Nível --}}
        <x-form.select label="Tipo Usuário" :name="$name = 'nivel'" col="3">
            <x-form.option :data="$user->nivel" value="comum" option="Comum" :name="$name" />
            <x-form.option :data="$user->nivel" value="admin" option="Admin" :name="$name" />
            <x-form.option :data="$user->nivel" value="super" option="Super" :name="$name" />
        </x-form.select>

    </x-form.form-layout>
    {{-- ===== End Form ===== --}}

    @push('js')
        <script src="{{ asset('assets/js/form.js') }}"></script>
    @endpush
</x-layout>

