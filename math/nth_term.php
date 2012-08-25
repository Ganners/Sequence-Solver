<?php

/**
 * Allows the calculation of the Nth term from a sequence, and can return
 * the formula used. Offers two solutions, first being a difference table
 * and the second an arithmetic forumla.
 *
 * PHP version 5.3
 *
 * @package    Math
 * @author     Mark Gannaway <mark@ganners.co.uk>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version    1
 * @link       http://
 */

namespace Math;

class Nth_Term {

    public $sequence = array();
    public $formula = "";

   /**
    * Sets up the sequence dependency for the object
    * @param [string|array] $vars - The sequence of numbers as either a string or an array
    */
    public function __construct($vars) {

        $this->setSequence($vars);
        $this->convertSequenceTypesToInt();

    }

    /**
     * Get the nth term using a difference table
     * @return [int]
     * @throws ErrorException if term could not be found
     */ 
    public function getNextTerm() {

        $last = array();

        $diff = array_slice($this->sequence, 0);

        $n = count($this->sequence);

        $formula = implode(" ", $this->sequence);
        $formula .= "\n";

        for($k = 0; $k < $n; $k++) {

            $same = 1;

            for($j = 0; $j < count($diff) - $k - 1; $j++) {
                
                $diff[$j] = $diff[$j+1] - $diff[$j];

                $formula .= "{$diff[$j]} ";

                if($j > 0 && $diff[$j] != $diff[$j-1])
                    $same = 0;

            }

            $formula .= "\n";

            array_push($last, $diff[$j]);

            if($same) {

                $formula .= "\n----\n\n";

                if($k < ($n + 1) - 2) {

                    $out = $diff[0];

                    $formula .= "{$out} + ";

                    for($s = count($last)-1; $s > -1; $s--) {

                        $formula .= "{$last[$s]}";
                        $formula .= $s > 0 ? " + " : "";

                        $out += $last[$s];

                    }

                    $formula .= " = {$out}";

                    //Set the formula
                    $this->formula = $formula;

                    return (int) $out;

                }
                else
                    throw new ErrorException("Next term could not be found, not a valid sequence.", 500);

                break;

            }

        }

    }

    /**
     * Get the nth term using the formula a+(n-1)d
     * @return [int]
     * @throws ErrorException if terms are not arithmetic
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

        //Write out the formula used
        $this->formula = "{$a} + ({$n}) * {$d}";
        return (int) $a + ($n) * $d;

    }

    /**
     * Returns a formula if it is set, or false
     * @return [string|bool]
     */
    public function getFormula() {

        if($this->formula)
            return (string) $this->formula;
        else
            return FALSE;

    }

    /**
     * Gets the sequence that has been set
     * @return [array]
     */
    public function getSequence() {

        if(isset($this->sequence) && count($this->sequence) > 0)
            return (array) $this->sequence;
        else
            return (array) NULL;

    }

    /**
     * Sets the sequence by type, checks and validates
     * @param [array|string] $vars - The input vars to the sequence
     * @return [bool]
     * 
     * @throws ErrorException if array has less than 1 number
     * @throws ErrorException if sequence has less than 1 number
     * @throws ErrorException if type is wrong
     */
    protected function setSequence($vars) {

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

        return TRUE;

    }

    /**
     * Checks if all values in array are numeric
     * @param [array] $array
     * @return [bool]
     * @throws ErrorException if invalid
     */
    protected function validateNumericArray(array $array) {

        foreach($array as $key => $value)
            if(!is_numeric($value))
                throw new ErrorException("Array must only contain numerical values");

        return TRUE;
    }

    /**
     * Sets all values in a sequence to type int
     */
    protected function convertSequenceTypesToInt() {

        if($this->sequence) {

            foreach($this->sequence as &$sequence)
                $sequence = (int) $sequence;

        }

    }

}