<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Fatura - Escola de Condução 3 de Agosto</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            font-size: 14px;
        }

        .container {
            width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .invoice-box {
            border: 1px dashed #ccc;
            padding: 30px;
            margin-bottom: 50px;
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .info-table {
            width: 100%;
            margin-bottom: 30px;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .data-label {
            color: #888;
            width: 150px;
        }

        .data-value {
            font-weight: bold;
        }

        .title-via {
            position: absolute;
            top: 10px;
            right: 10px;
            font-weight: bold;
            color: #999;
            text-transform: uppercase;
            font-size: 10px;
        }

        .footer-sig {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
            gap: 50px;
        }

        .sig-box {
            flex: 1;
            text-align: center;
            border-top: 1px solid #333;
            padding-top: 10px;
            margin-top: 30px;
        }

        .credit-line {
            margin-top: 16px;
            text-align: right;
            color: #666;
            font-size: 12px;
        }

        @media print {
            .no-print {
                display: none;
            }

            body {
                padding: 0;
            }
        }
    </style>
</head>

<body>

    <div class="no-print" style="background: #333; padding: 10px; text-align: center;">
        <button onclick="window.print()"
            style="padding: 10px 20px; cursor: pointer; background: #007bff; color: #fff; border: none; border-radius: 4px;">Imprimir
            Fatura (A4)</button>
        <a href="<?php echo URLROOT; ?>/estudantes/perfil/<?php echo $pagamento->estudante_id; ?>"
            style="color: #fff; margin-left: 20px; text-decoration: none;">Voltar ao Perfil</a>
    </div>

    <div class="container">
        <?php
       /*  */ $vias = ["1ª Via - Original (Estudante)", "2ª Via - Cópia (Administração)"];
        foreach ($vias as $via):
            ?>
            <div class="invoice-box">
                <div class="title-via">
                    <?php echo $via; ?>
                </div>

                <div class="header">
                    <h1>Escola de Condução 3 de Agosto</h1>
                    <p>Formando Condutores Responsáveis</p>
                    <p>Contato: 95... /96.... XXX XXX XXX | Email: info@escola3agosto.com</p>
                </div>

                <table class="info-table">
                    <tr>
                        <td class="data-label">Recibo Nº:</td>
                        <td class="data-value">#
                            <?php echo str_pad($pagamento->id_pagamento, 6, "0", STR_PAD_LEFT); ?>
                        </td>
                        <td class="data-label">Data:</td>
                        <td class="data-value">
                            <?php echo date('d/m/Y', strtotime($pagamento->data_pagamento)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="data-label">Estudante:</td>
                        <td class="data-value" colspan="3">
                            <?php echo $pagamento->nome_completo; ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="data-label">Categoria:</td>
                        <td class="data-value">
                            <?php echo $pagamento->nome_categoria; ?>
                        </td>
                        <td class="data-label">Forma Pag.:</td>
                        <td class="data-value">
                            <?php echo ucfirst($pagamento->forma_pagamento); ?>
                        </td>
                    </tr>
                </table>

                <table class="info-table" style="background: #fdfdfd;">
                    <tr>
                        <td class="data-label">Valor Total do Curso:</td>
                        <td class="data-value">CFA
                            <?php echo number_format($pagamento->preco_total, 2, ',', '.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="data-label" style="color: #28a745;">VALOR PAGO AGORA:</td>
                        <td class="data-value" style="color: #28a745; font-size: 18px;">CFA
                            <?php echo number_format($pagamento->valor_pago, 2, ',', '.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="data-label">Acumulado Pago:</td>
                        <td class="data-value">CFA
                            <?php echo number_format($pagamento->total_pago_ate_agora, 2, ',', '.'); ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="data-label">Saldo de Dívida:</td>
                        <td class="data-value">CFA
                            <?php echo number_format($pagamento->preco_total - $pagamento->total_pago_ate_agora, 2, ',', '.'); ?>
                        </td>
                    </tr>
                </table>

                <div class="footer-sig">
                    <!-- <div class="sig-box">
                        Assinatura do Estudante
                    </div> -->
                    <div class="sig-box">
                        Carimbo e Assinatura (EC 3 de Agosto)
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>

</html>
