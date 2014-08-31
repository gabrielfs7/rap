<div class="panel panel-default">
    <div class="panel-heading">
        Response(s) for <?php echo $resource->getMethod() . ' ' . $resource->getUri(); ?>
    </div>
    <div class="panel-body">
        <?php foreach ($resource->getResponses() as $response) { ?>
            <p>
                <strong>
                    <?php echo $response->getHelp(); ?>
                </strong>
            </p>
            <ul>
                <li>STATUS CODE: <?php echo $response->getStatus(); ?></li>
                <li>RETURN SAMPLE:</li>
            </ul>
            <pre><?php echo $response->getSample(); ?></pre>
        <?php } ?>
    </div>
</div>