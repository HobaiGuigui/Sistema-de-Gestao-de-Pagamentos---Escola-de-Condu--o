<?php require_once '../app/Views/layout/header.php'; ?>

<div class="row">
    <div class="col-md-6">
        <div class="table-container">
            <h5 style="font-weight: 700; margin-bottom: 25px;">Relatórios Disponíveis</h5>

            <div class="list-group">
                <a href="/relatorios/pagamentos" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1" style="font-weight: 700;"><i class="fa fa-money"></i> Relatório de Pagamentos
                        </h5>
                    </div>
                    <p class="mb-1">Veja todos os pagamentos registados no sistema por período.</p>
                </a>
                <a href="/relatorios/export_csv" class="list-group-item list-group-item-action">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1" style="font-weight: 700;"><i class="fa fa-file-excel-o"></i> Exportar
                            Pagamentos (CSV)</h5>
                    </div>
                    <p class="mb-1">Descarregue o histórico de pagamentos em formato Excel/CSV.</p>
                </a>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layout/footer.php'; ?>