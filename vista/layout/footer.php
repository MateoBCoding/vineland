    
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" crossorigin="anonymous">
    </script>


    <script src="../public/app/publico/js/lib/jquery/jquery.min.js">
    </script>
    <script src="../public/app/publico/js/lib/tether/tether.min.js">
    </script>
    <script src="../public/app/publico/js/lib/bootstrap/bootstrap.min.js">
    </script>
    <script src="../public/app/publico/js/plugins.js">
    </script>

    <!-- datatables -->
    <script src="../public/app/publico/js/lib/datatables-net/datatables.min.js"></script>
    <script src="../vista/inicio/js/estilo-preguntas.js"></script>
    


    <!-- sweet alert -->
    <script src="../public/sweet/js/sweetalert2.js"></script>
    <script src="../public/sweet/js/sweet.js"></script>


    <script>
        $(function() {
            $('#example').DataTable({
                select: {
                    //style: 'multi'
                },
                responsive: true,
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla =(",
                    "sInfo": "Registros del _START_ al _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Registros del 0 al 0 de 0 registros",
                    "sInfoFiltered": "-",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                }
            });
        });
    </script>


    <script type="text/javascript" src="../public/app/publico/js/lib/jqueryui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../public/app/publico/js/lib/lobipanel/lobipanel.min.js"></script>
    <script type="text/javascript" src="../public/app/publico/js/lib/match-height/jquery.matchHeight.min.js">
    </script>
    <script type="text/javascript" src="../public/loader/loader.js"></script>
    <script src="../public/app/publico/js/app.js">
    </script>

    <script src="../public/app/publico/js/lib/jquery-flex-label/jquery.flex.label.js"></script>
    
    <script type="application/javascript">
        (function($) {
            $(document).ready(function() {
                $('.fl-flex-label').flexLabel();
            });
        })(jQuery);
    </script>






    </body>

    </html>