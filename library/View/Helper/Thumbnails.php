<?php

class Zend_View_Helper_Thumbnails extends Zend_View_Helper_Abstract {

    private $archi;
    private $extension;
    private $ancho;
    private $alto;

    public function thumbnails($archi, $archinue, $ancho=140, $alto=137){
        $this->archi = $archi;
        $vec = explode('.', $archi);
        $this->extension = strtoupper($vec[sizeof($vec) - 1]);
        $this->ancho = $ancho;
        $this->alto = $alto;
        
        $tam = getimagesize($this->archi);
        $imagen = imagecreatetruecolor($this->ancho, $this->alto);
        switch ($this->extension) {
            case "PNG":
                $origen = imagecreatefrompng($this->archi);
                imagecopyresampled($imagen, $origen, 0, 0, 0, 0, $this->ancho, $this->alto, $tam[0], $tam[1]);
                $this->guardarEnDisco($imagen, $archinue);
                break;
            case "GIF":
                $origen = imagecreatefromgif($this->archi);
                imagecopyresampled($imagen, $origen, 0, 0, 0, 0, $this->ancho, $this->alto, $tam[0], $tam[1]);
                $this->guardarEnDisco($imagen, $archinue);
                break;
            case "JPG":;
            case "JPEG":
                $origen = imagecreatefromjpeg($this->archi);
                imagecopyresampled($imagen, $origen, 0, 0, 0, 0, $this->ancho, $this->alto, $tam[0], $tam[1]);
                $this->guardarEnDisco($imagen, $archinue);
                break;
        }
        

    }

    private function guardarEnDisco($imagen, $archinuevo) {
        $vec = explode('.', $archinuevo);
        $ext = strtoupper($vec[sizeof($vec) - 1]);
        switch ($ext) {
            case "PNG":
                imagepng($imagen, $archinuevo);
                break;
            case "GIF":
                imagegif($imagen, $archinuevo);
                break;
            case "JPG":;
            case "JPEG":
                imagejpeg($imagen, $archinuevo);
                break;
        }
    }

    public function guardar($archinue) {
        $tam = getimagesize($this->archi);
        $imagen = imagecreatetruecolor($this->ancho, $this->alto);
        switch ($this->extension) {
            case "PNG":
                $origen = imagecreatefrompng($this->archi);
                imagecopyresampled($imagen, $origen, 0, 0, 0, 0, $this->ancho, $this->alto, $tam[0], $tam[1]);
                $this->guardarEnDisco($imagen, $archinue);
                break;
            case "GIF":
                $origen = imagecreatefromgif($this->archi);
                imagecopyresampled($imagen, $origen, 0, 0, 0, 0, $this->ancho, $this->alto, $tam[0], $tam[1]);
                $this->guardarEnDisco($imagen, $archinue);
                break;
            case "JPG":;
            case "JPEG":
                $origen = imagecreatefromjpeg($this->archi);
                imagecopyresampled($imagen, $origen, 0, 0, 0, 0, $this->ancho, $this->alto, $tam[0], $tam[1]);
                $this->guardarEnDisco($imagen, $archinue);
                break;
        }
    }

    public function redimensionar($porc) {
        $tam = getimagesize($this->archi);
        $this->ancho = $tam[0] * $porc;
        $this->alto = $tam[1] * $porc;
    }

}

?>