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
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class DrcExport implements FromCollection, WithTitle, WithHeadings, WithStyles, WithMapping, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // Buscando os dados que serão exibidos na planilha
    public function collection()
    {
        return ControleAcordo::with(
            'ufAux',
            'tipoRecuperacaoAux',
            'statusAux',
            'condutorAux',
            'andamentoAux',
            'classificacaoAux',
            'formaPagamentoAux'
        )
        ->orderBy('updated_at', 'desc')
        ->get();
    }

    // Formata campos do tipo data
    private function formatDate($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    // Definindo o nome da aba
    public function title(): string
    {
        return 'Plan1';
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
            $acordo->ufAux->sigla,
            $acordo->fase_processual,
            $acordo->gecor,
            $acordo->prefixo_dependencia,
            $acordo->tipoRecuperacaoAux->nome,
            $acordo->classificacaoAux->nome,
            $acordo->rastreamento,
            $acordo->documentos_classificados ? 'SIM' : 'NÃO',
            $acordo->num_compromisso,
            $acordo->condutorAux->nome,
            $acordo->formaPagamentoAux->nome,
            $acordo->valor_honorarios,
            $acordo->valor_recuperacao,
            $acordo->statusAux->nome,
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
            $acordo->andamentoAux->nome,
            $acordo->observacao,
        ];
    }

    // Configurando os dados da planilha
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $line = $sheet->getHighestRow();

                // centralizar todas as colunas
                $sheet
                    ->getStyle('A1:AG' . $line)
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // ajuste de largura automático para todas as colunas
                for ($col = 'A'; $col <= 'Z'; $col++) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // aplicar formato de texto às colunas específicas
                $textColumns = ['K2:k', 'M2:m', 'X2:x', 'W2:w']; // ajuste os índices das colunas conforme necessário
                foreach ($textColumns as $col) {
                    $sheet
                        ->getStyle($col . $line)
                        ->getNumberFormat()
                        ->setFormatCode(NumberFormat::FORMAT_TEXT);
                }
            }
        ];
    }
}
