  <div class="container">

      <div class="card o-hidden border-0 shadow-lg my-5 col-lg-6 mx-auto">
          <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                  <div class="col-lg">
                      <div class="p-5">
                          <div class="text-center">
                              <h1 class="h4 text-gray-900 mb-4">Registration Page</h1>
                          </div>
                          <form class="user" method="POST" action="<?php echo base_url('auth/do_register') ?>">
                              <div class="form-group">
                                  <input type="text" class="form-control form-control-user" name="name" value="<?php set_value('name') ?>" placeholder="Name">
                                  <?php echo form_error('name','<small class="text-danger">','</small>') ?>
                              </div>
                              <div class="form-group">
                                  <input type="email" class="form-control form-control-user" name="email" value="<?php set_value('email') ?>" placeholder="Email Address">
                                  <?php echo form_error('email','<small class="text-danger">','</small>') ?>
                              </div>
                              <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0">
                                      <input type="password" class="form-control form-control-user" name="password1" placeholder="Password">
                                      <?php echo form_error('password1','<small class="text-danger">','</small>') ?>
                                  </div>
                                  <div class="col-sm-6">
                                      <input type="password" class="form-control form-control-user" name="password2" placeholder="Repeat Password">
                                  </div>
                              </div>
                              <button type="submit" class="btn btn-primary btn-user btn-block"> Register Account </button>
                          </form>
                          <hr>
                          <div class="text-center">
                              <a class="small" href="forgot-password.html">Forgot Password?</a>
                          </div>
                          <div class="text-center">
                              <a class="small" href="<?php echo base_url('auth') ?>">Already have an account? Login!</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  </div>
