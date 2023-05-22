<?php

defined('YUOG') or exit('No direct script access allowed / Yetkisiz Erişim ');


?>

<div class="main-content">
    <div class="breadcrumb">
        <h1>Dashboard |</h1>
        <ul>
           
            <li>the future is here </li>
        </ul>
    </div>

    <div class="separator-breadcrumb border-top"></div>

    <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-Add-User"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Yöneticiler</p>
                        <?php $ybak = $mysqli->query("select * from admin "); ?>
                        <p class="text-primary text-24 line-height-1 mb-2"><?php echo $ybak->num_rows; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                <div class="card-body text-center">
                    <i class="i-File-Clipboard-File--Text"></i>
                    <div class="content">
                        <p class="text-muted mt-2 mb-0">Banner</p>
                        <?php $banbak = $mysqli->query("select * from banner "); ?>
                        <p class="text-primary text-24 line-height-1 mb-2"><?php echo $banbak->num_rows; ?></p>
                    </div>
                </div>
            </div>
        </div>


        <?php

        $sisbakk = $mysqli->query("select * from sistem where durum='on' order by sira asc ");
        while ($sisyazz = $sisbakk->fetch_array()) {
            $menuID     = $sisyazz['id'];
            $menusay     = $mysqli->query("select * from sahap where menu='$menuID' ")->num_rows;

            echo '<div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-File-Clipboard-File--Text"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">' . $sisyazz['menu'] . '</p>
					 
                                <p class="text-primary text-24 line-height-1 mb-2">' . $menusay . '</p>
                            </div>
                        </div>
                    </div>
                </div>';
        }

        ?>




    </div>

    <!--   <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Gelen Ödemeler</div>
                            <div id="echartBar" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
						<span class="badge badge-pill badge-warning">Aylık</span>
                            <div class="card-title">Hareket Noktaları</div>
							  
                            <div id="echartPie" style="height: 300px;"></div>
							
                        </div>
                    </div>
                </div>
            </div>  -->

    <!--   <div class="row">
                <div class="col-lg-6 col-md-12">

                    

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card o-hidden mb-4">
                                <div class="card-header d-flex align-items-center border-0">
                                    <h3 class="w-50 float-left card-title m-0">Bekleyen Rezervasyonlar</h3>
                                    <div class="dropdown dropleft text-right w-50 float-right">
                                        <button class="btn bg-gray-100" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="nav-icon i-Gear-2"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <a class="dropdown-item" href="#">Add new user</a>
                                            <a class="dropdown-item" href="#">View All users</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="">
                                    <div class="table-responsive">
                                        <table id="user_table" class="table  text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Adı Soyadı</th>
                                                    <th scope="col">Avatar</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Durum</th>
                                                    <th scope="col">İşlemler</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>Smith Doe</td>
                                                    <td>

                                                        <img class="rounded-circle m-0 avatar-sm-table " src="assets/images/faces/1.jpg" alt="">

                                                    </td>

                                                    <td>Smith@gmail.com</td>
                                                    <td><span class="badge badge-success">Active</span></td>
                                                    <td>
                                                        <a href="#" class="text-success mr-2">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                        </a>
                                                        <a href="#" class="text-danger mr-2">
                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jhon Doe</td>
                                                    <td>

                                                        <img class="rounded-circle m-0 avatar-sm-table " src="assets/images/faces/1.jpg" alt="">

                                                    </td>

                                                    <td>Jhon@gmail.com</td>
                                                    <td><span class="badge badge-info">Pending</span></td>
                                                    <td>
                                                        <a href="#" class="text-success mr-2">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                        </a>
                                                        <a href="#" class="text-danger mr-2">
                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">3</th>
                                                    <td>Alex</td>
                                                    <td>

                                                        <img class="rounded-circle m-0 avatar-sm-table " src="assets/images/faces/1.jpg" alt="">

                                                    </td>

                                                    <td>Otto@gmail.com</td>
                                                    <td><span class="badge badge-warning">Not Active</span></td>
                                                    <td>
                                                        <a href="#" class="text-success mr-2">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                        </a>
                                                        <a href="#" class="text-danger mr-2">
                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th scope="row">4</th>
                                                    <td>Mathew Doe</td>
                                                    <td>

                                                        <img class="rounded-circle m-0 avatar-sm-table " src="assets/images/faces/1.jpg" alt="">

                                                    </td>

                                                    <td>Mathew@gmail.com</td>
                                                    <td><span class="badge badge-success">Active</span></td>
                                                    <td>
                                                        <a href="#" class="text-success mr-2">
                                                            <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                        </a>
                                                        <a href="#" class="text-danger mr-2">
                                                            <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>


                <div class="col-lg-6 col-md-12">

                   
                    <div class="card mb-4">
                        <div class="card-body p-0">
                            <div class="card-title border-bottom d-flex align-items-center m-0 p-3">
                                <span>Acenta İşlemleri</span>
                                <span class="flex-grow-1"></span>
                                <span class="badge badge-pill badge-warning">Günlük</span>
                            </div>
                            <div class="d-flex border-bottom justify-content-between p-3">
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Pages / Visit</span>
                                    <h5 class="m-0">2065</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">New user</span>
                                    <h5 class="m-0">465</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Last week</span>
                                    <h5 class="m-0">23456</h5>
                                </div>
                            </div>
                            <div class="d-flex border-bottom justify-content-between p-3">
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Pages / Visit</span>
                                    <h5 class="m-0">1829</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">New user</span>
                                    <h5 class="m-0">735</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Last week</span>
                                    <h5 class="m-0">92565</h5>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between p-3">
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Pages / Visit</span>
                                    <h5 class="m-0">3165</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">New user</span>
                                    <h5 class="m-0">165</h5>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="text-small text-muted">Last week</span>
                                    <h5 class="m-0">32165</h5>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
 

            </div>  -->

    Sayın <strong><?php $maill  = $_SESSION['admin']['mail'];
                    $adminbul1 = $mysqli->query("select * from admin where mail='$maill'");
                    $adminbul  = $adminbul1->fetch_array();

                    echo $adminbul['adsoyad'];

                    ?> </strong>Panele Hoş Geldiniz.
    <hr />
    Panele Son Giriş : <?php
                        $oturumbak1 = $mysqli->query("select * from oturum where oturumacan='$maill' order by id desc limit 1,1");
                        $oturumbak    = $oturumbak1->fetch_array();
                        echo  $oturumbak['tarih'];
                        ?>
    <hr />


</div>