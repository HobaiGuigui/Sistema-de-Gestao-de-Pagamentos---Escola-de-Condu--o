<?php require_once APPROOT . '/Views/layout/header.php'; ?>

<?php if (!$estudante): ?>
    <div class="alert alert-danger">Estudante nao encontrado.</div>
<?php else: ?>

    <?php
    $saldo_divida = $estudante->preco_total - $estudante->total_pago;
    $percentagem_paga = ($estudante->preco_total > 0) ? ($estudante->total_pago / $estudante->preco_total) * 100 : 0;
    ?>

    <div class="row">
        <div class="col-md-4">
            <div class="table-container text-center">
                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($estudante->nome_completo); ?>&size=128&background=1d4ed8&color=fff"
                    class="img-circle" style="border: 4px solid #f8f9fa; margin-bottom: 20px;" alt="Avatar do estudante">
                <h4 style="font-weight: 800; margin-bottom: 5px;"><?php echo $estudante->nome_completo; ?></h4>
                <p class="text-muted"><?php echo $estudante->nome_categoria; ?></p>
                <hr>
                <div style="text-align: left; padding: 0 20px;">
                    <p><strong><i class="fa fa-phone"></i> Contato:</strong> <?php echo $estudante->telefone; ?></p>
                    <p><strong><i class="fa fa-envelope"></i> Email:</strong> <?php echo $estudante->email; ?></p>
                    <p><strong><i class="fa fa-map-marker"></i> Endereco:</strong> <?php echo $estudante->endereco; ?></p>
                    <p><strong><i class="fa fa-calendar"></i> Inicio:</strong>
                        <?php echo date('d/m/Y', strtotime($estudante->data_inicio_curso)); ?></p>
                    <p><strong><i class="fa fa-clock-o"></i> Fim:</strong>
                        <?php echo date('d/m/Y', strtotime($estudante->data_fim_curso)); ?></p>
                </div>
                <a href="<?php echo URLROOT; ?>/estudantes" class="btn btn-default btn-block" style="margin-top: 20px;">
                    <i class="fa fa-arrow-left"></i> Voltar para lista
                </a>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <div class="card-stat">
                        <h4>Preco do Curso</h4>
                        <div class="value">CFA <?php echo number_format($estudante->preco_total, 2, ',', '.'); ?></div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-stat"
                        style="border-left: 4px solid <?php echo ($saldo_divida <= 0) ? '#16a34a' : '#dc2626'; ?>;">
                        <h4>Saldo em Divida</h4>
                        <div class="value">CFA <?php echo number_format($saldo_divida, 2, ',', '.'); ?></div>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <div class="section-toolbar" style="margin-bottom: 16px;">
                    <div>
                        <h5 class="section-title" style="font-size:16px;">Historico de Pagamentos</h5>
                    </div>
                    <a href="<?php echo URLROOT; ?>/pagamentos/registar/<?php echo $estudante->id_estudante; ?>" class="btn btn-success">
                        <i class="fa fa-money"></i> Registar Pagamento
                    </a>
                </div>

                <div class="progress" style="height: 10px; border-radius: 5px; margin-bottom: 30px;">
                    <div class="progress-bar progress-bar-success" role="progressbar"
                        style="width: <?php echo $percentagem_paga; ?>%;"></div>
                </div>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Data</th>
                            <th>Valor Pago</th>
                            <th>Forma</th>
                            <th style="text-align: right;">Fatura</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($pagamentos)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Nenhum pagamento registado.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pagamentos as $pag): ?>
                                <tr>
                                    <td>#<?php echo $pag->id_pagamento; ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($pag->data_pagamento)); ?></td>
                                    <td><strong>CFA <?php echo number_format($pag->valor_pago, 2, ',', '.'); ?></strong></td>
                                    <td><?php echo ucfirst($pag->forma_pagamento); ?></td>
                                    <td style="text-align: right;">
                                        <a href="<?php echo URLROOT; ?>/pagamentos/fatura/<?php echo $pag->id_pagamento; ?>" target="_blank"
                                            class="btn btn-default btn-xs btn-action"><i class="fa fa-print"></i> Imprimir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php require_once APPROOT . '/Views/layout/footer.php'; ?>
