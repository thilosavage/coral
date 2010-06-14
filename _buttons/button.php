<?php
class button{
	function internal($route,$text){
		return "<a href='".site::url.$route."'>".$text."</a>";
	}
	function external($site,$text){
		return "<a href='".$site."' target='_blank'>".$text."</a>";
	}
}
?>