<ul class="breadcrumb">
    <li>Akun Pengguna</li>
    <li class="active">
        <?=$role->display_name?>
    </li>
</ul>

<div class="page-title">
    <h2><span class="fa fa-users"></span> <?=$role->display_name?></h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Daftar <?=$role->display_name?></h3>
                </div>

                <div class="panel-body">
                    <div class="btnContainer">
                        <button class="btn btn-default btn-rounded link-to" data-to="<?=base_url("admin/users/create/$role->id")?>">
                            <i class="fa fa-user"></i> Tambah <?=$role->display_name?>
                        </button>
                    </div>
                    <table class="table table-bordered" id="admin">
                        <thead>
                            <th width="8%">No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Dibuat</th>
                            <th width="10%">Tindakan</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<style>
    .btnContainer {
        margin-bottom: 10px;
    }
</style>

<script>
    $(document).ready(() => {
        $('#admin').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [
                [3, 'desc']
            ],
            "ajax": {
                "url": "<?=base_url("admin/users-table/$role->id")?>",
                "type": "POST"
            },
            columns: [
                {
                    data: "no",
                },
                {
                    data: "name",
                },
                {
                    data: "email",
                },
                {
                    data: "created_at",
                },
                {
                    data: 'actions'
                }
            ]
        });
    });
</script>