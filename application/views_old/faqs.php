<main>
    <section class="pt-100 pb-145">
        <div class="container">
            <div class="section__title-wrapper text-center mb-55 mt-50">
                <h2 class="section__title">FAQ's</h2>
            </div>
            <div class="faqpnl">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <?php if(!empty($faqs)) {
                    $i = 1; 
                    foreach($faqs as $val) { ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne_<?= $i?>" aria-expanded="false" aria-controls="flush-collapseOne_<?= $i?>"><?= $val['title']?></button>
                        </h2>
                        <div id="flush-collapseOne_<?= $i?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body"><?= $val['description']?></div>
                        </div>
                    </div>
                    <?php $i++; } } else { ?>
                    <?php ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo"> Is the network politically engaged? </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                            data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">No. The Makutano network is apolitical and secular.</div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</main>
<style>
.accordion-body * {color: #fff;}
</style>