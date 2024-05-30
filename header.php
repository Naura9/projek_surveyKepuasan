<?php
$username = $_SESSION['username'];
$role = $_SESSION['role'];
$nama = $_SESSION['nama'];
?>

<link rel="stylesheet" href="../header.css">

<style>
   
        .logout {
            margin-left: 0px;
            margin-right: 30px;
        }

        .survey-box {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 30px;
            display: flex;
            align-items: center;
            width: 450px;
            height: 200px;
            margin-left: 300px;
            margin-top: 40px;
        }

        .survey-count {
            font-size: 28px;
            font-weight: bold;
            margin-left: 50px;
            margin-right: 16px;
        }

        .icon {
            margin-left: 50px;
            font-size: 60px;
        }

        .survey-text {
            font-size: 13px;
            color: #555555;
        }

        .message {
            width: 5px;
            margin-left: 885px;

        
        }
        .sidebar-nav .active > a {
    background-color: #BEB8D1;
    border-radius: 4px;
    }

 
</style>

        <nav class="navbar">
            <div class="logo">
                <img src="img/logo-nama.png" alt="Logo" width="100">
            </div>
            <div class="username">
                <span><?php echo $nama; ?> | 
                    <?php 
                    if ($_SESSION['role'] == 'mahasiswa') {
                        echo 'Mahasiswa';
                    } elseif ($_SESSION['role'] == 'industri') {
                        echo 'Industri';
                    } elseif ($_SESSION['role'] == 'alumni') {
                        echo 'Alumni';
                    } elseif ($_SESSION['role'] == 'ortu') {
                        echo 'Orang Tua';
                    } elseif ($_SESSION['role'] == 'tendik') {
                        echo 'Tendik';
                    } elseif ($_SESSION['role'] == 'dosen') {
                        echo 'Dosen';
                    } 
                    ?></span>
                <img src="img/<?php echo $profil_image; ?>" alt="User" width="35" height="35" style="border-radius: 50%; margin-left: 820px;">
                <a href="../login/logout.php" class="logout">
                    <i class="fa-solid fa-arrow-right-from-bracket logout"></i>
                </a>
            </div>
        </nav>
    </div>

    <nav class="sidebar">
        <ul class="sidebar-nav">
            <li class="">
                <a href="<?php 
                    if ($_SESSION['role'] == 'mahasiswa') {
                        echo 'dashboard-mahasiswa.php';
                    } elseif ($_SESSION['role'] == 'industri') {
                        echo 'dashboard-industri.php';
                    } elseif ($_SESSION['role'] == 'alumni') {
                        echo 'dashboard-alumni.php';
                    } elseif ($_SESSION['role'] == 'ortu') {
                        echo 'dashboard-ortu.php';
                    } elseif ($_SESSION['role'] == 'tendik') {
                        echo 'dashboard-tendik.php';
                    } elseif ($_SESSION['role'] == 'dosen') {
                        echo 'dashboard-dosen.php';
                    } 
                ?>" class="">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>            
            </li>
            <li class="">
                <a href="#" class="" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                    <i class="fa-solid fa-list-ol"></i> Survey
                    <span class="lni lni-chevron-down"></span>
                </a>
                <ul id="auth" class="collapse" data-bs-parent="#sidebar">
                <?php
                if ($_SESSION['role'] === 'mahasiswa' || $_SESSION['role'] === 'ortu' || $_SESSION['role'] === 'tendik' || $_SESSION['role'] === 'dosen') {
                    echo '
                        <li><a href="survey-pendidikan.php"><i class="fa-solid fa-medal"></i> Kualitas Pendidikan</a></li>
                        <li><a href="survey-fasilitas.php"><i class="fa-solid fa-layer-group"></i> Fasilitas</a></li>                    
                        <li><a href="survey-pelayanan.php"><i class="fa-solid fa-handshake"></i> Pelayanan</a></li>
                    ';
                } elseif ($_SESSION['role'] === 'industri') {
                    echo '
                        <li><a href="survey-pelayanan.php"><i class="fa-solid fa-handshake"></i> Pelayanan</a></li>
                        <li><a href="survey-lulusan.php"><i class="fa-solid fa-user-graduate"></i> Lulusan</a></li>
                    ';
                } elseif ($_SESSION['role'] === 'alumni') {
                    echo '
                        <li><a href="survey-pelayanan.php"><i class="fa-solid fa-handshake"></i> Pelayanan</a></li>
                    ';
                }
                ?>
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
        var sidebarItems = document.querySelectorAll('.sidebar-nav > li > a');
        var subSidebarItems = document.querySelectorAll('.sidebar-nav .collapse li > a');

        function removeActiveClass() {
            sidebarItems.forEach(function(el) {
                el.parentElement.classList.remove('active');
            });
            subSidebarItems.forEach(function(el) {
                el.parentElement.classList.remove('active');
            });
        }

        sidebarItems.forEach(function(item) {
            item.addEventListener('click', function() {
                removeActiveClass();

                this.parentElement.classList.add('active');

                localStorage.setItem('activeSidebarItem', this.getAttribute('href'));
                localStorage.removeItem('activeSubSidebarItem');
            });
        });

        subSidebarItems.forEach(function(item) {
            item.addEventListener('click', function(event) {
                event.stopPropagation();
                removeActiveClass();

                this.parentElement.classList.add('active');
                this.closest('.collapse').previousElementSibling.parentElement.classList.add('active');

                localStorage.setItem('activeSubSidebarItem', this.getAttribute('href'));
                localStorage.setItem('activeSidebarItem', this.closest('.collapse').previousElementSibling.getAttribute('href'));
            });
        });

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