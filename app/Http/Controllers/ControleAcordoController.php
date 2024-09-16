<?php

namespace App\Http\Controllers;

use App\Exports\DrcExport;
use Illuminate\Http\Request;
use App\Models\Auxiliares\Uf;
use App\Models\ControleAcordo;
use App\Models\Contrato;
use App\Models\ControleAcordoHistorico;
use App\Models\Auxiliares\Status;
use Illuminate\Support\Facades\DB;
use App\Models\Auxiliares\Condutor;
use App\Models\Auxiliares\Andamento;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Auxiliares\Classificacao;
use App\Models\Auxiliares\FormaPagamento;
use App\Models\Auxiliares\TipoRecuperacao;

class ControleAcordoController extends Controller
{
    // =====================================================
    // LIST
    // =====================================================
    public function list()
    {
        // $acordos = DB::table('controle_acordos as ca')
        // ->select(
        //     'ca.id',
        //     'localizador_npj',
        //     'tp.nome as tipo_recuperacao',
        //     'adverso_principal',
        //     'mci',
        //     'updated_at'
        // )
        // ->join('controle_acordos_tipo_recuperacao_aux as tp', 'tipo_recuperacao', 'tp.id')
        // ->get();
        $acordos = ControleAcordo::with('tipoRecuperacaoAux')->get();
        // dd($acordos);
// dd(ControleAcordo::with('ufAux')->get());
        return view('pages.drc.drc_list', compact('acordos'));
    }


    // =====================================================
    // CREATE & STORE
    // =====================================================
    public function create()
    {
        $compact = $this->tabelasAux();

        return view('pages.drc.drc_create', $compact);
    }

    public function store(Request $request)
    {
        $dados = $request->all();

        $this->validarRegras($request);

        ControleAcordo::create($dados);

        return redirect()->route('drc.list')->with('success', 'Acordo inserido com sucesso');
    }


    // =====================================================
    // EDIT & UPDATE
    // =====================================================
    public function edit(Request $request, $id)
    {
        $acordo = ControleAcordo::find($id);

        if(!$acordo) {
            return redirect()->back();
        }

        $camposAcordo = [
            'localizador_npj'               => 'Localizador (NPJ)',
            'adverso_principal'             => 'Adverso Principal',
            'cpf_cnpj'                      => 'CPF/CNPJ',
            'mci'                           => 'MCI',
            'uf'                            => 'UF',
            'fase_processual'               => 'Fase Processual',
            'gecor'                         => 'GECOR',
            'prefixo_dependencia'           => 'Prefixo (Dep.)',
            'tipo_recuperacao'              => 'Tipo Recuperação',
            'classificacao'                 => 'Classificação',
            'rastreamento'                  => 'Rastreamento',
            'documentos_classificados'      => 'Documentos Classificados',
            'num_compromisso'               => 'Nº Compromisso',
            'condutor'                      => 'Condutor',
            'forma_pagamento'               => 'Forma Pagamento',
            'valor_honorarios'              => 'Valor Honorários',
            'valor_recuperacao'             => 'Valor Recuperação',
            'status'                        => 'Status',
            'data_vencimento'               => 'Data Vencimento',
            'data_pagamento'                => 'Data Pagamento',
            'data_protocolo'                => 'Data Protocolo',
            'data_final_vencimento'         => 'Data Final Vencimento',
            'data_envio_subsidio'           => 'Data Envio Subsídio',
            'dependencia_receptora'         => 'Dependência Receptora',
            'formulario_rateio'             => 'Formulário Rateio',
            'periodicidade'                 => 'Periodicidade',
            'qtd_parcelas'                  => 'Quantidade de Parcelas',
            'valor_parcela'                 => 'Valor Parcela',
            'vencimento_primeira_parcela'   => 'Vencimento 1º Parcela',
            'valor_entrada'                 => 'Valor Entrada',
            'saldo_devedor_atualizado'      => 'Saldo Devedor Atualizado',
            'percentual_honorarios'         => 'Percentual Honorários',
            'andamento'                     => 'Andamento',
            'observacao'                    => 'Observação'
        ];

        // Buscar o histórico de alterações para esse registro
        $historico = ControleAcordoHistorico::where('model', ControleAcordo::class)
                                            ->where('model_id', $id)
                                            ->orderBy('created_at', 'desc')
                                            ->get();

        $tabelasAux = $this->tabelasAux();

        return view('pages.drc.drc_edit', compact('acordo', 'historico', 'camposAcordo'), $tabelasAux);
    }

    public function update(Request $request, $id)
    {
        $acordo = ControleAcordo::find($id);

        if(!$acordo) {
            return redirect()->back();
        }

        $resultado = ($acordo['localizador_npj'] === $request['localizador_npj']) ? false : true;
        $this->validarRegras($request, $resultado); // se o resultado for false, desativa regra unique do campo localizador_npj

        $dados = $request->all();
        $acordo->update($dados);

        return redirect()->route('drc.list')->with('success', 'Acordo atualizado com sucesso');
    }


