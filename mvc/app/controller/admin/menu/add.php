<?php
$menu = select("select * from menu");
$data = getCates("menu");
if($_POST){
  $name = $_POST['name'];
  $pid = $_POST['c_id'];
  $module = $_POST['module'];
  $controller = $_POST['controller'];    
  $action = $_POST['action'];
  $is_show = $_POST['is_show'];

   $res=insert("insert into menu (name,pid,module,controller,action,is_show) values('$name','$pid','$module','$controller','$action',$is_show)"); 
   if (!$res) {
      echo '<script>alert("失败");window.location.href="index.php?m=1&c='.C.'&a='.A.'&id='.$id.'"</script>';
      exit;
    
    }

    echo '<script>alert("成功");window.location.href="index.php?m=1&c='.C.'&a=index"</script>';

}


require'app/view/admin/public/header.html';
require 'app/view/admin/menu/add.html';
require'app/view/admin/public/footer.html';
