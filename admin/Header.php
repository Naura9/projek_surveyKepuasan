<!-- partials.php -->
<?php
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];
?>

<style>
        .sidebar-nav li a {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar-nav li a i {
            margin-right: 10px;
        }

        .sidebar-nav li {
            margin-bottom: 10px;
        }

        .sidebar-nav .collapse li a:hover, .sidebar-nav .collapse li.active > a {
            background-color: grey;
            border-radius: 4px;
        }

        .username span {
            margin-left: 45px;
        }
        .message {
            width: 5px;
            margin-left: 800px;

        }
        .logout {
            margin-left: ;
            margin-right: 30px;
        }

</style>
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
                <i class="fa-solid fa-arrow-right-from-bracket logout"></i>
            </a>
        </div>
    </nav>
</div>

<nav class="sidebar">
    <ul class="sidebar-nav">
        <li class="">
            <a href="dashboard-admin.php" class="">
                <i class="fa-solid fa-house"></i>
                Dashboard
            </a>
        </li>
        <li class="">
            <a href="#" class="" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
            <i class="fa-solid fa-list-ol"></i> Survey
                <span class="lni lni-chevron-down"></span>
            </a>
            <ul id="auth" class="" data-bs-parent="#sidebar">
                <li><a href="SurveyPendidikan.php"><i class="fa-solid fa-medal"></i> Kualitas Pendidikan</a></li>
                <li><a href="SurveyFasilitas.php"><i class="fa-solid fa-layer-group"></i>     Fasilitas</a></li>                    
                <li><a href="SurveyPelayanan.php"><i class="fa-solid fa-handshake"></i>  Pelayanan</a></li>
                <li><a href="SurveyLulusan.php"><i class="fa-solid fa-graduation-cap"></i>  Lulusan</a></li>
            </ul>
        </li>
        <li class="">
            <a href="responden-survey.php" class="">
                <i class="fa-solid fa-user-group"></i>
                Responden
            </a>
        </li>
        <li class="">
            <a href="laporan-survey.php" class="">
                <i class="fa-solid fa-book-open"></i>
                Laporan
            </a>
        </li>
    </ul>
</nav>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var sidebarItems = document.querySelectorAll('.sidebar-nav > li');
            var subSidebarItems = document.querySelectorAll('.sidebar-nav .collapse li');

            sidebarItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    // Remove active class from all items
                    sidebarItems.forEach(function(el) {
                        el.classList.remove('active');
                    });
                    subSidebarItems.forEach(function(el) {
                        el.classList.remove('active');
                    });

                    // Add active class to the clicked item
                    this.classList.add('active');

                    // Store the active item in localStorage
                    localStorage.setItem('activeSidebarItem', this.querySelector('a').getAttribute('href'));
                });
            });

            subSidebarItems.forEach(function(item) {
                item.addEventListener('click', function(event) {
                    event.stopPropagation();
                    // Remove active class from all items
                    subSidebarItems.forEach(function(el) {
                        el.classList.remove('active');
                    });

                    // Add active class to the clicked item
                    this.classList.add('active');

                    // Store the active item in localStorage
                    localStorage.setItem('activeSubSidebarItem', this.querySelector('a').getAttribute('href'));
                });
            });

            // Set the active item based on localStorage
            var activeItem = localStorage.getItem('activeSidebarItem');
            var activeSubItem = localStorage.getItem('activeSubSidebarItem');

            if (activeItem) {
                sidebarItems.forEach(function(item) {
                    if (item.querySelector('a').getAttribute('href') === activeItem) {
                        item.classList.add('active');
                    }
                });
            }

            if (activeSubItem) {
                subSidebarItems.forEach(function(item) {
                    if (item.querySelector('a').getAttribute('href') === activeSubItem) {
                        item.classList.add('active');
                    }
                });
            }
        });
    </script>
