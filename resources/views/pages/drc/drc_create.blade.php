<x-layout pagetitle="Cadastrar Acordo">

    {{-- ===== FORM ===== --}}
    <x-form.form-layout action="drc.store" route-list="drc.list">

        {{-- Localizador (NPJ) --}}
        <x-form.input label="Localizador (NPJ)" name="localizador_npj" type="text" numeric-input />

        {{-- Adverso Principal --}}
        <x-form.input label="Adverso Principal" name="adverso_principal" type="text" col="5" />

        {{-- CPF/CNPJ --}}
        <x-form.input label="CPF/CNPJ" name="cpf_cnpj" type="text" col="3" />

        {{-- MCI --}}
        <x-form.input label="MCI" name="mci" type="text" numeric-input />

        {{-- UF --}}
        <x-form.select label="UF" :name="$name = 'uf'">
            @foreach ($estados as $uf)
                <x-form.option :value="$uf->id" :option="$uf->sigla" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Fase Processual --}}
        <x-form.select label="Fase Processual" :name="$name = 'fase_processual'" col="3">
            <x-form.option value="PRÉ-PROCESSUAL" option="PRÉ-PROCESSUAL" :name="$name" />
            <x-form.option value="PROCESSUAL" option="PROCESSUAL" :name="$name" />
        </x-form.select>

        {{-- GECOR --}}
        <x-form.input label="GECOR" name="gecor" type="text" numeric-input />

        {{-- Prefixo (Dep.) --}}
        <x-form.input label="Prefixo (Dep.)" name="prefixo_dependencia" type="text" numeric-input />

        {{-- Tipo Recuperação --}}
        <x-form.select label="Tipo Recuperação" :name="$name = 'tipo_recuperacao'" col="3">
            @foreach ($tipo_recuperacao as $tp)
                <x-form.option :value="$tp->id" :option="$tp->nome" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Classificação --}}
        <x-form.select label="Classificação" :name="$name = 'classificacao'" col="4">
            @foreach ($classificacao as $cf)
                <x-form.option :value="$cf->id" :option="$cf->nome" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Rastreamento --}}
        <x-form.input label="Rastreamento" name="rastreamento" type="text" numeric-input />

        {{-- Documentos Classificados --}}
        <x-form.select label="Docs. Classificados" :name="$name = 'documentos_classificados'" type-bool />

        {{-- Nº Compromisso --}}
        <x-form.input label="Nº Compromisso" name="num_compromisso" type="text" numeric-input />

        {{-- Condutor --}}
        <x-form.select label="Condutor" :name="$name = 'condutor'">
            @foreach ($condutores as $condutor)
                <x-form.option :value="$condutor->id" :option="$condutor->nome" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Forma Pagamento --}}
        <x-form.select label="Forma Pagamento" :name="$name = 'forma_pagamento'" col="3">
            @foreach ($forma_pagamento as $fp)
                <x-form.option :value="$fp->id" :option="$fp->nome" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Valor Honorários --}}
        <x-form.input-money label="Valor Honorários" name="valor_honorarios" />

        {{-- Valor Recuperação --}}
        <x-form.input-money label="Valor Recuperação" name="valor_recuperacao" />

        {{-- Status --}}
        <x-form.select label="Status" :name="$name = 'status'" col="5">
            @foreach ($status as $st)
                <x-form.option :value="$st->id" :option="$st->nome" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Data Vencimento --}}
        <x-form.input label="Data Vencimento" name="data_vencimento" type="date" />

        {{-- Data Pagamento --}}
        <x-form.input label="Data Pagamento" name="data_pagamento" type="date" />

        {{-- Data Protocolo --}}
        <x-form.input label="Data Protocolo" name="data_protocolo" type="date" />

        {{-- Data Final Vencimento --}}
        <x-form.input label="Data Final Vencimento" name="data_final_vencimento" type="date" col="3" />

        {{-- Data Envio Subsídio --}}
        <x-form.input label="Data Envio Subsídio" name="data_envio_subsidio" type="date" col="3" />

        {{-- Dep. Receptora --}}
        <x-form.input label="Dep. Receptora" name="dependencia_receptora" type="text" />

        {{-- Formulário Rateio --}}
        <x-form.input label="Formulário Rateio" name="formulario_rateio" type="text" />

        {{-- Periodicidade --}}
        <x-form.select label="Periodicidade" :name="$name = 'periodicidade'">
            <x-form.option value="MENSAL" option="MENSAL" :name="$name" />
            <x-form.option value="ANUAL" option="ANUAL" :name="$name" />
        </x-form.select>

        {{-- Qtd. Parcelas --}}
        <x-form.input label="Qtd. Parcelas" name="qtd_parcelas" type="number" />

        {{-- Valor Parcela --}}
        <x-form.input-money label="Valor Parcela" name="valor_parcela" />

        {{-- Venc. 1º Parcela --}}
        <x-form.input label="Venc. 1º Parcela" name="vencimento_primeira_parcela" type="date" />

        {{-- Valor Entrada--}}
        <x-form.input-money label="Valor Entrada" name="valor_entrada" />

        {{-- Saldo Devedor Atualizado --}}
        <x-form.input-money label="Saldo Devedor Atualizado" name="saldo_devedor_atualizado" col="3" />

        {{-- Percentual Honorários --}}
        <x-form.input label="Percentual Hono." name="percentual_honorarios" type="text" />

        {{-- Andamento --}}
        <x-form.select label="Andamento" :name="$name = 'andamento'" col="3">
            @foreach ($andamentos as $andamento)
                <x-form.option :value="$andamento->id" :option="$andamento->nome" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Contratos --}}
        <div class="col-md-2 d-flex flex-column align-self-end">
            <button type="button" id="btnContratos" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#contratosModal" title="Clique para visualizar ou inserir contrato" disabled>Contratos (<span id="qtdContratos"></span>)</button>
        </div>

        {{-- Observações --}}
        <x-form.textarea label="Observações" name="observacao" col="12" placeholder="Protocolo realizado como processo apenso" />

    </x-form.form-layout>
    {{-- ===== End Form ===== --}}

    {{-- Modal dos Contratos --}}
    @include('includes.modal_contratos')

    {{-- ===== SCRIPTS ===== --}}
    @include('includes.script_form')
    @push('js')
        <script src="{{ asset('assets/js/drc/drc_form.js') }}"></script>
        <script src="{{ asset('assets/js/drc/crud_contrato.js') }}"></script>
    @endpush
</x-layout>

