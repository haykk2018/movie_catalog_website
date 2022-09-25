<!DOCTYPE html>
<html>
<head>
    <title>Movie Catalog Site</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
{{--    <link rel="stylesheet" href="{{ Vite::asset('resources/css/style.css') }}">--}}
{{--    @vite(['resources/css/style.css', 'resources/js/app.js'])--}}
    <style>
        input[type=text] {
            width: 100%;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 8px;
            font-size: 20px;
            background-color: white;
            background-image: url('searchicon.png');
            background-position: 10px 10px;
            background-repeat: no-repeat;
            padding: 5px 10px 5px 20px;
         }
        #row {
         margin-top: 0px !important;
        }
    </style>
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
        <div class="w3-center w3-padding-16"></div>
        <div class="w3-right ">
            <input type="text" name="search" placeholder="Search Movie..">
        </div>
    </div>
</div>
<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">
