<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if ($coupons): ?>
    <h1 class="page-header">Купоны</h1>
    <div class="coupon-number my-3">Кол-во зарегистрированных купонов: <strong><?= $totalCoupons ?></strong></div>
    <div class="coupons-helpers">
        <form method="GET" action="/admin/" class="form-inline mb-3">
            <input type="hidden" name="view" value="coupons">
            <div class="form-group">
                <label for="search" class="mr-2">Поиск:</label>
                <input type="text" name="search" id="search" class="form-control mr-2"
                       value="<?= $search ?>" placeholder="поиск...">
            </div>
            <button type="submit" class="btn btn-primary">Искать</button>
        </form>
        <form method="GET" action="/admin/" class="form-inline mb-3">
            <input type="hidden" name="view" value="coupons">
            <div class="form-group">
                <label for="limit" class="mr-2">Купонов на странице:</label>
                <select name="limit" id="limit" class="form-control" onchange="this.form.submit()">
                    <?php foreach ([10, 20, 50] as $option): ?>
                        <option value="<?= $option ?>" <?= isset($_GET['limit']) && $_GET['limit'] == $option ? 'selected' : '' ?>>
                            <?= $option ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>

    <div class="my-3">
        <a href="/admin/?view=add_coupon" class="btn btn-success">Добавить купон</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Купон</th>
                <th>ФИО</th>
                <th>Почта</th>
                <th>Телефон</th>
                <th>Дата регестрации</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($coupons as $coupon): ?>
                <tr>
                    <td><?= $coupon['code'] ?></td>
                    <td><?= $coupon['name'] ?></td>
                    <td><?= $coupon['email'] ?></td>
                    <td><?= $coupon['phone'] ?></td>
                    <td><?= dateFormat($coupon['updated_at']) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <nav aria-label="Page navigation" class="mt-3">
        <ul class="pagination">
            <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                <a class="page-link" href="/admin/?view=coupons&limit=<?= $limit ?>&page=<?= max(1, $page - 1) ?>"
                   aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php if ($page <= 3): ?>
                <?php for ($i = 1; $i <= min(4, $totalPages); $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link"
                           href="/admin/?view=coupons&limit=<?= $limit ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <?php if ($totalPages > 5): ?>
                    <li class="page-item disabled"><a class="page-link">...</a></li>
                    <li class="page-item">
                        <a class="page-link"
                           href="/admin/?view=coupons&limit=<?= $limit ?>&page=<?= $totalPages ?>"><?= $totalPages ?></a>
                    </li>
                <?php endif; ?>
            <?php elseif ($page > 3 && $page < $totalPages - 2): ?>
                <li class="page-item">
                    <a class="page-link" href="/admin/?view=coupons&limit=<?= $limit ?>&page=1">1</a>
                </li>
                <li class="page-item disabled"><a class="page-link">...</a></li>
                <li class="page-item">
                    <a class="page-link"
                       href="/admin/?view=coupons&limit=<?= $limit ?>&page=<?= $page - 1 ?>"><?= $page - 1 ?></a>
                </li>
                <li class="page-item active">
                    <a class="page-link"
                       href="/admin/?view=coupons&limit=<?= $limit ?>&page=<?= $page ?>"><?= $page ?></a>
                </li>
                <li class="page-item">
                    <a class="page-link"
                       href="/admin/?view=coupons&limit=<?= $limit ?>&page=<?= $page + 1 ?>"><?= $page + 1 ?></a>
                </li>
                <li class="page-item disabled"><a class="page-link">...</a></li>
                <li class="page-item">
                    <a class="page-link"
                       href="/admin/?view=coupons&limit=<?= $limit ?>&page=<?= $totalPages ?>"><?= $totalPages ?></a>
                </li>
            <?php else: ?>
                <li class="page-item">
                    <a class="page-link" href="/admin/?view=coupons&limit=<?= $limit ?>&page=1">1</a>
                </li>
                <li class="page-item disabled"><a class="page-link">...</a></li>
                <?php for ($i = $totalPages - 3; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link"
                           href="/admin/?view=coupons&limit=<?= $limit ?>&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
            <?php endif; ?>
            <li class="page-item <?= $page >= $totalPages ? 'disabled' : '' ?>">
                <a class="page-link"
                   href="/admin/?view=coupons&limit=<?= $limit ?>&page=<?= min($totalPages, $page + 1) ?>"
                   aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>


<?php else: ?>
    <p>Купонов пока нет</p>
    <a href="/admin/?view=add_coupon" class="btn btn-sm btn-success" style="margin-bottom: 20px;">Добавить купон</a>
<?php endif; ?>
