<?php require_once APPROOT . '/Views/layout/header.php'; ?>

<div class="table-container">
    <div class="section-toolbar">
        <div>
            <h5 class="section-title">Gestão de Despesas</h5>
            <p class="section-subtitle">Controle os gastos operacionais da escola (combustível, manutenção, etc.).</p>
        </div>
        <a href="<?php echo URLROOT; ?>/despesas/adicionar" class="btn btn-primary"><i class="fa fa-plus"></i> Registar Despesa</a>
    </div>

    <div class="row" style="margin-bottom: 20px;">
        <div class="col-md-4">
            <div class="card-stat" style="border-left: 4px solid #ef4444; background: #fff;">
                <h4>Total Processado</h4>
                <div class="value" style="color: #ef4444;">CFA <?php echo number_format($total, 2, ',', '.'); ?></div>
            </div>
        </div>
    </div>

    <?php if (empty($despesas)): ?>
        <div class="alert alert-info">Nenhuma despesa registada até ao momento.</div>
    <?php else: ?>
        <table class="table table-striped dataTable">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Categoria</th>
                    <th>Valor</th>
                    <th style="text-align: right;">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($despesas as $despesa): ?>
                    <tr>
                        <td><?php echo date('d/m/Y', strtotime($despesa->data_despesa)); ?></td>
                        <td><?php echo $despesa->descricao; ?></td>
                        <td><span class="label label-default"><?php echo ucfirst($despesa->categoria); ?></span></td>
                        <td><strong>CFA <?php echo number_format($despesa->valor, 2, ',', '.'); ?></strong></td>
                        <td style="text-align: right;">
                            <form action="<?php echo URLROOT; ?>/despesas/eliminar/<?php echo $despesa->id_despesa; ?>" method="post" style="display:inline;" onsubmit="return confirm('Tem certeza?');">
                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once APPROOT . '/Views/layout/footer.php'; ?>
