<?php

class Zend_View_Helper_Funciones extends Zend_View_Helper_Abstract 
{

    public function funciones(){
        return $this;
    }

    
    public function fecha_bd2sh($f) {
        $fech = explode("-", $f);
        $anno = $fech[0];
        $mes = $fech[1];
        $dia = $fech[2];

        switch ($mes) {
            case '01':
                $mes = 'Enero';
                break;
            case '02':
                $mes = "Febrero";
                break;
            case '03':
                $mes = "Marzo";
                break;
            case '04':
                $mes = "Abril";
                break;
            case '05':
                $mes = "Mayo";
                break;
            case '06':
                $mes = "Junio";
                break;
            case '07':
                $mes = "Julio";
                break;
            case '08':
                $mes = "Agosto";
                break;
            case '09':
                $mes = "Septiembre";
                break;
            case '10':
                $mes = "Octubre";
                break;
            case '11':
                $mes = "Noviembre";
                break;
            case '12':
                $mes = "Diciembre";
                break;
        }

        $fecha = $mes . " " . $dia . ", " . $anno;

        return $fecha;
    }

    public function fecha_fr2bd($f) {
        $fech = explode("/", $f);
        $anno = $fech[2];
        $mes = $fech[1];
        $dia = $fech[0];

        $fecha = $anno . "-" . $mes . "-" . $dia;

        return $fecha;
    }

    public function fecha_bd2fr($f) {
        $fech = explode("-", $f);
        $anno = $fech[0];
        $mes = $fech[1];
        $dia = $fech[2];

        $fecha = $dia . "/" . $mes . "/" . $anno;

        return $fecha;
    }

    public function fecha_dp2bd($f) {
        $fecha = str_replace('/', '-', $f);

        return $fecha;
    }

    public function fecha_bd2cl($f) {
        $fecha = str_replace('-', '/', $f);
        /*
          $fech = explode("-", $f);
          $anno = $fech[0];
          $mes = $fech[1];
          $dia = $fech[2];

          $fecha = $dia."-".$mes."-".$anno;
         */
        return $fecha;
    }

    public function dias($f1, $f2) {
        $fecha = explode("-", $f1);
        $ano1 = $fecha[0];
        $mes1 = $fecha[1];
        $dia1 = $fecha[2];

        $fecha2 = explode("-", $f2);
        $ano2 = $fecha2[0];
        $mes2 = $fecha2[1];
        $dia2 = $fecha2[2];


        //calculo timestam de las dos fechas
        $timestamp1 = mktime(0, 0, 0, $mes1, $dia1, $ano1);
        $timestamp2 = mktime(0, 0, 0, $mes2, $dia2, $ano2);


        //resto a una fecha la otra
        $segundos_diferencia = $timestamp1 - $timestamp2;
        //echo $segundos_diferencia;
        //convierto segundos en días
        $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

        //obtengo el valor absoulto de los días (quito el posible signo negativo)
        $dias_diferencia = abs($dias_diferencia);

        //quito los decimales a los días de diferencia
        return $dias_diferencia = floor($dias_diferencia);
    }

    public function resumen($text, $longitud) {
        if (strlen($text) > $longitud) {
            $texto = substr("$text", 0, $longitud);
            return $texto . "...";
        } else {
            return $text;
        }
    }

    //This public function reads the extension of the file. It is used to determine if the file  is an image by checking the extension.
    public function getExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    public function substr_rand($long) {
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $cad = "";
        for ($i = 0; $i < $long; $i++) {
            $cad .= substr($str, rand(0, 62), 1);
        }
        return $cad;
    }

    public function bd2mail($texto) {
        $texto = str_replace("Ã¡", "&aacute;", $texto);
        $texto = str_replace("Ã±", "&ntilde;", $texto);
        $texto = str_replace("Ã©", "&eacute;", $texto);
        $texto = str_replace("Ã³", "&oacute;", $texto);
        $texto = str_replace("Ã­", "&iacute;", $texto);
        $texto = str_replace("Ãº", "&uacute;", $texto);
        $texto = str_replace("á", "&aacute;", $texto);
        $texto = str_replace("ñ", "&ntilde;", $texto);
        $texto = str_replace("é", "&eacute;", $texto);
        $texto = str_replace("ó", "&oacute;", $texto);
        $texto = str_replace("í", "&iacute;", $texto);
        $texto = str_replace("ú", "&uacute;", $texto);

        return $texto;
    }

