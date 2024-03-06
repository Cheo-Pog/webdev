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
        $isApiRoute = $baseSegment === 'api';
        $isAdminRoute = $baseSegment === 'admin';

        if (($isApiRoute || $isAdminRoute) && empty($uriSegments[1])) {
            http_response_code(404);
            return;
        }

        $controllerNamespace = match ($baseSegment) {
            'admin' => "App\\Controllers\\admin\\",
            'api' => "App\\Api\\Controllers\\",
            default => "App\\Controllers\\",
        };

        $controllerName = $controllerNamespace . ucfirst($uriSegments[$isApiRoute || $isAdminRoute ? 1 : 0] ?: 'home') . 'Controller';
        $methodName = $uriSegments[$isApiRoute || $isAdminRoute ? 2 : 1] ?? 'index';

        if (!class_exists($controllerName) || !method_exists($controllerName, $methodName)) {
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