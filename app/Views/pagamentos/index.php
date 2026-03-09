<?php require_once '../app/Views/layout/header.php'; ?>

<div class="table-container">
    <div class="section-toolbar">
        <div>
            <h5 class="section-title">Histórico de Pagamentos</h5>
            <p class="section-subtitle">Acompanhe os últimos pagamentos realizados no sistema.</p>
        </div>
        <a href="/estudantes" class="btn btn-default"><i class="fa fa-users"></i> Ver Estudantes</a>
    </div>

    <?php if (empty($pagamentos)): ?>
        <div class="alert alert-info" style="margin-bottom: 0;">
            Ainda nao existem pagamentos registados. Acesse o perfil de um estudante para registar o primeiro pagamento.
        </div>
    <?php else: ?>
        <table class="table table-hover dataTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Data</th>
                    <th>Estudante</th>
                    <th>Categoria</th>
                    <th>Valor Pago</th>
                    <th>Forma</th>
                    <th style="text-align: right;">Acoes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pagamentos as $pag): ?>
                    <tr>
                        <td>#<?php echo $pag->id_pagamento; ?></td>
                        <td><?php echo date('d/m/Y', strtotime($pag->data_pagamento)); ?></td>
                        <td><?php echo $pag->nome_completo; ?></td>
                        <td><?php echo $pag->nome_categoria; ?></td>
                        <td><strong>CFA <?php echo number_format($pag->valor_pago, 2, ',', '.'); ?></strong></td>
                        <td><?php echo ucfirst($pag->forma_pagamento); ?></td>
                        <td style="text-align: right; white-space: nowrap;">
                            <a href="/estudantes/perfil/<?php echo $pag->id_estudante; ?>" class="btn btn-default btn-xs btn-action">
                                <i class="fa fa-user"></i> Perfil
                            </a>
                            <a href="/pagamentos/fatura/<?php echo $pag->id_pagamento; ?>" target="_blank"
                                class="btn btn-success btn-xs btn-action">
                                <i class="fa fa-print"></i> Fatura
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once '../app/Views/layout/footer.php'; ?>
