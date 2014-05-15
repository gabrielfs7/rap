<?php
include __DIR__ . '/../vendor/autoload.php';

use GSoares\EasyJsonDoc\Parser\AnnotationParser;
use GSoares\EasyJsonDoc\Parser\AnnotationInterface;
use GSoares\EasyJsonDoc\Map\Resource;
use GSoares\EasyJsonDoc\Map\Param;
use GSoares\EasyJsonDoc\Map\Response;
use GSoares\EasyJsonDoc\Serializer\JsonSerializer;
use GSoares\EasyJsonDoc\Serializer\JsonFormatter;

$classes = ['Sample\RestService'];

$parser = new AnnotationParser();
$serializer = new JsonSerializer();

echo '<pre>';

$out = '';

foreach ($classes as $class) {
    $reflectionClass = new ReflectionClass($class);

    $out .= '<h1>' . $class . '</h1>';

    foreach ($reflectionClass->getMethods() as $method) {
        if (strstr($method->getDocComment(), AnnotationInterface::RESOURCE)) {
            $vars = $parser->parse($method->getDocComment());

            $resource = null;
            $responses = [];
            $params = [];

            foreach ($vars as $var) {
                if ($var instanceof Resource) {
                    $resource = $var;
                }

                if ($var instanceof Param) {
                    $params[] = $var;
                }

                if ($var instanceof Response) {
                    $responses[] = $var;
                }
            }

            $out .= '<h2>URI: ' . $resource->getUri() . ' ' . $resource->getMethod() . '</h2>';

            $out .= '<p>' . $resource->getHelp() . '</p>';

            $out .= '<h3>REQUEST</h3>';

            foreach ($params as $param) {
                $out .= '<p>' . $param->getHelp() . '</p>';
                $out .= '<ul>';
                $out .= '<li>NAME: ' . $param->getName() . '</li>';
                $out .= '<li>EXAMPLE: ' . $param->getSample() . '</li>';
                $out .= '<li>TYPE: ' . $param->getType() . '</li>';
                $out .= '<li>Required: ' . $param->getRequired() . '</li>';
                $out .= '<li>Default: ' . $param->getDefault() . '</li>';
                $out .= '</ul>';
            }

            $out .= '<p>...</p>';

            $out .= '<h3>RESPONSE(s)</h3>';

            foreach ($responses as $response) {
                $out .= '<p>' . $response->getHelp() . '</p>';
                $out .= '<ul>';
                $out .= '<li>STATUS CODE: ' . $response->getStatus() . '</li>';

                $isArray = false;

                if (strstr($response->getReturn(), '[]')) {
                    $isArray = true;
                }

                $responseJson = $serializer->serialize(str_replace('[]', '', $response->getReturn()));

                if ($isArray) {
                    $responseJson = JsonFormatter::format([$responseJson]);
                } else {
                    $responseJson = JsonFormatter::format($responseJson);
                }

                $out .= '<li>RETURN SAMPLE: <br/>' . $responseJson . '</li>';
                $out .= '</ul>';
            }
        }
    }
}

echo $out;
