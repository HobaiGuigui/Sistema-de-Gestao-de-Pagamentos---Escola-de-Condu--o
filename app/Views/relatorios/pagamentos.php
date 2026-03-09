<?php require_once '../app/Views/layout/header.php'; ?>

<div class="table-container">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h5 style="font-weight: 700; margin: 0;">Relatório Geral de Pagamentos</h5>
        <button onclick="window.print()" class="btn btn-default"><i class="fa fa-print"></i> Imprimir</button>
    </div>

    <table class="table table-striped dataTable">
        <thead>
            <tr>
                <th>Data</th>
                <th>Estudante</th>
                <th>Categoria</th>
                <th>Valor Pago</th>
                <th>Forma de Pagamento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pagamentos as $pag): ?>
                <tr>
                    <td>
                        <?php echo date('d/m/Y', strtotime($pag->data_pagamento)); ?>
                    </td>
                    <td>
                        <?php echo $pag->nome_completo; ?>
                    </td>
                    <td>
                        <?php echo $pag->nome_categoria; ?>
                    </td>
                    <td><strong>CFA
                            <?php echo number_format($pag->valor_pago, 2, ',', '.'); ?>
                        </strong></td>
                    <td>
                        <?php echo ucfirst($pag->forma_pagamento); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once '../app/Views/layout/footer.php'; ?>