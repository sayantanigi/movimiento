<main>
    <section class="po-rel-z1 pt-100 pb-145">
        <img src="<?= base_url()?>assets/img/rdc_Makutano9_Abidjan_English_pages-to-jpg-0001-2048x1152.webp" class="img-fluid">
        <div class="container">
            <?php if(!empty($mak_zeronine)) { 
            foreach ($mak_zeronine as $val) { ?>
            <img src="uploads/maknine/<?= $val['image']?>" class="img-fluid">
            <?php } } ?>
        </div>
        <div>
            
            <img src="<?= base_url()?>assets/img/mak-09-14.webp" class="img-fluid">
        </div>
    </section>
</main>