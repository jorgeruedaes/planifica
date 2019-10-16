<?php
global $conexion;
/// Consulta de numero de equipos que han jugado para generar la Tabla de posiciones
$equiposquehanjugado = mysqli_query($conexion,"SELECT id_equipo,nombre_equipo,puntos,grupo
FROM tb_equipos,tb_partidos 
WHERE tb_equipos.id_equipo = tb_partidos.equipo1
OR tb_equipos.id_equipo = tb_partidos.equipo2
 AND  tb_partidos.Estado='2'
GROUP BY id_equipo");

// se realiza la busqueda equipo por equipo con el fin de que se guarden los datos en una matrix , esto ayudara a organizar la informacion
// se calcula el numero de equipos que han jugado hasta ahora con una nueva variable que define el numero de columnas creadas (numero de equipos que ha jugado)
$numerodeequiposparaeltamañodelamatriz = mysqli_num_rows($equiposquehanjugado);

$matriz[$numerodeequiposparaeltamañodelamatriz]['20'] = 0;
$i = 0;
while ($identificaciones = mysqli_fetch_array($equiposquehanjugado)) {
    $matriz[$i]['3'] = 0;  // GOLES A FAVOR
    $matriz[$i]['4'] = 0; // GOLES CONTRA
    $matriz[$i]['5'] = 0;  // PARTIDOS PERDIOS
    $matriz[$i]['6'] = 0;  // PARTIDOS GANADOS
    $matriz[$i]['7'] = 0; // EMPATES


    $matriz[$i]['0'] = $identificaciones['id_equipo'];
    $matriz[$i]['1'] = $identificaciones['nombre_equipo'];
    $matriz[$i]['2'] = $identificaciones['puntos'];
    $matriz[$i]['11'] = $identificaciones['grupo'];


// // saber en que lugar esta si en el equipo1 o equipo2 para tomar los valores de los goles 
    $lugardentrodelospartidos = mysqli_query($conexion,"SELECT  distinct equipo1,equipo2,resultado1,resultado2
 FROM  tb_partidos WHERE tb_partidos.Estado='2' AND numero_fecha <18
 ");

    while ($equipoparticipante = mysqli_fetch_array($lugardentrodelospartidos)) {
        if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo'] || $equipoparticipante['equipo2'] == $identificaciones['id_equipo']) {


            // se incluira el codigo para saber que partidos se han ganado perdido o empatado por el respectivo equipo
// ifs para definir el ganador perdedor o empate
            if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) {

                if ($equipoparticipante['resultado1'] == $equipoparticipante['resultado2']) {
                    // EMPATE
                    $matriz[$i]['7'] = $matriz[$i]['7'] + 1;
                }

                if ($equipoparticipante['resultado1'] > $equipoparticipante['resultado2']) {
                    // GANA EQUIPO 1
                    $matriz[$i]['6'] = $matriz[$i]['6'] + 1;
                }

                if ($equipoparticipante['resultado1'] < $equipoparticipante['resultado2']) {
                    // GANA EQUIPO 2
                    $matriz[$i]['5'] = $matriz[$i]['5'] + 1;
                }
            }    ///---------------> PARA EQUIPO 1 ARRIBA


            if ($equipoparticipante['equipo2'] == $identificaciones['id_equipo']) {

                if ($equipoparticipante['resultado1'] == $equipoparticipante['resultado2']) {
                    // EMPATE
                    $matriz[$i]['7'] = $matriz[$i]['7'] + 1;
                }

                if ($equipoparticipante['resultado1'] > $equipoparticipante['resultado2']) {
                    // GANA EQUIPO 1
                    $matriz[$i]['5'] = $matriz[$i]['5'] + 1;
                }

                if ($equipoparticipante['resultado1'] < $equipoparticipante['resultado2']) {
                    // GANA EQUIPO 2
                    $matriz[$i]['6'] = $matriz[$i]['6'] + 1;
                }
            }//-------------------> PARA EQUIPO 2 CUANDO GPE ARRIBA
// --->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>AQUI TERMINA CODIGO PARTIDOS GPE


            if ($equipoparticipante['equipo1'] == $identificaciones['id_equipo']) {
                $Golesafavor = $equipoparticipante['resultado1'];
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $matriz[$i]['3'] = $matriz[$i]['3'] + $Golesafavor;
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $Golescontra = $equipoparticipante['resultado2'];
                $matriz[$i]['4'] = $matriz[$i]['4'] + $Golescontra;
            } else {
                $Golesacontra = $equipoparticipante['resultado1'];
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $matriz[$i]['4'] = $matriz[$i]['4'] + $Golesacontra;
// guardamos los datos en la matriz y sumamos los goles que deban ser sumados
                $Golesafavor = $equipoparticipante['resultado2'];
                $matriz[$i]['3'] = $matriz[$i]['3'] + $Golesafavor;
            }
        }
    }
    $i++;
}

// Ordenar matriz
    $eliminaciondeinfoanterio = mysqli_query($conexion,"DELETE FROM te_posiciones");

for ($i = 0; $i < $numerodeequiposparaeltamañodelamatriz; $i++) {

    $matriz[$i]['8'] = $matriz[$i]['6'] + $matriz[$i]['7'] + $matriz[$i]['5'];
    $matriz[$i]['9'] = $matriz[$i]['3'] - $matriz[$i]['4'];
    $matriz[$i]['10'] = $i + 1;

                            $variable1 = $matriz[$i]['1'];  // nombre equipo
                            $variable11 = $matriz[$i]['0'];  // id
                            $variable2 = (($matriz[$i]['6'] * 2) + $matriz[$i]['7']);  // puntos
                            $variable3 = $matriz[$i]['8'];  // partidos jugados
                            $variable4 = $matriz[$i]['6'];  // partidos ganados
                            $variable5 = $matriz[$i]['7'];  // empates
                            $variable6 = $matriz[$i]['5'];  // partidos perdidos
                            $variable7 = $matriz[$i]['3'];  // goles a favor
                            $variable8 = $matriz[$i]['4'];  // goles en contra
                            $variable9 = $matriz[$i]['9'];  // diferencia de Gol
                            $variable10 = $matriz[$i]['11'];  // Grupo
                            
                                //SITUACIONES ESPECIALES
                        

                            // FIN SITUACIONES ESPECIALES

mysqli_query($conexion,"INSERT INTO `te_posiciones`(`equipo`, `puntos`, `pj`, `pg`, `pe`, `pp`, `gf`, `gc`, `dg`,`id`,`grupo`)
  VALUES ('$variable1','$variable2','$variable3','$variable4','$variable5','$variable6','$variable7','$variable8','$variable9','$variable11','$variable10');")
or die(mysql_error());
                       
                        }

?>