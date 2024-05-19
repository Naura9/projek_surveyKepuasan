<?php
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];
?>

<link rel="stylesheet" href="../header.css">

<style>
        .sidebar-nav li a {
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar-nav li a:hover, .sidebar-nav li.active a {
            background-color: rgba(190, 184, 209, 0.5);
            border-radius: 4px;
        }

        .sidebar-nav li a i {
            margin-right: 5px;
        }

        .sidebar-nav li {
            margin-bottom: 2px;
        }

        .username img {
            margin-left: 750px;
        }

        .username span {
            margin-left: 45px;
        }

        .logout {
            margin-left: 0px;
            margin-right: 30px;
        }
</style>

        <nav class="navbar">
            <div class="logo">
                <img src="img/logo-nama.png" alt="Logo" width="100">
            </div>
            <div class="username">
                <span><?php echo $nama; ?> | Mahasiswa</span>
                <img src="img/<?php echo $profil_image; ?>" alt="User" width="35" height="35" style="border-radius: 50%;">
                <a href="../login/logout.php" class="logout">
                    <i class="fa-solid fa-arrow-right-from-bracket logout"></i>
                </a>
            </div>
        </nav>
    </div>

    <nav class="sidebar">
        <ul class="sidebar-nav">
            <li class="">
                <a href="dashboard-mahasiswa.php" class="">
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
                    <li><a href="survey-pendidikan.php"><i class="fa-solid fa-medal"></i> Kualitas Pendidikan</a></li>
                    <li><a href="survey-fasilitas.php"><i class="fa-solid fa-layer-group"></i>     Fasilitas</a></li>                    
                    <li><a href="survey-pelayanan.php"><i class="fa-solid fa-handshake"></i>  Pelayanan</a></li>
                </ul>
            </li>
            <li class="">
                <a href="profil.php" class="">
                    <i class="fa-solid fa-user"></i>
                     Profile
                </a>
            </li>
        </ul>
    </nav>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var sidebarItems = document.querySelectorAll('.sidebar-nav li');

            sidebarItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    // Remove active class from all items
                    sidebarItems.forEach(function(el) {
                        el.classList.remove('active');
                    });

                    // Add active class to the clicked item
                    this.classList.add('active');

                    // Store the active item in localStorage
                    localStorage.setItem('activeSidebarItem', this.querySelector('a').getAttribute('href'));
                });
            });

            // Set the active item based on localStorage
            var activeItem = localStorage.getItem('activeSidebarItem');
            if (activeItem) {
                sidebarItems.forEach(function(item) {
                    if (item.querySelector('a').getAttribute('href') === activeItem) {
                        item.classList.add('active');
                    }
                });
            }
        });
    </script>
