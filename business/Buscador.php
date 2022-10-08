
<?php

class Buscador
{

  public function __construct()
  {
  }

  public function resaltar_frase($string, $frase, $taga = '<b>', $tagb = '</b>')
  {
    return ($string !== '' && $frase !== '')
      ? preg_replace('/(' . preg_quote($frase, '/') . ')/i' . ('true' ? 'u' : ''), $taga . '\\1' . $tagb, $string)
      : $string;
  }

  public function buscar($columna1, $columna2, $tabla,$dato)
  {

    if (!isset($dato)){
      $dato = '';
    }
    if (!empty($dato)) {
      
      $akeyword = explode(" ", $dato);
      //$filtro = "Where titulo LIKE LOWER('%".$akeyword[0]."%') OR contenido LIKE LOWER('%".$akeyword[0]."%')";
      
      $query = "SELECT * FROM  $tabla WHERE $columna1 Like LOWER('%" . $akeyword[0] . "%') OR $columna2 Like LOWER('%" . $akeyword[0] . "%')";

      for ($i = 1; $i < count($akeyword); $i++) {
        if (!empty($akeyword[$i])) {

          $query .= " OR $columna1 Like LOWER '%" . $akeyword[$i] . "%' 0R $columna2 Like LOWER '%" . $akeyword[$i] . "%'";
        }
      }
      require '../data/Conexion.php';

      $result = mysqli_query($db, $query);
      $numero = mysqli_num_rows($result);
      $buscador = new Buscador();
      if (mysqli_num_rows($result) > 0 && $dato != '') {
        $row_count = 0;
        echo "<br>Resultados encontrados:<b> " . $numero . "</b>";
        echo "<br><br><table border=1>
    <thead>
    <tr>
    <th> # </th>
    <th> Columna 1 </th>
    <th> Columna 2 </th>
    </tr>
    </thead>";
        while ($row = $result->fetch_assoc()) {
          $row_count++;
          echo "<tr>
     <td>" . $row_count . "</td>
     <td>" . $buscador->resaltar_frase($row[$columna1], $dato) . "</td>
     <td>" .  $buscador->resaltar_frase($row[$columna2], $dato) . "</td>
     </tr>";
        }
        echo "</table>";
      }
    }
  }
}

if(isset($_POST['tabla']) && isset($_POST['buscar']) && isset($_POST['column1']) && isset($_POST['column2'])){
  $Buscador = new Buscador();
  $Buscador->buscar($_POST['column1'], $_POST['column2'],$_POST['tabla'],$_POST['buscar']);
}



