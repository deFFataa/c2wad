<?php

    $con = mysqli_connect("localhost", "root", "", "c2wad");

    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }