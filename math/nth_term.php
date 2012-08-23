<?php

namespace math;

class Nth_Term {

    public $sequence = array();

   /**
    * Sets up the sequence dependency for the object
    * @param [string|array] $vars - The sequence of numbers as either a string or an array
    */
    public function __construct($vars) {

        $this->setSequence($vars);
        $this->convertSequenceTypesToInt();

    }

    /**
     *  Get the nth term using a difference table
     */ 
    public function getNextTerm() {

        $last = array();

        $diff = array_slice($this->sequence, 0);

        $n = count($this->sequence) - 1;

        for($k = 0; $k < $n; $k++) {

            $same = 1;

            for($j = 0; $j < count($diff) - $k - 1; $j++) {
                
                $diff[$j] = $diff[$j+1] - $diff[$j];

                if($j > 0 && $diff[$j] != $diff[$j-1])
                    $same = 0;

            }

            array_push($last, $diff[$j]);

            if($same) {

                if($k < count($this->sequence) - 2) {

                    $out = $diff[0];

                    for($s = count($last)-1; $s > -1; $s--) {

                        $out += $last[$s];

                    }

                    return $out;
                }
                else
                    return FALSE;

                break;

            }

        }

    }

    /**
     * Get the nth term using the formula a+(n-1)d
     */
    public function getNextTermArithmetic() {

        $a = $this->sequence[0];

        $n = count($this->sequence);

        $d = 0;

        foreach($this->sequence as $key => $term) {

            if(!isset($this->sequence[($key + 1)]))
                break;

            $difference = $this->sequence[($key + 1)] - $this->sequence[$key];

            if($d == 0)
                $d = $difference;
            else if ($d != $difference)
                throw new ErrorException("Terms are not arithmetic, sequence could not be generated");
            else if ($d == $difference)
                continue;

        }

        return $a + ($n) * $d;

    }
    
    /**
     * 
     */
    public function setSequence($vars) {

        switch(gettype($vars)) {

            case 'array':
                if(count($vars) > 1)
                    if($this->validateNumericArray($vars))
                        $this->sequence = $vars;
                else
                    throw new ErrorException("Array must have more than 1 number");
            break;

            case 'string':
                preg_match_all("/(?P<matches>[0-9]+)/", $vars, $sequence);
                if(count($sequence['matches']) > 0)
                    $this->sequence = $sequence['matches'];
                else
                    throw new ErrorException("Sequence must have more than 1 number");
            break;

            default:
                throw new ErrorException("Type not permitted");
            break;

        }

    }

    /**
     * 
     */
    public function getSequence() {

        if(isset($this->sequence) && count($this->sequence) > 0)
            return $this->sequence;
        else
            return (array) NULL;

    }

    /**
     * 
     */
    public function validateNumericArray($array) {

        foreach($array as $key => $value)
            if(!is_numeric($value))
                throw new ErrorException("Array must only contain numerical values");

        return TRUE;
    }

    /**
     * 
     */
    protected function convertSequenceTypesToInt() {

        if($this->sequence) {

            foreach($this->sequence as &$sequence)
                $sequence = (int) $sequence;

        }

    }

}