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
     * a+(n-1)d
     */
    public function getNextTerm() {

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