<?php




$touch = select("select * from touch");
if($_POST){
	$img_path =upload($_FILES['file']);  //上传原图
	
	$thumb_path = getThumb($img_path);  //缩略图
	// var_dump($_POST);die;
	if($_POST['water']==1){
  
  $water_path =getFonWater($img_path);
  // var_dump($water_path);die;
 }else if($_POST['water']==2){
  $water_path =getimgWater($img_path);
 }
  $contact = $_POST['contact'];
  $gsname = $_POST['gsname'];
  $gssite = $_POST['gssite'];
  $zip = $_POST['zip'];    
  $tel = $_POST['tel'];
  $user = $_POST['user'];
  $phone = $_POST['phone'];
 
  $res=insert("insert into touch (contact,gsname,gssite,zip,tel,user,phone,img) values('$contact','$gsname','$gssite','$zip','$tel','$user','$phone','$img_path')") ;
  if (!$res) {
      echo '<script>alert("失败");window.location.href="index.php?m=1&c='.C.'&a='.A.'&id='.$id.'"</script>';
      exit;
    
    }

    echo '<script>alert("成功");window.location.href="index.php?m=1&c='.C.'&a=index"</script>';

}

require'app/view/admin/public/header.html';
require 'app/view/admin/touch/add.html';
require'app/view/admin/public/footer.html';
