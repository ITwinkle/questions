<div class="row">
    <div class="col-lg-9 scrollit"><h1>Experts in <?php echo $cat?></h1>
        <div id="experts"><?php if($experts){
            foreach($experts as $expert):?>
                <div class="post-title">
                   <?php echo $expert['name']?>
                </div>
                <img src="<?php echo $expert['photo']?>" height="300" width="250">
                <div><?php echo $expert['desc']?></div>
                <div>Answers: <?php echo $count[$expert['id']]?></div>
                <div>Rating: <?php echo $rating[$expert['id']]?></div>
                <button id="click" expert="<?php echo $expert['id']?>" class="btn-success" type="button">Ask me anything</button>
                <hr>
            <?php endforeach;
        } else {?>
            <h1>No experts in this category</h1>
        <?php } ?>
        </div>
        <div id="search_experts" class="hidden"></div>
    </div>
    <div class="col-lg-3 fixed" >
        <div class="text-right" style="margin-right: 20px">Search in all categories <input type="search" id="search"></div>
    </div>
</div>

<script>
    jQuery( document ).ready(function(){
        jQuery(".btn-success").click(function(){
            var expert = jQuery(this).attr('expert');
            jQuery.colorbox({href:"/<?php echo $cat?>/experts/"+expert+"/ask", title: "Ask me!", innerWidth: 500, innerHeight: 500, scrolling: true, opacity: '0.8',maxWidth: '95%'});
        });
    });
</script>

<script>
    $(document).ready(function(){
        $('#search').on('input',function(e){
            var cat = '<?php echo $cat?>';
            if($(this).val().length != 0) {
                $.post('/search/' + $(this).val(), {'cat': cat}).done(function (data) {
                    $.each(data, function (key, value) {
                        $('#search_experts').empty();
                        $('#experts').hide();
                        var expName = document.createElement('div');
                        expName.innerHTML = value.name;

                        var expImg = document.createElement('img');
                        expImg.src = value.photo;
                        expImg.setAttribute('height', '300');
                        expImg.setAttribute('width', '250');

                        var expDesc = document.createElement('div');
                        expDesc.innerHTML = value.desc;

                        var expRating = document.createElement('div');
                        expRating.innerHTML = 'Rating: ' + value.rating;

                        var expAnsw = document.createElement('div');
                        expAnsw.innerHTML = 'Answers: ' + value.col_answers;

                        var expButton = document.createElement('button');
                        expButton.id = 'click';
                        expButton.type = 'button';
                        expButton.setAttribute('class', 'btn-success');
                        expButton.setAttribute('expert', value.id);
                        expButton.innerHTML = 'Ask me anything';

                        $('#search_experts').append(expName);
                        $('#search_experts').append(expImg);
                        $('#search_experts').append(expDesc);
                        $('#search_experts').append(expAnsw);
                        $('#search_experts').append(expRating);
                        $('#search_experts').append(expButton);
                        $('#search_experts').append('<hr>')

                        $('#search_experts').removeClass('hidden');
                        jQuery(".btn-success").click(function(){
                            var expert = jQuery(this).attr('expert');
                            jQuery.colorbox({href:"/<?php echo $cat?>/experts/"+expert+"/ask", title: "Ask me!", innerWidth: 500, innerHeight: 500, scrolling: true, opacity: '0.8',maxWidth: '95%'});
                        });
                    });
                });
            } else {
                $('#search_experts').empty();
                $('#experts').show();
            }
        });
    });
</script>