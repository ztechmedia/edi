<ul class="breadcrumb">
    <li class="active">
       Biodata
    </li>
</ul>

<div class="page-title">
    <h2><span class="fa fa-users"></span> Biodata</h2>
</div>

<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading ui-draggable-handle">
                    <h3 class="panel-title">Daftar Biodata</h3>
                </div>

                <div class="panel-body">
                    <table class="table table-bordered" id="user">
                        <thead>
                            <th width="8%">No</th>
                            <th>Nama</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Posisi Dilamar</th>
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
        $('#user').DataTable({
            "processing": false,
            "serverSide": true,
            "order": [
                [1, 'desc']
            ],
            "ajax": {
                "url": "<?=base_url("admin/biodata-table")?>",
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
                    data: "ttl",
                },
                {
                    data: "position_applied",
                },
                {
                    data: 'actions'
                }
            ]
        });
    });
</script>