<?php require_once APPROOT . '/Views/layout/header.php'; ?>

<?php if (!$estudante): ?>
    <div class="alert alert-danger"><?php echo htmlspecialchars($geral_err ?? 'Estudante nao encontrado.', ENT_QUOTES, 'UTF-8'); ?></div>
<?php else: ?>

    <?php
    $saldoAtualView = isset($saldo_atual)
        ? (float) $saldo_atual
        : max(0, ((float) $estudante->preco_total - (float) $estudante->total_pago));
    ?>

    <div class="row">
        <div class="col-md-6">
            <div class="table-container">
                <h5 style="font-weight: 700; margin-bottom: 25px;">Novo Pagamento:
                    <?php echo htmlspecialchars($estudante->nome_completo, ENT_QUOTES, 'UTF-8'); ?>
                </h5>

                <?php if (!empty($geral_err)): ?>
                    <div class="alert alert-danger" style="border-radius: 8px;">
                        <?php echo htmlspecialchars($geral_err, ENT_QUOTES, 'UTF-8'); ?>
                    </div>
                <?php endif; ?>

                <div class="alert alert-info" style="border-radius: 8px;">
                    <p><strong>Categoria:</strong>
                        <?php echo htmlspecialchars($estudante->nome_categoria, ENT_QUOTES, 'UTF-8'); ?>
                    </p>
                    <p><strong>Total do Curso:</strong> CFA
                        <?php echo number_format((float) $estudante->preco_total, 2, ',', '.'); ?>
                    </p>
                    <p><strong>Saldo Atual:</strong> CFA
                        <?php echo number_format($saldoAtualView, 2, ',', '.'); ?>
                    </p>
                </div>

                <form action="<?php echo URLROOT; ?>/pagamentos/registar/<?php echo (int) $estudante->id_estudante; ?>" method="post">
                    <div class="form-group">
                        <label>Valor a Pagar (CFA)</label>
                        <input type="number" step="0.01" min="0.01" max="<?php echo number_format($saldoAtualView, 2, '.', ''); ?>"
                            name="valor_pago" class="form-control" placeholder="0.00"
                            value="<?php echo htmlspecialchars((string) ($valor_pago ?? ''), ENT_QUOTES, 'UTF-8'); ?>" required autofocus>
                        <?php if (!empty($valor_err)): ?>
                            <small class="text-danger"><?php echo htmlspecialchars($valor_err, ENT_QUOTES, 'UTF-8'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data de Pagamento</label>
                                <input type="date" name="data_pagamento" class="form-control"
                                    value="<?php echo htmlspecialchars((string) ($data_pagamento ?? date('Y-m-d')), ENT_QUOTES, 'UTF-8'); ?>"
                                    required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Forma de Pagamento</label>
                                <?php $formaSel = $forma_pagamento ?? 'dinheiro'; ?>
                                <select name="forma_pagamento" class="form-control" required>
                                    <option value="dinheiro" <?php echo ($formaSel === 'dinheiro') ? 'selected' : ''; ?>>Dinheiro</option>
                                    <option value="transferencia" <?php echo ($formaSel === 'transferencia') ? 'selected' : ''; ?>>Transferencia</option>
                                    <option value="cartao" <?php echo ($formaSel === 'cartao') ? 'selected' : ''; ?>>Cartao Multicaixa</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Observações</label>
                        <input type="text" name="observacao" class="form-control" placeholder="Ex: Pagamento da 1a parcela"
                            value="<?php echo htmlspecialchars((string) ($observacao ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
                    </div>

                    <div style="margin-top: 20px;">
                        <button type="submit" class="btn btn-success"
                            style="height: 45px; padding: 0 30px; border-radius: 8px;" <?php echo ($saldoAtualView <= 0) ? 'disabled' : ''; ?>>Confirmar Pagamento</button>
                        <a href="<?php echo URLROOT; ?>/estudantes/perfil/<?php echo (int) $estudante->id_estudante; ?>" class="btn btn-default"
                            style="height: 45px; padding: 12px 30px; border-radius: 8px;">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php endif; ?>

<?php require_once APPROOT . '/Views/layout/footer.php'; ?>
