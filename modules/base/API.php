<?php

	$db = new PDO('mysql:host=home.dev;dbname=devforum', "root", "tango255");

	session_start();
	if(isLoggedin()){
		$USER = new User($_SESSION['userID']);
	}

	$syntaxes = array(
		new SyntaxObject("H::", "::H", array("<h2>","</h2>")),
		new SyntaxObject("I::", "::I", array("<i>","</i>")),
		new SyntaxObject("PART::", "::PART", array("<div class='text'>", "</div>")),
		new SyntaxObject("CODE::", "::CODE", array("<pre><code>", "</code></pre>"))
	);

	define("SYNTAX_COLOR","#41e739");

	class User{
		var $id;
		var $email;
		var $firstname;
		var $lastname;
		var $password;
		var $devtypeID;
		var $usergroupID;

		function __construct($userID){
			global $db;
			$this->id = $userID;

			$result = $db->query("SELECT * FROM users WHERE userID=$userID");
			while(($row = $result->fetch()) != false){
				$this->email = $row['userEmail'];
				$this->firstname = $row['userFirstname'];
				$this->lastname = $row['userLastname'];
				$this->password = $row['userPassword'];
				$this->devtypeID = $row['devtypeID'];
				$this->usergroupID = $row['usergroupID'];
			}
		}
	}

	class Article{
		var $id;
		var $userID;
		var $title;
		var $text;
		var $date;
		var $image;

		function __construct($id = null){
			if(isset($id))
			$this->id = $id;
		}

		function fetch_build(){
			global $db;

			$result = $db->query("SELECT * FROM articles WHERE articleID=$this->id");
			while(($row = $result->fetch()) != false){
				$this->userID = $row['userID'];
				$this->title = $row['articleTitle'];
				$this->text = $row['articleText'];
				$this->date = $row['articleDate'];
				$this->image = $row['articleImage'];
			}
		}

		function render(){
			$publisher = new User($this->userID);
			?>

				<div class="text center squeezed">
					<h1><?php echo enquote($this->title); ?></h1>
					<p><?php echo "By: $publisher->firstname $publisher->lastname"; ?></p>
					<p><?php echo $this->date; ?></p>
				</div>
				<div class="text center squeezed">
					<p><?php echo enquote(textify($this->text)); ?></p>
				</div>

			<?php
		}
	}

	class SyntaxObject{
		var $start;
		var $end;
		var $_start = "";
		var $_end = "";

		function __construct($start, $end, $replace = array()){
			$this->start = $start;
			$this->end = $end;
			if(isset($replace)){
				$this->_start = $replace[0];
				$this->_end = $replace[1];
			}
		}
	}

	class Notification{
		var $id;
		var $recieverID;
		var $message;
		var $date;
		var $url;

		function __construct($id = null){
			if(isset($id))
			$this->id = $id;
		}

		function fetch_build(){
			global $db;

			$result = $db->query("SELECT * FROM notifications WHERE notificationID=$this->id");
			while(($row = $result->fetch()) != false){
				$this->recieverID = $row['recieverID'];
				$this->message = $row['notificationMessage'];
				$this->date = $row['notificationDate'];
				$this->url = $row['notificationUrl'];
			}
		}
	}

	class Issue{
		var $id;
		var $desc;
		var $userID;
		var $date;

		function __construct($id = null){
			if(isset($id)){
				$this->id = $id;
			}
		}

		function fetch_build(){
			global $db;

			$result = $db->query("SELECT * FROM issues WHERE issueID=$this->id");
			while(($row = $result->fetch()) != false){
				$this->desc = $row['issueDesc'];
				$this->userID = $row['userID'];
				$this->date = $row['issueDate'];
			}
		}
	}

	class Usergroup{
		var $id;
		var $name;
		var $desc;

		function __construct($id = null){
			$this->id = $id;
		}

		function fetch_build(){
			global $db;

			$sql = "SELECT * FROM usergroups WHERE usergroupID=$this->id";
			$result = $db->query($sql);
			while(($row = $result->fetch()) != false){
				$this->name = $row['usergroupName'];
				$this->desc = $row['usergroupDesc'];
			}
		}
	}

	function publish_issue($issue){
		global $db;

		$sql = "INSERT INTO issues (issueDesc, userID) VALUES('".remove_html(dequote($issue->desc))."', $issue->userID)";
		$db->query($sql);
	}

	function publish_notification($noti){
		global $db;

		$sql = "INSERT INTO notifications (recieverID, notificationMessage, notificationUrl)
		VALUES($noti->recieverID, '$noti->message', '$noti->url')";
		$db->query($sql);
	}

	function delete_notification($id){
		global $db;

		$db->query("DELETE FROM notifications WHERE notificationID=$id");
	}

	function isLoggedin(){
		return (isset($_SESSION['userID']));

	}

	function publish_article($article){
		global $db;

		$title = dequote($article->title);
		$text = dequote($article->text);

		$sql ="INSERT INTO articles (userID, articleTitle, articleText, articleImage)
		VALUES($article->userID, '$title', '$text', '$article->image')";

		$db->query($sql);
	}

	function textify($text){
		global $syntaxes;

		$nice_text = $text;
		$nice_text = remove_html($nice_text);

		foreach($syntaxes as $syntax){
			if(substr_count($text, $syntax->start) != substr_count($text, $syntax->end)){
				echo "The text is not formated correctly. Check your syntax.";
				return;
			}
		}

		//Parse the syntax
		foreach($syntaxes as $syntax){
			$nice_text = str_replace($syntax->start, $syntax->_start, $nice_text);
			$nice_text = str_replace($syntax->end, $syntax->_end, $nice_text);
		}

		return $nice_text;
	}

	function syntaxify($text){
		global $syntaxes;

		$nice_text = $text;

		//Parse the syntax
		foreach($syntaxes as $syntax){
			$nice_text = str_replace($syntax->start, "<font color='".SYNTAX_COLOR."'>$syntax->start</font>", $nice_text);
			$nice_text = str_replace($syntax->end, "<font color='".SYNTAX_COLOR."'>$syntax->end</font>", $nice_text);
		}

		return $nice_text;

	}

	function remove_html($text){
		return strip_tags($text);
	}

	function dequote($text){
		return str_replace("'", ";q;", $text);
	}

	function enquote($text){
		return str_replace(";q;", "'", $text);
	}

	function get_devtype_name($id){
		global $db;

		$result = $db->query("SELECT * FROM devtypes WHERE devtypeID=$id");
		$row = $result->fetchAll();
		echo $row[0]['devtypeName'];
	}

?>
