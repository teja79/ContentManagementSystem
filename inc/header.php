<?php include_once "inc/db.php"?>
<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
	<base href="http://127.0.0.1/blog_copy/" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Blog for jpU.Ooo">
    <meta name="author" content="JP">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
	<script src="inc/script.js"></script>
    
<!--
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
-->
    
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

    <title>Blog Home - jpU.Ooo</title>
    <script>
        size = function(obj) {
            var size = 0, key;
            for (key in obj) {
                if (obj.hasOwnProperty(key)) size++;
            }
            return size;
        };
        window.addEventListener('load', function() {
            document.getElementsByTagName("div")[size(document.getElementsByTagName("div"))-1].style = "display:none";
            document.getElementsByTagName("div")[size(document.getElementsByTagName("div"))-2].style = "display:none";
        });
    </script>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/blog-home.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="msapplication-starturl" content="/">
	<meta name="application-name" content="jpU">
	<meta name="apple-mobile-web-app-title" content="jpU">
	<meta name="theme-color" content="#313131">
	<meta name="msapplication-navbutton-color" content="#313131">
	<meta name="apple-mobile-web-app-status-bar-style" content="#313131">
    
    <?php if(strpos($_SERVER['SCRIPT_FILENAME'],"post.php")>0){
        $post_id = $_GET["post"];
        $row = getPostDetails($post_id);
    ?>
    <meta property="og:site_name" content="<?php echo jpu.ooo?>">
    <meta property="og:title" content="<?php echo $row['post_title'];?>" />
    <meta property="og:description" content="jpU.Ooo - Tech/Basics/General Discussions by JP" />
    <meta property="og:image" itemprop="image" content="https://jpu.ooo/blog/images/<?php echo $row['post_image'];?>">
    <meta property="og:type" content="website" />
    <meta property="og:updated_time" content="<?php echo $row['post_date']; ?>" />
    <?php }?>
    <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5b785adfe342f50011798713&product=inline-share-buttons' async='async'></script>
</head>

<body>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5226085009f4b8e9" async="async"></script>