<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<style>
            @media only screen and (max-width: 600px) {
                .main_logo{
                    width: 350px;
                }
                .row_2_div1{
                    display: none;
                }
                .certificates{
                    width: 300px;
                    float: left!important;
                }
                .img_book{
                   width: 300px; 
                }
                .vl{
                   display: none; 
                }
                .picture{
                    width: 250px;
                    height: 200px;
                }
                #logo_footer{
                    width:350px;
                }
                
}
</style>
        <html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap-3.3.7/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/styles/style_page.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>GCL</title>
        
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <img class="main_logo" src="<?php echo base_url()?>assets/images/logo_main.jpg"/>
                </div>
                                
                <div class="col-md-5 pull-right" style="padding-top: 75px;">
                    <p style="font-size: 20px;font-weight: bold"><i class="fa fa-phone"></i> +94771234567 &nbsp;&nbsp;&nbsp;
                    <i class="fa fa-envelope"></i> info@gemologycentral.com
                    </p>
                </div>
            </div>    
            <div class="row row_2">
                <div class="col-md-1 row_2_div1">
                    <a href=""><i style="font-weight: bold; font-size: 40px; padding-top: 75px;"  class="fa fa-angle-left"></i></a>
                </div>
                <div class="col-md-5 row_2_div2" >
                    <span style="font-weight: 400; font-size: 30px;">Welcome to GCL</span>
                    <br/><br/>
                        
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed 
                        do eiusmod tempor incididunt ut labore et dolore magna aliqua
                    </p>    
                                               
                    <button type="button" class="btn btn-primary btn-lg"><span style="font-size: 15px;">READ MORE</span></button>
                         
                </div>
                <div class="col-md-5 row_2_div3" style="position: relative;">
                    <i style="position: relative; top: 90%" class="fa fa-circle-o"></i>&nbsp;&nbsp;
                    <i style="position: relative; top: 90%" class="fa fa-circle-o"></i>&nbsp;&nbsp;
                    <i style="position: relative; top: 90%" class="fa fa-circle-o"></i>&nbsp;&nbsp;
                    <i style="position: relative; top: 90%" class="fa fa-circle-o"></i>&nbsp;&nbsp;
                </div>
                <div class="col-md-1 row_2_div1">
                    <a href=""><i style="font-weight: bold; font-size: 40px; padding-top: 75px;"  class="fa fa-angle-right"></i></a>
                </div>
            </div>
            
            <div class="row row3">
                <div class="col-md-6 ">
                    <img class="pull-right certificates" src="<?php echo base_url()?>assets/images/certificat_1.jpg"/>
                </div>
                <div class="col-md-6 certificates">
                    <img class="certificates" src="<?php echo base_url()?>assets/images/certificat_2.jpg"/>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 row4_div1" >
                    <img class="img_book" src="<?php echo base_url();?>assets/images/img_book.jpg" />
                </div>
                
                <div class="col-md-1 vl" style=" padding-top: 50px;">
                    <img style="padding-top: 100px;"  src="<?php echo base_url();?>assets/images/vertical_line.jpg" height="500px"/>
                </div>
               
                <div class="col-md-5"  style=" padding-top: 200px;">
                     <img src="<?php echo base_url() ?>assets/images/img_logo_1.jpg">
                     <span style="font-size: 20px;">Obtain your certificate today</span>
                     <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed 
                        do eiusmod tempor incididunt ut labore et dolore magna aliqua
                     </p>
                     <button type="button" class="btn btn-primary">Get Your Report</button>
                </div>    
            </div>
            
           
            
            