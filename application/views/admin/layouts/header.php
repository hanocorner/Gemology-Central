<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
      <a class="navbar-brand" href="index.html">Gemology Central Laboratory</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
            <a class="nav-link" href="<?php echo base_url();?>admin/profile">
              <i class="fa fa-tachometer" aria-hidden="true"></i>&nbsp;&nbsp;
              <span class="nav-link-text">Dashboard</span>
            </a>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Report">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsereport" data-parent="#exampleAccordion">
              <i class="fa fa-certificate" aria-hidden="true"></i>&nbsp;&nbsp;
              <span class="nav-link-text">Gemstone</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapsereport">
              <li>
                <a href="<?php echo base_url();?>admin/report">All</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/report/add-customer">Add Customer</a>
              </li>
            </ul>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Blog">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseblog" data-parent="#exampleAccordion">
              <i class="fa fa-file-text-o" aria-hidden="true"></i>&nbsp;&nbsp;
              <span class="nav-link-text">Blog</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapseblog">
              <li>
                <a href="<?php echo base_url();?>admin/blog">All Articles</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/blog/add-article">Add Article</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/comment">Comments</a>
              </li>
            </ul>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Settings">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsesettings" data-parent="#exampleAccordion">
              <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;
              <span class="nav-link-text">Settings</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapsesettings">
              <li>
                <a href="<?php echo base_url();?>admin/setting/change-information">Change Information</a>
              </li>
              <li>
                <a href="<?php echo base_url();?>admin/setting/change-password">Change Password</a>
              </li>
            </ul>
          </li>

          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="frontend">
            <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapsefrontend" data-parent="#exampleAccordion">
              <i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;&nbsp;
              <span class="nav-link-text">Front end</span>
            </a>
            <ul class="sidenav-second-level collapse" id="collapsefrontend">
              <li>
                <a href="#">Banner</a>
              </li>
              <li>
                <a href="#">Feedback</a>
              </li>
            </ul>
          </li>

        </ul>
        <ul class="navbar-nav sidenav-toggler">
          <li class="nav-item">
            <a class="nav-link text-center" id="sidenavToggler">
              <i class="fa fa-fw fa-angle-left"></i>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>admin/home/logout">
              <i class="fa fa-fw fa-power-off"></i>&nbsp; Logout</a>
          </li>
        </ul>
      </div>
    </nav>
