<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <h4>Category: <?php echo $question['name']?></h4>
                    <h4>Question: <?php echo $question['question_text']?></h4>
                    <h5>Answer: <?php echo $question['answer']?></h5>
                    <p class="post-meta">Asked on <?php echo $question['date']?></p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</article>
