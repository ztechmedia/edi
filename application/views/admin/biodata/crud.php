<ul class="breadcrumb">
    <li class="active">Form Biodata</li>
</ul>

<div class="page-title">
    <h2>Update Biodata</h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Form Biodata</h3>
                </div>
                <form id="validate" role="form" class="form-horizontal action-submit-update"
                    data-action="<?=base_url("admin/biodata/$user->user_id/update")?>">
                    <div class="panel-body">
                        <?php $data['user'] = $user; $this->load->view('admin/biodata/form', $data)?>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <button class="btn btn-primary save" type="submit">Update</button>
                            </div>
                        </div>
                        
                    </div>
                </form>

            </div>
        </div>
    </div>

</div>

<script>
    formSelect();
    formValidation(".action-submit-update");

    function education(userId) {
        $("#modal_basic").modal("show");
    }
</script>