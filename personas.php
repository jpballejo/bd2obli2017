<?php 
// En este modo, notamos que abrimos un <tr> inicial...
// ...que extraño no?

include 'manejo_conexiones.php';
echo '<table style="border: 1px inset" border="1"><tr>';

$columnas = fun_select(,,,);
$filas = 4;

$inicial = 0;
$total = 32; // total?



while ($inicial < $total)
{
  echo '<td>';
  
  // rutinas...
  echo "$inicial,$filas";

 
  echo '</td>';

  // break!
  if (++$inicial == $columnas)
  {
        if (!(--$filas))
      {
         break;
      }
      
   // cerramos y continuamos...
    echo '</tr><tr>';
    $inicial=0; // debemos resetear!!!
  }
  
}

// cerramos ambos...
echo '</tr></table>';
?>




























































































































































































   .php" method="post">
      <label type="label"> INSERTAR QUERY : </label>
      <input type="text" name="sql"></input>
      <input type="submit"></input>
   </form>

</body>

<?php

function displayTable($sql){

   //Creamos la conexión
   $g = new gestor();
   if(!$result = mysqli_query($this->g, $sql)) die();

   $rawdata = array();
   //guardamos en un array multidimensional todos los datos de la consulta
   $i=0;

   while($row = mysqli_fetch_array($result))
   {
       $rawdata[$i] = $row;
       $i++;
   }


   //DIBUJAMOS LA TABLA

   echo '<table width="100%" border="1" style="text-align:center;">';
   $columnas = count($rawdata[0])/2;
   //echo $columnas;
   $filas = count($rawdata);
   //echo "<br>".$filas."<br>";

   //Añadimos los titulos

   for($i=1;$i<count($rawdata[0]);$i=$i+2){
      next($rawdata[0]);
      echo "<th><b>".key($rawdata[0])."</b></th>";
      next($rawdata[0]);
   }

   for($i=0;$i<$filas;$i++){

      echo "<tr>";
      for($j=0;$j<$columnas;$j++){
         echo "<td>".$rawdata[$i][$j]."</td>";

      }
      echo "</tr>";
   }

   echo '</table>';

}
if(empty($_POST) || $_POST["sql"] == ""){
     DIE("");
 }
$sql = $_POST["sql"];
echo $sql;
displayTable($sql);
?>
 ?>