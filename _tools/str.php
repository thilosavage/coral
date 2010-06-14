<?php
class str {
	public static function gen($length = '10', $upperCase = true) {
		$key = '';
		($upperCase) ?
		$keyset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789":
		$keyset = "abcdefghijklmnopqrstuvwxyz0123456789";
		for ($i=0; $i<$length; $i++) $key .= substr($keyset, rand(0,strlen($keyset)-1), 1);
		return $key;
	}
}
?>