    public function formato_fecha($fecha) {
        //compruebo si las características del archivo son las que deseo

        $seccion = explode("/", $fecha);

        $dia = $seccion[0];
        $mes = $seccion[1];
        $ano = $seccion[2];

        if (($dia > 0) && ($dia < 32)) {
            if (($mes > 0) && ($mes < 13)) {
                if (($ano > 2000) && ($ano < 2030)) {
                    return 1;
                } else {
                    return 0;
                }
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function calcular_tiempo_trasnc($hora1, $hora2) {
        $separar[1] = explode(':', $hora1);
        $separar[2] = explode(':', $hora2);

        $total_minutos_trasncurridos[1] = ($separar[1][0] * 60) + $separar[1][1];
        $total_minutos_trasncurridos[2] = ($separar[2][0] * 60) + $separar[2][1];

        return $total_minutos_trasncurridos = $total_minutos_trasncurridos[1] - $total_minutos_trasncurridos[2];
    }

    public function clean_post($variable) {
        return stripslashes(trim(strip_tags($variable)));
    }

    public function clean_post_html($variable) {
        return stripslashes(trim(strip_tags($variable, '<p><a><u><em><strong><caption><table><thead><tbody><tr><td><ol><ul><li><img><h1><h2><h3><h4><h5><h6><pre><address><div>')));
    }

    public function calcular_edad($fecha_nac) {
        $hoy = date('Y-m-d');

        $a_fecha = explode('-', $fecha_nac);
        $a_hoy = explode('-', $hoy);

        $dia_fecha = $a_fecha[2];
        $mes_fecha = $a_fecha[1];
        $anno_fecha = $a_fecha[0];
        $dia_hoy = $a_hoy[2];
        $mes_hoy = $a_hoy[1];
        $anno_hoy = $a_hoy[0];

        $edad = $anno_hoy - $anno_fecha;

        if (($mes_hoy < $mes_fecha) || ($mes_hoy == $mes_fecha && $dia_hoy < $dia_fecha)) {
            $edad--;
        }
        return $edad;
    }

    //toma la fecha actual hora:min:segundo y le suma al parametro
    public function sumar_hora($date, $hh, $mn, $ss) {
        $date_r = getdate(strtotime($date));
        $date_result = date("h:i:s", mktime(($date_r["hours"] + $hh), ($date_r["minutes"] + $mn), ($date_r["seconds"] + $ss)));
        return $date_result;
    }

    public function getIP() {

        if ($_SERVER['HTTP_X_FORWARDED_FOR'] != '') {
            $client_ip =
                    (!empty($_SERVER['REMOTE_ADDR']) ) ?
                    $_SERVER['REMOTE_ADDR'] :
                    ( (!empty($_ENV['REMOTE_ADDR']) ) ?
                            $_ENV['REMOTE_ADDR'] :
                            "unknown" );

            // los proxys van añadiendo al final de esta cabecera
            // las direcciones ip que van "ocultando". Para localizar la ip real
            // del usuario se comienza a mirar por el principio hasta encontrar
            // una dirección ip que no sea del rango privado. En caso de no
            // encontrarse ninguna se toma como valor el REMOTE_ADDR

            $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);

            reset($entries);
            while (list(, $entry) = each($entries)) {
                $entry = trim($entry);
                if (preg_match("/^([0-9]+\\.[0-9]+\\.[0-9]+\\.[0-9]+)/", $entry, $ip_list)) {
                    // http://www.faqs.org/rfcs/rfc1918.html
                    $private_ip = array(
                        '/^0\\./',
                        '/^127\\.0\\.0\\.1/',
                        '/^192\\.168\\..*/',
                        '/^172\\.((1[6-9])|(2[0-9])|(3[0-1]))\\..*/',
                        '/^10\\..*/');

                    $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

                    if ($client_ip != $found_ip) {
                        $client_ip = $found_ip;
                        break;
                    }
                }
            }
        } else {
            $client_ip =
                    (!empty($_SERVER['REMOTE_ADDR']) ) ?
                    $_SERVER['REMOTE_ADDR'] :
                    ( (!empty($_ENV['REMOTE_ADDR']) ) ?
                            $_ENV['REMOTE_ADDR'] :
                            "unknown" );
        }

        return $client_ip;
    }

}

?>