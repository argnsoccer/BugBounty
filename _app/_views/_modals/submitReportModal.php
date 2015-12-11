      <div class="modal fade" id="submitReportModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="exampleModalLabel">New Report</h4>
            </div>
            <form id="reportForm" data-ID={{bounty.id}} data-username={{username}}>
              <div class="modal-body">
                <div class="form-group">
                  <label for="recipient-name" class="control-label">Error:</label>
                  <input type="text" class="form-control" id="errorNameForm">
                </div>
                <div class="form-group">
                  <label for="message-text" class="control-label">Description of Error:</label>
                  <textarea class="form-control" id="errorDescriptionForm"></textarea>
                </div>
                <div class="form-group">
                  <label for="message-text" class="control-label">Path to Error:</label>
                  <textarea class="form-control" id="errorPathForm"></textarea>
                </div>
                <div class="form-group">
                  <label for="recipient-name" class="control-label">Link of Error:</label>
                  <input type="text" class="form-control" id="errorLinkForm">
                </div>
              </div>
            </form>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <span class="btn btn-default btn-file">
                Browse <input type="file" id="fileName">
              </span>
              <button type="submit" class="btn btn-primary" id="submitReportForm">Submit</button>
            </div>
          </div>
        </div>
      </div>