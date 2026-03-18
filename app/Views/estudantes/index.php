<?php require_once APPROOT . '/Views/layout/header.php'; ?>

<div class="table-container">
    <div class="section-toolbar">
        <div>
            <h5 class="section-title">Lista de Estudantes</h5>
            <p class="section-subtitle">Gerencie perfis, inscricoes e pagamentos dos estudantes.</p>
        </div>
        <a href="<?php echo URLROOT; ?>/estudantes/cadastrar" class="btn btn-primary">
            <i class="fa fa-user-plus"></i> Adicionar Estudante
        </a>
    </div>

    <table class="table table-hover dataTable">
        <thead>
            <tr>
               <!--  <th>ID</th> -->
                <th>Nome Completo</th>
                <th>Categoria</th>
                <th>Contato</th>
                <th>Estado</th>
                <th style="text-align: right;">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($estudantes)): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">Nenhum estudante cadastrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($estudantes as $est): ?>
                    <tr>
                        <!-- <td>#<?php echo $est->id_estudante; ?></td> -->
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($est->nome_completo); ?>&background=random"
                                    class="img-circle" width="30" alt="Avatar do estudante">
                                <strong><?php echo $est->nome_completo; ?></strong>
                            </div>
                        </td>
                        <td><?php echo $est->nome_categoria; ?></td>
                        <td><?php echo $est->telefone; ?></td>
                        <td>
                            <span class="label <?php echo ($est->estado == 'ativo') ? 'label-success' : 'label-primary'; ?>">
                                <?php echo ucfirst($est->estado); ?>
                            </span>
                        </td>
                        <td style="text-align: right; white-space: nowrap;">
                            <a href="<?php echo URLROOT; ?>/estudantes/perfil/<?php echo $est->id_estudante; ?>"
                                class="btn btn-default btn-xs btn-action" title="Ver Perfil">
                                <i class="fa fa-user"></i> Perfil
                            </a>
                            <a href="<?php echo URLROOT; ?>/pagamentos/registar/<?php echo $est->id_estudante; ?>"
                                class="btn btn-success btn-xs btn-action" title="Registar Pagamento">
                                <i class="fa fa-money"></i> Pagamento
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once APPROOT . '/Views/layout/footer.php'; ?>
