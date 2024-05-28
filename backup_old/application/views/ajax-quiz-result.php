
<div class="mb-5">
    <h4>Score:<span style="float: right;"><a onclick="getQuizTryAgain('<?php echo @$enrollment_id; ?>', '<?php echo @$id; ?>', '<?php echo $keyId; ?>', '<?php echo $page; ?>');" style="padding:7px;" href="javascript:void(0);" class="button btn-primary btn-sm">Try Again</a></span></h4>
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th scope="col" style="text-align: center;" colspan="2">
                    <?php echo @$correctAttempt; ?> of <?php echo @$totalQuiz; ?> (<?php echo @$score; ?>%)
                    <div class="ansbox">
                        <label style="font-size: 12px; font-weight: 400;" class="<?php if($score > 50) { echo"bg-success-txt"; } else { echo"bg-danger-txt"; } ?>">
                            <?php echo @$message; ?>
                        </label>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Total number of questions</th>
                <td><?php echo @$totalQuiz; ?></td>
            </tr>
            <tr>
                <th scope="row">Number of answered questions</th>
                <td><?php echo @$totalAttempt; ?></td>
            </tr>
            <tr>
                <th scope="row">Number of unanswered questions</th>
                <td><?php echo @$notAttempt; ?></td>
            </tr>
            <tr>
                <th scope="row">Number of correct questions</th>
                <td><?php echo @$correctAttempt; ?></td>
            </tr>
        </tbody>
    </table>
</div>

