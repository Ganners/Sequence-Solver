<?php

require_once(dirname(__FILE__) . "/../loader.php");

use math\nth_term;

class Math_Nth_TermTest extends PHPUnit_Framework_TestCase {

    public function testSetSequence() {

        $input = "1, 2, 3, 4, 5";
        $expected = array(1,2,3,4,5);
        $nth_term = new Nth_Term($input);
        $this->assertEquals($expected, $nth_term->getSequence());

        $input = array(2,4,6,8,10);
        $expected = array(2,4,6,8,10);
        $nth_term = new Nth_Term($input);
        $this->assertEquals($expected, $nth_term->getSequence());

    }

    /**
     * @expectedException ErrorException
     */
    public function testSetSequenceException() {

        $invalid_input = (int) 12345;
        $nth_term = new Nth_Term($invalid_input);

        $invalid_input = "1";
        $nth_term = new Nth_Term($invalid_input);

    }

    /**
     * @expectedException ErrorException
     */
    public function testValidateNumericArrayException() {
        
        $nth_term = new Nth_Term(array(1, 2, 3, "four"));

    }

    public function testGetNextTerm() {

        $nth_term = new Nth_Term("1, 2, 3, 4");
        $this->assertEquals(5, $nth_term->getNextTerm());

        $nth_term = new Nth_Term("2, 4, 6, 8");
        $this->assertEquals(10, $nth_term->getNextTerm());

        $nth_term = new Nth_Term("5, 10, 15, 20");
        $this->assertEquals(25, $nth_term->getNextTerm());

        $nth_term = new Nth_Term("100, 200, 300, 400");
        $this->assertEquals(500, $nth_term->getNextTerm());

        $nth_term = new Nth_Term("101, 202, 303, 404");
        $this->assertEquals(505, $nth_term->getNextTerm());

        $nth_term = new Nth_Term("4, 8, 16, 32");
        $this->assertEquals(505, $nth_term->getNextTerm());

    }

    public function testGetFormula() {
        
    }

}