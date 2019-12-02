<style>
    @import url('https://fonts.googleapis.com/css?family=Lato:400,900&display=swap');

    html,
    body {
        font-family: 'Open Sans', sans-serif;
    }

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
        width: 420px;
        height: 500px;
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
        font-size: 13px;
    }

    .image {
        position: relative;
    }

    .image>.qr {
        width: 80px;
        padding: 1px;
        border: 1px solid #00adee;
        border-radius: 1px;
        position: absolute;
        top: 42px;
        left: 52%;
    }

    .image p:nth-child(1) {
        position: relative;
        top: 18px;
        left: 52%;
        font-size: 14px;
    }

    .image p:nth-child(2) {
        position: absolute;
        transform: rotate(-90deg);
        left: 40%;
        top: 73px;
        font-size: 14px;
    }

    .download-btn {
        display: block;
        max-width: 130px;
        margin: 0 auto;
    }
</style>

<div class="container">
    <input type="hidden" id="repID" value="<?php echo $result->repoid; ?>">
    <div class="d-flex align-items-start justify-content-around">
        <div class="d-flex flex-column bg-white p-1 my-3 canvas-size" id="capture">
            <table cellspacing="5" cellpadding="2">
                <tbody>
                    <tr>
                        <td width="200" class="text-uppercase">report no</td>
                        <td>
                            <?php echo $result->repoid; ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="200" class="text-uppercase">Date</td>
                        <td><?php echo $result->date; ?></td>
                    </tr>
                    <tr>
                        <td width="200" class="text-uppercase">Object</td>
                        <td id="object"><?php echo $result->object; ?></td>
                    </tr>
                    <tr>
                        <td><br /></td>
                    </tr>
                    <tr>
                        <td width="200" class="text-uppercase"><strong>Variety</strong></td>
                        <td><strong><?php echo $result->variety; ?></strong></td>
                    </tr>
                    <tr>
                        <td width="200" class="text-uppercase"><strong>Species/Group</strong></td>
                        <td id="spgroup"><strong><?php echo $result->spgroup; ?></strong></td>
                    </tr>
                    <tr>
                        <td><br /></td>
                    </tr>
                    <tr>
                        <td width="200" class="text-uppercase">Weight</td>
                        <td id="weight"><?php echo $result->weight; ?></td>
                    </tr>
                    <tr>
                        <td width="200" class="text-uppercase">Dimensions</td>
                        <td><?php echo $result->dimensions; ?></td>
                    </tr>
                    <tr>
                        <td width="200" class="text-uppercase">Shape & Cut</td>
                        <td><?php echo $result->shapecut; ?></td>
                    </tr>
                    <tr>
                        <td width="200" class="text-uppercase">Color</td>
                        <td><?php echo $result->color; ?></td>
                    </tr>
                    <tr>
                        <td><br /></td>
                    </tr>
                    <tr>
                        <td width="200" class="text-uppercase"><strong>Comments</strong></td>
                        <td style="line-height:8px;"><strong><?php echo $result->comment; ?></strong></td>
                    </tr>
                    <tr>
                        <td><br /></td>
                    </tr>
                </tbody>
            </table>
            <div class="image">
                <p>Verification</p>
                <p>Verification</p>
                <img class="qr" src="<?php echo base_url('assets/images/qr/'.$result->repoid.'.png');?>">
            </div>

        </div>
        <span class="my-3" id="exCanvas"></span>
    </div>








</div>

<div class="d-flex align-items-center justify-content-center my-3">
    <a href="#" id="downloadBtn" class="btn btn-danger mr-4"><i class="fa fa-download fa-fw"></i> Download</a>
    <a href="<?php echo base_url('admin/report/published'); ?>" class="btn btn-light "><i
            class="fa fa-arrow-left fa-fw"></i> Go back</a>
</div>