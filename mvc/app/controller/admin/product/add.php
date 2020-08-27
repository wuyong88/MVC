<?php



  $data = select("select n.*,c.name  from product as n left join product_cates as c on n.cate_id=c.id");
  $product_cates = select("select * from product_cates");

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
	$title  = $_POST['title'];
	$content= strip_tags($_POST['content']);
	$cate_id= $_POST['cate_id'];
  $file =  $img_path;
    $ctime  = time();
    $utimec = $_POST['utimec'];
    $author = $_POST['author'];
    $is_show= isset($_POST['is_show']) ? 1:0;
    $res = insert("insert into product(title,content,is_show,img,cate_id) 
    	values('$title','$content',$is_show,'$file','$cate_id')");  

    if (!$res) {
    	echo '<script>alert("失败");window.location.href="index.php?m=1&c='.C.'&a='.A.'&id='.$id.'"</script>';
    	exit;
    
    }

    echo '<script>alert("成功");window.location.href="index.php?m=1&c='.C.'&a=index"</script>';
	
}




// $news_cate = select


require'app/view/admin/public/header.html';
require 'app/view/admin/product/add.html';
require'app/view/admin/public/footer.html';
