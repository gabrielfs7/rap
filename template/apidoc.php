<?php
use GSoares\RAP\Parser\AnnotationParser;
use GSoares\RAP\Parser\AnnotationInterface;
use GSoares\RAP\Map\Resource;
use GSoares\RAP\Map\Param;
use GSoares\RAP\Map\Response;
use GSoares\RAP\Serializer\JsonSerializer;
use GSoares\RAP\Serializer\JsonFormatter;
use GSoares\RAP\Document\Documentor;

$parser = new AnnotationParser();
$serializer = new JsonSerializer();
$classes = [];
$i = 0;

foreach (Documentor::getClasses() as $class) {
    $classes[$class] = [];

    foreach ((new ReflectionClass($class))->getMethods() as $method) {
        if (strstr($method->getDocComment(), AnnotationInterface::RESOURCE)) {
            $data = [
                'resource' => null,
                'responses' => [],
                'params' => [],
            ];

            foreach ($parser->parse($method->getDocComment()) as $var) {
                if ($var instanceof Resource) {
                    $data['resource'] = $var;
                }

                if ($var instanceof Param) {
                    $data['params'][] = $var;
                }

                if ($var instanceof Response) {
                    $data['responses'][] = $var;
                }
            }

            $classes[$class][$i++] = $data;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>RAP - Rest API for PHP</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo Documentor::getConfig(Documentor::BOOTSTRAP_CSS_URL); ?>" rel="stylesheet">
<link href="<?php echo Documentor::getConfig(Documentor::BOOTSTRAP_RESPONSIVE_CSS_URL); ?>" rel="stylesheet">
<script src="<?php echo Documentor::getConfig(Documentor::JQUERY_URL); ?>"></script>
<script src="<?php echo Documentor::getConfig(Documentor::BOOTSTRAP_JAVASCRIPT_URL); ?>"></script>
</head>
<body data-spy="scroll" data-target=".bs-docs-sidebar">
<div class="hero-unit" style="padding: 20px 30px">
    <h1>RAP! </h1>
    <p>
        <strong>R</strong>est <strong>A</strong>pi For <strong>P</strong>HP
    </p>
</div>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span2 bs-docs-sidebar">
            <?php foreach ($classes as $class => $methods) { ?>
            <ul class="nav nav-list bs-docs-sidenav affix">
                <li>
                    <strong><?php echo $class; ?></strong>
                </li>
                <?php foreach ($methods as $key => $method) { ?>
                <li>
                    <a href="#method<?php echo $key; ?>">
                        (<?php echo $method['resource']->getMethod(); ?>) <?php echo $method['resource']->getUri(); ?>
                    </a>
                </li>
                <?php } ?>
            </ul>
            <?php } ?>
        </div>
    <div class="span10">
      <!--Body content-->
        <?php foreach ($classes as $class => $methods) { ?>
        <h2><?php echo $class; ?></h2>
        <br/>
            <?php foreach ($methods as $key => $method) { ?>
            <h3 id="method<?php echo $key; ?>">
                <?php echo $method['resource']->getUri() . ' ' . $method['resource']->getMethod(); ?>
            </h3>
            <div class="alert alert-info"><?php echo $method['resource']->getHelp(); ?></div>
            <h4>
                REQUEST PARAMETER(S) FOR :
                <?php echo $method['resource']->getUri() . ' ' . $method['resource']->getMethod(); ?>
            </h4>

            <div class="well">
            <?php
            $requestExample = [];

            foreach ($method['params'] as $param) {
                $paramValue = null;

                if ($param->isPrimitive()) {
                    $paramValue = $serializer->serialize($param);
                }

                if ($param->isClass()) {
                    $paramValue = (object) [$param->getName() => $serializer->serialize($param)];
                }

                $requestExample = array_merge($requestExample, (array) $paramValue);
                ?>
                <p><?php echo $param->getHelp(); ?></p>
                <ul>
                    <li>NAME: <?php echo $param->getName(); ?></li>
                    <li>TYPE: <?php echo $param->isClass() ? 'Object' : $param->getType(); ?></li>
                    <li>REQUIRED: <?php echo ($param->getRequired() ? 'yes' : 'no'); ?></li>
                    <?php if ($param->getSample()) { ?>
                    <li>EXAMPLE: <?php echo $param->getSample(); ?></li>
                    <?php } ?>
                    <?php if ($param->getDefault()) { ?>
                    <li>DEFAULT: <?php echo $param->getDefault(); ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
            </div>

            <p>Request Example:</p>
            <pre><?php echo JsonFormatter::format(json_encode((object) $requestExample)); ?></pre>

            <br/>
            <h4>
                RESPONSE(S) FOR
                <?php echo $method['resource']->getUri() . ' ' . $method['resource']->getMethod(); ?>
            </h4>
            <?php foreach ($method['responses'] as $response) { ?>
            <p><?php echo $response->getHelp(); ?></p>
            <ul>
                <li>STATUS CODE: <?php echo $response->getStatus(); ?></li>
                <?php
                $responseExample = [];

                foreach ($response->getParams() as $param) {
                    $responseExample = array_merge($responseExample, (array) $serializer->serialize($param));
                }

                ?>
                <li>RETURN SAMPLE:</li>
            </ul>
            <pre><?php echo JsonFormatter::format(json_encode($responseExample)); ?></pre>
            <hr/>
            <?php } ?>
        <?php } ?>
    <?php } ?>
        </div>
    </div>
</div>
</body>
</html>