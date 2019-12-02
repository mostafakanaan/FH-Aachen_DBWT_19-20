<?php

if(file_exists("controllers/".$_GET['url'].".php")){
    include("controllers/".$_GET['url'].".php");
    }
