<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Laravel</title>

<!-- Google Font -->

<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

<!-- Bootstrap -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

/* ---------- DARK MODE (Nova style) ---------- */

html[data-theme="dark"] body{
background:#06090f;
color:#e5e7eb;
}

html[data-theme="dark"] .navbar{
background:linear-gradient(to right,#0d1117,#06090f);
border-bottom:1px solid #1e293b;
}

html[data-theme="dark"] select.form-select{
background:#111827;
color:#e5e7eb;
border:1px solid #334155;
}

html[data-theme="dark"] .chart-box{
background:#161b22;
border:1px solid #334155;
box-shadow:
0 10px 25px rgba(0,0,0,0.5),
0 0 0 1px rgba(255,255,255,0.02);
}

/* ---------- LIGHT MODE ---------- */

html[data-theme="light"] body{
background:#eef1f4;
color:#111827;
}

html[data-theme="light"] .navbar{
background:linear-gradient(to right,#161b22,#0d1117);
border-bottom:1px solid #d1d5db;
}

html[data-theme="light"] select.form-select{
background:white;
color:#111827;
border:1px solid #d1d5db;
}

html[data-theme="light"] .chart-box{
background:#252d37;
border:1px solid #e5e7eb;
box-shadow:
0 10px 25px rgba(0,0,0,0.08),
0 0 0 1px rgba(0,0,0,0.02);
}

html[data-theme="light"] #themeToggle{
border:1px solid #3a87c4;
color:#e8e8e8;
}

/* ---------- Shared ---------- */

.chart-box{
padding:25px;
border-radius:12px;
transition:all .25s ease;
max-width:1200px;
margin:auto;
}

.chart-box:hover{
transform:translateY(-4px);
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg">
<div class="container d-flex justify-content-between">

<a class="navbar-brand text-white" href="/">Laravel</a>

<button id="themeToggle" class="btn btn-sm btn-outline-light">
Toggle Theme
</button>

</div>
</nav>

<div class="container mt-4">
@yield('content')
</div>

<footer class="text-center mt-5 mb-3 text-muted">
© {{ date('Y') }} Laravel
</footer>

<script>

document.addEventListener("DOMContentLoaded", function(){

const toggle = document.getElementById("themeToggle");

/* restore saved theme */

const saved = localStorage.getItem("theme");
if(saved){
document.documentElement.setAttribute("data-theme", saved);
}

/* toggle theme */

toggle.addEventListener("click", function(){

let current = document.documentElement.getAttribute("data-theme");

if(current === "dark"){
document.documentElement.setAttribute("data-theme","light");
localStorage.setItem("theme","light");
}else{
document.documentElement.setAttribute("data-theme","dark");
localStorage.setItem("theme","dark");
}

});

});

</script>

</body>
</html>
