<?php
/*
后台新闻添加控制器

1.html的表单from action与method
2.from组件的neme的值
3.接收用户信息
4.添加数据
5.提示

文件上传
1.html的form
  加 enctype = 'multipart/form-data'
  input的name值
  type='file'    加<input type='file' name='file'>

2.php接收
  $_FILES['表单的file组件的name的值']

3.长传流程
  a.判断有无条件
  b.判断文件大小
  c.判断文件后缀--(文件类型)
  d.创建文件夹(方便管理上传文件)
      mkdir 创建文件目录
  e.上传
      move_uploaded_file 移动文件

扩充：图片即时显示
   1.获取文件信息
   2.通过文件信息获取文件临时地址


文件上传流程
  1.完善表单
  2.php接收
  3.判断有无上传
  4.

f.return 新图片地址

  上传的程序需要调用
    php中调用，接受这个新地址，存数据表

  上传后显示，如果没图，显示暂无照片，有图片通过img标签显示
    （
      is_dir
      is_file
      is_exists
      放置数据表内img字段下，存在的不是文件地址
        在数据表中查询数据
        对文件路径做判断，是否存在
        不存在，显示再无照片的路劲
        如果存在显示自己的


        ）


function getUrl(file){
	var url = null;
	if(window.createObjectURL !==undefined){
	url = window.createObjectURL(file)
	}else if (window .URL !== undefine){
	url = window.URL.createObjictURL(file)
	}else if(window.webkitURL！==undefined){
	url = window.webkitURL.createObjictURL(file)
	}
	return url;
}
$('[type = "file"]').change(function(){
	var src = getURL($(this)[0.files]);
	$('.upload').append('<img src="'=+src+'">')
})




分类
新闻分类在新闻添加中显示
  1.在新闻添加器，查询分类数据
    select("select * from news_cates")
  2.显示到添加html中
    foreach
      <option></option>

分类在新闻列表中的显示
  1.新闻列表控制器
  双表联查，注意：重复字段，后面覆盖前面的
    select("select n.*,c.name as cate_name from news as ma left join news_cates as c on n.cate_id=c.id");
   注意：如果name没有别名，注意修改所有的cate_name
 分类在新文修改中显示
   1.在新闻修改控制器，查询分类数据
     select("select* from news_cates")
   2.显示到添加html中
    foreach
      <option></option>
   3.html中需要显示对应的分类
     <option <php if($data[0]['cate_id'] == $v[id]){?> selected="true" <?php }?></option>
*/

// var_dump($data);die;


/*
分页：
  庞大的数据通过分段展示，加快查询速度
   select * from 表名 limit 开始位置,查询条数
   核心：
     sql语句后面的limt
   如何分页：
   select * from 表名 limt 0,5
   两个值：
    开始位置  显示条数
   分页中需要的数据
     数据中有n条数据
     每页显示条数m

   按钮个数
     n/m(遇到小数也要现实一页，向上取整)

   分页按钮卫生莫点击后会变化
     通过地址栏传参，控制limt开始位置的变化
     index.php?m=1&c=news&a=index&page=
      按钮1 index.php?m=1&c=news&a=index&p=1
      按钮2 index.php?m=1&c=news&a=index&p=2
      按钮3 index.php?m=1&c=news&a=index&p=3

   用户点击按钮（）

   alter table news_cates add pid int unsigned not null;

*/


     $data = select("select n.*,c.name  from news as n left join news_cates as c on n.cate_id=c.id");
     $news_cates = select("select * from news_cates");
     
     
   
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
	$file =  $img_path;
	$content= strip_tags($_POST['content']);
	$cate_id= $_POST['cate_id'];
    $ctime  = time();
    $utimec = $_POST['utimec'];
    $author = $_POST['author'];
    $is_show= isset($_POST['is_show']) ? 1:0;
    $res = insert("insert into news(title,content,ctime,is_show,img,cate_id,thumb) 
    	values('$title','$content','$ctime',$is_show,'$file','$cate_id','$thumb_path')");  

    if (!$res) {
    	echo '<script>alert("失败");window.location.href="index.php?m=1&c='.C.'&a='.A.'&id='.$id.'"</script>';
    	exit;
    
    }

    echo '<script>alert("成功");window.location.href="index.php?m=1&c='.C.'&a=index"</script>';
	
}




// $news_cate = select


require'app/view/admin/public/header.html';
require 'app/view/admin/news/add.html';
require'app/view/admin/public/footer.html';
