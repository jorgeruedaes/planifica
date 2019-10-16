<?php



function Int_Total_Visitantes(){

    $valor = mysqli_fetch_array(consultar("SELECT COUNT(*) 
      AS visitas FROM tb_contador WHERE lugar='index'"));
    $totalvisitas= $valor['visitas'];
    
    return $totalvisitas;
}


function Int_Total_Visitantes_Mes(){


    $fecha1 = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-30,date('Y')));
    $valor = mysqli_fetch_array(consultar("SELECT COUNT(*) 
      AS visitas FROM tb_contador WHERE lugar='index' and fecha BETWEEN '$fecha1' and now()  "));
    $totalvisitas= $valor['visitas'];
    
    return $totalvisitas;
}

function Int_Total_Visitantes_Semana(){


    $fecha1 = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-7,date('Y')));
    $valor = mysqli_fetch_array(consultar("SELECT COUNT(*) 
      AS visitas FROM tb_contador WHERE lugar='index' and fecha BETWEEN '$fecha1' and now()  "));
    $totalvisitas= $valor['visitas'];
    
return $totalvisitas;    
}

function Int_Total_Visitantes_Hoy(){


    $fecha1 = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-1,date('Y')));
    $valor = mysqli_fetch_array(consultar("SELECT COUNT(*) 
      AS visitas FROM tb_contador WHERE lugar='index' and fecha BETWEEN '$fecha1' and now()  "));
      return $valor['visitas'];
}
