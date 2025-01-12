<?php
session_start();
if (empty($_SESSION['nombre']) and empty($_SESSION['apellido'])) {
    header('location:login/login.php');
}
?>
<link rel="stylesheet" type="text/css" href="../vista/inicio/css/formulario-entrevistado.css">
<script src="../vista/inicio/js/Entrevistado.js"></script>


<!-- primero se carga el topbar -->
<?php require('./layout/topbar.php'); ?>
<!-- luego se carga el sidebar -->
<?php require('./layout/sidebar.php'); ?>
<!-- inicio del contenido principal -->


<!-- <script src="../vista/inicio/js/Entrevistado.js"></script> -->


<body>

    <div class="page-content">
        <div class="formulario">
            <header>Registro</header>

            <form method="POST" action="receptiva.php">

                <div class="details personal">
                    <span class="title">Datos Entrevistado</span>

                    <div class="fields">
                        <div class="input-field">
                            <label>Cedula</label>
                            <input id="identrevistado" type="text" oninput="convertirAMinusculas(this)" placeholder="C.C , C.E, T.I" name="identrevistado" required>
                        </div>

                        <div class="input-field d-none">
                            <label>Nombre Completo</label>
                            <input id="nombre" name="nombre" type="text" oninput="convertirAMinusculas(this)" placeholder="Ingresa tu nombre" required>
                        </div>

                        <div class="input-field d-none">
                            <label>Fecha de nacimiento</label>
                            <input id="fecha_n" name="fecha_n" type="date" placeholder="Ingresa la Fecha de Nacimiento" onchange="calculoedad()" required>
                        </div>
                        <script>
                            function calculoedad() {
                                var fechaNacimiento = new Date(document.getElementById("fecha_n").value);
                                var hoy = new Date();
                                var diff = hoy.getTime() - fechaNacimiento.getTime();
                                var edad = {};
                                edad.años = Math.floor(diff / 31557600000); // 1 año en milisegundos
                                edad.meses = Math.floor((diff % 31557600000) / 2629800000); // 1 mes en milisegundos
                                edad.dias = Math.floor(((diff % 31557600000) % 2629800000) / 86400000); // 1 día en milisegundos

                                var edadTexto = `${edad.años} años: ${edad.meses} meses:${edad.dias} dias`;
                                document.getElementById("edad").value = edadTexto;
                            }
                        </script>

                        <div class="input-field d-none">
                            <label>Email</label>
                            <input id="email" name="email" type="text" oninput="convertirAMinusculas(this)" placeholder="Entra el correo electronico" required>
                        </div>

                        <div class="input-field d-none">
                            <label>Numero Telefonico</label>
                            <input type="number" name="telefono" id="telefono" placeholder="Entra el numero telefonico" required>
                        </div>

                        <div class="input-field d-none">
                            <label>Genero</label>
                            <select name="sexo" id="sexo" required>
                                <option disabled selected>Selecciona el Genero</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                                <option value="3">Otros</option>
                            </select>
                        </div>

                        <div class="input-field d-none">
                            <label>Grado</label>
                            <input name="grado" id="grado" type="text" oninput="convertirAMinusculas(this)" placeholder="Grado Actual" required>
                        </div>

                        <div class="input-field d-none">
                            <label>Colegio/Otros</label>
                            <input id="colegio" name="colegio" type="text" oninput="convertirAMinusculas(this)" placeholder="Ingrese el colegio u otro" required>
                        </div>

                        <div class="input-field d-none">
                            <label>Diagnosis</label>
                            <input id="diagnosis" type="text" name="diagnosis" oninput="convertirAMinusculas(this)" placeholder="Ingrese el diagnosis del entrevistado" required>
                        </div>
                        <div class="input-field d-none">
                            <label>Edad Cronologica</label>
                            <input id="edad" name="edad" type="text" oninput="convertirAMinusculas(this)" placeholder="AA/MM/DD" readonly>
                        </div>

                        <div class="input-field d-none">
                            <label>Razon Entrevista</label>
                            <input id="razon" name="razon" type="text" oninput="convertirAMinusculas(this)" placeholder="Ingrese la razon de la entrevista" required>
                        </div>

                    </div>
                </div>

                <div class="details ID">
                    <span class="title">Datos Acompañante</span>

                    <div class="fields">
                        <div class="input-field d-none">
                            <label>ID respondedor</label>
                            <input id="idrespondedor" name="idrespondedor" type="text"  oninput="convertirAMinusculas(this)" placeholder="C.C , C.E, T.I" required>
                        </div>

                        <div class="input-field">
                            <label>Nombre Completo</label>
                            <input id="nombrerespondedor" name="nombrerespondedor" type="text" oninput="convertirAMinusculas(this)" placeholder="Ingresar nombre completo" required>
                        </div>

                        <div class="input-field d-none">
                            <label>Genero</label>
                            <select required id="sexorespondedor" name="sexorespondedor">
                                <option disabled selected>Selecciona el Genero</option>
                                <option value="1">Masculino</option>
                                <option value="2">Femenino</option>
                                <option value="3">Otros</option>
                            </select>
                        </div>
                        <div class="input-field d-none">
                            <label>Telefono</label>
                            <input id="telefonorespondedor" name="telefonorespondedor" type="text" oninput="convertirAMinusculas(this)" placeholder="Ingresa el telefono del respondedor" required>
                        </div>

                        <div class="input-field d-none">
                            <label>Tipo de Relacion</label>
                            <select id="relacion" name="relacion" required>
                                <option disabled selected>Selecciona el tipo de relacion</option>
                                <option value="1">Madre</option>
                                <option value="2">Padre</option>
                                <option value="3">Hijo</option>
                                <option value="4">Hermano</option>
                                <option value="5">Hermana</option>
                                <option value="6">Tio</option>
                                <option value="7">Tia</option>
                                <option value="8">Primo</option>
                                <option value="9">Prima</option>
                                <option value="10">Madrastra</option>
                                <option value="11">Padrastro</option>
                                <option value="12">Familiar</option>
                                <option value="13">Otros</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="buttons">

                    <button class="sumbit" id="diossoyo">
                        <span class="btnText">Submit</span>
                        <i class="uil uil-navigator"></i>
                    </button>
                </div>

        </div>
        </form>
    </div>

    </div>
</body>
<script>
        function convertirAMinusculas(inputElement) {
            inputElement.value = inputElement.value.toLowerCase();
        }

    $(document).ready(function() {
    $('#miFormulario').submit(function(e) {
      e.preventDefault();
      
      var id = $('#idInput').val();
      
    
      $.ajax({
        url: '/ruta-a-tu-api/buscar-registro',
        method: 'GET',
        data: { id: id },
        dataType: 'json',
        success: function(data) {
        
          if (data.exists) {
          
            $('#nombreInput').val(data.nombre);
            $('#apellidoInput').val(data.apellido);
            // Otros campos de datos...
          } else {

            alert('El registro no existe en la base de datos.');
          }
        },
        error: function() {

          alert('Error al procesar la solicitud.');
        }
      });
    });
  });
</script>
<!-- por ultimo se carga el footer -->
<?php require('./layout/footer.php'); ?>