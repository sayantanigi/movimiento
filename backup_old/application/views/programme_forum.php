<main>
    <section class="signup__area po-rel-z1 pt-100 pb-50">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center mb-55">
                        <?php if(!empty($tab)) { ?>
                        <h2 class="section__title">PROGRAMME DU FORUM #MAKUTANO8</h2>
                        <?php } else { ?>
                        <h2 class="section__title">PROGRAMME DU FORUM #MAKUTANO9</h2>
                        <?php } ?>
                        <nav>
                            <ol class="breadcrumbnav mb-lg-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Programme du Forum</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="po-rel-z1 pb-50">
        <div class="container">
            <?php if(!empty($tab)) { ?>
            <div class="p-3 text-center bg-gold mb-3">
                <h4>#MAKUTANO8 FORUM PROGRAM</h4>
                <h4>INFINITELY TERRITORIES</h4>
            </div>
            <?php } else { ?>
            <div class="p-3 text-center bg-gold mb-3">
                <h4>MAKUTANO 9</h4>
                <h4>SOFITEL ABIDJAN HÔTEL IVOIRE</h4>
                <p class="mb-0 text-white">Bd Hassan II, Abidjan, Côte d’Ivoire</p>
            </div>
            <?php } ?>
            <div class="forumtabBox">
                <ul class="nav nav-pills mb-40 flex-column flex-sm-row forumtab" id="pills-tab" role="tablist">
                    <?php 
                    $i = 1; 
                    foreach ($programme as $value) { ?>
                    <li class="nav-item flex-fill" role="presentation">
                        <button class="nav-link w-100 rounded-0 <?php if($i == '1') { echo "active"; }?>" id="pills-home<?=$i?>-tab" data-bs-toggle="pill" data-bs-target="#pills-home<?=$i?>" type="button" role="tab" aria-controls="pills-home<?=$i?>" aria-selected="true"><?= ucwords($value['title']) ?></button>
                    </li>
                    <?php $i++; } ?>
                </ul>
                <div class="tab-content bg-white text-dark" id="pills-tabContent">
                    <?php 
                    $j = 1; 
                    foreach ($programme as $value) { ?>
                    <div class="tab-pane fade show <?php if($j == '1') { echo "active"; }?>" id="pills-home<?= $j?>" role="tabpanel" aria-labelledby="pills-home<?= $j?>-tab">
                        <div class="p-3 text-center bg-gold">
                            <h2 class="h5 fw-bold mb-0">DRESS CODE : <?= $value['dress_code']?></h2>
                        </div>
                        <div class="p-3 text-center border-bottom border-danger">
                            <?= $value['description']?>
                        </div>
                    </div>
                    <?php $j++; } ?>
                </div>
            </div>
        </div>
    </section>
</main>