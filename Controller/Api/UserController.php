<?php


class UserController extends BaseController
{
    /**
     * 
     */
    public function statsDNA()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        //$arrQueryStringParams = $this->getQueryStringParams();
 
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $userModel = new UserModel(); 
                $mutants = $userModel->getMutants();
                $humans = $userModel->getHumans();
                $ratio = $this->ratio(json_encode($mutants) , json_encode($humans));
                $arrDNA = array('count_mutant_dna:'.json_encode($mutants).', count_human_dna:'.json_encode($humans).', ratio:'.$ratio);
                $responseData = json_encode($arrDNA);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 403 Forbiden';
        }
 
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(json_encode(array('error' => $strErrorDesc)), 
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }


    /**
     * 
     */
    public function DNA()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $analizeResult = '';
        $userModel = new UserModel();

        if ($data && strtoupper($requestMethod) == 'POST') {
            $dna = $data['dna'];  
            require PROJECT_ROOT_PATH . "/meli/analyzeDNA.php";
            $analize = new AnalizeDNA();
            $analizeResult = $analize->verificar($dna);   
            $almacena = $userModel->saveDNA(json_encode($dna),$analizeResult); 
            $responseData = json_encode($analizeResult);
        }else{
            $this->sendOutput(json_encode(array('error' => 'Data Error')), 
                array('Content-Type: application/json', 'HTTP/1.1 403 Forbiden')
            );
        }
 
        if ($analizeResult) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else{
            $this->sendOutput(json_encode(array('error' => 'Data Error')), 
                array('Content-Type: application/json', 'HTTP/1.1 403 Forbiden')
            );
        } 
        
    }

    public function ratio($a, $b){
        if ($a > 0 && $b > 0) {
            return $ratio = round($a/$b, 2);
        }else{
            return $ratio = "--";
        }        

    }

}