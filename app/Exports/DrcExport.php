<?php

namespace App\Exports;

use App\Models\ControleAcordo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DrcExport implements FromCollection, WithHeadings, WithStyles, WithMapping, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // Buscando os dados que serão exibidos na planilha
    public function collection()
    {
        return DB::table('controle_acordos as ca')
        ->select(
            'ca.id',
            'localizador_npj',
            'adverso_principal',
            'cpf_cnpj',
            'mci',
            'uf.sigla as uf',
            'fase_processual',
            'gecor',
            'prefixo_dependencia',
            'tp.nome as tipo_recuperacao',
            'cf.nome as classificacao',
            'rastreamento',
            'documentos_classificados',
            'num_compromisso',
            'cd.nome as condutor',
            'fp.nome as forma_pagamento',
            'valor_honorarios',
            'valor_recuperacao',
            'st.nome as status',
            'data_vencimento',
            'data_pagamento',
            'data_protocolo',
            'data_final_vencimento',
            'data_envio_subsidio',
            'dependencia_receptora',
            'formulario_rateio',
            'periodicidade',
            'qtd_parcelas',
            'valor_parcela',
            'vencimento_primeira_parcela',
            'valor_entrada',
            'saldo_devedor_atualizado',
            'percentual_honorarios',
            'and.nome as andamento',
            'observacao'
        )
        ->join('uf_aux as uf', 'uf', 'uf.id')
        ->join('controle_acordos_tipo_recuperacao_aux as tp', 'tipo_recuperacao', 'tp.id')
        ->join('controle_acordos_classificacao_aux as cf', 'classificacao', 'cf.id')
        ->leftJoin('controle_acordos_condutor_aux as cd', 'condutor', 'cd.id')
        ->leftJoin('controle_acordos_forma_pagamento_aux as fp', 'forma_pagamento', 'fp.id')
        ->leftJoin('controle_acordos_status_aux as st', 'status', 'st.id')
        ->leftJoin('controle_acordos_andamento_aux as and', 'andamento', 'and.id')
        ->orderBy('updated_at', 'desc')
        ->get();
    }

    // Formata campos do tipo data
    private function formatDate($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    // Defindo os cabeçalhos das colunas
    public function headings(): array
    {
        return [
            "LOCALIZADOR (NPJ)",
            "ADVERSO PRINCIPAL",
            "CPF/CNPJ",
            "MCI",
            "UF",
            "FASE PROCESSUAL",
            "GECOR",
            "PREFIXO (DEP.)",
            "TIPO RECUPERAÇÃO",
            "CLASSIFICAÇÃO",
            "RASTREAMENTO",
            "DOCUMENTOS CLASSIFICADOS",
            "Nº COMPROMISSO",
            "CONDUTOR",
            "FORMA PAGAMENTO",
            "VALOR HONORÁRIOS",
            "VALOR RECUPERAÇÃO",
            "STATUS",
            "DATA VENCIMENTO",
            "DATA PAGAMENTO",
            "DATA PROTOCOLO",
            "DATA FINAL VENCIMENTO",
            "DATA ENVIO SUBSÍDIO",
            "DEPEDÊNCIA RECEPTORA",
            "FORMULÁRIO RATEIO",
            "PERIODICIDADE",
            "QTD. PARCELAS",
            "VALOR PARCELA",
            "VENCIMENTO 1º PARCELA",
            "VALOR ENTRADA",
            "SALDO DEVEDOR ATUALIZADO",
            "PERCENTUAL HONORÁRIOS",
            "ANDAMENTO",
            "OBSERVAÇÕES"
        ];
    }

    // Estilizando o cabeçalho da planilha
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                // definindo cor da letra
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFFFF']
                ],
                // defindo cor do cabeçalho
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => ['argb' => '1E90FF']
                ],
                // centralizando células
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ]
        ];
    }

    // Incluindo os dados para a planilha
    public function map($acordo): array
    {
        return [
            $acordo->localizador_npj,
            $acordo->adverso_principal,
            $acordo->cpf_cnpj,
            $acordo->mci,
            $acordo->uf,
            $acordo->fase_processual,
            $acordo->gecor,
            $acordo->prefixo_dependencia,
            $acordo->tipo_recuperacao,
            $acordo->classificacao,
            $acordo->rastreamento,
            $acordo->documentos_classificados ? 'SIM' : 'NÃO',
            $acordo->num_compromisso,
            $acordo->condutor,
            $acordo->forma_pagamento,
            $acordo->valor_honorarios,
            $acordo->valor_recuperacao,
            $acordo->status,
            $this->formatDate($acordo->data_vencimento),
            $this->formatDate($acordo->data_pagamento),
            $this->formatDate($acordo->data_protocolo),
            $this->formatDate($acordo->data_final_vencimento),
            $this->formatDate($acordo->data_envio_subsidio),
            $acordo->dependencia_receptora,
            $acordo->formulario_rateio,
            $acordo->periodicidade,
            $acordo->qtd_parcelas,
            $acordo->valor_parcela,
            $this->formatDate($acordo->vencimento_primeira_parcela),
            $acordo->valor_entrada,
            $acordo->saldo_devedor_atualizado,
            $acordo->percentual_honorarios,
            $acordo->andamento,
            $acordo->observacao,
        ];
    }

    // Configurando os dados da planilha
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // centralizar todas as colunas
                $sheet->getStyle('A1:AG' . $sheet->getHighestRow())
                      ->getAlignment()
                      ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // ajuste de largura automático para todas as colunas
                for ($col = 'A'; $col <= 'Z'; $col++) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            }
        ];
    }
}
