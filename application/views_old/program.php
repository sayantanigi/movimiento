<main>
    <section class="signup__area po-rel-z1 pt-50 pb-50 bg-primary mt-100 conferencebg  bgbanner" style="background-image: url(./assets/img/mak.PR_.FAR_.jpeg);">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center pt-20 pb-20 mb-30">
                        <h2 class="section__title">PROGRAMME DU FORUM #MAKUTANO7</h2>
                        <h4 class="h3 fw-bold">INTERNATIONAL BUSINESS FORUM</h4>
                        <h4 class="h3 fw-bold"><i class="far fa-angle-double-left"></i> OUT OF THE BOX ! <i class="far fa-angle-double-right"></i></h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="po-rel-z1 pt-50 pb-50 text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="mb-3">
                        <img src="<?= base_url()?>uploads/cms/<?= $program->image?>" class="img-fluid" id="download_html"/>
                    </div>
                    <div class="mb-3">
                        <img src="<?= base_url()?>uploads/cms/<?= $program->image1?>" class="img-fluid"/>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="<?= base_url()?>uploads/programme-MAK7.pdf" class="e-btn bg-primary" id="download_button">DOWNLOAD THE PROGRAM</a>
            </div>
        </div>
    </section>
</main>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    const button = document.getElementById('download_button');
    function generatePDF() {
        // Choose the element that your content will be rendered to.
        const element = document.getElementById('download_html');
        // Choose the element and save the PDF for your user.
        html2pdf().from(element).save();
    }

    button.addEventListener('click', generatePDF);
</script>