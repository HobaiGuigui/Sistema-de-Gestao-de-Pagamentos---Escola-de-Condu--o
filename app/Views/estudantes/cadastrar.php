<?php require_once '../app/Views/layout/header.php'; ?>

<div class="table-container">
    <div class="section-toolbar">
        <div>
            <h5 class="section-title">Cadastrar Novo Estudante</h5>
            <p class="section-subtitle">Preencha os dados pessoais e os dados da inscricao.</p>
        </div>
        <a href="/estudantes" class="btn btn-default">
            <i class="fa fa-arrow-left"></i> Voltar para lista
        </a>
    </div>

    <form action="/estudantes/cadastrar" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nome Completo</label>
                    <input type="text" name="nome_completo" class="form-control" placeholder="Ex: Joao Silva" required>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Sexo</label>
                    <select name="sexo" class="form-control" required>
                        <option value="M" selected>Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label>Data de Nascimento</label>
                    <input type="date" name="data_nascimento" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Contato</label>
                    <input type="text" name="telefone" class="form-control" placeholder="95... /96.... ..." required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="exemplo@email.com">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Endereço</label>
                    <input type="text" name="endereco" class="form-control" placeholder="Bairro, Rua..." required>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label>Categoria de Curso</label>
                    <select name="categoria_id" class="form-control" required>
                        <option value="">Selecione...</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo $cat->id_categoria; ?>">
                                <?php echo $cat->nome_categoria; ?> (CFA <?php echo number_format($cat->preco_total, 0, ',', '.'); ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Data Inicio</label>
                    <input type="date" name="data_inicio" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Data Fim (Previsao)</label>
                    <input type="date" name="data_fim" class="form-control"
                        value="<?php echo date('Y-m-d', strtotime('+3 months')); ?>">
                </div>
            </div>
        </div>

        <div style="margin-top: 24px; display: flex; gap: 10px; flex-wrap: wrap;">
            <button type="submit" class="btn btn-primary" style="height: 44px; padding: 0 26px;">
                <i class="fa fa-check"></i> Cadastrar Estudante
            </button>
            <a href="/estudantes" class="btn btn-default" style="height: 44px; padding: 12px 26px;">Cancelar</a>
        </div>
    </form>
</div>

<?php require_once '../app/Views/layout/footer.php'; ?>
