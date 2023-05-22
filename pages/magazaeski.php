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

            .d-flex {
                display: flex !important;
                flex-direction: row-reverse !important;
            }
        </style>

        <div style="opacity:0" class="sc-jJoQJp bATEBn __pf" id="__pf">
            <div data-pf-type="Body" class="sc-evcjhq leJfDA pf-1_">
                <div data-pf-type="Layout" class="sc-ctqQKy hrYNC pf-2_" style="text-align: center;">
                    <div data-parallax="true" data-parallax-speed="4" style="--overlay:rgba(0, 0, 0, 0)" data-section-id="pf-3d75" data-pf-type="Section" class="sc-uojGG cmSGgF pf-12_">
                        <div class="sc-bilyIR GPOte"></div>
                        <div class="sc-ilfuhL bpQaoh">
                            <div class="sc-ikJyIC iIcPdk pf-13_ pf-r pf-r-eh" style="--s-xs:0px" data-pf-type="Row">
                                <div class="pf-c" style="--c-xs:12;--c-lg:12">
                                    <div data-pf-type="Column" class="sc-fHeRUh hpWXZa pf-14_">
                                        <div class="sc-ikJyIC iIcPdk pf-15_ pf-r pf-c-ct pf-r-eh" style="--s-xs:4px;--s-sm:3px;--s-md:5px;--s-lg:4px" data-pf-type="Row">


                                            <h3 data-pf-type="Heading" class="sc-jUosCB gcYDfN pf-17_"><span data-pf-type="Text" class="sc-gyElHZ fxaypC pf-19_"><?php echo dilbak($dilID, 56); ?></span>
                                            </h3>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <?php
                        $magazasor = $mysqli->query("SELECT * FROM sahap WHERE menu = 22 AND  durum = 'on' AND dil=$dilID ORDER BY sira asc");
                        while ($magaza = $magazasor->fetch_array()) {
                            $resimURL = 'href="' . $magaza['son3'] . '"';
                        ?>
                            <div data-section-id="pf-c4ca" data-pf-type="Section" class="sc-uojGG cmSGgF pf-30_ " style="marginÇ auto;">
                                <div style="--cw:1900px" class="sc-ilfuhL bpQaoh">
                                    <div class="sc-ikJyIC iIcPdk pf-31_ pf-r pf-c-cm pf-r-eh <?php echo ($magaza['sira'] % 2) ? 'd-flex' : ''; ?>" style="--s-xs:0px;--s-sm:15px;--s-lg:10px" data-pf-type="Row">
                                        <a <?php echo ($magaza['son3'] != '') ? $resimURL  : ''; ?>>
                                            <div class="pf-c" style="">


                                                <img width="100%" height="auto" src="uploads/<?php echo $magaza['resim']; ?>">



                                            </div>
                                        </a>
                                        <div class="pf-c" style="--c-xs:12;--c-md:6;--c-lg:5">
                                            <div data-pf-type="Column" class="sc-fHeRUh hpWXZa pf-35_">
                                                <p class="sc-xiLah fvOkQT pf-36_" data-pf-type="Paragraph">

                                                    <span data-pf-type="Text" class="sc-gyElHZ fxaypC pf-38_"><?php echo $magaza['baslik']; ?></span>
                                                </p>
                                                <p data-pf-type="Paragraph" style="padding: 3%;">

                                                    <span data-pf-type="Text" class="sc-gyElHZ fxaypC pf-41_">
                                                        <?php echo $magaza['icerik1']; ?>
                                                    </span>
                                                </p>
                                                <p data-pf-type="Paragraph" style="padding: 3%;">
                                                    <span data-pf-type="Text" class="sc-gyElHZ fxaypC pf-41_">
                                                        <?php echo $magaza['son1']; ?>
                                                    </span>
                                                </p>
                                                <p data-pf-type="Paragraph" style="padding: 3%;">
                                                    <span data-pf-type="Text" class="sc-gyElHZ fxaypC pf-41_">
                                                        <?php echo $magaza['son2']; ?>
                                                    </span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>


                </div>
            </div>
        </div>

    </div>