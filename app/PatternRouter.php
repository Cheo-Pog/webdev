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
        $isApi = $baseSegment === 'api';
       
        $isApi ? $controllerNamespace = 'App\\Api\\Controllers\\' : $controllerNamespace = 'App\\Controllers\\';
        $isApi ? $controllerName = $controllerNamespace . ucfirst($uriSegments[1]) . 'Controller' : $controllerName = $controllerNamespace . ucfirst($baseSegment) . 'Controller';
        $isApi ? $methodName = $uriSegments[2] ?? 'index' : $methodName = $uriSegments[1] ?? 'index';

        if (!class_exists($controllerName)){
            http_response_code(404);
            return;
        }

        try {
            $controllerInstance = new $controllerName();
            $controllerInstance->$methodName(isset($uriSegments[3]) ? $uriSegments[3] : null);

        } catch (Exception) {
            http_response_code(500);
        }
    }

    private function stripQueryParameters(string $uri): string
    {
        return str_contains($uri, '?') ? substr($uri, 0, strpos($uri, '?')) : $uri;
    }
}