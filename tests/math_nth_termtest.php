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

        $nth_term = new Nth_Term("10, 9, 8, 7");
        $this->assertEquals(6, $nth_term->getNextTerm());

        $nth_term = new Nth_Term("2, 4, 6, 8");
        $this->assertEquals(10, $nth_term->getNextTerm());

        $nth_term = new Nth_Term("5, 10, 15, 20");
        $this->assertEquals(25, $nth_term->getNextTerm());

        $nth_term = new Nth_Term("100, 200, 300, 400");
        $this->assertEquals(500, $nth_term->getNextTerm());

        $nth_term = new Nth_Term("101, 202, 303, 404");
        $this->assertEquals(505, $nth_term->getNextTerm());

        $nth_term = new Nth_Term("1, 8, 27, 64, 125");
        $this->assertEquals(216, $nth_term->getNextTerm());

        $nth_term = new Nth_Term("9, 73, 241, 561, 1081, 1849");
        $this->assertEquals(2913, $nth_term->getNextTerm());

    }

    public function testGetNextTermArithmetic() {

        $nth_term = new Nth_Term("1, 2, 3, 4");
        $this->assertEquals(5, $nth_term->getNextTermArithmetic());

        $nth_term = new Nth_Term("10, 9, 8, 7");
        $this->assertEquals(6, $nth_term->getNextTermArithmetic());

        $nth_term = new Nth_Term("2, 4, 6, 8");
        $this->assertEquals(10, $nth_term->getNextTermArithmetic());

        $nth_term = new Nth_Term("5, 10, 15, 20");
        $this->assertEquals(25, $nth_term->getNextTermArithmetic());

        $nth_term = new Nth_Term("100, 200, 300, 400");
        $this->assertEquals(500, $nth_term->getNextTermArithmetic());

        $nth_term = new Nth_Term("101, 202, 303, 404");
        $this->assertEquals(505, $nth_term->getNextTermArithmetic());

    }

    public function testGetFormula() {

        $nth_term = new Nth_Term("1, 2, 3, 4");
        $nth_term->getNextTermArithmetic();
        $this->assertEquals("1 + (4) * 1", $nth_term->getFormula());

        $nth_term = new Nth_Term("1, 8, 27, 64, 125");
        $nth_term->getNextTerm();
        $difference_table = "7 19 37 61 \n12 18 24 \n6 6 \n\n----\n\n6 + 24 + 61 + 125 = 216";
        $this->assertEquals($difference_table, $nth_term->getFormula());

    }

}