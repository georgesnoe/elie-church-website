<!-- Admin Header -->
<div class="header__top">
    <div class="header__container">
        <!-- Logo, Name, and Location Section -->
        <a class="header__brand" href="admin.php">
            <img src="https://placehold.co/80x80/00ffff/ff0000?text=LOGO" alt="Church Logo" class="header__logo">
            <div>
                <h1 class="header__name">Eglise méthodiste du Togo</h1>
                <p class="header__location">Tokoin Wuiti, Face école Ancilla</p>
            </div>
        </a>

        <!-- Navigation links section for Admin -->
        <nav class="header__nav">
            <ul class="header__nav-list">
                <li class="header__nav-item">
                    <a href="versets.php" class="header__nav-link">Versets</a>
                </li>
                <li class="header__nav-item">
                    <a href="activites.php" class="header__nav-link">Activités</a>
                </li>
                <li class="header__nav-item">
                    <a href="enseignements.php" class="header__nav-link">Enseignements</a>
                </li>
                <li class="header__nav-item">
                    <a href="admins.php" class="header__nav-link">Admins</a>
                </li>
            </ul>
        </nav>

        <!-- Hamburger menu for Admin -->
        <div class="header__hamburger">
            <svg class="header__menu-open" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 432 384"><path fill="currentColor" d="M0 336v-48h432v48H0zm0-120v-48h432v48H0zM0 48h432v48H0V48z"/></svg>
        </div>

        <!-- Menu for Admin -->
        <div class="header__menu">
            <div class="header__menu-control">
                <svg class="header__menu-close" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 304 384"><path fill="currentColor" d="M299 73L179 192l120 119l-30 30l-120-119L30 341L0 311l119-119L0 73l30-30l119 119L269 43z"/></svg>
            </div>
            <nav class="header__menu-nav">
                <ul class="header__menu-nav-list">
                    <li class="header__menu-nav-item">
                        <a href="versets.php" class="header__menu-nav-link">Versets</a>
                    </li>
                    <li class="header__menu-nav-item">
                        <a href="activites.php" class="header__menu-nav-link">Activités</a>
                    </li>
                    <li class="header__menu-nav-item">
                        <a href="enseignements.php" class="header__menu-nav-link">Enseignements</a>
                    </li>
                    <li class="header__menu-nav-item">
                        <a href="admins.php" class="header__menu-nav-link">Admins</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<div class="header__backdrop"></div>
<script>
    let menuOpen = document.querySelector(".header__menu-open");
    let menuClose = document.querySelector(".header__menu-close");
    let menu = document.querySelector(".header__menu");
    menuOpen.addEventListener("click", () => {
        menu.style.left = "0";
    });
    menuClose.addEventListener("click", () => {
        menu.style.left = "-100%";
    });
</script>
