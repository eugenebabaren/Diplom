<?php
include("include/auth_cookie.php");
?>

<nav class="navbar fixed-top navbar-expand-lg navbar-light white scrolling-navbar">
    <div class="container-fluid">
        <a href="index.php" class="navbar-brand mr-4"><img src="images/logo.svg" width="120vw" alt="logo"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mr-2">
                    <a href="#" class="nav-link waves-effect">КАТАЛОГ</a>
                </li>
                <li class="nav-item mr-2">
                    <a href="#" class="nav-link waves-effect">О НАС</a>
                </li>
                <li class="nav-item mr-2">
                    <a href="#" class="nav-link waves-effect">ОПЛАТА И ДОСТАВКА</a>
                </li>
                <li class="nav-item mr-2">
                    <a href="#" class="nav-link waves-effect">КОНТАКТЫ</a>
                </li>
                <li class="nav-item mr-2">
                    <a href="#" class="nav-link waves-effect">НОВОСТИ</a>
                </li>
                <li class="nav-item mr-2">
                    <a href="#" class="nav-link waves-effect">ВОПРОСЫ И ОТВЕТЫ</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link waves-effect">ОБРАТНАЯ СВЯЗЬ</a>
                </li>
            </ul>
            <ul>
                <ul class="navbar-nav nav-flex-icons mt-3">
                    <li class="nav-item mr-1">
                        <a href="#" class="nav-link border border-light rounded waves-effect">
                            <i class="fas fa-heart"></i>
                        </a>
                    </li>
                    <li class="nav-item mr-1">
                        <a href="cart.php?action=oneclick" class="nav-link border border-light rounded waves-effect">
                            <i id="fa-shopping-basket" class="fas fa-shopping-basket badge-wrapper">
                                <span class='badge badge-danger ml-1'>1</span>
                            </i>
                        </a>
                    </li>
                    <li id="profile_icon" class="nav-item mr-1" hidden>
                        <a href="profile.php" class="nav-link border border-light rounded waves-effect">
                            <i class="far fa-user-circle"></i>
                        </a>
                    </li>
                    <li class="nav-item mr-1">
                        <a href="sign_in.php" id="sign_in_link" class="nav-link border border-light rounded waves-effect">
                            <b id="sign_in_navbar_title_old" class="sign_in_navbar_title">ВХОД</b>
                            <i id="sign_in_navbar_title_new" class="sign_in_navbar_title" hidden></i>
                        </a>
                    </li>
                    <li id="reg_remove" class="nav-item">
                        <a href="registration.php" class="nav-link border border-light rounded waves-effect">
                            <b>РЕГИСТРАЦИЯ</b>
                        </a>
                    </li>
                </ul>
            </ul>
        </div>
    </div>
</nav>