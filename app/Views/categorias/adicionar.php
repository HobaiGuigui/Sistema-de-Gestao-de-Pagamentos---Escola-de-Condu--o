<?php require_once APPROOT . '/Views/layout/header.php'; ?>

<div class="row">
    <div class="col-md-6">
        <div class="table-container">
            <h5 style="font-weight: 700; margin-bottom: 25px;">Cadastrar Nova Categoria</h5>

            <form action="<?php echo URLROOT; ?>/categorias/adicionar" method="post">
                <div class="form-group">
                    <label>Nome da Categoria</label>
                    <input type="text" name="nome_categoria" class="form-control" placeholder="Ex: Categoria B"
                        required>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Preço Total (CFA)</label>
                            <input type="number" step="0.01" name="preco_total" class="form-control" placeholder="0.00"
                                required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Duração (Meses)</label>
                            <input type="number" name="duracao_meses" class="form-control" value="3" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Descrição</label>
                    <textarea name="descricao" class="form-control" rows="3"
                        placeholder="Breve descrição do curso..."></textarea>
                </div>

                <div style="margin-top: 20px;">
                    <button type="submit" class="btn btn-primary"
                        style="height: 45px; padding: 0 30px; border-radius: 8px;">Salvar Categoria</button>
                    <a href="<?php echo URLROOT; ?>/categorias" class="btn btn-default"
                        style="height: 45px; padding: 12px 30px; border-radius: 8px;">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once APPROOT . '/Views/layout/footer.php'; ?>