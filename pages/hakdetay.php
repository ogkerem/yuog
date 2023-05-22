<?php 
$hakk = $mysqli->query("SELECT * FROM sahap where menu = 4 AND dil = $dilID AND durum = 'on' and seo = $seoID")->fetch_array();
$galeriID = $hakkYazi['id'];
?>

<main id="main" role="main">
    <div id="shopify-section-template--15189590081706__pf-33ba1c16" class="shopify-section">

        <script>
            window.__pagefly_analytics_settings__ = {
                acceptTracking: true
            };
        </script>
        <script>
            window.__pagefly_global_settings__ = {
                fontFamilies: ["Playfair Display", "Lato", "Source Sans Pro"],
                selectedFonts: {
                    "Playfair Display": {
                        "400": 0
                    },
                    "Lato": {
                        "400": 0
                    },
                    "Source Sans Pro": {
                        "400": 0
                    }
                }
            };
        </script>

<style>
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    label {
        font-size: 1.5em;
        font-family: "Montserrat, sans-serif" !important;
        letter-spacing: 1.7px;
    }
    
    p {
        font-family: montserrat;
        font-size: 16px;
        letter-spacing: 1.7px;
    }
</style>

        <div style="opacity:0" class="sc-jJoQJp bATEBn __pf" id="__pf">
            <div data-pf-type="Body" class="sc-evcjhq leJfDA pf-1_">
                <div data-pf-type="Layout" class="sc-ctqQKy hrYNC pf-2_">
                    <div data-parallax="true" data-parallax-speed="4" style="--overlay:rgba(0, 0, 0, 0)" data-section-id="pf-3d75" data-pf-type="Section" class="sc-uojGG cmSGgF pf-12_">
                        <div class="sc-bilyIR GPOte"></div>
                        <div class="sc-ilfuhL bpQaoh">
                            <div class="sc-ikJyIC iIcPdk pf-13_ pf-r pf-r-eh" style="--s-xs:0px" data-pf-type="Row">
                                <div class="pf-c" style="--c-xs:12;--c-lg:12">
                                    <div data-pf-type="Column" class="sc-fHeRUh hpWXZa pf-14_">
                                        <div class="sc-ikJyIC iIcPdk pf-15_ pf-r pf-c-ct pf-r-eh" style="--s-xs:4px;--s-sm:3px;--s-md:5px;--s-lg:4px" data-pf-type="Row">
                                            <div class="pf-c" style="--c-xs:12;--c-sm:6;--c-lg:6">
                                                <div data-pf-type="Column" class="sc-fHeRUh hpWXZa pf-16_">
                                                    <h3 data-pf-type="Heading" class="sc-jUosCB gcYDfN pf-17_"><span data-pf-type="Text" class="sc-gyElHZ fxaypC pf-19_"><?php echo dilbak($dilID, 136); ?></span></h3>
                                                </div>
                                            </div>
                                            <div class="pf-c" style="--c-xs:12;--c-sm:6;--c-lg:6">
                                                <div data-pf-type="Column" class="sc-fHeRUh hpWXZa pf-20_">
                                                    <h3 data-pf-type="Heading" class="sc-jUosCB gcYDfN pf-21_"><span data-pf-type="Text" class="sc-gyElHZ fxaypC pf-23_"><?php echo dilbak($dilID, 137); ?></span></h3>
                                                    <h3 data-pf-type="Heading" class="sc-jUosCB gcYDfN pf-24_"><span data-pf-type="Text" class="sc-gyElHZ fxaypC pf-26_"><?php echo dilbak($dilID, 138); ?></span></h3>
                                                </div>
                                            </div>
                                        </div>
                                        <p class="sc-xiLah fvOkQT pf-27_" data-pf-type="Paragraph"><span data-pf-type="Text" class="sc-gyElHZ fxaypC pf-29_">
                                                <?php
                                                $hakkGenel = $mysqli->query("SELECT * FROM bilgi WHERE konu = 'Hakkımızda' AND durum = 1 AND dil = $dilID")->fetch_array();
                                                echo $hakkGenel['icerik'];
                                                ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                        <div data-section-id="pf-c4ca" data-pf-type="Section" id="Stores" class="sc-uojGG cmSGgF pf-30_">
                            <div style="--cw:1900px" class="sc-ilfuhL bpQaoh">
                                <div class="sc-ikJyIC iIcPdk pf-31_ pf-r pf-c-cm pf-r-eh" style="--s-xs:0px;--s-sm:15px;--s-lg:10px" data-pf-type="Row">
                                    <div class="pf-c" style="--c-xs:12;--c-md:6;--c-lg:7">
                                        <div data-pf-type="Column" class="sc-fHeRUh hpWXZa pf-32_">
                                            <div>
                                                <img width="100%" height="auto" src="uploads/<?php echo $hakk['resim']; ?>">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="pf-c" style="--c-xs:12;--c-md:6;--c-lg:5">
                                        <div data-pf-type="Column" class="sc-fHeRUh hpWXZa pf-35_">
                                            <p class="sc-xiLah fvOkQT pf-36_" data-pf-type="Paragraph">
                                                <span data-pf-type="Text" class="sc-gyElHZ fxaypC pf-38_"><?php echo $hakk['baslik']; ?></span>
                                            </p>
                                            <p data-pf-type="Paragraph"><span data-pf-type="Text" class="sc-gyElHZ fxaypC pf-41_">
                                                    <?php echo $hakk['icerik1']; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                   

                  
                  
                </div>
            </div>
        </div>

    </div>
</main>