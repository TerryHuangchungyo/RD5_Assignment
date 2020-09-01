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
                    <label for="accoutId">帳號:</label>
                    <input type="text" class="form-control" id="accoutId" placeholder="請輸入網銀帳號" required>
                </div>
                <div class="form-group">
                    <label for="accoutPassword">密碼:</label>
                    <input type="password" class="form-control" id="accoutPassword" placeholder="請輸入網銀密碼" required>
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe">
                    <label class="form-check-label" for="exampleCheck1">記住我</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">登入</button>
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
                </div>
                <div class="form-group">
                    <label for="signupName">帳戶名稱:</label>
                    <input type="text" class="form-control" id="signupName" placeholder="請輸入帳戶名稱" required>
                </div>
                <div class="form-group">
                    <label for="signupHolder">使用者姓名:</label>
                    <input type="text" class="form-control" id="signupHolder" placeholder="請輸入帳戶擁有人姓名" required>
                </div>
                <div class="form-group">
                    <label for="signupPassword">密碼:</label>
                    <input type="password" class="form-control" id="signupPassword" placeholder="請輸入網銀密碼" required>
                </div>
                <div class="form-group">
                    <label for="signupCheckPassword">確認密碼:</label>
                    <input type="password" class="form-control" id="signupCheckPassword" placeholder="請再次輸入網銀密碼" required>
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
<div class="modal fade" id="waitModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
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
<!-- Signup Success Modal -->
<div class="modal fade" id="successModal" aria-labelledby="signupModalLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h7 class="modal-title" id="successModalLabel">註冊成功</h7>
            </div>
            <div class="modal-body"> 
                <h6 class="my-auto">請使用剛剛註冊的帳號登入</h6>
            </div>
        </div>
    </div>
</div>
<script src="<?=$data["script"]?>"></script>