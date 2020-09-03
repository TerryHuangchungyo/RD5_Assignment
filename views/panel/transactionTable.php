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
            <tr>
            <th scope="row">00000000001</th>
            <td><span class="text-success">存款</span></td>
            <td>1000</td>
            <td><span class="text-success">成功</span></td>
            <td>5000.000</td>
            <td>2020-08-31 14:05:23</td>
            </tr>
            <tr>
            <th scope="row">00000000002</th>
            <td>存款</td>
            <td>1000</td>
            <td>成功</td>
            <td>5000.000</td>
            <td>2020-08-31 14:05:23</td>
            </tr>
            <tr>
            <th scope="row">00000000003</th>
            <td>存款</td>
            <td>1000</td>
            <td>成功</td>
            <td>5000.000</td>
            <td>2020-08-31 14:05:23</td>
            </tr>
            <tr>
            <th scope="row">00000000004</th>
            <td>存款</td>
            <td>1000</td>
            <td>成功</td>
            <td>5000.000</td>
            <td>2020-08-31 14:05:23</td>
            </tr>
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                </li>
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&lt;</span>
                </a>
                </li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&gt;</span>
                </a>
                </li>
                <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<div id="transDetail" class="container my-3">
    <div class="container mt-3">
        <h4 class="text-secondary">交易明細</h4>
        <div class="container rounded border border-dark">
            <div class="my-3 ml-2">
                <h5>交易編號: 24</h5>
            </div>
            <div class="my-3 ml-2">
                <h5>交易日期: 2020-09-03 11:35:40</h5>
            </div>
            <div class="my-3 ml-2">
                <h5>交易類型: <span class="text-danger">提款</span></h5>
            </div>
            <div class="my-3 ml-2">
                <h5>交易狀態: <span class="text-success">成功</span></h5>
            </div>
            <div class="my-3 ml-2">
                <h5>交易帳戶: 核彈總司令</h5>
            </div>
            <div class="my-3 ml-2">
                <h5>交易金額: 2000.000</h5>
            </div>
            <div class="my-3 ml-2">
                <h5>帳戶餘額: 2000.000</h5>
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