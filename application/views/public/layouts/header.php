<body class="ht-autoboot">
    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="<?php echo base_url(); ?>">
          <picture>
					  <source media="(min-width: 465px)" srcset="<?php echo base_url('assets/public/images/gcl-logo.png')?>">
					  <img src="<?php echo base_url('images/gcl-mob-logo.png')?>" alt="Kirulads Logo" class="main_logo">
				  </picture>
            <!-- <img class="main_logo" src=""/> -->
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url(); ?>">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('blog'); ?>">Blog</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('about'); ?>">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#contactModal">Contact</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link btn btn-primary px-3 my-3 my-md-0" href="<?php echo base_url('report'); ?>">Verify your Report</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
