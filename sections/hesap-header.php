<!-- <header class="pt_urun_kat" style="display: grid;">
    <a href="/cikis" class="PageHeader__Back Heading Text--subdued"><?php echo dilbak($dilID, 70); ?></a>

    <a href="/siparislerim" class="PageHeader__Back Heading Text--subdued <?php echo ($url == 'siparislerim') ? 'h4' : '';  ?>"><?php echo dilbak($dilID, 68); ?></a>

    <a href="/sifre-degistir" class="PageHeader__Back Heading Text--subdued <?php echo ($url == 'sifre-degistir') ? 'h4' : '';  ?>"><?php echo dilbak($dilID, 67); ?></a>

    <a href="/hesabim" class="PageHeader__Back Heading Text--subdued <?php echo ($url == 'hesabim') ? 'h4' : '';  ?>"><?php echo dilbak($dilID, 69); ?></a>

    <a href="/havale-bilgileri" class="PageHeader__Back Heading Text--subdued <?php echo ($url == 'havale-bilgileri') ? 'h4' : '';  ?>"><?php echo dilbak($dilID, 66); ?></a>
    <hr>
    <div style="margin-bottom: 3%;" >
        <p class="SectionHeader__Description h4"><?php echo dilbak($dilID, 143); ?>, <?php echo $uyeveri['bayi_adi']; ?></p>
    </div>

</header> -->
<script src="https://kit.fontawesome.com/017f4ee974.js" crossorigin="anonymous"></script>

<style>
    a {
        text-decoration: none !important;
        color: inherit !important;
    }

    .menuItem {
        text-decoration: none !important;
        color: inherit !important;
    }

    .list-group-item {
        padding: 1rem 1rem;
    }

    .icon-size {
        font-size: large;
    }

    .br {
        border: 1px solid black !important;
        border-radius: 20px !important;
        background-color: black !important;
        align-items: center !important;
        justify-content: space-between !important;
        display: flex;
        transition: 0.3 !important;
    }

    .br:hover {
        transition: 0.3 !important;

        border: 1px solid black !important;
        background-color: white !important;
        color: black !important;
    }

    .br:hover i {
        transition: 0.3 !important;
        color: black !important;
    }
</style>


<div class="col-md-3">
    <ul class="list-group pb-4 pt-4">

        <div class="pt-2 pb-2">
            <a href="/urunlistesi" class="menuItem">
                <button type="button" class="list-group-item list-group-item-action active br icon-size" aria-current="true">
                    <i class="fas fa-box"></i><?php echo dilbak($dilID, 180); ?>
                </button>
            </a>
        </div>

        <div class="pt-2 pb-2">
            <a href="/urunarama" class="menuItem">
                <button type="button" class="list-group-item list-group-item-action active br icon-size" aria-current="true">
                <i class="fa-solid fa-magnifying-glass"></i><?php echo dilbak($dilID, 193); ?>
                </button>
            </a>
        </div>

        <div class="pt-2 pb-2">
            <a href="hesabim" class="menuItem">
                <button type="button" class="list-group-item list-group-item-action active br icon-size" aria-current="true">
                    <i class="fas fa-user icon-size"></i> <?php echo dilbak($dilID, 69); ?>
                </button>
            </a>
        </div>

        <div class="pt-2 pb-2">
            <a href="siparislerim" class="menuItem">
                <button type="button" class="list-group-item list-group-item-action active br icon-size" aria-current="true">
                    <i class="fas fa-box"></i><?php echo dilbak($dilID, 68); ?>
                </button>
            </a>
        </div>

        <div class="pt-2 pb-2">
            <a href="sifre-degistir" class="menuItem">
                <button type="button" class="list-group-item list-group-item-action active br icon-size" aria-current="true">
                    <i class="fas fa-lock"></i> <?php echo dilbak($dilID, 67); ?>
                </button>
            </a>
        </div>



        <div class="pt-2 pb-2">
            <a href="havale-bilgileri" class="menuItem">
                <button type="button" class="list-group-item list-group-item-action active br icon-size" aria-current="true">
                    <i class="fas fa-money-check"></i> <?php echo dilbak($dilID, 66); ?>
                </button>
            </a>
        </div>

        <div class="pt-2 pb-2">
            <a href="destek" class="menuItem">
                <button type="button" class="list-group-item list-group-item-action active br icon-size" aria-current="true">
                    <i class="fas fa-life-ring"></i> Destek
                </button>
            </a>
        </div>


        <div class="pt-2 pb-2">
            <a href="cikis" class="menuItem">
                <button type="button" class="list-group-item list-group-item-action active br icon-size" aria-current="true">
                    <i class="fas fa-sign-out"></i> <?php echo dilbak($dilID, 70); ?>
                </button>
            </a>
        </div>
    </ul>
</div>