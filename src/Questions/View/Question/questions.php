<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="post-preview">
                    <h2 class="post-title">
                    </h2>
                <h3 class="post-subtitle">
                </h3>
                    <?php foreach($questions as $question):?>
                        <h4><?php echo $question['name']?></h4>
                        <h4><?php echo $question['question_text']?></h4>
                        <h4>
                            <?php if(!empty($question['answer'])) {echo $question['answer'];
                        } else {?>
                            There is still no answer to the question<?php }?>
                        </h4>
                        <p class="post-meta">Asked on <?php echo $question['date']?></p>
                        <hr>
                    <?php endforeach;?>
            </div>
            <hr>
        </div>
    </div>
</div>