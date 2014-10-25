<div class="panel panel-success">
    <div class="panel-heading">
        Response(s):
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