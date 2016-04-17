<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <div class="post-preview" style="border: 1px solid #000;">
                <?php foreach($questions as $question):?>
                    <a href="/questions/<?php echo $question['id']?>">
                        <h4><?php echo $question['name']?></h4>
                        <div style="overflow: hide;"><h4 class="post-title">Question: </h4></div>
                        <?php echo $question['question_text']?>
                    </a>
                    <h5>Answer: </h5>
                    <?php if(!empty($question['answer_text'])) {echo $question['answer_text'];?>
                        <div><input value="<?php echo $question['rating']?>" id="<?php echo $question['answer_id']?>" type="hidden" class="rating"/></div>
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
                    <p >Rating: <?php echo $t['rating']?></p>
                    <br><br>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('input').on('change', function () {
            $(this).attr('disabled','disabled');
            var rating = $(this).val();
            var answer_id = $(this).attr('id');
            var url = '/score';

            $.post(url,{id: answer_id, rat: rating }).done(function(){

            });
        });
    });

</script>