<?php include('head.php') ?>
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card corona-gradient-card">
                  <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">
                      <div class="col-4 col-sm-3 col-xl-2">
                        <img src="admin/assets/images/dashboard/Group126@2x.png" class="gradient-corona-img img-fluid" alt="">
                      </div>
                      <div class="col-5 col-sm-7 col-xl-8 p-0">
                        <h4 class="mb-1 mb-sm-0">Announcement ! Announcement !! Announcement !!!</h4>
                        <p class="mb-0 font-weight-normal d-none d-sm-block">Welcome to MULAN Conference 2024 registration portal</p>
                      </div>
                      <!-- <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                        <span>
                          <a href="https://www.bootstrapdash.com/product/corona-admin-template/" target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">Upgrade to PRO</a>
                        </span>
                      </div> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
            <div class="row">
              <div class="col-md-4 grid-margin stretch-card">
                <div class="card" style="background-color: <?= $uColo?>; color:black">
                  <div class="card-body">
                    <h4 class="card-title text-dark">MULAN CONFERENCE - 2024</h4>
                   
                    <div class="d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Member Number</h6>
                        <p class="text-muted mb-0"><?= $uMNumb ?></p>
                      </div>
                      <!-- <div class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                        <h6 class="font-weight-bold mb-0">$236</h6>
                      </div> -->
                      
                    </div>
                    <div class="d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Member Name</h6>
                        <p class="text-muted mb-0"><?= $uName ?></p>
                      </div>
                    </div> 
                    <div class="d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Tag Code</h6>
                        <p class="text-muted mb-0"><?= $memberID ?></p>
                      </div>
                    </div>
                    <div class="d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded">
                      <div class="text-md-center text-xl-left">
                        <h6 class="mb-1">Category</h6>
                        <p class="text-muted mb-0"><?= $ucatNa ?></p>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title mb-1">Member Details</h4>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="preview-list">
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-primary">
                                <i class="mdi mdi-file-document"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">MEMBER EMAIL ADDRESS</h6>
                                <p class="text-muted mb-0"><?=  $uEmail ?></p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-success">
                                <i class="mdi mdi-cloud-download"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">MEMBER PHONE NUMBER</h6>
                                <p class="text-muted mb-0"><?= $uPhone ?></p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-info">
                                <i class="mdi mdi-clock"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">MEMBER SUPREME COURT NUMBER</h6>
                                <p class="text-muted mb-0"><?= $uSCN ?></p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-danger">
                                <i class="mdi mdi-email-open"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">MEMBER YEAR OF CALL</h6>
                                <p class="text-muted mb-0"><?= $uYCall ?></p>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-warning">
                                <i class="mdi mdi-chart-pie"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">MEMBER BRANCH</h6>
                                <p class="text-muted mb-0"><?= $uBranch ?></p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
<?php include('foot.php') ?>
  </body>
</html>