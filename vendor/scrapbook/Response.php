<?php
namespace Scrapbook\Core;

class Response
{
    private string $body;

    public function __construct(string $body = '')
    {
        $this->body = $body;
    }

    public function setStatusCode(int $code): Response | null
    {
        http_response_code($code);

        return $this;
    }

    public function addHeader(string $header): Response | null
    {
        header($header);

        return $this;
    }

    public function send(string $body = null): void
    {
        if($body)
        {
            $this->setBody($body);
        }

        echo $this->body;
    }

    public function setBody(string $body): Response | null
    {
        $this->body = $body;

        return $this;
    }
}