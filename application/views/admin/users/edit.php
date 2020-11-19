<ul class="breadcrumb">
    <li>Akun Pengguna</li>
    <li><a class="link-to" data-to="<?=base_url("admin/users/$role->id")?>"><?=$role->display_name?></a></li>
    <li class="active">Edit Data</li>
</ul>

<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left link-to" data-to="<?=base_url("admin/users/$role->id")?>"></span> Update <?=$role->display_name?></h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Form User</h3>
                </div>
                <form id="validate" role="form" class="form-horizontal action-submit-update"
                    data-action="<?=base_url("admin/users/$user->id/update")?>" 
                    data-redirect="<?=base_url("admin/users/$role->id")?>"
                    data-target=".content">
                    <div class="panel-body">
                        <?php $data['user'] = $user; $this->load->view('admin/users/form', $data)?>
                    </div>
                    <div class="panel-footer">
                        <div class="btn-group pull-right">
                            <button class="btn btn-primary save" type="submit">Update</button>
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
</script>