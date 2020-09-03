<div id="transTable" class="container my-3">
    <table class="table table-hover">
        <thead class="thead-light">
            <tr>
            <th scope="col">交易編號</th>
            <th scope="col">交易類型</th>
            <th scope="col">交易金額</th>
            <th scope="col">交易狀態</th>
            <th scope="col">帳戶餘額</th>
            <th scope="col">交易日期</th>
            </tr>
        </thead>
        <tbody id="transTableBody">
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <div id="pagination" class="text-center"></div>
    </div>
</div>
<div id="transDetail" class="container my-3">
    <div class="container mt-3">
        <h4 class="text-secondary">交易明細</h4>
        <div class="container rounded border border-dark">
            <div class="my-3 ml-2">
                <h5>交易編號: <span id="span-trans-id"></span></h5>
            </div>
            <div class="my-3 ml-2">
                <h5>交易日期: <span id="span-trans-date"></span></h5>
            </div>
            <div class="my-3 ml-2">
                <h5>交易類型: <span id="span-trans-action"></span></h5>
            </div>
            <div class="my-3 ml-2">
                <h5>交易狀態: <span id="span-trans-status"></span></h5>
            </div>
            <div class="my-3 ml-2">
                <h5>交易帳戶: <span id="span-trans-accountName"></span></h5>
            </div>
            <div class="my-3 ml-2">
                <h5>交易金額: <span id="span-trans-value"></h5>
            </div>
            <div class="my-3 ml-2">
                <h5>帳戶餘額: <span id="span-trans-residue"></h5>
            </div>
            <div class="my-3 ml-2" id="errorText">
                <h5>失敗原因:</h5>
                <p id="errorMsg"></p>
            </div>
        </div>
        <div class="row float-right mr-1 my-3">
            <button type="button" id="backBtn" data-where="withdraw" class="btn btn-outline-primary">返回</button>
        </div>
    </div>
</div>
<?php if(isset($data["script"])):?>
    <?php foreach( $data["script"] as $script ):?>
        <script src="<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif;?>