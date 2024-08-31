<div class="navbar">
    testing
</div>
<div class="sidebar">
    <div class="sidebar__brand">Southern Library</div>
    <hr>
    <ul class="sidebar__nav">

        <li class="sidebar__nav__item"><a href="../../../Prakom/View/mainpage.php?page=home" class="sidebar__nav__item__link btn btn-secondary"><span class="SidebarBtnText"><span class="material-symbols-outlined">home</span>Home</span></a></li>

        <?php
        if ($_SESSION['Level'] == 'PMJ') {
        ?>
            <li class="sidebar__nav__item"><a href="#" class="sidebar__nav__item__link btn btn-secondary"><span class="SidebarBtnText"><span class="material-symbols-outlined">home</span>Library</span></a></li>
            <li class="sidebar__nav__item"><a href="#" class="sidebar__nav__item__link btn btn-secondary"><span class="SidebarBtnText"><span class="material-symbols-outlined">home</span>My Loan</span></a></li>

        <?php
        } elseif ($_SESSION['Level'] == 'ADM' or 'PTG') {
        ?>
            <li class="sidebar__nav__item"><a href="../../../Prakom/View/mainpage.php?page=operate" class="sidebar__nav__item__link btn btn-secondary"><span class="SidebarBtnText"><span class="material-symbols-outlined">build</span>operate</span></a></li>
        <?php
        }
        ?>
        <li class="sidebar__nav__item"><a href="../../../Prakom/View/mainpage.php?page=profile" class="sidebar__nav__item__link btn btn-secondary"><span class="SidebarBtnText"><span class="material-symbols-outlined">person</span>Profile</span></a></li>
    </ul>
</div>