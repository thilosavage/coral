<?php
/*
	Use this for all your error messages!
	Like if a failed login says "Your password was incorrect."
	And you don't think that's expressive enough,
	you know right where to go and change it to:
	"ENTER THE GOD DAMN CORRECT PASSWORD!"
*/

class error {
	public static function incorrectLogin(){
		return "Incorrect password.";
	}
}
?>