<?php include "../inc/db.php";?>
<?php include "func.php";?>
<?php ob_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
?>
<?php session_start();
if($_SESSION['role'] == subscriber || $_SESSION['role'] == null){
	header("Location: ../index.php");
}else{
	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=gueq7qqy4rcg68onomh76iac1442tck1n688oqiqg8fi2j6b"></script> 
    <script>tinymce.init({
  selector: "textarea",
  autosave_ask_before_unload: false,
  codesample_dialog_width: 600,
  codesample_dialog_height: 425,
  template_popup_width: 600,
  template_popup_height: 450,
  powerpaste_allow_local_images: true,
  plugins: [
    "a11ychecker advcode advlist anchor autolink codesample colorpicker contextmenu fullscreen help image imagetools",
    " lists link linkchecker media mediaembed noneditable powerpaste preview",
    " searchreplace table template textcolor tinymcespellchecker visualblocks wordcount"
  ], //removed:  charmap insertdatetime print
  external_plugins: {
    mentions: "//www.tinymce.com/pro-demo/mentions/plugin.min.js",
    moxiemanager: "//www.tinymce.com/pro-demo/moxiemanager/plugin.min.js"
  },
  toolbar:
    "insertfile a11ycheck undo redo | bold italic | forecolor backcolor | template codesample | alignleft aligncenter alignright alignjustify | bullist numlist | link image",
  content_css: [
    "//fonts.googleapis.com/css?family=Lato:300,300i,400,400i",
    "//www.tiny.cloud/css/content-standard.min.css"
  ]
});</script>

    <title>CMS Admin Panel</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>

</head>

<body>