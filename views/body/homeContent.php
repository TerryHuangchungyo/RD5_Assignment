<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><?=$data["brandName"]?></a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0 ml-auto">
            <button data-toggle="modal" data-target="#loginModal" class="btn btn-outline-success my-2 my-sm-0" type="button">登入</button>
            <button data-toggle="modal" data-target="#signupModal" class="btn btn-outline-secondary my-2 my-sm-0 ml-2" type="button">註冊</button>
        </form>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="loginModalLabel">登入</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body"> 
                <div class="form-group">
                    <label for="accountId">帳號:</label>
                    <input type="text" class="form-control" id="accountId" placeholder="請輸入網銀帳號" required>
                    <div id="accountIdFeedback" class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label for="accountPassword">密碼:</label>
                    <input type="password" class="form-control" id="accountPassword" placeholder="請輸入網銀密碼" required>
                    <div id="accountPasswordFeedback" class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="exampleCheck1">記住我</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="loginBtn" class="btn btn-success">登入</button>
                <button type="button" id="loginCancel" class="btn btn-secondary" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>

<!-- Signup Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="signupModalLabel">註冊</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="signupId">帳號:</label>
                    <input type="text" class="form-control" id="signupId" placeholder="請輸入網銀帳號" required>
                    <div id="signupIdFeedback" class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label for="signupName">帳戶名稱:</label>
                    <input type="text" class="form-control" id="signupName" placeholder="請輸入帳戶名稱" required>
                    <div id="signupNameFeedback" class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label for="signupHolder">使用者姓名:</label>
                    <input type="text" class="form-control" id="signupHolder" placeholder="請輸入帳戶擁有人姓名" required>
                    <div id="signupHolderFeedback" class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label for="signupPassword">密碼:</label>
                    <input type="password" class="form-control" id="signupPassword" placeholder="請輸入網銀密碼" required>
                    <div id="signupPasswordFeedback" class="invalid-feedback">
                    </div>
                </div>
                <div class="form-group">
                    <label for="signupCheckPassword">確認密碼:</label>
                    <input type="password" class="form-control" id="signupCheckPassword" placeholder="請再次輸入網銀密碼" required>
                    <div id="signupCheckPasswordFeedback" class="invalid-feedback">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="signupBtn" class="btn btn-success">註冊</button>
                <button type="button" id="signupCancel" class="btn btn-secondary" data-dismiss="modal">取消</button>
            </div>
        </div>
    </div>
</div>

<!-- Wating Modal -->
<div class="modal fade" id="waitModal" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header" style="display: none;">
                <button id="secretBtn" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body row">
                    <div class="col-2">
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div class="col-10">
                        <h6 class="my-2">資料處理中，請稍候．．．</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- After Signup Modal -->
<div class="modal fade" id="afterSignupModal" aria-labelledby="afterSignupModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h7 class="modal-title" id="afterSignupModalLabel"></h7>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"> 
                <h6 class="my-auto" id="afterSignupModalContent"></h6>
            </div>
        </div>
    </div>
</div>
<?php if(isset($data["script"])):?>
    <?php foreach( $data["script"] as $script ):?>
        <script src="<?=$script?>"></script>
    <?php endforeach; ?>
<?php endif;?>