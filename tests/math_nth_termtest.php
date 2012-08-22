<?php

require_once("../loader.php");

use math\nth_term;

class Math_Nth_TermTest extends PHPUnit_Framework_TestCase {

    public function testConstruct() {

        $input = "1, 2, 3, 4, 5";
        $expected = array(1,2,3,4,5);

        $nth_term = new Nth_Term($input);

        $this->assertEquals($expected, $nth_term->getSequence());

    }

    /**
     * @expectedException ErrorException
     */
    public function testExceptionConstruct() {

        $invalid_input = (int) 12345;
        $nth_term = new Nth_Term($invalid_input);

        $invalid_input = "1";
        $nth_term = new Nth_Term($invalid_input);

    }

    public function testValidateNumericArray() {

    }

    public function testGetNextTerm() {

    }

    public function testGetForumla() {
        
    }

}