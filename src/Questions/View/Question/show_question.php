<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <h3>Category:</h3> <?php echo $question['name']?>
                    <h3>Question:</h3> <?php echo $question['question_text']?>
                    <h3>Answer:</h3> <?php if(isset($question['answer_text'])) echo $question['answer_text'];
                        else{?>No answer<?php } ?>
                    <p class="post-meta">Asked on <?php echo $question['date']?></p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</article>
