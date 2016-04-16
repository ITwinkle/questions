<div align="center">
    <form id="form" action="/<?php echo $cat?>/experts/<?php echo $expert_id?>/ask" method="post">
        <h3 class="post-subtitle"><p>Question in category <b><?php echo $cat?></b></p></h3>
        <b>Enter your question</b>
        <textarea rows="10" cols="44" name="question" id="question" required minlength="50" "></textarea>
        <input type="submit" class="btn-success" value="Ask and sent to email" id="submit">
    </form>
</div>
<script>
       $('#form').submit(function(event){
           event.preventDefault();
           var form = $('#form'),
               url = form.attr('action'),
               question = $('#question').val();
           $.post(url,{question:question}).done(function(){
               var text = 'Thank you for question. Your message send successful';
               $('#form').text(text);
               window.setTimeout(function(){
                  parent.jQuery.colorbox.close();
               },3000);
           });
       });
</script>
