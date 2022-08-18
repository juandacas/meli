<?php 

error_reporting(0);

class AnalizeDNA {

    public function size($array) {
        $correct = 1; 
        $matrizCorrect = $this->matrizCuadrada($array);
        if ($matrizCorrect == 0) {
            $correct = 0;
            return $correct;
        }
        $sizeTotal = count($array);
        $sizeArray = strlen($array[0]);               
        
        foreach($array as $arr) {
            if (strlen($arr)!=$sizeArray) {
                $correct = 0;
            }
        }
        return $correct;
    }

    public function matrizCuadrada($array){
        $sizeTotal = count($array);
        $cor = 1;
        for ($i=0; $i < $sizeTotal; $i++) { 
            if (strlen($array[$i]) != $sizeTotal) {
                $cor = 0;
            }
        }
        return $cor;
    }

    public function consecutivos($array, $mut=4) {
        $value = null;
        $count = 1;
        foreach($array as $arr) {
            if($count == $mut) {
                break;
            } elseif(($arr == $value)) {
                $count++;
            } else {
                $value = $arr;
                $count = 1;
            }
        }
        return ($count == $mut);
    }

    public function verificar($dna) {
        $correctSize = $this->size($dna);
        $result = false;
        if ($correctSize == 0) { //matriz NxN?
            return $result;
        }
        $size = count($dna);
        $transp = array_map(null, $dna);
        $diag_pr = [];        
        for($i=0; $i<$size; $i++) {
            if($this->consecutivos($dna[$i]) or $this->consecutivos($transp[$i])) {
                $result = true;
                break;
            }
            $diag_pr[] = $dna[$i][$i];
        }
        return ($result or $this->consecutivos($diag_pr));
    }

}


