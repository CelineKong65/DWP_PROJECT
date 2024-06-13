<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") 
   {
       // 处理表单提交
       $name = $_POST['name'];
       $email = $_POST['email'];
   }
?>

<html>
   <head>
       <title>处理表单提交</title>
   </head>
   <body>
       <h1>处理表单提交</h1>
       <!-- 在此处添加HTML表单 -->
       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
           <label for="name">姓名：</label>
           <input type="text" name="name" id="name"><br>
           <label for="email">邮箱：</label>
           <input type="email" name="email" id="email"><br>
           <!-- 其他表单字段... -->
           <input type="submit" value="提交">
       </form>
   </body>
   </html>