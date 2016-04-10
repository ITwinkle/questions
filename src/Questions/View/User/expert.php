<h2>Rating: <?php echo $expert['rating']?></h2>
<h2>Answers: <?php echo $expert['col_answers']?></h2>
<img src="<?php echo $expert['photo']?>" height="300" width="250">
<h1>My name is <?php echo $expert['name']?>!</h1>
<h1><?php echo $expert['desc']?></h1>
<h1>You may connect with me with this email <?php echo $expert['email']?></h1>
<button id="click" type="button">Ask me anything</button>

<script>
    jQuery( document ).ready(function(){
        jQuery("#click").click(function(){
            jQuery.colorbox({href:"/<?php echo $cat?>/experts/<?php echo $expert['id']?>/ask", title: "Ask me!", innerWidth: 500, innerHeight: 500, scrolling: true, opacity: '0.8',maxWidth: '95%'});
        });
    });
</script>