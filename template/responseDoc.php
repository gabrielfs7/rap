RESPONSE(S) FOR <?php echo $resource->getMethod() . ' ' . $resource->getUri(); ?>
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