<x-layout pagetitle="Cadastrar Usuário">

    {{-- ===== FORM ===== --}}
    <x-form.form-layout action="user.store" route-list="user.index">

        {{-- Nome --}}
        <x-form.input label="Nome" name="name" type="text" col="5" />

        {{-- Email --}}
        <x-form.input label="Email" name="email" type="text" col="4" placeholder="example@rms.adv.br" />

        {{-- Nível --}}
        <x-form.select label="Tipo Usuário" :name="$name = 'nivel'" col="3">
            <x-form.option value="comum" option="Comum" :name="$name" selected />
            <x-form.option value="admin" option="Admin" :name="$name" />
            @can('super_user')
                <x-form.option value="super" option="Super" :name="$name" />
            @endcan
        </x-form.select>

    </x-form.form-layout>
    {{-- ===== End Form ===== --}}

    @push('js')
        <script src="{{ asset('assets/js/form.js') }}"></script>
    @endpush
</x-layout>

