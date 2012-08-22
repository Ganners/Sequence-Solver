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

    }
    

    public function getNextTerm() {

    }
    
    
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
                preg_match_all("/([0-9]*)/", $vars, $sequence);
                if(count($sequence) > 0)
                    $this->sequence = $sequence;
                else
                    throw new ErrorException("Sequence must have more than 1 number");
            break;

            default:
                throw new ErrorException("Type not permitted");
            break;

        }

    }

    public function getSequence() {

        if(isset($this->sequence) && count($this->sequence) > 0)
            return $this->sequence;
        else
            return (array) NULL;

    }

    protected function validateNumericArray($array) {

        foreach($array as $key => $value)
            if(!is_numeric($value))
                throw new ErrorException("Array must only contain numerical values");

    }

}