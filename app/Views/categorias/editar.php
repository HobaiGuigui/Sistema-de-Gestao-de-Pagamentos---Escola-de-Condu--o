<?php require_once APPROOT . '/Views/layout/header.php'; ?>

<div class="row">
    <div class="col-md-7">
        <div class="table-container">
            <h5 style="font-weight: 700; margin-bottom: 25px;">Editar Categoria</h5>

            <?php if (!empty($geral_err)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($geral_err, ENT_QUOTES, 'UTF-8'); ?></div>
            <?php endif; ?>

            <form action="<?php echo URLROOT; ?>/categorias/editar/<?php echo (int) $id; ?>" method="post">
                <div class="form-group">
                    <label>Nome da Categoria</label>
                    <input type="text" name="nome_categoria" class="form-control"
                        value="<?php echo htmlspecialchars($nome ?? '', ENT_QUOTES, 'UTF-8'); ?>" required>
                    <?php if (!empty($nome_err)): ?>
                        <small class="text-danger"><?php echo htmlspecialchars($nome_err, ENT_QUOTES, 'UTF-8'); ?></small>
                    <?php endif; ?>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Preco Total (CFA)</label>
                            <input type="number" step="0.01" name="preco_total" class="form-control"
                                value="<?php echo htmlspecialchars((string) ($preco ?? ''), ENT_QUOTES, 'UTF-8'); ?>" required>
                            <?php if (!empty($preco_err)): ?>
                                <small class="text-danger"><?php echo htmlspecialchars($preco_err, ENT_QUOTES, 'UTF-8'); ?></small>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Duracao (Meses)</label>
                            <input type="number" min="1" name="duracao_meses" class="form-control"
                                value="<?php echo htmlspecialchars((string) ($duracao ?? 3), ENT_QUOTES, 'UTF-8'); ?>" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Estado</label>
                    <select name="estado" class="form-control">
                        <option value="ativo" <?php echo (($estado ?? 'ativo') === 'ativo') ? 'selected' : ''; ?>>Ativo</option>
                        <option value="inativo" <?php echo (($estado ?? 'ativo') === 'inativo') ? 'selected' : ''; ?>>Inativo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Descricao</label>
                    <textarea name="descricao" class="form-control" rows="3"
                        placeholder="Breve descricao do curso..."><?php echo htmlspecialchars((string) ($descricao ?? ''), ENT_QUOTES, 'UTF-8'); ?></textarea>
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary"
                        style="height: 45px; padding: 0 30px; border-radius: 8px;">Atualizar Categoria</button>
                    <a href="<?php echo URLROOT; ?>/categorias" class="btn btn-default"
                        style="height: 45px; padding: 12px 30px; border-radius: 8px;">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once APPROOT . '/Views/layout/footer.php'; ?>
