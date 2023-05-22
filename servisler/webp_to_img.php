<?php
// require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/head.php");
// require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/header.php");
if ($_SESSION['id']) {
    // $uyeid = $_SESSION['id'];
    // $uyeveri = $mysqli->query("SELECT * FROM uyeler WHERE id ='$uyeid' ")->fetch_assoc();
?>

    <section class="py-3">
        <div class="container py-5 mt-4 mt-lg-5 mb-lg-4 my-xl-5">
            <div class="row pt-sm-2 pt-lg-0">
                <?php require_once $_SERVER['DOCUMENT_ROOT'] . '/userSections/musteriSidebar.php'; ?>
                <div class="col-lg-9 pt-4 pb-2 pb-sm-4">
                    <!-- <h1 class="h2 mb-4">Genel Bakış</h1> -->
                    <!-- Basic info-->
                    <section class="card border-0 py-1 p-md-2 p-xl-3 p-xxl-4 mb-4">
                        <div class="card-body">

                            <div>
                                <?php
                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    $uploadedFileNames = $_FILES['dosya']['name'];
                                    $uploadedFileSources = $_FILES['dosya']['tmp_name'];
                                    // $uploadedFiles = $_FILES['dosya'];
                                    // print_r($uploadedFileNames);
                                    // print_r($uploadedFileSource);



                                    $uploadedFileCount = count($uploadedFileNames);
                                    for ($i = 0; $i < $uploadedFileCount; $i++) {
                                        $uploadedFile = $uploadedFileNames[$i];
                                        $uploadedTMP = $uploadedFileSources[$i];

                                        $targetDirectory = "uploads/convert/";
                                        $targetFileName = $uploadedFile;
                                        $targetFile = $targetDirectory . $targetFileName;

                                        if (move_uploaded_file($uploadedTMP, $targetFile)) {
                                            $webpFile = $targetDirectory . pathinfo($targetFileName, PATHINFO_FILENAME) . '.webp';
                                            $imagick = new Imagick($targetFile);
                                            $imagick->setImageFormat('webp');
                                            $imagick->writeImage($webpFile);

                                            $imagePath = $webpFile;
                                            $resmiKaydet = $mysqli->query("INSERT INTO image_convert SET image_path = '$imagePath', musteriID = $uyeid, tarih = now()");
                                            if ($resmiKaydet) {
                                                echo "Görsel yolunu veritabanına başarıyla kaydettiniz.";
                                            } else {
                                                echo "Veritabanına kaydetme hatası: " . $mysqli->error();
                                            }
                                        } else {
                                            echo "Dosya yükleme hatası.";
                                        }
                                    }
                                }
                                ?>
                                <form action="" method="POST" enctype="multipart/form-data">
                                    <div class="w-100">
                                        <div class="row justify-content-between align-items-center pb_sm_3">
                                            <div class="col-lg-7">
                                                <h3 class="mb-0">Convert .WEBP</h3>
                                            </div>
                                            <div class="col-lg-5 webp_buttons">
                                                <a class="btn btn-primary py-2"> <i class="ai-cloud-download pe-2"></i> Kaydedilenler</a>
                                            </div>
                                        </div>
                                        <hr class="mt-2">

                                        <div class="row justify-content-between align-items-center pb_sm_3">
                                            <div class="col-lg-7">
                                                <input class="file_load form-control" type="file" name="dosya[]" multiple accept="image/*">
                                            </div>
                                            <div class="col-lg-5 webp_buttons">
                                                <button class="downloadAll btn btn-primary" type="button"><i class="ai-download pe-2"></i> Hepsini indir</button>
                                                <button type="submit" class="btn btn-outline-primary"> <i class="ai-save pe-2"></i> Kaydet</button>
                                            </div>
                                        </div>

                                        <div id="previews"></div>
                                        <div class="dropTarget" style="height: 400px"></div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <script>
        let refs = {};
        refs.imagePreviews = document.querySelector('#previews');
        refs.fileSelector = document.querySelector('input[type=file]');

        function addImageBox(container) {
            let imageBox = document.createElement("div");
            let progressBox = document.createElement("progress");
            imageBox.appendChild(progressBox);
            container.appendChild(imageBox);

            return imageBox;
        }

        function processFile(file) {
            if (!file) {
                return;
            }
            console.log(file);

            let imageBox = addImageBox(refs.imagePreviews);

            // Load the data into an image
            new Promise(function(resolve, reject) {
                    let rawImage = new Image();

                    rawImage.addEventListener("load", function() {
                        resolve(rawImage);
                    });

                    rawImage.src = URL.createObjectURL(file);
                })
                .then(function(rawImage) {
                    // Convert image to webp ObjectURL via a canvas blob
                    return new Promise(function(resolve, reject) {
                        let canvas = document.createElement('canvas');
                        let ctx = canvas.getContext("2d");

                        canvas.width = rawImage.width;
                        canvas.height = rawImage.height;
                        ctx.drawImage(rawImage, 0, 0);

                        canvas.toBlob(function(blob) {
                            resolve(URL.createObjectURL(blob));
                        }, "image/webp");
                    });
                })
                .then(function(imageURL) {
                    // Load image for display on the page
                    return new Promise(function(resolve, reject) {
                        let scaledImg = new Image();

                        scaledImg.addEventListener("load", function() {
                            resolve({
                                imageURL,
                                scaledImg
                            });
                        });

                        scaledImg.setAttribute("src", imageURL);
                    });
                })
                .then(function(data) {
                    // Inject into the DOM
                    let imageLink = document.createElement("a");

                    imageLink.setAttribute("href", data.imageURL);
                    imageLink.setAttribute('download', `${file.name}.webp`);
                    imageLink.appendChild(data.scaledImg);

                    imageBox.innerHTML = "";
                    imageBox.appendChild(imageLink);
                });
        }

        function processFiles(files) {
            for (let file of files) {
                processFile(file);
            }
        }

        function fileSelectorChanged() {
            processFiles(refs.fileSelector.files);
            // refs.fileSelector.value = "";
        }

        refs.fileSelector.addEventListener("change", fileSelectorChanged);

        // Set up Drag and Drop
        function dragenter(e) {
            e.stopPropagation();
            e.preventDefault();
        }

        function dragover(e) {
            e.stopPropagation();
            e.preventDefault();
        }

        function drop(callback, e) {
            e.stopPropagation();
            e.preventDefault();
            callback(e.dataTransfer.files);
        }

        function setDragDrop(area, callback) {
            area.addEventListener("dragenter", dragenter, false);
            area.addEventListener("dragover", dragover, false);
            area.addEventListener("drop", function(e) {
                drop(callback, e);
            }, false);
        }
        setDragDrop(document.documentElement, processFiles);

        function downloadAllImages() {
            // Get all image links inside the #previews element
            const imageLinks = document.querySelectorAll("#previews a");

            // Iterate over each image link and initiate download
            imageLinks.forEach((link, index) => {
                // Get the URL of the image
                const imageURL = link.getAttribute("href");

                // Set the download attribute and filename
                link.setAttribute("download", `image${index + 1}.webp`);

                // Simulate a click event to trigger the download
                link.click();
            });
        }

        // Add a click event listener to the "Kaydet" button
        const downloadButton = document.querySelector(".downloadAll");
        downloadButton.addEventListener("click", downloadAllImages);
    </script>

<?php
} else {
    header("Location: /uye-giris");
}
// require_once($_SERVER['DOCUMENT_ROOT'] . "/sections/footer.php");
?>