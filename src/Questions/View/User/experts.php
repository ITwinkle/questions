<div class="row">
    <div class="col-lg-9 scrollit"><h1>Experts in <?php echo $cat?></h1>
    <?php if($experts){
        foreach($experts as $expert):?>
            <h3 class="post-title">
                <a href="experts/<?php echo $expert['id']?>"><?php echo $expert['name']?></a>
            </h3>
                <img src="<?php echo $expert['photo']?>" height="300" width="250">
                <h5>Rating: <?php echo $expert['rating']/$expert['col_answers']?></h5>
            <hr>
        <?php endforeach;
    } else {?>
        <h1>No experts in this category</h1>
    <?php } ?>
    </div>
    <div class="col-lg-2 fixed" >
        <div class="text-right" style="margin-right: 20px">Search in all categories <input type="search" id="search"></div>
        <div  id="value" class="text-right pull-right table-bordered" style="margin-right: 20px"></div>
    </div>
    </div>
<script>
    $(document).ready(function(){
        $('#search').on('input',function(e){
            $.post('/search/'+$(this).val()).done(function(data){
                data = JSON.parse(data);
                $('#value').empty();
                var id = [];
                var name = [];
                $.each( data, function( key, value ) {
                    $('#value').css('border','solid 2px black');
                    $('#value').append('<a href="/'+value.cat+'/experts/'+value.id+'">'+value.name+'</a><br>');
                });
            });
        });
        $(document).click(function(){
            $('#value').empty();
            $('#value').css('border','none');
        });
    });
</script>