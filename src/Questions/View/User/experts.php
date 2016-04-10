<h1>Experts in <?php echo $cat?></h1>
<?php if($experts){
    foreach($experts as $expert):?>
        <h3 class="post-title">
            <a href="experts/<?php echo $expert['id']?>"><?php echo $expert['name']?></a>
        </h3>
            <img src="<?php echo $expert['photo']?>" height="300" width="250">
            <h5>Rating: <?php echo $expert['rating']?></h5>
    <?php endforeach;
} else {?>
    <h1>No experts in this category</h1>
<?php } ?>

