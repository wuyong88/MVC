<?php

// 用户点击修改按钮（每个按钮追加了当前数据的id）【程序知道用户要修改那条数据】
// 查询当前数据--显示【获取地址栏id0】，根据id查询数据，并且显示到html中
// 用户填写数据--提交
// 修改


/*
图片在修改控制器中上床的处理
  判断没有图片上传，不能修改表内img字段
  isset($_FILES['file']) && $FILES[file']['size']>0
  不满足条件，[不拼接sql]

 修改视图显示图片上传的组件及显示图片
   1.把添加的拷贝过来
     a.上传组件
     b.上传js
   2.上传组件下面的img标签加了个判断，有图片显示

  修改图片再次上传
    1.点击上传按钮，删掉第一张，显示第二张
      a.上传按钮change事件里面，找到第一张图，执行remove
      $('[type="file"]').change(9999999999999999999999999999999999999999999999999999999999999999)

      )

*/
$id = isset($_GET['id']) && is_numeric($_GET['id'])? $_GET['id'] : 0;   //empty是否存在
// var_dump($id);die;
if (!$id) {
 echo '<script>alert ("修改异常");window.location.href="index.php?m=1&c='.C.'&a='.A.'"</script>';
 exit;
}
$data = select("select * from news where id = $id");
$news_cates = select("select * from news_cates");

if($_POST){
			$img_sql ='';
			if (isset($_FILES['file']) && $_FILES['file']['size']>0 ){
				$img_path =upload($_FILES['file']);
				$img_sql .="img = '$img_path'".',';
				$thumb_path =getThumb($img_path);
				$thumb_sql .="thumb = '$thumb_path'".',';

				/* 水印修改 */
				if($_POST['water']==1){
		              $water_path =getFonWater($img_path);
	                    }else if($_POST['water']==2){
		                   $water_path =getimgWater($img_path);
	                        }
			         }


			    if($_POST['water']==1){
		               $water_path =getFonWater($data[0]['img']);	
	                     }else if($_POST['water']==2){
		               $water_path =getimgWater($data[0]['img']);
	                  } 
		 
			$file =  $img_path;
	       	$title  = $_POST['title'];
		  	$content= strip_tags($_POST['content']);
		  	$cate_id= $_POST['cate_id'];
	       	$ctime = time();
	       	$is_show= isset($_POST['is_show'])? 1:0;

    $res=update("update news set
     	title  		= '$title',
     	$thumb_sql
        $img_sql
        content 	= '$content',
        cate_id 	= '$cate_id',   
        ctime 		= '$ctime',
        is_show 	= $is_show
    	where id 	= $id

    	");


if (!$data) {
 	echo '<script>alert ("修改失败");window.location.href="index.php?m=1&c='.C.'&a='.A.'&id='.$id.'"</script>';
 	exit;
 }

if (!$res) {
	echo '<script>alert ("修改失败");window.location.href="index.php?m=1&c='.C.'&a='.A.'&id='.$id.'"</script>';
	exit;
}

echo '<script>alert ("修改成功");window.location.href="index.php?m=1&c='.C.'&a=index"</script>';

    }



require'app/view/admin/public/header.html';
require 'app/view/admin/news/save.html';
require'app/view/admin/public/footer.html';

