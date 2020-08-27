<?php

/*
后台管理控制器
*/

   
//查询角色表数据
$role_data =select("select * from role ");
// $data =select("select admin.*,role.name  from admin left jion role on admin.role_id=role.id where admin.is_del=0");

// $data = select("select n.*,c.name  from admin as n left join role as c on n.role_id=c.id");
//接收数据
if ($_POST) {
$img_path =upload($_FILES['file']);  //上传原图

 $nickname=$_POST['nickname'];
 $name=$_POST['name'];
 $pwd=md5($_POST['pwd']);
 $role_id=$_POST['role_id'];
 $tel=$_POST['tel'];
 $email=$_POST['email'];
 $sex=$_POST['sex'];

$res=insert("insert into admin(
     nickname,
     username,
     password,
     role_id,
     phone,
     email,
     sex,
     img_src
    

       )values(
       '$nickname',
       '$name',
       '$pwd',
       '$role_id',
       '$tel',
       '$email',
       $sex,
       '$img_path'

      


       )");

    if (!$res) {
      echo '<script>alert("失败");window.location.href="index.php?m=1&c='.C.'&a='.A.'&id='.$id.'"</script>';
      exit;
    
    }

    echo '<script>alert("成功");window.location.href="index.php?m=1&c='.C.'&a=index"</script>';


}

require'app/view/admin/public/header.html';
require 'app/view/admin/admin/add.html';
require'app/view/admin/public/footer.html';

