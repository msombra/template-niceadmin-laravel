<x-layout pagetitle="Editar Acordo" button-top-right="Exibir Histórico">

    {{-- ===== FORM ===== --}}
    <x-form.form-layout action="drc.update" :data-id="$acordo->id" route-list="drc.list">

        {{-- Localizador (NPJ) --}}
        <x-form.input :value="$acordo->localizador_npj" label="Localizador (NPJ)" name="localizador_npj" type="text" max="11" numeric-input />

        {{-- Adverso Principal --}}
        <x-form.input :value="$acordo->adverso_principal" label="Adverso Principal" name="adverso_principal" type="text" col="5" />

        {{-- CPF/CNPJ --}}
        <x-form.input :value="$acordo->cpf_cnpj" label="CPF/CNPJ" name="cpf_cnpj" type="text" max="18" col="3" />

        {{-- MCI --}}
        <x-form.input :value="$acordo->mci" label="MCI" name="mci" type="text" max="9" numeric-input />

        {{-- UF --}}
        <x-form.select label="UF" :name="$name = 'uf'">
            @foreach ($estados as $uf)
                <x-form.option :data="$acordo->uf" :value="$uf->id" :option="$uf->sigla" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Fase Processual --}}
        <x-form.select label="Fase Processual" :name="$name = 'fase_processual'" col="3">
            <x-form.option :data="$acordo->fase_processual" value="PRÉ-PROCESSUAL" option="PRÉ-PROCESSUAL" :name="$name" />
            <x-form.option :data="$acordo->fase_processual" value="PROCESSUAL" option="PROCESSUAL" :name="$name" />
        </x-form.select>

        {{-- GECOR --}}
        <x-form.input :value="$acordo->gecor" label="GECOR" name="gecor" type="text" max="4" numeric-input />

        {{-- Prefixo (Dep.) --}}
        <x-form.input :value="$acordo->prefixo_dependencia" label="Prefixo (Dep.)" name="prefixo_dependencia" type="text" max="4" numeric-input />

        {{-- Tipo Recuperação --}}
        <x-form.select label="Tipo Recuperação" :name="$name = 'tipo_recuperacao'" col="3">
            @foreach ($tipo_recuperacao as $tp)
                <x-form.option :data="$acordo->tipo_recuperacao" :value="$tp->id" :option="$tp->nome" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Classificação --}}
        <x-form.select label="Classificação" :name="$name = 'classificacao'" col="4">
            @foreach ($classificacao as $cf)
                <x-form.option :data="$acordo->classificacao" :value="$cf->id" :option="$cf->nome" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Rastreamento --}}
        <x-form.input :value="$acordo->rastreamento" label="Rastreamento" name="rastreamento" type="text" max="14" numeric-input />

        {{-- Documentos Classificados --}}
        <x-form.select label="Docs. Classificados" :name="$name = 'documentos_classificados'" :type-bool="$acordo->documentos_classificados" />

        {{-- Nº Compromisso --}}
        <x-form.input :value="$acordo->num_compromisso" label="Nº Compromisso" name="num_compromisso" type="text" max="12" numeric-input />

        {{-- Condutor --}}
        <x-form.select label="Condutor" :name="$name = 'condutor'">
            @foreach ($condutores as $condutor)
                <x-form.option :data="$acordo->condutor" :value="$condutor->id" :option="$condutor->nome" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Forma Pagamento --}}
        <x-form.select label="Forma Pagamento" :name="$name = 'forma_pagamento'" col="3">
            @foreach ($forma_pagamento as $fp)
                <x-form.option :data="$acordo->forma_pagamento" :value="$fp->id" :option="$fp->nome" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Valor Honorários --}}
        <x-form.input-money :value="$acordo->valor_honorarios" label="Valor Honorários" name="valor_honorarios" />

        {{-- Valor Recuperação --}}
        <x-form.input-money :value="$acordo->valor_recuperacao" label="Valor Recuperação" name="valor_recuperacao" />

        {{-- Status --}}
        <x-form.select label="Status" :name="$name = 'status'" col="5">
            @foreach ($status as $st)
                <x-form.option :data="$acordo->status" :value="$st->id" :option="$st->nome" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Data Vencimento --}}
        <x-form.input :value="$acordo->data_vencimento" label="Data Vencimento" name="data_vencimento" type="date" />

        {{-- Data Pagamento --}}
        <x-form.input :value="$acordo->data_pagamento" label="Data Pagamento" name="data_pagamento" type="date" />

        {{-- Data Protocolo --}}
        <x-form.input :value="$acordo->data_protocolo" label="Data Protocolo" name="data_protocolo" type="date" />

        {{-- Data Final Vencimento --}}
        <x-form.input :value="$acordo->data_final_vencimento" label="Data Final Vencimento" name="data_final_vencimento" type="date" col="3" />

        {{-- Data Envio Subsídio --}}
        <x-form.input :value="$acordo->data_envio_subsidio" label="Data Envio Subsídio" name="data_envio_subsidio" type="date" col="3" />

        {{-- Dep. Receptora --}}
        <x-form.input :value="$acordo->dependencia_receptora" label="Dep. Receptora" name="dependencia_receptora" type="text" max="14" numeric-input />

        {{-- Formulário Rateio --}}
        <x-form.input :value="$acordo->formulario_rateio" label="Formulário Rateio" name="formulario_rateio" type="text" max="14" numeric-input />

        {{-- Periodicidade --}}
        <x-form.select label="Periodicidade" :name="$name = 'periodicidade'">
            <x-form.option :data="$acordo->periodicidade" value="MENSAL" option="MENSAL" :name="$name" />
            <x-form.option :data="$acordo->periodicidade" value="ANUAL" option="ANUAL" :name="$name" />
        </x-form.select>

        {{-- Qtd. Parcelas --}}
        <x-form.input :value="$acordo->qtd_parcelas" label="Qtd. Parcelas" name="qtd_parcelas" type="number" />

        {{-- Valor Parcela --}}
        <x-form.input-money :value="$acordo->valor_parcela" label="Valor Parcela" name="valor_parcela" />

        {{-- Venc. 1º Parcela --}}
        <x-form.input :value="$acordo->vencimento_primeira_parcela" label="Venc. 1º Parcela" name="vencimento_primeira_parcela" type="date" />

        {{-- Valor Entrada--}}
        <x-form.input-money :value="$acordo->valor_entrada" label="Valor Entrada" name="valor_entrada" />

        {{-- Saldo Devedor Atualizado --}}
        <x-form.input-money :value="$acordo->saldo_devedor_atualizado" label="Saldo Devedor Atualizado" name="saldo_devedor_atualizado" col="3" />

        {{-- Percentual Honorários --}}
        <x-form.input :value="$acordo->percentual_honorarios" label="Percentual Hono." name="percentual_honorarios" type="text" />

        {{-- Andamento --}}
        <x-form.select label="Andamento" :name="$name = 'andamento'" col="3">
            @foreach ($andamentos as $andamento)
                <x-form.option :data="$acordo->andamento" :value="$andamento->id" :option="$andamento->nome" :name="$name" />
            @endforeach
        </x-form.select>

        {{-- Contratos --}}
        <div class="col-md-2 d-flex flex-column align-self-end">
            <button type="button" id="btnContratos" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#contratosModal" title="Clique para visualizar ou inserir contrato" disabled>Contratos (<span id="qtdContratos"></span>)</button>
        </div>

        {{-- Observações --}}
        <x-form.textarea :value="$acordo->observacao" label="Observações" name="observacao" col="12" placeholder="Protocolo realizado como processo apenso" />

        {{-- Input Hidden: Responsável --}}
        <input type="hidden" name="responsavel" id="responsavel" value="{{ Auth::user()->name }}">

    </x-form.form-layout>
    {{-- ===== End Form ===== --}}

    {{-- ===== MODALS ===== --}}

    @include('includes.modal_contratos') {{-- Contratos --}}

    @include('includes.modal_historico') {{-- Histórico --}}

    {{-- ===== END MODALS ===== --}}

    {{-- ===== SCRIPTS ===== --}}
    @include('includes.script_form')
    @push('js')
        <script src="{{ asset('assets/js/drc/drc_form.js') }}"></script>
    @endpush
</x-layout>

