<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="post-preview">
                    <?php foreach($questions as $question):?>
                    <a href="/questions/<?php echo $question['id']?>">
                        <h4><?php echo $question['name']?></h4>
                        <h2 class="post-title"><?php echo $question['question_text']?></h2>
                        <h4><?php if(!empty($question['answer'])) {echo $question['answer'];?></h4>
                            <?php } else {?>
                            There is still no answer to the question
                        <?php }?>
                        <p class="post-meta">Asked on <?php echo $question['date']?></p>
                    </a>
                        <hr>
                    <?php endforeach;?>
            </div>
            <hr>
        </div>
    </div>
</div>