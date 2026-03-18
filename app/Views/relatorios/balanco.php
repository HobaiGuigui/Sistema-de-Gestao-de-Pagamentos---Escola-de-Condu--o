<?php require_once APPROOT . '/Views/layout/header.php'; ?>

<div class="row">
    <div class="col-md-12">
        <div class="table-container">
            <h5 class="section-title">Balanço Financeiro Geral</h5>
            <p class="section-subtitle">Comparativo entre receitas (pagamentos de alunos) e despesas operacionais.</p>

            <div class="row" style="margin-top: 30px;">
                <div class="col-md-4">
                    <div class="card-stat" style="border-left: 4px solid #16a34a; background: #f0fdf4;">
                        <h4 style="color: #166534;">Total de Receitas (+)</h4>
                        <div class="value" style="color: #16a34a;">CFA <?php echo number_format($receitas, 2, ',', '.'); ?></div>
                        <p style="font-size: 12px; color: #666; margin-top: 10px;">Proveniente de pagamentos realizados pelos estudantes.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-stat" style="border-left: 4px solid #ef4444; background: #fef2f2;">
                        <h4 style="color: #991b1b;">Total de Despesas (-)</h4>
                        <div class="value" style="color: #ef4444;">CFA <?php echo number_format($despesas, 2, ',', '.'); ?></div>
                        <p style="font-size: 12px; color: #666; margin-top: 10px;">Custos operacionais registados no sistema.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-stat" style="border-left: 4px solid #3b82f6; background: #eff6ff;">
                        <h4 style="color: #1e40af;">Saldo Líquido (Lucro)</h4>
                        <div class="value" style="color: #3b82f6;">CFA <?php echo number_format($saldo, 2, ',', '.'); ?></div>
                        <p style="font-size: 12px; color: #666; margin-top: 10px;">Diferença entre o que entrou e o que saiu.</p>
                    </div>
                </div>
            </div>

            <div class="alert <?php echo ($saldo >= 0) ? 'alert-success' : 'alert-danger'; ?>" style="margin-top: 30px; border-radius: 12px;">
                <strong>Resumo:</strong> Atualmente, a escola apresenta um saldo <?php echo ($saldo >= 0) ? 'POSITIVO' : 'NEGATIVO'; ?> de 
                <strong>CFA <?php echo number_format(abs($saldo), 2, ',', '.'); ?></strong>.
            </div>
        </div>
    </div>
</div>

<?php require_once APPROOT . '/Views/layout/footer.php'; ?>
