<?php

namespace Security\BrokenAccessControl\Http\MIddleware;

use Security\BrokenAccessControl\Http\Request;

class RequestHandler implements RequestHandlerInterface
{
    private array $middleware = [];

    public function __construct(array $middlewares = []) {
        $this->middleware = array_merge($this->middleware, $middlewares);
    }

    public function handle(Request &$request): void
    {
        if(empty($this->middleware)) {
            return;
        }

        $middlewareClass = array_shift($this->middleware);

        (new $middlewareClass())->process($request, $this);
    }
}