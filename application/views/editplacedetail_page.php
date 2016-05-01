<script>
$(document).ready(function(){
    $('.goback').click(function(){
        $('#mainarea').load(
    		"<?=base_url('mainpage/getplace')?>"
		);

        $('html,body').animate({
        scrollTop: $("#mainarea").offset().top},
        'slow');
    });
    $(document).on("submit", "form", function(event){
        event.preventDefault();
            
        var inputFile = $('input[name=placepic]');
        var placepic = inputFile[0].files[0];

        var formElement = document.querySelector("form");
        var formData = new FormData(formElement);

        if (placepic != 'undefined') {
          formData.append("placepic", placepic);
        }


        var url = "<?=base_url('editplace/editplacedetailcheck')?>";
        $.ajax({
               type: "POST",
               url: url,
               data: formData,
               processData: false,
               contentType: false,
               success: function(data){
                   if(data == 'edit_placedetail_success'){
                        $('#mainarea').load(
                            "<?=base_url('mainpage/getplace')?>"
                        );

                        $('html,body').animate({
                            scrollTop: $("#mainarea").offset().top},
                            'slow'
                        );
                   }else if(data == 'edit_placedetail_failed'){
                        alert('Edit placedetail failed');
                   }else if(data == 'edit_placedetail_error'){
                        alert('Error: Some field is not valid');
                   }
               }
        });
        return false;
    });
});
</script>
<form enctype="multipart/form-data" method="post" accept-charset="utf-8">
<input type="hidden" name="placeid" id="placeid" value="<?=$placeid?>">
    Place Details:*<br>
		<textarea name="placedetails" id="placedetails" rows="5" cols="50" required>
		<?=$placedetaildata['placedetails']?>
		</textarea><br>
	Phone Contact:<br>
	1.* <input type="tel" name="phonecontact1" id="phonecontact1" size="10" value="<?=$placedetaildata['phonecontact1']?>" required maxlength="10" pattern="[0-9]{9,10}" title="number"><br>
	2. <input type="tel" name="phonecontact2" id="phonecontact2" size="10" value="<?=$placedetaildata['phonecontact2']?>" maxlength="10" pattern="[0-9]{9,10}" title="number"><br>
	Website:<br>
	<input type="url" name="website" id="website" size="30" value="<?=$placedetaildata['website']?>"><br>
	Email:<br>
	<input type="email" name="email" id="email" size="30" value="<?=$placedetaildata['email']?>"><br>
	<input type="hidden" name="imageurl" id="imageurl" value="<?=$placedetaildata['imageurl']?>">
    Place Picture: <input type="file"
        class ="register-margin register-box"
        name="placepic"
        id="placepic"
        size ="999"
        accept="image/*">
        <?php if(!empty($placedetaildata['imageurl'])):?>
        <img
            src="http://52.74.64.61/questio_management<?=$placedetaildata['imageurl']?>"
            alt="<?= $placedetaildata['imageurl']?>"
            style="width:100px;
                    height:100px;">
        <?php endif;?>
        <br>
    <input type="submit" value="Submit">
</form>
<a href="#" class="goback"style ="color:black">Go Back</a>