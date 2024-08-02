<!-- Sign up Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #2A403D;">
        <h5 class="modal-title" style="color:white;" id="signupModal">Sign Up Here</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="partials/_handleSignup.php" method="post">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="username" class="font-weight-bold">Username</label>
              <input class="form-control" id="username" name="username" placeholder="Choose a unique Username" type="text" required minlength="3" maxlength="11">
            </div>
            <div class="form-group col-md-6">
              <label for="email" class="font-weight-bold">Email</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Enter Your Email" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="firstName" class="font-weight-bold">First Name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" required>
            </div>
            <div class="form-group col-md-6">
              <label for="lastName" class="font-weight-bold">Last Name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="phone" class="font-weight-bold">Phone No</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon">+62</span>
                </div>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter Your Phone Number" required pattern="[0-9]{12}" maxlength="12">
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="password" class="font-weight-bold">Password</label>
              <input class="form-control" id="password" name="password" placeholder="Enter Password" type="password" required data-toggle="password" minlength="4" maxlength="21">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="cpassword" class="font-weight-bold">Re-enter Password</label>
              <input class="form-control" id="cpassword" name="cpassword" placeholder="Re-enter Password" type="password" required data-toggle="password" minlength="4" maxlength="21">
            </div>
          </div>
          <button type="submit" class="btn btn-success" style="background-color:#2A403D;">Submit</button>
        </form>
        <p class="mb-0 mt-1">Already have an account? <a href="#" data-dismiss="modal" data-toggle="modal" data-target="#loginModal" style="color:#2A403D;">Login here</a></p>
      </div>
    </div>
  </div>
</div>
