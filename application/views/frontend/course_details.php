<section class="courseListpnl">
    <div class="container">
        <div class="cstm_class">
            <h4 class="fw-bold text-danger"><?= $getcourseData->course_name; ?></h4>
            <div class="col-lg-2">
                <div class="px-3 py-2 border rounded ">
                    <p class="mb-0 text-warning fw-bold">Only:</p>
                    <h2 class="mb-0 fw-bold text-warning">$<?= (int)$getcourseData->offer_price; ?></h2>
                    <span class="text-success">Save $<?= (int)$getcourseData->course_price - (int)$getcourseData->offer_price; ?></span>
                </div>
            </div>
        </div>
        <?= htmlspecialchars_decode($getcourseData->course_description); ?>
    </div>
</section>
<style>
.cstm_class{display: flex; flex-wrap: nowrap; flex-direction: row; align-items: center; justify-content: space-between;}
</style>