    // =====================================================
    // SHOW & DESTROY
    // =====================================================
    public function show($id)
    {
        $acordo = ControleAcordo::find($id);

        if(!$acordo) {
            return redirect()->back();
        }

        $tabelasAux = $this->tabelasAux();

        $contratos = Contrato::where('localizador_npj', $acordo->localizador_npj)->get();
        $qtdContratos = $contratos->count();

        return view('pages.drc.drc_show', compact('acordo', 'contratos', 'qtdContratos'), $tabelasAux);
    }

    public function destroy($id)
    {
        $acordo = ControleAcordo::find($id);

        if(!$acordo) {
            return redirect()->back();
        }

        $acordo->delete();

        return redirect()->route('drc.list')->with('success', 'Acordo removido com sucesso');
    }


    // =====================================================
    // EXPORTAÇÃO PLANILHA
    // =====================================================
    public function export()
    {
        return Excel::download(new DrcExport, 'ACORDO.xlsx');
    }


    // =====================================================
    // PRIVATE METHODS
    // =====================================================
    private function tabelasAux()
    {
        $estados = Uf::all();
        $tipo_recuperacao = TipoRecuperacao::all();
        $classificacao = Classificacao::all();
        $condutores = Condutor::all();
        $forma_pagamento = FormaPagamento::all();
        $status = Status::all();
        $andamentos = Andamento::all();

        return [
            'estados'           => $estados,
            'tipo_recuperacao'  => $tipo_recuperacao,
            'classificacao'     => $classificacao,
            'condutores'        => $condutores,
            'forma_pagamento'   => $forma_pagamento,
            'status'            => $status,
            'andamentos'        => $andamentos
        ];
    }

    private function validarRegras(Request $request, $unique = true)
    {
        if($unique) {
            $uniqueRule = '|unique:controle_acordos,localizador_npj';
            $uniqueMsg = 'localizador(npj) já cadastrado';
        } else {
            $uniqueRule = $uniqueMsg = '';
        }

        $regras = [
            'localizador_npj'           => 'required|max:11|min:11' . $uniqueRule,
            'adverso_principal'         => 'required|min:3',
            'cpf_cnpj'                  => 'required|min:14|max:18',
            'mci'                       => 'required|min:9|max:9',
            'uf'                        => 'required',
            'gecor'                     => 'min:4|max:4|nullable',
            'prefixo_dependencia'       => 'max:4',
            'tipo_recuperacao'          => 'required',
            'classificacao'             => 'required',
            'rastreamento'              => 'required|min:14|max:14',
            'documentos_classificados'  => 'required',
            'num_compromisso'           => 'min:12|max:12|nullable',
            'valor_recuperacao'         => 'required',
            'dependencia_receptora'     => 'min:14|max:14|nullable',
            'formulario_rateio'         => 'min:14|max:14|nullable',
            'qtd_parcelas'              => 'min:2|integer|nullable',
        ];

        $obrigatorio = 'Campo obrigatório';
        $max = 'Máximo :max dígitos';
        $min = 'Mínimo :min dígitos';

        $mensagens = [
            // required
            'localizador_npj.required'          => $obrigatorio,
            'adverso_principal.required'        => $obrigatorio,
            'cpf_cnpj.required'                 => $obrigatorio,
            'mci.required'                      => $obrigatorio,
            'uf.required'                       => $obrigatorio,
            'tipo_recuperacao.required'         => $obrigatorio,
            'classificacao.required'            => $obrigatorio,
            'rastreamento.required'             => $obrigatorio,
            'documentos_classificados.required' => $obrigatorio,
            'valor_recuperacao.required'        => $obrigatorio,
            // max
            'localizador_npj.max'               => $max,
            'adverso_principal.max'             => $max,
            'cpf_cnpj.max'                      => $max,
            'mci.max'                           => $max,
            'gecor.max'                         => $max,
            'rastreamento.max'                  => $max,
            'num_compromisso.max'               => $max,
            'dependencia_receptora.max'         => $max,
            'formulario_rateio.max'             => $max,
            // min
            'localizador_npj.min'               => $min,
            'adverso_principal.min'             => $min,
            'cpf_cnpj.min'                      => $min,
            'mci.min'                           => $min,
            'gecor.min'                         => $min,
            'rastreamento.min'                  => $min,
            'num_compromisso.min'               => $min,
            'dependencia_receptora.min'         => $min,
            'formulario_rateio.min'             => $min,
            'qtd_parcelas.min'                  => 'Mínimo 2 parcelas',
            // unique
            'localizador_npj.unique'            => $uniqueMsg,

        ];

        // Campos que serão obrigatórios caso a opção do Tipo Recuperação seja ACORDO
        $regrasOpcionais = [
            'status'            => 'required',
            'condutor'          => 'required',
            'valor_honorarios'    => 'required',
        ];

        $mensagensOpcionais = [
            'status.required'              => $obrigatorio,
            'condutor.required'            => $obrigatorio,
            'valor_honorarios.required'    => $obrigatorio,
        ];

        if($request['tipo_recuperacao'] == 1) { // ID da opção ACORDO do campo Tipo Recuperação
            $regras = array_merge($regras, $regrasOpcionais);
            $mensagens = array_merge($mensagens, $mensagensOpcionais);
        }

        return $request->validate($regras, $mensagens);
    }
}
