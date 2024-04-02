<?php

namespace App;
use Error;

class PatternRouter
{
    public function route(string $uri): void
    {
        $uriWithoutQueryParameters = $this->stripQueryParameters($uri);

        $uriSegments = explode('/', $uriWithoutQueryParameters);
        $baseSegment = $uriSegments[0] === '' ? 'home' : $uriSegments[0];
       
        $controllerNamespace = "App\\Controllers\\";

        $controllerName = $controllerNamespace . ucfirst($uriSegments[0] ?: 'home') . 'Controller';
        $methodName = $uriSegments[1] ?? 'index';

        if (!class_exists($controllerName)){
            http_response_code(404);
            return;
        }

        try {
            $controllerInstance = new $controllerName();
            $controllerInstance->$methodName();
        } catch (Exception) {
            http_response_code(500);
        }
    }

    private function stripQueryParameters(string $uri): string
    {
        return str_contains($uri, '?') ? substr($uri, 0, strpos($uri, '?')) : $uri;
    }
}