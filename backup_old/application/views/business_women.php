<main>
    <section class="pt-200 pb-120 instbanner" style="background-image: url(<?= base_url()?>assets/img/makutano-wib-2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="p-5 bg-white">
                        <h6 class="text-danger h5 fw-bold">WOMEN IN BUSINESS</h6>
                        <p>The network of women of influence from Central Africa is taking shape and, with its five years of existence, continues to promote exceptional networking. After welcoming more than 250 women leaders, during Makutano 5, and had the immense honor of receiving HE Mr. Elle Jonhson Sirleaf, Honorary President of Liberia, the Distinguished First Lady of the DRC, Denise Nyakeru Tshisekedi, and the Honorable President of the The National Assembly of the DRC, Jeanine Mabunda, female business leaders will meet again on December 5, at the Pullman Hotel.</p>
                        <p>Whether it is about breaking the "glass ceiling" in companies, opening the way to higher education for young women in certain remote areas of the country or in certain underprivileged areas, or directing students towards political or scientific careers, the WIB strives to implement innovative strategies adapted to African contexts to better communicate and better inspire women in order to break their isolation.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="po-rel-z1 pt-50 pb-50">
        <div class="container">
            <div class="row g-2">
                <?php if(!empty($business_women)) { 
                foreach ($business_women as $value) { ?>
                <div class="col-lg-4 col-6">
                    <a href="<?= base_url()?>uploads/portfolio/<?php echo $value['image']?>" data-fancybox="group" class="galleryBox">
                        <img src="<?= base_url()?>uploads/portfolio/<?php echo $value['image'] ?>" />
                    </a>
                </div>
                <?php } } else { ?>
                <div class="col-lg-4 col-6">No data found</div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>
<style>
.pt-200 {padding-top: 250px !important;}
.bg-white{background-color: #ffffff40 !important;}
.bg-white p{color: #fff !important;}
.text-danger{color: #fff !important;}
</style>