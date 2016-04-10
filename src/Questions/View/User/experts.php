<div class="text-right" style="margin-right: 20px">Search in all categories <input type="search" id="search"></div>
<div  id="value" class="text-right pull-right" style="margin-right: 20px"></div>
<h1>Experts in <?php echo $cat?></h1>

<?php if($experts){
    foreach($experts as $expert):?>
        <h3 class="post-title">
            <a href="experts/<?php echo $expert['id']?>"><?php echo $expert['name']?></a>
        </h3>
            <img src="<?php echo $expert['photo']?>" height="300" width="250">
            <h5>Rating: <?php echo $expert['rating']?></h5>
        <hr>
    <?php endforeach;
} else {?>
    <h1>No experts in this category</h1>
<?php } ?>

<script>
    $(document).ready(function(){
        $('#search').on('input',function(e){
            $.post('/search/'+$(this).val()).done(function(data){
                data = JSON.parse(data);
                $('#value').empty();
                var id = [];
                var name = [];
                $.each( data, function( key, value ) {
                    $('#value').append('<a href="/'+value.cat+'/experts/'+value.id+'">'+value.name+'</a><br>');
                });
            });
        });
        $('#search').click(function(){
            $('#value').empty();
        });
    });
</script>