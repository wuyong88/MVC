<?php
// 后台控制器
// 如何实现登录
   // 1.获取用户提交的信息
   //    from表单提交信息
   //      action提交地址
   //      method提交方式
   //      input组件的name的值
   //      提交按钮
   //    php获取
   //      get => $_GET
   //      post=> $POST
   // 2.

// 控制器打印数据
//   1.页面填写，不要提交
//   2.控制器打赢数据，并且打断程序
//   3.页面控制


// print_r($_POST);
// die;
// session与cookie
// session保存在服务端 --web服务器
// cookie保存在浏览器指定目录下
// 生命周期 session session.ge_maxlifetime = 1440
// 不适用

// cookie的应用场景
// 账号和密码的记住，方便再次登录
// 1.在login.html登录按钮上面加复选框（记住我）
// <input type="checkbox" name="check">
// 2.在login.php账号密码没问题的情况下
// a.判断用户是否西安则记住我
//  if(sesset($_POST['check']))
// b.setcookie设置账号密码，保存
//  setcookie('name',$name,time()+1111)
// c.判断没有打钩，setcookie
//  将值设为null,不给时间，达到清除的目的
//    setcoolie('name',null)
// 注意：location之后应该停止代码运行

// $_SESSION
//   1.开启session_start();在公共文件开启——入口开启
// session的应用场景
//    1.控制用户登录
    // 将用户信息保存session，session内没有用户信息


// 生命周期 cookie 自定义的 当前时间+存活时间
// 重要信息存session，服务端安全，服务端需注意使用空间
// cookie的大小不超过4k，单站点不超过20个（因为每次请求服务器都携带cookie）
// SESSION_ID
//服务端保存session，生成session_id唯一的，session以文件的形式存在
// 服务端将session_id传回


// 加密
// 单项散列值  不可逆———只有加密没有解密
// mds   sha1
// // 对称加密  加密与解码的方式一样，可解密
// url加密  base64[图片文字--目的网络中快速传播]
// 非对称加密  加密(密钥)与解密（密钥）不一样
// 不同系统之间自定义方式
// echo md5(123);  32位16进制
// echo aha1('123');
// echo crypt('123','')

// 1.用户注册给用户密码加密@crypt('用户密码');
// 2.将上面结果保存到数据库
// 3.用户登陆是用自己的明文密码登陆
//   a.程序拿到明文密码
//   b.通过账号的查询获取到用户的密文密码
//   c.crypt(用户明文密码，秘文密码)得到数据
//   d.最终的数据库的密文密码比较
// $pwd = 123;
// echo $a = @crypt($pwd);
// echo'<br';
// echo = ($pwd,$a)

// $pwd = 123;
// echo $a = @crypt($pwd);
// echo'<br';
// echo $b= ($pwd,$a)
// if(hash_equals($a,$b)){
//    echo '相等';

// }
// echo'<br>';
// $url =' http://localhost/mvc/index.php?m=1&c=index&a=index'


// // 1.链接数据库
// // 2.查询表 sql
// 3.正确或失败
if($_POST){//判断用户是否提交
   $name = $_POST['name'];
   $pwd  = $_POST['pwd'];
   $code = $_POST['code'];

// strtolower()大写字母转小写字母
// strtoupper()小写字母转大写字母
   if(strtolower($code)!=strtolower($_SESSION['code'])){

         $arr= [
        'status'=>'100',
        'msg'=>'验证码错误',
        'data'=>'',

   ];
     // echo json_decode()  json字符串转回
    echo json_encode($arr);   //其他类型转json字符串
    exit;

//       echo'<script>alert("验证码错误"); 
// window.location.href="http://localhost/mvc/index.php?m=1&c=login&a=login"</script>';
   }


$data = select("select * from admin admin where username='$name'");
if(!$data){

    $arr= [
        'status'=>'101',
        'msg'=>'没有这个账号',
        'data'=>'',

   ];
     
    echo json_encode($arr);   
    exit;
// echo'<script>alert("没有这个账号"); 
// window.location.href="http://localhost/mvc/index.php?m=1&c=login&a=login"</script>';

}

  
// var_dump($data[0]['password']);echo '</br>';
// var_dump(MD5($pwd));  
//  // 

// if($data[0]['password'] != MD5($pwd)){
if($data[0]['password'] != ($pwd)){

    $arr= [
        'status'=>'102',
        'msg'=>'密码错误',
        'data'=>'',

   ];
    echo json_encode($arr);  
    exit;
//    //提示跳转
// echo'<script>alert("密码错误"); 
// window.location.href="http://localhost/mvc/index.php?m=1&c=login&a=login"</script>';
}

  

if(isset($_POST['check'])){
   setcookie('name',$name,time()+1160);
   setcookie('pwd',$pwd,time()+1160);
   setcookie('check',$name,time()+1160);

}else{
   setcookie('name',null);
  setcookie('pwd','',0);
   setcookie('check',null);
}
// var_dump($_POST['check']);

$_SESSION['user_info'] = $data[0];
// echo'<script>alert("成功"); 
// window.location.href="http://localhost/mvc/index.php?m=1&c=index&a=index"</script>';

 $arr= [
        'status'=>'200',
        'msg'=>'成功',
        'data'=>'index.php?m=1&c=index&a=index',

   ];
    echo json_encode($arr);  
    exit;

}

// 加载视图
require 'app/view/admin/login/login.html';