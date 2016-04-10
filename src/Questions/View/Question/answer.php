<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <?php if(isset($question) && empty($question['answer'])){?>
                            <p><h2>Author</h2><?php echo $question['email']?></p>
                            <p><h1>Category</h1> <?php echo $question['name']?></p>
                            <h1>Question</h1> <?php echo $question['question_text']?>
                            <form action="/answer/<?php echo $hash;?>" method="post">
                                <p><h1>Answer</h1> <textarea name="answer" required></textarea></p>
                                <input type="hidden" name="id" value="<?php echo $question['id']?>">
                                <input type="hidden" name="email" value="<?php echo $question['email']?>">
                                <input type="hidden" name="expert_id" value="<?php echo $question['expert_id']?>">
                                <input type="submit" value="Send answer" id="submit">
                            </form>
                    <?php } else { header('location: /'); } ?>
                </div>
            </div>
        </div>
    </div>
</article>
