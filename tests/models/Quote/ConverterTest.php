<?php

namespace Test\Model\Quote;

use App\Model\Quote;

class ConverterTest extends \PHPUnit_Framework_TestCase
{

    public function testConvertsQuoteToOrderUsingConverters()
    {
        $quote = new Quote;
        $order =  new \App\Model\Order;

        $partConverter = $this->getMock('\App\Model\Quote\IConverter', ['toOrder']);
        $partConverter->expects($this->once())
            ->method('toOrder')
            ->with($this->equalTo($quote), $this->equalTo($order));

        $converterFactory = $this->getMock('\App\Model\Quote\ConverterFactory', ['getConverters']);

        $converterFactory->expects($this->once())
            ->method('getConverters')
            ->will($this->returnValue([$partConverter]));

        $converter = new \App\Model\Quote\Converter($converterFactory);

        $converter->toOrder($quote, $order);
    }
}
 