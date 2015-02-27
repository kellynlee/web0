<?php
include_once('connectdb.php');

class todo {
	public function test_input($data){
		  $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
	}
	public function writeresume($title,$name,$sex,$age,$phone,$email,$qq,$msn,$content) {
		$title=$this->test_input($title)
		$name=$this->test_input($name);
		$sex=$this->test_input($sex);
		$age=$this->test_input($age);
		$phone=$this->test_input($phone);
		$email=$this->test_input($email);
		$qq=$this->test_input($qq);
		$msn=$this->test_input($msn);
		$content=$this->test_input($content);
		if ($name=='' || $sex=='' || $age=='' || $phone=='' || $content=='') {
			die('{"status":-1,"message":"Basic data is needed"}');
		}
		if($phone && !ereg("^1([0-9]{10})$",$phone)){
		echo '{"status":400,"message":"Wrong phone number"}';
	}

		$sql="INSERT INTO jianzhi(id,name,sex,age,phone,email,qq,msn,content,time) VALUES (NULL, '$_POST[name]', '$_POST[sex]', '$_POST[age]', '$_POST[phone]','$_POST[email]','$_POST[qq]','$_POST[msn]','$_POST[content]',now())";
        result=mysql_query($sql);
        if(result)
        	echo '{"status":200,"message":"Resume created"}';
        else
        	echo '{"status":500,"message":"Failed"}';
	}
	public function createshop($name,$owner,$phone,$content) {
		$name=$this->test_input($name);
		$owner=$this->test_input($owner);
		$phone=$this->test_input($phone);
		$content=$this->test_input($content);
		if ($name=='' || $owner=='' || $phone=='' || $content=='') {
			die('{"status":-1,"message":"Basic data is needed"}');
		}
		$sql="INSERT INTO meishi(id,name,owner,phone,content,time) VALUES (NULL, '$_POST[name]',  '$_POST[owner]','$_POST[phone]','$_POST[content]',now())";
        result=mysql_query($sql);
        if(result)
        	echo '{"status":200,"message":"Resume created"}';
        else
        	echo '{"status":500,"message":"Failed"}';
	}
	public function searchresume($data){
		$sql="select * from data1 where title like '%$data%'";
		$query=mysql_query($sql);
		while($row = mysql_fetch_array($result)){
		  echo $row['title'];
		  echo $row['name'];
		  echo $row['sex'];
		  echo $row['age'];
		  echo $row['phone'];
		  echo $row['email'];
		  echo $row['qq'];
		  echo $row['msn'];
		  echo $row['content'];
		}
	}
	public function searchshop($data){
		$sql="select * from data2 where name like '%$data%'";
		$query=mysql_query($sql);
		while($row = mysql_fetch_array($result)){
		  echo $row['name'];
		  echo $row['owner'];
		  echo $row['phone'];
		  echo $row['content'];
		}
	}

}