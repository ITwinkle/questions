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
        <div id="search_experts" class="hidden">
            <div id="name"></div>
            <div id="photo"></div>
            <div id="desc"></div>
            <div id="answers"></div>
            <div id="rating"></div>
        </div>
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
            $.post('/search/'+$(this).val(),{'cat' : cat }).done(function(data){
                $.each( data, function( key, value ) {
                    $.each(value, function(k,v){
                       console.log(k + '  :  '+ v);
                        $('#experts').hide();
                        $('#name').append(v);
                        $('#search_experts').removeClass('hidden');
                    });
                });
            });
        });
//                        $('#value').css('border','solid 2px black');
//                        $('#value').append('<a href="/'+value.cat+'/experts/'+value.id+'"><ul>'+value.name+'</ul></a><br>');
    });
</script>