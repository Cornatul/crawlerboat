<?php

namespace UnixDevil\CrawlerBoat\Tests\Unit;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Mockery;

use UnixDevil\Crawler\Contracts\SentimentContract;
use UnixDevil\CrawlerBoat\Client\SentimentClient;
use UnixDevil\CrawlerBoat\DTO\SentimentDTO;
use UnixDevil\CrawlerBoat\Interfaces\CrawlerConfigInterface;
use UnixDevil\NewsBoat\Client\NewsBoat;
use UnixDevil\NewsBoat\Interfaces\AllNewsInterface;
use UnixDevil\NewsBoat\Interfaces\NewsConfigInterface;
class SentimentTest extends \UnixDevil\CrawlerBoat\Tests\TestCase
{

    /**
     * @throws \JsonException
     * @throws GuzzleException
     */
    public function testGetSentiment()
    {

        $sentiment= $this->getMockBuilder(SentimentDTO::class)
            ->getMock();
        $sentiment
            ->with([
                "title" => "test",
                "date" => "test",
                "text" => "test",
                "html" => "test",
                "summary" => "test",
                "authors" => [],
                "keywords" => [],
                "images" => [],
                "entities" => [],
                "sentiment" => []
            ]);

        //generate a test for the sentiment client
        $mock = $this->getMockBuilder(SentimentClient::class)
            ->setConstructorArgs([Mockery::mock(ClientInterface::class), Mockery::mock(CrawlerConfigInterface::class)])
            ->getMock();
        $mock->method('getSentiment')
            ->with('https://v1.nlpapi.org')
            ->willReturn($sentiment);

        $this->assertSame($sentiment, $mock->getSentiment('https://v1.nlpapi.org'));

    }

}
