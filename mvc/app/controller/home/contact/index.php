<?php
/*
乐农首页

*/
// 1.查询banner表


$menu_data=select('select * from menu where module="home"');

$banner_data=('select * from banner');

$menu_data=select('select * from menu where module="home"');
// banner图
$banner_data=select('select * from banner');
// 查touch_cates表找到pid=0的数据
$touch_cates=select("select * from touch_cates where pid=0");
// var_dump($touch_cates)die;
// 用三目运算符判断样式  判断cate_id
$cate_id=isset($_GET['cate_id'])?($_GET['cate_id']):$touch_cates[0]['id'];

// 查news表 条件 cate_id是否等于$cate_id...然后倒序查找三个
$touch_data=select("select * from touch where cate_id=$cate_id and is_show=1 order by id desc limit 1");
$touch = select("select * from touch where id=7");

$content=select("select * from content");

if($_POST){

	 $username = $_POST['username'];
	 $telephone = $_POST['telephone'];
     $mailboxes = $_POST['mailboxes'];
     $massage = $_POST['massage'];

  $res=insert("insert into content (username,telephone,mailboxes,massage) values('$username','$telephone','$mailboxes','$massage')") ;
  if (!$res) {
      echo '<script>alert("失败")"</script>';
      exit;
    
    }

    echo '<script>alert("成功")</script>';

}

require'app/view/home/public/header.html';

require'app/view/home/contact/index.html';
