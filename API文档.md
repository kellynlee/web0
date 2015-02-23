#用户
## createUser
* 创建一个新用户
*  请求URL：api_users.php?action=createuser
*  请求方式：POST
*  请求参数：
username - 用户名
password - 密码
email - 邮箱
avatar - 头像的URL
properties - 其它属性，留空
* 返回值
```
{"status":-1,"message":"Invalid input."}	//参数错误（下同，省略）
```
```
{"status":0,"message":"Username already exists."} //用户名已存在
```
```
{"status":200,"message":"User created."} //用户创建成功
```
* 调用示例(JQuery)
```
$.post("api_users.php?action=createuser",
  {	
	//请求参数
    "username":"TestUsername",
    "password":"test",
    "email":"test@sina.com",
    "avatar":"uploads/avatar001.png",
    "properties":""
  },
  function(data,status){	//请求完成后的回调函数
    result = eval(data);	//将返回的JSON转换为JS对象
    alert("Status:" + result.status);
    alert("Message": + result.message);
  });
```
##login
* 登录
* URL: api_users.php?action=login
* 请求方式：POST
* 请求参数：
username - 用户名
password - 密码
* 返回值
```
{"status":403,"message":"Username or password incorrect."}	//用户名或密码错误
```
```
{"status":200,"message":"Successfully Logged in.","accesstoken":"0AB538E92C6DB78D10B1694E645F3625"}	//登录成功。注意：accesstoken的值务必保留，以后大量请求都需要在参数中提交该值
```
##getUserInfoByToken
* 通过AccessToken获取当前用户的信息
* URL: api_users.php?action=getuserinfobytoken
* 请求方式：GET
* 请求参数：
accesstoken - 通过login方法得到的AccessToken
* 返回值
```
{"status":404,"message":"Username not found."}	//用户名不存在
```
```
{"status":200,"message":"Success.","userinfo":{"username":"用户名","email":"邮箱地址","avatar":"头像URL","properties":"","authorities":"用户权限"}}
```
##logout
* 注销当前登录用户
* URL: api_users.php?action=logout
* 请求方式：GET
* 请求参数：accesstoken
##getAllUsernames
* 得到全部注册用户的用户名（只有管理员有调用该方法的权限）
* URL: api_users.php?action=getallusernames
* GET
* 请求参数：accesstoken
* 返回值
```
{"status":403,"message":"Permission denied."}	//非管理员调用该方法，拒绝请求
```
```
{"status":200,"message":"Success.","userlist":["user0","user1","user2"]}
```
##updateUserInfoByToken
* 更新当前用户的信息
* URL: api_users.php?action=updateuserinfobytoken
* POST
* 请求参数：
accesstoken
email - 新邮箱地址
avatar - 新头像URL
properties - 用户属性
* 返回值
```
{"status":200,"message":"Success."}
```
