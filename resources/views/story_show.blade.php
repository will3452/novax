<!DOCTYPE html>
<html class="no-js">
<head>
	<meta charset="utf-8">
	<title></title>
	<meta name="description" content="">
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui,maximum-scale=2">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui,maximum-scale=1">
	<meta http-equiv="cleartype" content="on">

	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/touch/apple-touch-icon-144x144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/touch/apple-touch-icon-114x114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/touch/apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="img/touch/apple-touch-icon-57x57-precomposed.png">
	<link rel="shortcut icon" sizes="196x196" href="img/touch/touch-icon-196x196.png">
	<link rel="shortcut icon" href="img/touch/apple-touch-icon.png">

	<!-- Tile icon for Win8 (144x144 + tile color) -->
	<meta name="msapplication-TileImage" content="img/touch/apple-touch-icon-144x144-precomposed.png">
	<meta name="msapplication-TileColor" content="#222222">

	<!-- SEO: If mobile URL is different from desktop URL, add a canonical link to the desktop page -->
	<!--
	<link rel="canonical" href="http://www.example.com/" >
	-->

	<!-- Add to homescreen for Chrome on Android -->
	<!--
	<meta name="mobile-web-app-capable" content="yes">
	-->

	<!-- For iOS web apps. Delete if not needed. https://github.com/h5bp/mobile-boilerplate/issues/94 -->
	<!--
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-title" content="">
	-->

	<!-- This script prevents links from opening in Mobile Safari. https://gist.github.com/1042026 -->
	<!--
	<script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script>
	-->

	<link rel="stylesheet" href="/css/normalize.css">
	<link rel="stylesheet" href="/wow_book/wow_book.css" type="text/css" />
	<link rel="stylesheet" href="/css/main.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@1.16.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
	<script src="/js/vendor/modernizr-2.7.1.min.js"></script>
</head>
<body>
    <div style="position: absolute; z-index:9999; top: 1em;right: 1em;">

        <a href="/quiz-now/{{$story->id}}" class="bg-blue-900 text-white p-2 rounded-lg text-lg font-bold">TAKE QUIZ</a>
    </div>
	<!-- Add your site or application content here -->
	<div class='book_container'>
		<div id="book">

        </div>
	</div>



	<!-- if you don't need support for IE8 use jquery 2.1 -->
	<!-- <script src="js/vendor/jquery-2.1.0.min.js"></script> -->
	<script src="/js/vendor/jquery-1.11.2.min.js"></script>

	<script src="/js/helper.js"></script>

	<script type="text/javascript" src="/wow_book/pdf.combined.min.js"></script>
	<script src="/wow_book/wow_book.min.js"></script>
	<!-- <script src="js/main.js"></script> -->
	<script>
		$(function(){
			var bookOptions = {
				 height   : 500
				,width    : 800
				// ,maxWidth : 800
				,maxHeight : 600

				,centeredWhenClosed : true
				,hardcovers : true
				,pageNumbers: false
				,toolbar : "lastLeft, left, right, lastRight, fullscreen, thumbnails, home"
				,thumbnailsPosition : 'left'
				,responsiveHandleWidth : 50

				,container: window
				,containerPadding: "20px"
				,pdf: "/storage/{{$story->content}}",
                homeURL: '/story-mode',
			};

			$('#book').wowBook( bookOptions ); // create the book
		})
	</script>

</body>
</html>
