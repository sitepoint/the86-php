<?php

namespace The86\Command;

abstract class AbstractCommand extends \Guzzle\Service\Command\AbstractCommand
{
    /**
     * TODO: patch Guzzle AbstractCommand with pluggable JSON decoder.
     */
    protected function process()
    {
        parent::process();
        $this->result = $this->arrayToObject($this->result);
    }

    /**
     * Recursively map a nested associative array (decoded from JSON)
     * to a nested object with stdClass for key/value structures, and array for 
     * numeric indexed lists.
     */
    private function arrayToObject($array)
    {
        if (is_array($array)) {

            if ($this->isAssoc($array)) {
                $node = new \StdClass();
                foreach ($array as $key => $value) {
                    $node->$key = $this->arrayToObject($value);
                }
            } else {
                $node = array_map(array($this, 'arrayToObject'), $array);
            }

        } else {
            $node = $array;
        }

        return $node;
    }

    /**
     * Determines if an array is associative.
     * Taken from Guzzle\Parser\UriTemplate\UriTemplate.
     *
     * @param array $array Array to check
     *
     * @return bool
     */
    private function isAssoc(array $array)
    {
        return (bool) count(array_filter(array_keys($array), 'is_string'));
    }

    /**
     * Wrapper for creating json encoded post response. Automatically encode the
     * body and set Content-Type header
     *
     * @param string|array                       $uri      Resource URI
     * @param array|Collection|string|EntityBody $postBody POST body. Can be a string, EntityBody,
     *                                                     or associative array of POST fields to
     *                                                     send in the body of the request.  Prefix
     *                                                     a value in the array with the @ symbol
     *                                                     reference a file.
     *
     * @return EntityEnclosingRequest
     */

    protected function postJson($uri = null, $postBody = null)
    {
        return $this->client->post(
            $uri,
            array('application/json; charset=utf-8'),
            json_encode($postBody)
        );
    }
}
