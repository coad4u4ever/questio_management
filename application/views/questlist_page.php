<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Quest List</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?=script_tag('assets/jquery/jquery-2.2.0.min.js')?>
<?=script_tag('assets/bootstrap/js/bootstrap.js')?>
<?=link_tag('assets/bootstrap/css/bootstrap.min.css')?>
<?=link_tag('assets/questio/questio.css')?>
</head>
<body>
<div class="container-fluid">
	<?php $this->load->view('header', array('title' => 'Quest List'));?>
	<?=form_open('questlist/search')?>
	Search: <input type="text" name="namepart" id="namepart" size="50"><br>
		<input type="submit" value="Enter">
	<?=form_close()?>
	<?php
		$this->table->set_heading('#','Quest name','Type','Zone','Difficulty','Reward');

		if(!empty($questdata)){
			for($i=0; $i<count($questdata);$i++){
				$this->table->add_row($questdata[$i]['questno'],$questdata[$i]['questname'],$questdata[$i]['typename'],$questdata[$i]['zonename'],$questdata[$i]['difftype'],$questdata[$i]['rewardname']);
			}
			echo $this->table->generate();
		}else{
			echo "<h2 style='color:red'>Quest not found</h2>";
		}
	?>
	<a href="<?=base_url('login')?>">Go back</a>
</div>
</body>
</html>
