<?php

namespace Vendor;

class Response
{
    protected static $messages = [
        // Information 1xx
        100 => 'Continue',
        101 => 'Switching Protocols',
        // Success 2xx
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        // Redirect 3xx
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found', // 1.1
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        // Client errors 4xx
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Request Entity Too Large',
        414 => 'Request-URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Requested Range Not Satisfiable',
        417 => 'Expectation Failed',
        423 => 'Locked',
        429 => 'Too Many Requests',
        // Server errors 5xx
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',
        507 => 'Insufficient Storage',
        508 => 'Loop Detected',
        509 => 'Bandwidth Limit Exceeded'
    ];

    protected $headers = array();

    protected $body = '';

    protected $status;

    public function __construct($body = '', $status = 200)
    {
        $this->setBody($body);
        $this->setStatus($status);
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function setHeaders(array $header)
    {
        $this->headers = array_merge($this->headers, $header);
        return $this;
    }

    public function sendHeaders()
    {
        $status_line = 'HTTP/1.1 ' . $this->status . ' ' . self::$messages[$this->status];
        header($status_line, true, $this->status);
        foreach ($this->headers as $name => $value) {
            header($name . ':' . $value);
        }
        return $this;
    }

    public function send()
    {
        if (0 != count($this->headers)) {
            $this->sendHeaders();
        }
        echo $this->body;
    }
}