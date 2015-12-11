      <div class="modal fade changeModal" id="profileChangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">Update Profile</h4>
            </div>
            <form id="reportForm" data-ID={{bounty.id}} data-username={{username}}>
              <div class="modal-body">
                <div class="input-group input-group-Modal">
                  <span class="input-group-addon addOnCustom">Username</span>
                  <input type ="text" class="form-control modalInput" id="changeUsernameForm">
                </div>
                <div class="input-group input-group-Modal">
                  <span class="input-group-addon addOnCustom">Email</span>
                  <input type ="text" class="form-control modalInput" id="changeEmailForm">
                </div>
                <div class="input-group input-group-Modal">
                  <span class="input-group-addon addOnCustom">Old Password</span>
                  <input type ="password" class="form-control modalInput" id="changePassworldOldForm">
                </div>
                <div class="input-group input-group-Modal">
                  <span class="input-group-addon addOnCustom">New Password</span>
                  <input type ="password" class="form-control modalInput" id="changePasswordNewForm">
                </div>
                <div class="input-group input-group-Modal">
                  <span class="input-group-addon addOnCustom">Confirm Password</span>
                  <input type ="password" class="form-control modalInput" id="changePasswordConfirmForm">
                </div>
              </div>
            </form>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" id="submitChangeProfile">Submit</button>
            </div>
          </div>
        </div>
      </div>