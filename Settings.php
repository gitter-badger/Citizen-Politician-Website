<?php
session_start();
if(!isset($_SESSION['username'])){
  header("Location: HomePage.php");
  return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Mwananchi</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="shortcut icon" type="image/png" href="MwananchiIcon.png">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="Logged.css">
  <link rel="stylesheet" type="text/css" href="LoggedPhone.css">


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
</head>
<body style="background-color: whitesmoke;">
  <?php
    require 'NavBar.php';
  ?>
  <div class="container-fluid" style="position: relative;top: 100px">
      <hr>
      <div class="container bootstrap snippet">
        <div class="row mb-3">
          <div class="text-info col-lg-12"><h1><?php echo "@".$_SESSION['username'];?></h1></div>
        </div>
        <div class="row">
          <div class="col-lg-3 mb-5">
            <div class="text-center">
              <img src="<?php echo $photo;?>" class="avatar img-circle img-thumbnail mb-2 w-50">
              <h6 class="mb-3">Upload a different photo...</h6>
              <div class="form-group text-left">
                  <div class="custom-file">
                    <input type="file" accept="image/png,image/jpeg" class="custom-file-input border" name="photo" id="photo" style="cursor: pointer;">
                    <label for="photo" class="custom-file-label" id="labelPhoto">Change Photo.</label>
                  </div>
                </div>
            </div><hr><hr>             
            <ul class="list-group">
              <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center"><div>Activity <small>(One Week)</small></div> <i class="fab fa-hotjar"></i></li>
              <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Shares</strong> <span class="badge badge-info ml-auto">125</span></li>
              <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Likes</strong> <span class="badge badge-info ml-auto">13</span></li>
              <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Posts</strong> <span class="badge badge-info ml-auto">37</span></li>
              <li class="list-group-item d-flex justify-content-between align-items-center"><strong>Followers</strong> <span class="badge badge-info ml-auto">78</span></li>
            </ul><hr><hr>
          </div>
          <div class="col-lg-9">
            <ul class="nav nav-tabs bg-info">
              <li class="nav-item" style="width: 50%"><a class="nav-link active" style="color: darkslategray;border-radius: 0" data-toggle="tab" href="#Basic">Profile Settings</a></li>
              <li class="nav-item" style="width: 50%"><a class="nav-link" style="color: darkslategray;border-radius: 0" data-toggle="tab" href="#Advanced">Advanced Settings</a></li>
            </ul>

            <div class="tab-content mb-5" style="border: 1px ridge rgba(0,0,0,0.1);border-radius: 10px;border-top-left-radius: 0px;border-top-right-radius: 0px;background-color: whitesmoke;">
              <div class="tab-pane container active" id="Basic">
                <hr><hr>
                <form class="form" action="##" method="post" >
                  <legend class="text-info">Basic Settings</legend>
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text">@</span>
                          </div>
                          <input type="text" class="form-control" name="user" id="user" placeholder="Username" value="<?php echo $_SESSION['username']?>" readonly="">
                        </div>
                      </div>
                      <div class="alert alert-danger">Username cannot be changed since changing it can have undesired side effects.</div>
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <input type="email" class="form-control" name="email" id="email" placeholder="Email" required="">
                            <div class="input-group-append">
                                <span class="input-group-text fa" id="2"></span>
                            </div>
                        </div>
                      </div>
                      <div id="emailError"></div>
                      <div class="form-group">
                        <div class="input-group mb-3">
                          <div class="input-group-prepend">
                                <span class="input-group-text">+254</span>
                          </div>
                          <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" required="">
                            <div class="input-group-append">
                                <span class="input-group-text fa" id="3"></span>
                            </div>
                        </div>
                      </div>
                      <div id="phoneError"></div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group mb-2">
                        <label for="counties"> County:</label>
                        <select class="custom-select mb-3" name="counties" id="counties" style="cursor: pointer;" required="">
                          <?php
                            $stmt=$connection->query("Select * from counties");
                            if ($stmt->num_rows > 0) {
                                while($row = $stmt->fetch_array(MYSQLI_NUM)) {
                                echo "<option value=$row[0]>$row[1]</option>";
                              }
                            } else {
                              echo "<option>No Supported Counties</option>";
                            }
                          ?>
                        </select>
                        <label for="account"> Account Type:</label>
                        <select class="custom-select mb-3" name="account" id="account" style="cursor: pointer;text-transform: capitalize;" required=""><option value="$_SESSION['usertype']"><?php echo $_SESSION["usertype"];?></option></select>
                        <label>Gender: </label>
                        <div class="custom-control custom-radio mb-1">
                            <input type="radio" class="custom-control-input" id="male" name="gender" value="male" required="">
                            <label class="custom-control-label" for="male">Male</label>
                        </div>
                        <div class="custom-control custom-radio mb-1">
                          <input type="radio" class="custom-control-input" id="female" name="gender" value="female" required="">
                            <label class="custom-control-label" for="female">Female</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row"><div class="col">
                    <div class="form-group mb-3 d-flex justify-content-center">
                      <button style="margin-right: 20px;" type="submit" class="btn btn-info"><i class="fas fa-arrow-alt-circle-down"></i> Save</button> <button type="button" class="btn btn-secondary"><i class="fas fa-redo-alt"></i> Redo</button>
                    </div>
                  </div></div>
                </form><hr><hr>
                <div class="row">
                  <div class="col-12 container">
                    <div class="text-info" style="font-size: 24px">Account Settings</div><br>
                      <form>
                        <legend class="text-info" style="font-size: 18px">Change Password</legend><hr>
                        <div class="form-group mb-3">
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="showOldSecret" style="cursor: pointer;"><img src="eye-icon.png" style="width: 23px;height: 23px;"></span>
                            </div>
                            <input type="password" class="form-control" name="oldSecret" id="oldSecret" placeholder="Old Password" required="">
                            <div class="input-group-append">
                              <span class="input-group-text fa" id="4"></span>
                            </div>
                          </div>
                        </div>
                        <div id="oldError"></div>
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                  <span class="input-group-text" id="showSecret" style="cursor: pointer;"><img src="eye-icon.png" style="width: 23px;height: 23px;"></span>
                              </div>
                            <input type="password" class="form-control" name="secret" id="secret" placeholder="New Password" required="">
                              <div class="input-group-append">
                                  <span class="input-group-text fa" id="5"></span>
                              </div>
                          </div>
                        </div>
                        <div id="secretError"></div>
                        <div class="form-group">
                          <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                  <span class="input-group-text" id="showSecretRe" style="cursor: pointer;"><img src="eye-icon.png" style="width: 23px;height: 23px;"></span>
                              </div>
                            <input type="password" class="form-control" name="secretRe" id="secretRe" placeholder="Repeat Password" required="">
                              <div class="input-group-append">
                                  <span class="input-group-text fa" id="6"></span>
                              </div>
                          </div>
                        </div>
                        <div id="secretReError"></div>
                        <div class="form-group mb-3">
                          <button type="submit" class="btn btn-info">Change Password</button>
                        </div>
                      </form><hr>
                      <div class="container-fluid" style="background-color: ghostwhite;border: 0.5px solid indianred;border-radius: 5px;">
                        <div class="text-danger mb-2" style="font-size: 20px;font-weight: bolder;">Delete Account</div>
                        <div class="mb-3"><strong>Disclaimer: </strong>Deleting an account is a serious task. There is no turning back. Please be certain that this is what you want. Once you delete your account it cannot be recovered.</div>
                        <button type="button" class="btn btn-danger mb-4">Delete Account</button>
                      </div>
                      <hr>
                  </div>
                </div>    
              </div>

              <div class="tab-pane container fade" id="Advanced">
                
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</body>
</html>