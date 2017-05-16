<?php 
function Conectarse() 
{ 
   if (!($link=mysql_connect("localhost","hc000464_MIP","1045701147Kael"))) 
   { 
      echo "Error conectando a la base de datos."; 
      exit(); 
   } 
   if (!mysql_select_db("hc000464_MIP",$link)) 
   { 
      echo "Error seleccionando la base de datos."; 
      exit(); 
   } 
   return $link; 
}
?>