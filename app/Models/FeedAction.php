<?php


namespace App\Models;


use CloudCreativity\JsonApi\Document\Error;
use CloudCreativity\JsonApi\Exceptions\ValidationException;
use Neomerx\JsonApi\Exceptions\ErrorCollection;
use PicoFeed\Client\InvalidUrlException;
use PicoFeed\Reader\Reader;


/**
 * Class FeedAction
 *
 * @package App\Models
 */
class FeedAction
{
    /**
     * @var array*
     */
    public $result = [];
    /**
     * @var array
     */
    protected $params = [];


    /**
     * @return $this
     */
    public function discover()
    {
        try {
            $reader = new Reader;
            $resource = $reader->download($this->params['url']);

            $feeds = $reader->find($resource->getUrl(), $resource->getContent());

            $this->result['feeds'] = $feeds;
        } catch (InvalidUrlException $e) {
            $errors = new ErrorCollection();
            $error = new Error(null, null, null, null, $e->getMessage(), null, ['params' => 'url']);
            $errors->add($error);
            throw new ValidationException($errors);
        }

        return $this;
    }

    /**
     * @return array
     */
    public function result()
    {
        return $this->result;
    }

    /**
     * @param $params
     */
    public function setParams($params)
    {
        $this->params = array_dot($params);
    }

}
