<footer style="margin-top: 24px; padding: 12px 6px; border-top: 1px solid #e5eaf2; color: #64748b; font-size: 12px;">
    &copy; <?php echo date('Y'); ?> Todos os direitos reservados ao Engº. <b href:"https://linkedin.com/Hiobaldine">Hiobaldine</b> tel.:955502845
</footer>
</div> <!-- /.content-wrapper -->
</div> <!-- /.wrapper -->

<script src="<?php echo URLROOT; ?>/bower_components/jquery/dist/jquery.min.js"></script>
<script src="<?php echo URLROOT; ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?php echo URLROOT; ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo URLROOT; ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo URLROOT; ?>/bower_components/chart.js/Chart.min.js"></script>

<script>
    $(function () {
        if ($.fn.DataTable && $('.dataTable').length) {
            $('.dataTable').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese.json',
                    emptyTable: 'Sem registos disponiveis',
                    zeroRecords: 'Nenhum resultado encontrado'
                },
                pageLength: 10,
                order: []
            });
        }

        var wrapper = document.getElementById('appWrapper');
        var toggle = document.getElementById('sidebarToggle');
        var overlay = document.getElementById('layoutOverlay');

        if (!wrapper || !toggle || !overlay) {
            return;
        }

        var closeSidebar = function () {
            wrapper.classList.remove('sidebar-open');
        };

        toggle.addEventListener('click', function () {
            wrapper.classList.toggle('sidebar-open');
        });

        overlay.addEventListener('click', closeSidebar);

        var menuLinks = document.querySelectorAll('.sidebar-menu a');
        menuLinks.forEach(function (link) {
            link.addEventListener('click', function () {
                if (window.innerWidth <= 991) {
                    closeSidebar();
                }
            });
        });
    });
</script>
</body>

</html>
