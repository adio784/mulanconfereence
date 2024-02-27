    <?php 
    include('head.php');

    $Payment = mysqli_query($db, "SELECT *, 
                                    u.othername, rc.category_name, ph.amount_paid, ph.reference, ph.status, ph.created_at
                                    FROM payment_history ph
                                    INNER JOIN users u
                                    ON u.member_reg_no=ph.member_id
                                    INNER JOIN reg_category rc
                                    ON u.category= rc.category_id
                                    WHERE ph.member_id='$memberID'
                                    AND ph.transaction_id !=''
                                    AND ph.reference !='' ");

    ?>
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
           
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Payment History </h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th> Payment Category </th>
                            <th> Amount</th>
                            <th> Payment Reference</th>
                            <th> Payment Status </th>
                            <th> Date Registered </th>
                            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (mysqli_num_rows($Payment) > 0){
                            $i = 0;
                            while ($row = mysqli_fetch_array($Payment)) {
                                $i++;
                        ?>
                          <tr>
                            <td> <?= $i ?></td>
                            <td>
                              <div class="badge badge-outline-success"><?= $row['category_name'] ?> </div>
                            </td>
                            <td> <?= $row['amount_paid'] ?> </td>
                            <td> <?= $row['reference'] ?> </td>
                            <td> <?= $row['status'] ?> </td> 
                            <td> <?= date('F d, Y', strtotime($row['created_at'])) ?> </td>
                            <td>
                                <form method="post" action="receipt">
                                    <input type="hidden" name="ref" value="<?= $row['reference'] ?>">
                                    <button type="submit" class="btn btn-success p-2">Print Receipt</button>
                                </form>
                            </td>
                          </tr>
                          <?php }} ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
          </div>
          
    <?php include('foot.php') ?>
  </body>
</html>