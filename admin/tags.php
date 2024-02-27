<?php
    session_start();
    if ( !isset($_SESSION['username']) && !isset($_SESSION['password']) ) {
        header('location: index');
    } else {
        require_once('../connect.php');

        // All registered users
        $tUsers      = mysqli_query($db, "SELECT *, reg_category.category_name, reg_category.color_code FROM users INNER JOIN reg_category ON users.category = reg_category.category_id");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member-Tag :| Print Member Conference 2024 Tag</title>

    <link rel="shortcut icon" href="images/mulan_icon.png" type="image/x-icon">

    <style>
        *,
*::before,
*::after {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: Arial, Helvetica, sans-serif;
  background: #ffffff;
}

h1.demo-title {
  text-align: center;
  font-size: 30px;
  font-weight: 600;
  color: #005E09;
  letter-spacing: 2px;
}

h1.demo-title a {
  font-size: 16px;
  font-weight: 300;
}

.pricing-table {
  display: flex;
  flex-flow: row wrap;
  width: 100%;
  max-width: 1100px;
  margin: 0 auto;
  background: #ffffff;
}

.pricing-table .ptable-item {
  width: 30.33%;
  padding: 0 15px;
  margin-bottom: 30px;
}

@media (max-width: 992px) {
  .pricing-table .ptable-item {
    width: 33.33%;
  }
}

@media (max-width: 768px) {
  .pricing-table .ptable-item {
    width: 50%;
  }
}

@media (max-width: 576px) {
  .pricing-table .ptable-item {
    width: 100%;
  }
}

.pricing-table .ptable-single {
  position: relative;
  width: 100%;
  overflow: hidden;
}

.pricing-table .ptable-header,
.pricing-table .ptable-body,
.pricing-table .ptable-footer {
  position: relative;
  width: 100%;
  text-align: center;
  overflow: hidden;
}

.pricing-table .ptable-status ,
.pricing-table .ptable-title,
.pricing-table .ptable-price,
.pricing-table .ptable-description,
.pricing-table .ptable-action {
  position: relative;
  width: 100%;
  text-align: center;
}

.pricing-table .ptable-single {
  background: #f6f8fa;
}

.pricing-table .ptable-single:hover {
  box-shadow: 0 0 10px #999999;
}

.pricing-table .ptable-header {
  margin: 0 30px;
  padding: 30px 0 45px 0;
  width: auto;
  background: #005E09;
}

.pricing-table .ptable-header::before,
.pricing-table .ptable-header::after {
  content: "";
  position: absolute;
  bottom: 0;
  width: 0;
  height: 0;
  border-bottom: 100px solid #f6f8fa;
}

.pricing-table .ptable-header::before {
  right: 50%;
  border-right: 250px solid transparent;
}

.pricing-table .ptable-header::after {
  left: 50%;
  border-left: 250px solid transparent;
}

.pricing-table .ptable-item.featured-item .ptable-header {
  background: #FF6F61;
}

.pricing-table .ptable-status {
  margin-top: -30px;
}

.pricing-table .ptable-status span {
  position: relative;
  display: inline-block;
  width: 50px;
  height: 30px;
  padding: 5px 0;
  text-align: center;
  color: #FF6F61;
  font-size: 14px;
  font-weight: 300;
  letter-spacing: 1px;
  background: #005E09;
}

.pricing-table .ptable-status span::before,
.pricing-table .ptable-status span::after {
  content: "";
  position: absolute;
  bottom: 0;
  width: 0;
  height: 0;
  border-bottom: 10px solid #FF6F61;
}

.pricing-table .ptable-status span::before {
  right: 50%;
  border-right: 25px solid transparent;
}

.pricing-table .ptable-status span::after {
  left: 50%;
  border-left: 25px solid transparent;
}

.pricing-table .ptable-title h2 {
  color: #ffffff;
  font-size: 24px;
  font-weight: bold;
  padding:5px;
  letter-spacing: 2px;
}

.pricing-table .ptable-price h2 {
  margin: 0;
  color: #ffffff;
  font-size: 45px;
  font-weight: 700;
  margin-left: 15px;
}

.pricing-table .ptable-price h2 small {
  position: absolute;
  font-size: 18px;
  font-weight: 300;
  margin-top: 16px;
  margin-left: -15px;
}

.pricing-table .ptable-price h2 span {
  margin-left: 3px;
  font-size: 16px;
  font-weight: 300;
}

.pricing-table .ptable-body {
  padding: 20px 0;
}

.pricing-table .ptable-description ul {
  margin: 0;
  padding: 0;
  list-style: none;
}

.pricing-table .ptable-description ul li {
  color: #000000;
  font-size: 14px;
  font-weight: bold;
  letter-spacing: 1px;
  padding: 7px;
  border-bottom: 1px solid #dedede;
}

.pricing-table .ptable-description ul li:last-child {
  border: none;
}

.pricing-table .ptable-footer {
  padding-bottom: 30px;
}

.pricing-table .ptable-action a {
  display: inline-block;
  padding: 10px 20px;
  color: #FFFFFF; /*#FF6F61;*/
  font-size: 14px;
  font-weight: 500;
  letter-spacing: 2px;
  text-decoration: none;
  background: #005E09;
}

/* .pricing-table .ptable-action a:hover {
  color: #005E09;
  background: #FF6F61;
} */

.pricing-table .ptable-item.featured-item .ptable-action a {
  color: #005E09;
  background: #FF6F61;
}

.pricing-table .ptable-item.featured-item .ptable-action a:hover {
  color: #FF6F61;
  background: #005E09;
}
    </style>
</head>
<body>
<div class="pricing-table">

<?php
      if (mysqli_num_rows($tUsers) > 0){
      while ($row = mysqli_fetch_array($tUsers)) {
      $cls = $row['color_code'];
  ?>
  <div class="ptable-item">
    <div class="ptable-single">
      <div class="ptable-header">
        <div class="ptable-title" style="background-color: <?= $cls ?>">
          <h2 style="color: <?php if($cls=='yellow' || $cls=='white' || $cls=='pink'){ echo '#000';}else{ echo '#fff';} ?>">MULAN <br> <small>CONFERENCE</small> </h2>
        </div>
        <div class="ptable-price">
          <h2> 2024 </h2>
        </div>
      </div>
      <div class="ptable-body">
        <div class="ptable-description">
          <ul>
            <li><?= $row['lastname'] .' ' . $row['othername'] ?></li>
            <li><?= $row['membership_number'] ?></li>
            <li><?= $row['phone'] ?></li>
            <li><?= $row['category_name'] ?></li>
          </ul>
        </div>
      </div>
      <div class="ptable-footer">
        <div class="ptable-action">
          <a><?= $row['member_reg_no'] ?></a>
        </div>
      </div>
    </div>
  </div>
  <?php
      } 
  } else {
      echo "No record found !!!";
  }?>

  <!-- <div class="ptable-item featured-item">
    <div class="ptable-single">
      <div class="ptable-header">
        <div class="ptable-status">
          <span>Hot</span>
        </div>
        <div class="ptable-title">
          <h2>Gold</h2>
        </div>
        <div class="ptable-price">
          <h2><small>$</small>199<span>/ M</span></h2>
        </div>
      </div>
      <div class="ptable-body">
        <div class="ptable-description">
          <ul>
            <li>Pure HTML & CSS</li>
            <li>Responsive Design</li>
            <li>Well-commented Code</li>
            <li>Easy to Use</li>
          </ul>
        </div>
      </div>
      <div class="ptable-footer">
        <div class="ptable-action">
          <a href="">Buy Now</a>
        </div>
      </div>
    </div>
  </div> -->

  <!-- <div class="ptable-item">
    <div class="ptable-single">
      <div class="ptable-header">
        <div class="ptable-title">
          <h2>Platinum</h2>
        </div>
        <div class="ptable-price">
          <h2><small>$</small>299<span>/ M</span></h2>
        </div>
      </div>
      <div class="ptable-body">
        <div class="ptable-description">
          <ul>
            <li>Pure HTML & CSS</li>
            <li>Responsive Design</li>
            <li>Well-commented Code</li>
            <li>Easy to Use</li>
          </ul>
        </div>
      </div>
      <div class="ptable-footer">
        <div class="ptable-action">
          <a href="">Buy Now</a>
        </div>
      </div>
    </div>
  </div> -->
</div>
</body>
</html>