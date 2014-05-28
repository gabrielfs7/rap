<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>RAP - Rest API for PHP</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="<?php echo GSoares\RAP\Document\Documentor::getConfig(GSoares\RAP\Document\Documentor::BOOTSTRAP_CSS_URL); ?>" rel="stylesheet">
<link href="<?php echo GSoares\RAP\Document\Documentor::getConfig(GSoares\RAP\Document\Documentor::BOOTSTRAP_RESPONSIVE_CSS_URL); ?>" rel="stylesheet">
<script src="<?php echo GSoares\RAP\Document\Documentor::getConfig(GSoares\RAP\Document\Documentor::JQUERY_URL); ?>"></script>
<script src="<?php echo GSoares\RAP\Document\Documentor::getConfig(GSoares\RAP\Document\Documentor::BOOTSTRAP_JAVASCRIPT_URL); ?>"></script>
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
        <div class="span4 bs-docs-sidebar">
            <ul class="nav nav-list bs-docs-sidenav">
            <?php foreach ($classesDoc as $class) { ?>
                <li>
                    <strong><?php echo $class->getPresentation(); ?></strong>
                </li>
                <?php foreach ($class->getResources() as $resource) { ?>
                <li>
                    <a href="#method<?php echo $resource->getUri(); ?>">
                        <?php echo $resource->getMethod() . ' ' . $resource->getUri(); ?>
                    </a>
                </li>
                <?php } ?>
            <?php } ?>
            </ul>
    </div>
    <div class="span8">
      <!--Body content-->
        <?php foreach ($classesDoc as $class) { ?>
        <h2><?php echo $class->getPresentation(); ?></h2>
        <br/>
            <?php foreach ($class->getResources() as $resource) { ?>
            <h3 id="method<?php echo $resource->getUri(); ?>">
                <?php echo $resource->getMethod() . ' ' . $resource->getUri(); ?>
            </h3>
            <div class="alert alert-info"><?php echo $resource->getHelp(); ?></div>

            <?php if (count($resource->getParams())) { ?>
            <h4>
                REQUEST PARAMETER(S) FOR :
                <?php echo $resource->getMethod() . ' ' . $resource->getUri(); ?>
            </h4>
            <div class="well">
            <?php foreach ($resource->getParams() as $param) { ?>
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
            <?php } ?>

            <p>Request Example:</p>
            <pre><?php echo $resource->getSample(); ?></pre>

            <br/>
            <h4>
                RESPONSE(S) FOR
                <?php echo $resource->getMethod() . ' ' . $resource->getUri(); ?>
            </h4>
            <?php foreach ($resource->getResponses() as $response) { ?>
            <p><?php echo $response->getHelp(); ?></p>
            <ul>
                <li>STATUS CODE: <?php echo $response->getStatus(); ?></li>
                <li>RETURN SAMPLE:</li>
            </ul>
            <pre><?php echo $response->getSample(); ?></pre>
            <hr/>
            <?php } ?>
        <?php } ?>
    <?php } ?>
        </div>
    </div>
</div>
</body>
</html>