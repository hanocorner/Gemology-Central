<style>
    @import url('https://fonts.googleapis.com/css?family=Lato:400,900&display=swap');

    header,
    footer,
    aside,
    nav,
    form,
    .menu,
    .hero,
    .adslot {
        display: none;
    }

    p {
        margin: 0 !important;
    }

    .canvas-size {
        max-width: 612px;
    }

    canvas {
        display: block;
        margin: 0 auto;
    }

    table {
        font-family: 'Lato', sans-serif;
        margin-top: 4px;
        margin-left: 6px;
        width: 100%;
        border-collapse: collapse;
        border: none;
    }

    table td {
        font-size: 18px;
    }
    .image {
        position: relative;
    }
    .image>.qr {
        width: 95px;
        padding: 1px;
        border: 1px solid #00adee;
        border-radius: 1px;
        position: absolute;
        top: 138px;
        right: 1px;
    }

    .download-btn {
        display: block;
        max-width: 130px;
        margin: 0 auto;
    }
</style>

<div class="container">
    <input type="hidden" id="repID" value="<?php echo $result->repoid; ?>">
<div class="d-flex bg-white p-1 my-3 mx-auto canvas-size" id="capture">
            <table cellspacing="0" cellpadding="0">
                <tbody>

                    <tr>
                        <td width="32%" class="text-uppercase">Date</td>
                        <td><?php echo $result->date; ?></td>
                    </tr>
                    <tr>
                        <td width="32%" class="text-uppercase">GCL Memo No</td>
                        <td>
                            <?php echo $result->repoid; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="32%" class="text-uppercase">Color</td>
                        <td><?php echo $result->color; ?></td>
                    </tr>
                    <tr>
                        <td width="32%" class="text-uppercase">Shape</td>
                        <td><?php echo $result->shapecut; ?></td>
                    </tr>
                    <tr>
                        <td width="32%" class="text-uppercase">Weight</td>
                        <td id="weight"><?php echo $result->weight; ?>&nbsp;ct</td>
                    </tr>
                    <tr>
                        <td width="32%" class="text-uppercase">Measurements</td>
                        <td><?php echo $result->dimensions; ?>&nbsp;mm</td>
                    </tr>
                    <tr>
                        <td  style="font-weight:900;" width="32%" class="text-uppercase">Variety</td>
                        <td style="font-weight:900;"><?php echo $result->variety; ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight:900;" width="32%" class="text-uppercase">Species/Group</td>
                        <td style="font-weight:900;"><?php echo $result->spgroup; ?></td>
                    </tr>

                    <tr>
                        <td style="font-weight:900;" width="32%" class="text-uppercase">Comments</td>
                        <td style="font-weight:900;"><?php echo $result->comment; ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="image">
                <img class="qr" src="<?php echo base_url('assets/images/qr/'.$result->repoid.'.png');?>">
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-center my-3">
            <img src="<?php echo base_url('images/download-data.png');?>" class="img-fluid" alt="Data image">
            <h5 class="text-center text-muted ml-3">Your image</h5>
        </div>
        
        <span id="exCanvas"></span>

        <div class="d-flex align-items-center justify-content-center my-3">
            <a href="#" id="downloadBtn" class="btn btn-danger mr-4"><i class="fa fa-download fa-fw"></i> Download</a>
            <a href="<?php echo base_url('admin/report/published'); ?>"  class="btn btn-light "><i class="fa fa-arrow-left fa-fw"></i> Go back</a>
        </div>
        
</div>