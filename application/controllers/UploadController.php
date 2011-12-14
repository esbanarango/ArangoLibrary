<?php

/**
 * Description of UploadControlle
 *
 * @author Arango
 */
class UploadController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function imageuploadAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true);

        $path = "Images/tempsUpload/";

        $valid_formats = array("jpg", "png", "gif", "bmp");
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];

            if (strlen($name)) {
                list($txt, $ext) = explode(".", $name);
                if (in_array($ext, $valid_formats)) {
                    if ($size < (1024 * 1024)) {
                        $actual_image_name = time() . substr(str_replace(" ", "_", $txt), 5) . "." . $ext;
                        $tmp = $_FILES['photoimg']['tmp_name'];
                        if (move_uploaded_file($tmp, $path . $actual_image_name)) {;                    
                            $this->view->thumbnails($path . $actual_image_name,$path ."miniatura/". $actual_image_name);
                            echo "<img src='/arangolibrary.phpfogapp.com/public/Images/tempsUpload/miniatura/" . $actual_image_name . "'  class='preview'>";
                        }
                        else
                            echo "failed";
                    }
                    else
                        echo "Image file size max 1 MB";
                }
                else
                    echo "Invalid file format..";
            }

            else
                echo "Please select image..!";

            exit;
        }
    }

}

?>
