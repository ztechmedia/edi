<div class="form-group">
    <label class="col-md-3 control-label">Posisi Dilamar</label>
    <div class="col-md-6">
        <input name="position_applied" id="position_applied" type="text" class="validate[required,maxSize[30]] form-control" 
            value="<?=$user ? $user->position_applied : ""?>" />
        <span class="help-block form-error" id="position_applied-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Name</label>
    <div class="col-md-6">
        <input name="name" id="name" type="text" class="validate[required,maxSize[30]] form-control" 
            value="<?=$user ? $user->name : ""?>" />
        <span class="help-block form-error" id="name-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">No. KTP</label>
    <div class="col-md-6">
        <input name="id_card" id="id_card" type="number" class="validate[required,maxSize[30]] form-control" 
            value="<?=$user ? $user->id_card : ""?>" />
        <span class="help-block form-error" id="id_card-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Tempat lahir</label>
    <div class="col-md-6">
        <input name="birth_place" id="birth_place" type="text" class="validate[required,maxSize[30]] form-control" 
            value="<?=$user ? $user->birth_place : ""?>" />
        <span class="help-block form-error" id="birth_place-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Tanggal Lahir</label>
    <div class="col-md-6">
        <input readonly name="birth_date" id="birth_date" type="text" class="validate[required] form-control" 
            style="color: #000;cursor:pointer;"
            value="<?=$user && $user->birth_date ? revDate($user->birth_date) : '01-01-1999'?>" 
            data-date="01-01-1999" 
            data-date-format="dd-mm-yyyy" 
            data-date-viewmode="months"/>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Jenis Kelamin</label>
    <div class="col-md-6">
        <select class="form-control" name="gender" id="gender">
        <?php 
            $genders = ["Laki - Laki", "Perempuan"];
            foreach ($genders as $gender) {
                $selected = $gender === $user->gender ? "selected" : null;
                echo "<option $selected value='$gender'>$gender</option>";
            }
        ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Golongan Darah</label>
    <div class="col-md-6">
        <input name="blood" id="blood" type="text" class="validate[required,maxSize[30]] form-control" 
            value="<?=$user ? $user->blood : ""?>" />
        <span class="help-block form-error" id="blood-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Alamat KTP</label>
    <div class="col-md-6">
        <textarea name="address_id" id="address_id" class="validate[required] form-control"><?=$user ? $user->address_id : ""?></textarea>
        <span class="help-block form-error" id="address_id-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Alamat Tinggal</label>
    <div class="col-md-6">
        <textarea name="address_stay" id="address_stay" class="validate[required] form-control"><?=$user ? $user->address_stay : ""?></textarea>
        <span class="help-block form-error" id="address_stay-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Email</label>
    <div class="col-md-6">
        <input name="email" id="email" type="text" class="validate[required,custom[email]],maxSize[50]] form-control" 
            value="<?=$user ? $user->email : ""?>" />
        <span class="help-block form-error" id="email-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">No. Telpon</label>
    <div class="col-md-6">
        <input name="phone" id="phone" type="text" class="validate[required,maxSize[14]] form-control mask_phone" 
            value="<?=$user ? $user->phone : "0896-1722-7009"?>" />
        <span class="help-block">* Contoh: 0895-1722-7009 (kolom nomor harus diisi semua)</span>
        <span class="help-block form-error" id="phone-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Pendidikan Terakhir</label>
    <div class="col-md-6">
        <input name="last_education" id="last_education" type="text" class="validate[required,maxSize[30]] form-control" 
            value="<?=$user ? $user->last_education : ""?>" />
        <span class="help-block form-error" id="last_education-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Orang terdekat yang bisa dihubungi</label>
    <div class="col-md-6">
        <input name="closest_person" id="closest_person" type="text" class="validate[required,maxSize[30]] form-control" 
            value="<?=$user ? $user->closest_person : ""?>" />
        <span class="help-block form-error" id="closest_person-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Skills</label>
    <div class="col-md-6">
        <textarea name="skills" id="skills" class="validate[required] form-control"><?=$user ? $user->skills : ""?></textarea>
        <span class="help-block form-error" id="skills-error"></span>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Bersedia ditempatkan diseluruh kantor perusahaan?</label>
    <div class="col-md-6">
        <select class="form-control" name="status" id="status">
        <?php 
            $status = ["1" => "Ya", "2" => "Tidak"];
            foreach ($status as $key => $stat) {
                $selected = $key === $teacher->status ? "selected" : null;
                echo "<option $selected value='$key'>$stat</option>";
            }
        ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label">Penghasilan yang diharapkan</label>
    <div class="col-md-6">
        <input name="expected_sallary" id="expected_sallary" type="text" class="validate[required,maxSize[30]] form-control" 
            value="<?=$user ? $user->expected_sallary : ""?>" />
        <span class="help-block form-error" id="expected_sallary-error"></span>
    </div>
</div>

<script>
    $("#birth_date").datepicker();
    $("input.mask_phone").mask("9999-9999-9999");
</script>