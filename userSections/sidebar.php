<style>
    .dashboard-sidebar-menu {
        /* background-color: #ffffff; */
        padding-top: 50px;
        padding-bottom: 50px;
        /* border: 1px solid #e3e9ed; */
        border-left: 0;
        position: fixed;
        left: 0;
        top: 92px;
        height: 100%;
        width: 400px;
        padding-left: 20px;
    }

    .dashboard-sidebar-menu ul {
        padding-left: 0;
        margin-bottom: 0;
        list-style-type: none;
    }

    .dashboard-sidebar-menu ul li {
        position: relative;
    }

    .dashboard-sidebar-menu ul li a {
        font-size: 18px;
        display: block;
        padding-top: 20px;
        padding-bottom: 20px;
        padding-left: 70px;
        /* padding-right: 100px; */
        /* border-bottom: 1px solid #e3e9ed; */
        /* color: #7d79eb; */
        text-decoration: none;
    }

    .dashboard-sidebar-menu ul li a.active {
        color: #ffffff;
        background-color: #7d79eb;
    }

    /*
    .dashboard-sidebar-menu ul li a.active i {
        color: #ffffff;
    } */

    .dashboard-sidebar-menu ul li a i {
        color: #7d79eb;
        position: relative;
        top: 3px;
        margin-right: 5px;
        -webkit-transition: all ease 0.5s;
        transition: all ease 0.5s;
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: rgba(0, 0, 0, .00);
        border-bottom: 1px solid rgba(0, 0, 0, .125);
        border-bottom: 1px solid rgba(0, 0, 0, .0);
    }

    .dashboard-area .container-fluid {
        max-width: 1760px;
        padding-left: 430px;
        padding-right: 30px;
        margin: auto;
    }
</style>

<div class="dashboard-sidebar-menu">
    <ul class="mt-4 card">
        <li>
            <a href="dashboard" class="<?php echo ($url == '/dashboard') ? 'acive' : ''; ?> nav-link">
                <i class="ai-dashboard lead pe-1 me-2 mb-2"></i>
                Dashboard
            </a>
        </li>
        <li>
            <a href="yurtici" class="<?php echo ($url == '/yurtici') ? 'acive' : ''; ?> nav-link">
                <img width="24" class="me-2 mb-2 pe-1" src="images/api_icons/yurtici.webp" alt="yurtici">
                Yurtiçi Kargo
            </a>
        </li>
        <li>
            <a href="trendyol-invoice" class="<?php echo ($url == '/trendyol-invoice') ? 'acive' : ''; ?> nav-link">
                <img width="24" class="me-2 mb-2 pe-1" src="images/api_icons/trendyolcom2977.jpg" alt="trendyol">
                Trendyol Invoice
            </a>
        </li>
       
        <li>
            <a href="logout" class="nav-link">
                <i class="ai-dashboard lead pe-1 me-2 mb-2"></i>
                Çıkış
            </a>
        </li>

    </ul>
</div>

<button class="d-lg-none btn btn-sm fs-sm btn-primary w-100 rounded-0 fixed-bottom" data-bs-toggle="offcanvas" data-bs-target="#sidebarAccount"><i class="ai-menu me-2"></i>Hesap Menu</button>