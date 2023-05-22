<header class="navbar navbar-expand-lg fixed-top">
    <div class="container"><a class="navbar-brand pe-sm-3" href="/home">
            <img style="width: 175px" src="uploads/<?php echo $genelbak['logo']; ?>" alt="YUOG">
        </a>
        <div class="form-check form-switch mode-switch order-lg-2 me-3 me-lg-4 ms-auto" data-bs-toggle="mode">
            <input class="form-check-input" type="checkbox" id="theme-mode">
            <label class="form-check-label" for="theme-mode"><i class="ai-sun fs-lg"></i></label>
            <label class="form-check-label" for="theme-mode"><i class="ai-moon fs-lg"></i></label>
        </div>

        <?php if (@$_SESSION['id'] == false) { ?>
            <a class="btn btn-primary btn-sm fs-sm order-lg-3 d-none d-sm-inline-flex" href="uye-giris"><i class="ai-login fs-xl me-2 ms-n1"></i>Giriş Yap</a>
        <?php } else { ?>
            <a class="btn btn-primary btn-sm fs-sm order-lg-3 d-none d-sm-inline-flex" href="hesabim"><i class="ai-dashboard fs-xl me-2 ms-n1"></i>Hesabım</a>
        <?php } ?>
        <!-- <a class="btn btn-primary btn-sm fs-sm order-lg-3 d-none d-sm-inline-flex" href="logout"><i class="ai-logout fs-xl me-2 ms-n1"></i>Çıkış</a> -->
        <button class="navbar-toggler ms-sm-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"><span class="navbar-toggler-icon"></span></button>
        <nav class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav navbar-nav-scroll m-auto" style="--ar-scroll-height: 520px;">

                <?php
                $systemReq = $mysqli->query("SELECT * FROM sistem WHERE durum = 'on' AND ust = 'on' ORDER BY sira ASC");
                foreach ($systemReq as $system) {
                    $sID = $system['id'];
                    $sd = $mysqli->query("SELECT * FROM sistemdil WHERE menuID = $sID AND dilID = $dilID")->fetch_assoc();
                ?>
                    <li class="nav-item <?php echo ($sID == 2 || $sID == 4) ? 'dropdown' : ''; ?>">
                        <a class="nav-link <?php echo ($sID == 2 || $sID == 4) ? 'dropdown-toggle' : ''; ?>" href="/<?php echo $sd['dsef']; ?>"><?php echo $sd['dname']; ?></a>
                        <?php if ($sID == 2 || $sID == 4) { ?>
                            <ul class="dropdown-menu">
                                <?php
                                $icerikler = $mysqli->query("SELECT * FROM sahap WHERE menu = $sID AND durum = 'on' AND dil = $dilID ORDER BY sira ASC ");
                                foreach ($icerikler as $data) {
                                ?>
                                    <li class="dropdown">
                                        <a class="dropdown-item" href="<?php echo seocuk($data['seo']); ?>"><?php echo $data['baslik']; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </li>
                <?php } ?>
            </ul>
            <div class="d-sm-none p-3 mt-n3"><a class="btn btn-primary w-100  mb-1" href="login"><i class="ai-login fs-xl me-2 ms-n1"></i>Giriş Yap</a></div>
        </nav>
    </div>
</header>