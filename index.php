<?php
session_start();
$lista_empleados = [];
$empleado = [];
if (isset($_SESSION['empleadoData'])) {
  $lista_empleados = $_SESSION['empleadoData'];

}
if (isset($_POST['delete'])) {
  session_destroy();
  header("Location: index.php");
}
class empleado
{
  public $nombre_empleado;
  public $edad_empleado;
  public $estado_empleado;
  public $sexo_empleado;
  public $sueldo_empleado;
  public function __construct($nombre, $edad, $estado, $sexo, $sueldo)
  {
    $this->nombre_empleado = $nombre;
    $this->edad_empleado = $edad;
    $this->estado_empleado = $estado;
    $this->sexo_empleado = $sexo;
    $this->sueldo_empleado = $sueldo;
  }
  public function get_nombre()
  {
    return $this->nombre_empleado;
  }
  public function get_edad()
  {
    return $this->edad_empleado;
  }
  public function get_estado()
  {
    return $this->estado_empleado;
  }
  public function get_sexo()
  {
    return $this->sexo_empleado;
  }
  public function get_sueldo()
  {
    return $this->sueldo_empleado;
  }
}



if ((isset($_POST['nombre']) && isset($_POST['edad']) && isset($_POST['estado'])) && (isset($_POST['sexo']) && isset($_POST['sueldo']))) {
  if ((!empty($_POST['nombre']) && !empty($_POST['edad']) && !empty($_POST['estado'])) && (!empty($_POST['sexo']) && !empty($_POST['sueldo']))) {
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $estado = $_POST['estado'];
    $sexo = $_POST['sexo'];
    $sueldo = $_POST['sueldo'];

    $empleado = new empleado($nombre, $edad, $estado, $sexo, $sueldo);
    array_push($lista_empleados, $empleado);
    $_SESSION['empleadoData'] = $lista_empleados;
  } else {
  }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Act. 1</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
<br><h1>Primer Ejercicio: Salario de trabajadores </h1> <br><br>
    <form action="index.php" method="post" class="form-inline">

        <h2>Ingresa los siguientes datos</h2>
        <div class="form-group mb-2 ">
        <label for="nombre">Nombre y Apellido</label>
        <input onkeyup="lettersOnly(this)" class="form-control" type="text" id="nombre" name="nombre">

        <label for="edad">Edad</label>
        <input pattern="[0-9]+" maxlength="3" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" / class="form-control" type="number" id="edad" name="edad">


        <label>Estado Civil</label>
        <br>
        <input class="form-check-input" type="radio" id="Casado" name="estado" value="Casado(a)" checked>
        <label for="Casado">Casado(a)</label>
        <input class="form-check-input" type="radio" id="Soltero" name="estado" value="Soltero(a)">
        <label for="Soltero">Soltero(a)</label>
        <input class="form-check-input" type="radio" id="Viudo" name="estado" value="Viudo(a)">
        <label for="Viudo">Viudo(a)</label>
        <br>

        <label>Sexo</label>
        <br>
        <input class="form-check-input" type="radio" id="Casado" name="sexo" value="Masculino" checked>
        <label for="Masculino">Masculino</label>
        <input class="form-check-input" type="radio" id="Femenino" name="sexo" value="Femenino">
        <label for="Femenino">Femenino</label>
        <br>

        <label>Sueldo</label>
        <br>
        <input class="form-check-input" type="radio" id="1.000_Bs" name="sueldo" value="-1.000 Bs" checked>
        <label for="1.000_Bs"">-1.000 Bs</label>
        <input class="form-check-input" type="radio" id="1.000-2.500_Bs" name="sueldo" value="1.000 Bs a 2.500 Bs">
        <label for="1.000-2.500_Bs">1.000 Bs a 2.500 Bs</label>
        <input class="form-check-input" type="radio" id="2.500_Bs" name="sueldo" value="+2.500 Bs">
        <label for="2.500_Bs">+2.500 Bs</label>
        <br>
        <br>


        <input type="submit" value="Agregar" name="btn" class="btn btn-primary">
        <input type="submit" value="Reiniciar" name="delete" class="btn btn-danger">
        <a href="../index.php" class="btn btn-secondary">Regresar</a>


    </div>  

    </form>

<h2>Lista empleados</h2>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">Nombre y Apellido</th>
      <th scope="col">Edad</th>
      <th scope="col">Estado Civil</th>
      <th scope="col">Sexo</th>
      <th scope="col">Sueldo</th>
    </tr>   
  </thead>
  <tbody>
  <?php
          foreach ($lista_empleados as $empleado) {
            echo "<tr>";
            echo "<td>", $empleado->get_nombre(), "</td>";
            echo "<td>", $empleado->get_edad(), "</td>";
            echo "<td>", $empleado->get_estado(), "</td>";
            echo "<td>", $empleado->get_sexo(), "</td>";
            echo "<td>", $empleado->get_sueldo(), "</td>";
            echo "</tr>";

          }

          ?>
  </tbody>
</table>
<br><br>

<h2>Datos Filtrados</h2>

<?php
              $amountFemale = 0;
              $amountMalesMarried2500 = 0;
              $amountWidows1000 = 0;
              $amountMales = 0;
              $summAgeMale = 0;
              foreach ($lista_empleados as $employee) {
                if ($employee->get_sexo() == "Femenino") {
                  $amountFemale += 1;
                }
                if ($employee->get_sexo() == "Masculino" && $employee->get_estado() == "Casado(a)" && $employee->get_sueldo() == "+2.500 Bs") {
                  $amountMalesMarried2500 += 1;
                }
                if ($employee->get_estado() == "Viudo(a)" && $employee->get_sexo() == "Femenino" && ($employee->get_sueldo() == "1.000 Bs a 2.500 Bs" || $employee->get_sueldo() == "+2.500 Bs")) {
                  $amountWidows1000 += 1;
                }
                if ($employee->get_sexo() == "Masculino") {
                  $amountMales += 1;
                  $summAgeMale += $employee->get_edad();
                }
              }

              echo "<p> Total de empleadas femeninas: ", $amountFemale, "</p>";
              echo "<p> Total de empleados masculinos casados que ganan +2.500 Bs: ", $amountMalesMarried2500, "</p>";
              echo "<p> Total de empleadas femeninas viudas que ganan +1.000 Bs: ", $amountWidows1000, "</p>";
              echo "<p> Edad promedio de empleados masculinos: ";
              try {
                echo $averageAgeMale = intval($summAgeMale/$amountMales);
              }catch(DivisionByZeroError){
                echo "0";
              }
              echo "</p>";

              ?>
    
</body>
<script>
  function lettersOnly(input) {
    var regex = /[^a-z ]/gi;
    input.value = input.value.replace(regex, "");
}
</script>
</html>