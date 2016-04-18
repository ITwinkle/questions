<?php

/**
 * Json Response class
 *
 * @package    vendor
 * @version    1.0
 * @author     Ihor Anishchenko <ianischenko@mindk.com>
 * @copyright  2016 - 2017 Ihor Anischenko
 */

namespace Vendor\Response;


class JsonResponse extends Response
{
    /**
     * JsonResponse constructor.
     * @param string $body
     * @param int $status
     */
    public function __construct($body = '', $status = 200)
    {
        parent::__construct($body, $status);
        $this->setHeaders(array('Content-Type' => 'application/json'));
        if ('' != $body) {
            $this->body = json_encode($body);
        }
    }
}