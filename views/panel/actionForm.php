<div class="container my-3">
    <h4 class="text-secondary"><?=$data["actionName"]?></h4>
    <div class="row my-3">
        <div class="col-3">
            <h5 class="pt-2"><?=$data["actionName"]?>金額:</h5>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" id="value" placeholder="請輸入<?=$data["actionName"]?>金額">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-3">
            <h5 class="pt-2">密碼:</h5>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" id="actionPassword" placeholder="請輸入網銀密碼">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-3">
            <h5 class="pt-2">密碼確認:</h5>
        </div>
        <div class="col-7">
            <input type="text" class="form-control" id="actionCheckPassword" placeholder="請再次輸入網銀密碼">
        </div>
    </div>
    <div class="row">
        <div class="offset-8 col-2">
            <button type="button" id="actionSubmit" class="float-right btn btn-success">提交</button>
        </div>
    </div>
</div>