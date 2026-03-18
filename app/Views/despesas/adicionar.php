<?php require_once APPROOT . '/Views/layout/header.php'; ?>

<div class="table-container" style="max-width: 800px; margin: 0 auto;">
    <div class="section-toolbar">
        <div>
            <h5 class="section-title">Registar Nova Despesa</h5>
            <p class="section-subtitle">Insira os detalhes do gasto abaixo.</p>
        </div>
        <a href="<?php echo URLROOT; ?>/despesas" class="btn btn-default"><i class="fa fa-arrow-left"></i> Voltar</a>
    </div>

    <form action="<?php echo URLROOT; ?>/despesas/adicionar" method="post" class="modern-form">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Descrição da Despesa</label>
                    <input type="text" name="descricao" class="form-control" placeholder="Ex: Combustível Carrinha A" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Valor (CFA)</label>
                    <input type="number" step="0.01" name="valor" class="form-control" placeholder="0,00" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Data</label>
                    <input type="date" name="data_despesa" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Categoria</label>
                    <select name="categoria" class="form-control" required>
                        <option value="combustivel">Combustível</option>
                        <option value="salario">Salário / Colaboradores</option>
                        <option value="renda">Renda / Instalações</option>
                        <option value="manutencao">Manutenção de Veículos</option>
                        <option value="outros">Outros Gatos</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Observações (Opcional)</label>
            <textarea name="observacao" class="form-control" rows="3"></textarea>
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" class="btn btn-primary" style="height: 45px; padding: 0 30px; border-radius: 8px;">Guardar Despesa</button>
        </div>
    </form>
</div>

<?php require_once APPROOT . '/Views/layout/footer.php'; ?>
