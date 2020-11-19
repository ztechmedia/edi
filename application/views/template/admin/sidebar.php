<li class="xn-title">Navigation</li>

<li class="xn-openable users">
    <a><span class="fa fa-users"></span> <span class="xn-text">Akun Pengguna</span></a>
    <ul>
        <?php if($this->auth->role === "admin") { ?>
        <li class="admin"><a class="side-submenu" data-url="<?=base_url("admin/users/1")?>" data-menu=".users"
                data-submenu=".admin"><span class="fa fa-user"></span> Admin</a></li>
        <?php } ?>
        <li class="teacher"><a class="side-submenu" data-url="<?=base_url("admin/users/2")?>" data-menu=".users"
                data-submenu=".teacher"><span class="fa fa-user"></span> User</a></li>
    </ul>
</li>

<?php if($this->auth->role === "user") { ?>
<li class="form-biodata">
    <a class="side-menu" data-url="<?=base_url("admin/biodata/{$this->auth->userId}/edit")?>" data-menu=".form-biodata"><span
            class="fa fa-list"></span> <span class="xn-text">Form Biodata</span></a>
</li>
<?php } ?>

<?php if($this->auth->role === "admin") { ?>
<li class="biodata">
    <a class="side-menu" data-url="<?=base_url("admin/biodata")?>" data-menu=".biodata"><span
            class="fa fa-users"></span> <span class="xn-text">Biodata</span></a>
</li>
<?php } ?>

<li class="xn-openable settings">
    <a><span class="fa fa-gear"></span> <span class="xn-text">Pengaturan</span></a>
    <ul>
        <li class="roles"><a class="side-submenu" data-url="<?=base_url("admin/roles")?>" data-menu=".settings"
                data-submenu=".roles"><span class="fa fa-lock"></span> Roles</a></li>
    </ul>
</li>