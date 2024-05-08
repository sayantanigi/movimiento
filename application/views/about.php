<main>
    <section class="pt-100 pb-145">
        <div class="container">
            <div class="section__title-wrapper text-center mb-55 mt-50">
                <h2 class="section__title"><?php echo $aboutData[0]['title']?></h2>
            </div>
            <div class="faqpnl">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample" style="display: block;">
                            <div class="accordion-body"><?= $aboutData[0]['description']?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<style>
.accordion-body * {color: #fff;}
</style>