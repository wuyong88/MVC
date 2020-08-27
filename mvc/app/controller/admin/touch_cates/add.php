<?php



if($_POST){
    $name = htmlspecialchars($_POST['name'],ENT_QUOTES);
    $pid = $_POST['pid'];
    $res = insert("insert into touch_cates(
           name,
           pid
  )values(
           '$name',
           '$pid'
)");
    if(!$res){
      echo '<script>alert("失败");window.location.href="index.php?m=1&c=touch_cates&a=add"</script>';

    }
    echo '<script>alert("成功");window.location.href="index.php?m=1&c=touch_cates&a=index"</script>';

  }


$data = getCates("touch_cates");

// $news_cate = select


require'app/view/admin/public/header.html';
require 'app/view/admin/touch_cates/add.html';
require'app/view/admin/public/footer.html';