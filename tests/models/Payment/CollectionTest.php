<?php
namespace Test\Model\Payment;

class Collection extends \PHPUnit_Framework_TestCase
{

    public function testIsIterable()
    {
        $expected = [
            $this->getMock('\App\Model\Payment\IMethod'),
            $this->getMock('\App\Model\Payment\IMethod'),
        ];
        $collection = new \App\Model\Payment\Collection();
        $collection->addPayment($expected[0]);
        $collection->addPayment($expected[1]);

        $iterated = false;
        foreach ($collection as $_key => $_payment) {
            $this->assertSame($expected[$_key], $_payment);
            $iterated = true;
        }

        if (!$iterated) {
            $this->fail('Iteration did not happen');
        }
    }
}
 