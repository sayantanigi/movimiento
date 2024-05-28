<!-- Main content -->
<section class="content-header">
    <h1>
        <?= $title ?>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">
            <?= $title ?>
        </li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $title ?></h3>
                </div>
                <form action="<?= admin_url('programme_sejour/add/' . $programme_sejour->id) ?>" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Programme Sejor Name</label>
                                            <input type="text" name="frm[title]" value="<?= $programme_sejour->title ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Forum Date</label>
                                            <input type="date" name="frm[forum_date]" value="<?= $programme_sejour->forum_date ?>" class="form-control" id="forum_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Start Time</label>
                                            <input type="time" name="frm[start_time]" value="<?= $programme_sejour->start_time ?>" class="form-control" id="start_time">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">End Time</label>
                                            <input type="time" name="frm[end_time]" value="<?= $programme_sejour->end_time ?>" class="form-control" id="end_time">
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Dress Code</label>
                                            <input type="text" name="frm[dress_code]" value="<?= $programme_sejour->dress_code ?>" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea name="frm[description]" value="<?= $programme_sejour->description ?>" id="editor1"><?= $programme_sejour->description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Programme For</label>
                                            <select name="frm[programme_for]" class="form-control" id="exampleInputEmail1">
                                                <option value="">Select Programme For</option>
                                                <option value="mak_09" <?php if($programme_sejour->programme_for == 'mak_09'){echo "selected";}?>>Makutano 09</option>
                                                <option value="mak_08" <?php if($programme_sejour->programme_for == 'mak_08'){echo "selected";}?>>Makutano 08</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>