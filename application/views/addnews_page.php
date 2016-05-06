<script type="text/javascript">
    $(document).ready(function(){
    $.ajaxSetup({ 
        cache: false 
    });
    // $("#addnews").submit(function(e) {
    $(document).on("submit", "form", function(event){
        event.preventDefault();
            
        var formElement = document.querySelector("form");
        var formData = new FormData(formElement);


        var url = "<?=base_url('addnews/addnewscheck')?>";
        $.ajax({
               type: "POST",
               url: url,
               data: formData,
               processData: false,
               contentType: false,                
               success: function(data){
                   if(data == 'add_news_success'){
                        $('#mainarea').load(
                            "<?=base_url('newsoverview')?>"
                        );

                        $('html,body').animate({
                            scrollTop: $("#mainarea").offset().top},
                            'slow'
                        );
                   }else if(data == 'add_news_failed'){
                        alert('Add news failed');
                   }else if(data == 'add_news_error'){
                        alert('Error: Some field is not valid');
                   }
               }
        });
        return false;
    });
    $('.goback').click(function(){
        $('#mainarea').load(
        "<?=base_url('newsoverview')?>"
    );

        $('html,body').animate({
        scrollTop: $("#mainarea").offset().top},
        'slow');
    });
});
</script>
<form id="addnews" method="POST">
    Place Name*:
    <?= form_dropdown('placeid',$placedata,'','id="placeid"'); ?>
     <br>
    News Header*:<i>Must not longer than 100 characters</i>
    <input type="text" id="newsheader" name="newsheader" size="100" required maxlength="100"><br>
    News Details*:
    <input type="text" id="newsdetails" name="newsdetails" size="100" required><br>
    Date Started*:
    <input type="datetime-local" id="datestarted" name="datestarted" required><br>
    Date Ended*:
    <input type="datetime-local" id="dateended" name="dateended" required><br>
    <input type="submit" value="Submit">
</form>
<a href="#" class="goback"style ="color:black">Go Back</a>
