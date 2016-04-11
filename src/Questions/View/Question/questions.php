<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="post-preview">
                <?php foreach($questions as $question):?>
                    <a href="/questions/<?php echo $question['id']?>">
                        <h4><?php echo $question['name']?></h4>
                        <div style="overflow: hide;"><h2 class="post-title"><?php echo $question['question_text']?></h2></div>
                    </a>
                    <h4><?php if(!empty($question['answer'])) {echo $question['answer'];?></h4>
                    <?php } else {?>
                        There is still no answer to the question
                    <?php }?>

                    <p class="post-meta">Asked on <?php echo $question['date']?></p>
                    <hr>
                <?php endforeach;?>
            </div>
            <hr>
        </div>
        <?php $i=0;?>
        <div class="col-lg-2 fixed" >
            <div class="text-right">
                <h1>Top</h1>
                <?php foreach($top as $t):?>
                    <h4><?php echo ++$i.'. '. $t['name']?></h4>
                    <img src="<?php echo $t['photo']?>" height="80" width="70">
                    <h4><?php echo $t['rat']?></h4>
                    <br><br>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>

