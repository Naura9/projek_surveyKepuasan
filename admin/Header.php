<?php
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/96cfbc074b.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../header.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>

    <style>
        .username span {
            margin-left: 45px;
        }
        .username {
        background-color: #ececed;
        flex-grow: 1;
        display: flex;
        align-items: center; 
        border-left: 2px solid #ccc;
        height: 80px;
        border-bottom: 2px solid #a9a9ac;
        justify-content: space-between;
        }

        .username i {
        font-size: 23px;
        color: black;
        }
        .sidebar-nav li a {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar-nav li a i {
            margin-right: 10px;
        }

        .sidebar-nav li {
            margin-bottom: 10px;
        }

        .sidebar-nav .collapse li a:hover, .sidebar-nav .collapse li.active > a {
            background-color: #BEB8D1;
            border-radius: 4px;
        }

        

        .message {
            width: 5px;
            margin-left: 885px;

        
        }
        .sidebar-nav .active > a {
            background-color: #BEB8D1;
            border-radius: 4px;
        }
        .logout {
                    margin-left: 0px;
                    margin-right: 30px;
                }
                

    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar">
            <div class="logo">
                <img src="img/logo-nama.png" alt="Logo" width="100">
            </div>
            <div class="username">
                <span><?php echo $nama; ?> | Admin </span>
                <a href="permintaan-user.php" class="message">
                    <i class="fa-regular fa-envelope"></i>
                </a>
                <a href="../login/logout.php" class="logout">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>
            </div>
        </nav>
    </div>

    <nav class="sidebar">
        <ul class="sidebar-nav">
            <li>
                <a href="dashboard-admin.php">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="fa-solid fa-list-ol"></i> Survey
                    <span class="lni lni-chevron-down"></span>
                </a>
                <ul id="auth" class="collapse" data-bs-parent="#sidebar">
                    <li><a href="SurveyPendidikan.php"><i class="fa-solid fa-medal"></i> Kualitas Pendidikan</a></li>
                    <li><a href="SurveyFasilitas.php"><i class="fa-solid fa-layer-group"></i> Fasilitas</a></li>                    
                    <li><a href="SurveyPelayanan.php"><i class="fa-solid fa-handshake"></i> Pelayanan</a></li>
                    <li><a href="SurveyLulusan.php"><i class="fa-solid fa-graduation-cap"></i> Lulusan</a></li>
                </ul>
            </li>
            <li>
                <a href="responden-survey.php">
                    <i class="fa-solid fa-user-group"></i>
                    Responden
                </a>
            </li>
            <li>
                <a href="laporan-survey.php">
                    <i class="fa-solid fa-book-open"></i>
                    Laporan
                </a>
            </li>
        </ul>
    </nav>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
       document.addEventListener("DOMContentLoaded", function() {
    var sidebarItems = document.querySelectorAll('.sidebar-nav > li > a');
    var subSidebarItems = document.querySelectorAll('.sidebar-nav .collapse li > a');

    // Function to remove active class from all items
    function removeActiveClass() {
        sidebarItems.forEach(function(el) {
            el.parentElement.classList.remove('active');
        });
        subSidebarItems.forEach(function(el) {
            el.parentElement.classList.remove('active');
        });
    }

    // Add event listener to sidebar items
    sidebarItems.forEach(function(item) {
        item.addEventListener('click', function() {
            // Remove active class from all items
            removeActiveClass();

            // Add active class to the clicked item
            this.parentElement.classList.add('active');

            // Store the active item in localStorage
            localStorage.setItem('activeSidebarItem', this.getAttribute('href'));
            localStorage.removeItem('activeSubSidebarItem');
        });
    });

    // Add event listener to sub-sidebar items
    subSidebarItems.forEach(function(item) {
        item.addEventListener('click', function(event) {
            event.stopPropagation();
            // Remove active class from all items
            removeActiveClass();

            // Add active class to the clicked item
            this.parentElement.classList.add('active');
            this.closest('.collapse').previousElementSibling.parentElement.classList.add('active');

            // Store the active sub-item in localStorage
            localStorage.setItem('activeSubSidebarItem', this.getAttribute('href'));
            localStorage.setItem('activeSidebarItem', this.closest('.collapse').previousElementSibling.getAttribute('href'));
        });
    });

    // Set the active item based on localStorage
    var activeItem = localStorage.getItem('activeSidebarItem');
    var activeSubItem = localStorage.getItem('activeSubSidebarItem');

    if (activeItem) {
        sidebarItems.forEach(function(item) {
            if (item.getAttribute('href') === activeItem) {
                item.parentElement.classList.add('active');
            }
        });
    }

    if (activeSubItem) {
        subSidebarItems.forEach(function(item) {
            if (item.getAttribute('href') === activeSubItem) {
                item.parentElement.classList.add('active');
                item.closest('.collapse').classList.add('show');
                item.closest('.collapse').previousElementSibling.parentElement.classList.add('active');
            }
        });
    }
});

    </script>
</body>
</html>