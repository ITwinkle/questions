<article>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <div class="post-preview">
                    <h2>Category: <?php echo $question['name']?></h2>
                    <h1>Question: <?php echo $question['question_text']?></h1>
                    <h3>Answer: <?php echo $question['answer']?></h3>
                    <p class="post-meta">Asked on <?php echo $question['date']?></p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</article>
