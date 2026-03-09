<?php require_once '../app/Views/layout/header.php'; ?>

<div class="section-toolbar" style="margin-bottom: 16px;">
    <div>
        <h5 class="section-title">Visao Geral do Sistema</h5>
        <p class="section-subtitle">Acompanhe os indicadores principais e acesse as acoes rapidas.</p>
    </div>
    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        <a href="/estudantes/cadastrar" class="btn btn-primary"><i class="fa fa-user-plus"></i> Adicionar Estudante</a>
        <a href="/relatorios" class="btn btn-default"><i class="fa fa-file-text-o"></i> Ver Relatorios</a>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="card-stat">
            <h4>Total de Estudantes</h4>
            <div class="value"><?php echo $stats['total_estudantes']; ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-stat">
            <h4>Masculinos</h4>
            <div class="value"><?php echo $stats['estudantes_m']; ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-stat">
            <h4>Femininos</h4>
            <div class="value"><?php echo $stats['estudantes_f']; ?></div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card-stat" style="border-left: 4px solid #16a34a;">
            <h4>Receita Total</h4>
            <div class="value">CFA <?php echo number_format($stats['receita_total'], 2, ',', '.'); ?></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="table-container">
            <h5 class="section-title" style="font-size:16px; margin-bottom: 16px;">Atividades Recente</h5>
            <div class="chart-container" style="position: relative; height:300px;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="table-container">
            <h5 class="section-title" style="font-size:16px; margin-bottom: 16px;">Distribuicao por Sexo</h5>
            <div class="chart-container" style="position: relative; height:300px;">
                <canvas id="genderChart"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = function () {
        var revenueCtx = document.getElementById('revenueChart').getContext('2d');
        var revenueData = {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            datasets: [{
                label: 'Receita Mensal',
                fillColor: 'rgba(29, 78, 216, 0.10)',
                strokeColor: '#1d4ed8',
                pointColor: '#1d4ed8',
                pointStrokeColor: '#ffffff',
                pointHighlightFill: '#ffffff',
                pointHighlightStroke: '#1d4ed8',
                data: [12000, 19000, 3000, 5000, 2000, 3000, 12000, 19000, 3000, 5000, 2000, 3000]
            }]
        };

        new Chart(revenueCtx).Line(revenueData, {
            responsive: true,
            maintainAspectRatio: false,
            bezierCurve: true,
            datasetFill: true
        });

        var genderCtx = document.getElementById('genderChart').getContext('2d');
        var genderData = [
            {
                value: <?php echo (int) $stats['estudantes_m']; ?>,
                color: '#2563eb',
                highlight: '#1d4ed8',
                label: 'Masculino'
            },
            {
                value: <?php echo (int) $stats['estudantes_f']; ?>,
                color: '#ec4899',
                highlight: '#db2777',
                label: 'Feminino'
            }
        ];

        new Chart(genderCtx).Doughnut(genderData, {
            responsive: true,
            maintainAspectRatio: false,
            percentageInnerCutout: 70
        });
    };
</script>

<?php require_once '../app/Views/layout/footer.php'; ?>
