<?php 

error_reporting(0);

class AnalizeDNA {

    public function letters($array) {
        $correct = 1; 
        $notPerm = array("B","D","E","F","H","I","J","K","L","M","N","O","P","Q","R","S","U","V","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
        for ($i=0; $i < count($array); $i++) { 
            for ($j=0; $j < count($notPerm); $j++) { 
                if (strpos(strtoupper($array[$i]), $notPerm[$j])) {
                    return $correct = 0;
                }
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
        $correctSize = $this->matrizCuadrada($dna);
        $correctLetters = $this->letters($dna);
        $result = false;
        if ($correctSize == 0 || $correctLetters == 0) { //matriz NxN? letras permitidas?
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


