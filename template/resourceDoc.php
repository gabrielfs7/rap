<h2 id="resource<?php echo $class->getPresentation(); ?>"><?php echo $class->getPresentation(); ?></h2>
<?php foreach ($class->getResources() as $resource) { ?>
<h3 id="method<?php echo $resource->getUri(); ?>">
    <?php echo $resource->getMethod() . ' ' . $resource->getUri(); ?>
</h3>
<div class="alert alert-info"><?php echo $resource->getHelp(); ?></div>
<?php include __DIR__. '/requestDoc.php'; ?>
<br/>
<h4>
<?php include __DIR__. '/responseDoc.php'; ?>
<?php } ?>