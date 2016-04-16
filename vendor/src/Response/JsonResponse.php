<?php
/**
 * Created by PhpStorm.
 * User: ihor
 * Date: 14.04.16
 * Time: 5:10
 */

namespace Vendor\Response;


class JsonResponse extends Response implements ResponseInterface
{

    public function send()
    {
       return json_encode(parent::send());
    }
}