<h4 class="mb-4">Quiz Results</h4>
<form name="quiz-form-result" id="form-result" autocomplete="off" method="post" action="javascript:void(0);">
    <?php
        $quizList = $this->db->get_where('course_quiz', array('material_id' => $id))->result();

        if (!empty($optionArray)) {
            $c=1;
            foreach ($optionArray as $value) {

                $quizDataSql = "SELECT * FROM `course_quiz` WHERE `id` = '".$value['id']."'";
                $qs = $this->db->query($quizDataSql)->row();

                $correctans = $qs->correct_answer;  
    ?>
        <div class="mb-4">
            <h5 class="mb-2">
                <?php echo $c; ?>. <?= $qs->question ?>
                <input type="hidden" name="questions-<?php echo @$i; ?>[]" value="<?= $qs->id ?>">
            </h5>

            <div class="ansbox ">
                <label class="d-flex justify-content-between <?php if($correctans=="ans1") { if(@$value['choice']=="ans1"){ echo"bg-success"; } } else { if(@$value['choice']=="ans1"){ echo"bg-danger"; } } ?>">
                    <div class="d-flex">
                        <div class="markcontainer">
                            <?php if($correctans=="ans1") { ?>
                                <?php
                                    if(@$value['choice']=="ans1"){
                                        echo'<i class="fa fa-check text-success"></i>'; 
                                    } 
                                ?>
                                
                            <?php } else {  ?>
                                <?php
                                    if(@$value['choice']=="ans1"){
                                        echo'<i class="fa fa-times text-danger"></i>'; 
                                    } 
                                ?>
                            <?php } ?>
                            
                        </div> <?= $qs->ans1 ?>
                    </div>
                    <div>
                        <?php 
                            if($correctans=="ans1") { 
                                echo'<div class="badge">Correct Answer</div>'; 
                            } else { 
                                if(@$value['choice']=="ans1"){
                                    echo'<div class="badge">Your Answer</div>'; 
                                } 
                            } 
                        ?>
                    </div>
                </label>
            </div>

            <div class="ansbox ">
                <label class="d-flex justify-content-between <?php if($correctans=="ans2") { if(@$value['choice']=="ans2"){ echo"bg-success"; } } else { if(@$value['choice']=="ans2"){ echo"bg-danger"; } } ?>">
                    <div class="d-flex">
                        <div class="markcontainer">
                            <?php if($correctans=="ans2") { ?>
                                <?php
                                    if(@$value['choice']=="ans2"){
                                        echo'<i class="fa fa-check text-success"></i>'; 
                                    } 
                                ?>
                            <?php } else {  ?>
                                <?php
                                    if(@$value['choice']=="ans2"){
                                        echo'<i class="fa fa-times text-danger"></i>'; 
                                    } 
                                ?>
                            <?php } ?>
                        </div> <?= $qs->ans2 ?>
                    </div>
                    <div>
                        <?php 
                            if($correctans=="ans2") { 
                                echo'<div class="badge">Correct Answer</div>'; 
                            } else { 
                                if(@$value['choice']=="ans2"){
                                    echo'<div class="badge">Your Answer</div>'; 
                                } 
                            } 
                        ?>
                    </div>
                </label>
            </div>

            <div class="ansbox">
                <label class="d-flex justify-content-between <?php if($correctans=="ans3") { if(@$value['choice']=="ans3"){ echo"bg-success"; } } else { if(@$value['choice']=="ans3"){ echo"bg-danger"; }  } ?>">
                    <div class="d-flex">
                        <div class="markcontainer">
                            <?php if($correctans=="ans3") { ?>
                                <?php
                                    if(@$value['choice']=="ans3"){
                                        echo'<i class="fa fa-check text-success"></i>'; 
                                    } 
                                ?>
                            <?php } else {  ?>
                                <?php
                                    if(@$value['choice']=="ans3"){
                                        echo'<i class="fa fa-times text-danger"></i>'; 
                                    } 
                                ?>
                            <?php } ?>
                        </div> <?= $qs->ans3 ?>
                    </div>
                    <div>
                        <?php 
                            if($correctans=="ans3") { 
                                echo'<div class="badge">Correct Answer</div>'; 
                            } else { 
                                if(@$value['choice']=="ans3"){
                                    echo'<div class="badge">Your Answer</div>'; 
                                } 
                            } 
                        ?>
                    </div>
                </label>
            </div>

            <div class="ansbox">
                <label class="d-flex justify-content-between <?php if($correctans=="ans4") { if(@$value['choice']=="ans4"){ echo"bg-success"; } } else { if(@$value['choice']=="ans4"){ echo"bg-danger"; }  } ?>">
                    <div class="d-flex">
                        <div class="markcontainer">
                            <?php if($correctans=="ans4") { ?>
                                <?php
                                    if(@$value['choice']=="ans4"){
                                        echo'<i class="fa fa-check text-success"></i>'; 
                                    } 
                                ?>
                            <?php } else {  ?>
                                <?php
                                    if(@$value['choice']=="ans4"){
                                        echo'<i class="fa fa-times text-danger"></i>'; 
                                    } 
                                ?>
                            <?php } ?>
                        </div> <?= $qs->ans4 ?>
                    </div>
                    <div>
                        <?php 
                            if($correctans=="ans4") { 
                                echo'<div class="badge">Correct Answer</div>'; 
                            } else { 
                                if(@$value['choice']=="ans4"){
                                    echo'<div class="badge">Your Answer</div>'; 
                                } 
                            } 
                        ?>
                    </div>
                </label>
            </div>
        </div>
<?php $c++; } } ?>
</form>

<style>
    .ansbox label{
        padding: 5px;
        background: #f7f7f7;
        color: #000;
    }
    .markcontainer{
        min-width: 22px;
    }
    .ansbox .badge{
        background: #eee;
        font-size: 13px;
        font-weight: 500;
        padding: 3px 8px;
    }
    .ansbox label.bg-success{
        background: #C3E6CB !important;
    }
    .ansbox label.bg-danger{
        background: #F5C6CBCB !important;
    }

    .ansbox label.bg-success-txt{
        color: #09bf33 !important;
    }
    .ansbox label.bg-danger-txt{
        color: #e11128cb !important;
    }
</style>
<script>
    function getQuizTryAgain(enrollment_id, id, key, page) {
        $('#quizResultHTML-' + key).empty();
        $('#quizResultHTML-' + key).hide();
        $('#quizHTML-' + key).show();

        if(page=="end") {
            $('.material-plquiz-' + key).hide();

            $('.material-nxtqz2-' + key).show();
            $('.material-submitqz2-' + key).hide();
        } else {
            $('.material-plquiz-' + key).show();

            $('.material-nxtqz2-' + key).hide();
            $('.material-submitqz2-' + key).hide();
        }

        $('.material-nxquiz-' + key).hide();

        $('.material-nxtqz-' + key).show();
        $('.material-submitqz-' + key).hide();
    }
</script>