<?php
/**
 * Created by PhpStorm.
 * User: mkruege
 * Date: 12.10.17
 * Time: 14:36
 */

namespace Tests\Traits;


use App\Readers\FeedReader;
use Zend\Feed\Reader\Feed\AbstractFeed;

/**
 * Trait FeedReaderMock
 *
 * @package Tests\Traits
 */
trait FeedReaderMock
{

    /**
     * @var
     */
    protected $feedReaderMock;
    protected $httpClientMock;

//    public function createApplication()
//    {
//        $app = parent::createApplication();
//
//        $this->feedReaderMock = \Mockery::mock(Reader::class);
//        $this->httpClientMock = \Mockery::mock(Client::class);
//
//        $app->instance(FeedServiceProvider::FEED_READER, $this->feedReaderMock);
//        $app->instance(FeedServiceProvider::FEED_READER_HTTP_CLIENT, $this->httpClientMock);
//
//        return $app;
//    }

//    /**
//     *
//     */
//    public function setup()
//    {
//        parent::setup();
//    }


    /**
     *
     */
    public function mockFeedReader()
    {
        $abstractFeedMock = \Mockery::mock(AbstractFeed::class);
        $feedReaderMock = \Mockery::mock(FeedReader::class);
        $feedReaderMock->shouldReceive('read')
                       ->andReturn($abstractFeedMock);
        $feedReaderMock->shouldReceive('getEtag')
                       ->andReturn(str_random(52));
        $feedReaderMock->shouldReceive('getLastModified')
                       ->andReturn(null);
        $abstractFeedMock->shouldIgnoreMissing();
        $abstractFeedMock->shouldReceive('getId')
                         ->andReturnUsing(function () {
                             return str_random(52);
                         });
        $abstractFeedMock->shouldReceive('getTitle')
                         ->andReturn('Feed Title');
        $abstractFeedMock->shouldReceive('getDescription')
                         ->andReturn('Feed Description');
        $abstractFeedMock->shouldReceive('getLink')
                         ->andReturn('http://example.com');
        $abstractFeedMock->shouldReceive('getFeedLink')
                         ->andReturn('http://example.com/feed.rss');
        $abstractFeedMock->shouldReceive('getLanguage')
                         ->andReturn('en');
        $abstractFeedMock->shouldReceive('getLogo')
                         ->andReturn('http://example.com/logo.png');
        $abstractFeedMock->shouldReceive('getIcon')
                         ->andReturn('http://example.com/favicon.ico');
        app()->bind(FeedReader::class, function () use ($feedReaderMock) {
            return $feedReaderMock;
        });
    }
}
