<!DOCTYPE html>
<html>
<head>
    <title>Movie Catalog Site</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    @vite(['resources/js/app.js'])
</head>
<body>

<!-- Sidebar (hidden by default) -->
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left"
     style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
    <a href="javascript:void(0)" onclick="w3_close()"
       class="w3-bar-item w3-button">Close Menu</a>
    {{$slot}}
</nav>
<div class="w3-top">
    <div class="w3-white w3-xlarge" id="row" style="max-width:1200px;margin:auto">
        <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰ Select Category </div>
        <div id="liveAlertPlaceholder" class="w3-center w3-padding-16"></div>
        <div class="w3-right form-inline">
            <div class="row">
            <div class="col-6"><input type="text" id="search"  class="form-control" name="search" placeholder="Movie Title.."></div>
            <div class="col-3"><button class="btn btn-light" onclick="showMoViesByTitleAndCategory()"  >Find</button></div>
            <div class="col-3"><a class="btn btn-light" href="/"  >reset</a></div>
            </div>
        </div>
    </div>
</div>
<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
