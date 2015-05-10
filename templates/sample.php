<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $sitename; ?></title>
    </head>
    <body>

        <h1><?php echo $sitename; ?></h1>

        <ul id="navigation"> 
        <?php foreach ($navigation as $item) { ?> 
        	<li><a href="<?php echo $item['url']; ?>"><?php echo $item['caption']; ?></a></li> 
        <?php } ?> 
        </ul>

        <h2>Products</h2>
        
        <?php foreach ($products as $item) { ?> 
        <div>
            <h3><?php echo $item['name']; ?></h3>
            <p>{<?php echo $item['description']; ?></p>
            <p><?php echo $item['price']; ?></p>
        </div>
        <?php } ?> 
        
    </body>
</html>