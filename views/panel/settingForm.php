<div class="container my-3">
    <h4 class="text-secondary">帳戶設定</h4>
    <div class="row mb-3">
        <div class="col-3">
            <h5 class="pt-2">帳戶名稱:</h5>
        </div>
        <div class="col-7 form-group">
            <input type="text" class="<?=isset($data["accountNameInvalid"])?$data["accountNameInvalid"]:""?> form-control" id="accountNameInput" value="<?=isset($data["accountName"])?$data["accountName"]:""?>" placeholder="請輸入帳戶名稱">
            <div id="accountNameFeedback" class="invalid-feedback"><?=isset($data["accountNameFeedback"])?$data["accountNameFeedback"]:""?></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-3">
            <h5 class="pt-2">帳戶擁有人姓名:</h5>
        </div>
        <div class="col-7 form-group">
            <input type="text" class="<?=isset($data["accountHolderInvalid"])?$data["accountHolderInvalid"]:""?> form-control" id="accountHolderInput" value="<?=isset($data["accountHolder"])?$data["accountHolder"]:""?>" placeholder="請輸入帳戶擁有人名稱">
            <div id="accountHolderFeedback" class="invalid-feedback"><?=isset($data["accountHolderFeedback"])?$data["accountHolderFeedback"]:""?></div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-3">
            <h5>帳戶餘額屏蔽:</h5>
        </div>
        <div class="col-7 form-group">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="hindRadioBtn" id= "inlineCheckbox1" value="true" <?=$data["balanceHide"] == 1 ? "checked":""?>>
                <label class="form-check-label" for="inlineCheckbox1">是</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="hindRadioBtn" id="inlineCheckbox2" value="false" <?=$data["balanceHide"] != 1 ? "checked":""?>>
                <label class="form-check-label" for="inlineCheckbox2">否</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="offset-8 col-2">
            <button type="button" id="changeSubmit" class="float-right btn btn-success">提交</button>
        </div>
    </div>
</div>
<?php if(isset($data["script"])):?>
    <?php foreach( $data["script"] as $script ):?>
        <script src="<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif;?>