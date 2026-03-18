<?php require_once APPROOT . '/Views/layout/header.php'; ?>

<div class="table-container">
    <?php if (!empty($feedback)): ?>
        <div class="alert alert-<?php echo htmlspecialchars($feedback_type ?? 'info', ENT_QUOTES, 'UTF-8'); ?>" style="margin-bottom: 18px;">
            <?php echo htmlspecialchars($feedback, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <div class="section-toolbar">
        <div>
            <h5 class="section-title">Categorias de Cursos</h5>
            <p class="section-subtitle">Defina valores, duração e estado de cada categoria.</p>
        </div>
        <a href="<?php echo URLROOT; ?>/categorias/adicionar" class="btn btn-primary"><i class="fa fa-plus"></i> Nova Categoria</a>
    </div>

    <table class="table table-hover dataTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço Total</th>
                <th>Duração</th>
                <th>Estado</th>
                <th style="text-align: right;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($categorias)): ?>
               <!--  <tr>
                    <td colspan="6" class="text-center text-muted">Nenhuma categoria cadastrada.</td>
                </tr> -->
            <?php else: ?>
                <?php foreach ($categorias as $cat): ?>
                    <tr>
                        <td>#<?php echo $cat->id_categoria; ?></td>
                        <td><strong><?php echo $cat->nome_categoria; ?></strong></td>
                        <td>CFA <?php echo number_format($cat->preco_total, 2, ',', '.'); ?></td>
                        <td><?php echo $cat->duracao_meses; ?> meses</td>
                        <td>
                            <span class="label <?php echo ($cat->estado == 'ativo') ? 'label-success' : 'label-danger'; ?>">
                                <?php echo ucfirst($cat->estado); ?>
                            </span>
                        </td>
                        <td style="text-align: right; white-space: nowrap;">
                            <a href="<?php echo URLROOT; ?>/categorias/editar/<?php echo $cat->id_categoria; ?>"
                                class="btn btn-default btn-xs btn-action" title="Editar categoria">
                                <i class="fa fa-pencil"></i> Editar
                            </a>
                            <form action="<?php echo URLROOT; ?>/categorias/eliminar/<?php echo $cat->id_categoria; ?>" method="post"
                                style="display: inline;"
                                onsubmit="return confirm('Tem certeza que deseja eliminar esta categoria?');">
                                <button type="submit" class="btn btn-danger btn-xs btn-action" title="Eliminar categoria">
                                    <i class="fa fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once APPROOT . '/Views/layout/footer.php'; ?>
