<div class="modal fade" id="ajaxModelUpdate" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeadingUpdate"></h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" style="display:none"></div>
                <form id="dataFormUpdate" name="dataForm" class="form-horizontal">
                    <input type="hidden" name="data_id" id="data_id">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group col-sm-3">
                                <label for="name" class="col-sm-12 control-label">Name <span class="red"></span></label>
                                <div class="col-sm-12">
                                    <input type="text" id="name2" name="name" placeholder="Enter Map Name" required>
                                </div>
                            </div>                                
                            <div class="form-group col-sm-3">
                                <label for="latitude" class="col-sm-12 control-label">Latitude <span class="red"></span></label>
                                <div class="col-sm-12">
                                    <input type="text" id="latitude2" name="latitude" placeholder="Enter Latitude" required>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="longitude" class="col-sm-12 control-label">Longitude <span class="red"></span></label>
                                <div class="col-sm-12">
                                    <input type="text" id="longitude2" name="longitude" placeholder="Enter Longitude" required>
                                </div>
                            </div>                                                           
                            <div class="form-group col-sm-3">
                                <label for="file" class="col-sm-12 control-label">Type: </label>
                                <div class="col-sm-12">
                                    <select id="type2" name="type" required>
                                        <option>Select One</option>
                                        <option value="1">House</option>
                                        <option value="2">Hand Pump</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="details" class="col-sm-12 control-label">Details</label>
                                <div class="col-sm-12">
                                    <textarea name="details" id="details2" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="file" class="col-sm-12 control-label">File: </label>
                                <div class="col-sm-12">
                                    <input type="file" name="file" id="file2">
                                </div>
                            </div>
                            <div class="form-group col-sm-3">
                                <label for="status" class="col-sm-12 control-label">Status: </label>
                                <div class="col-sm-12">
                                    <select id="status2" name="status" required>
                                        <option>Select One</option>
                                        <option value="1">Active</option>
                                        <option value="2">InActive</option>
                                    </select>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="updateBtn">Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>