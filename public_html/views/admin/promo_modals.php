<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if ($promotion_modals): ?>
    <h1 class="page-header">Модальные окна для сайта bookmirs.ru</h1>
    <div class="table-responsive">
        <a href="/admin/?view=add_promo_modal" class="btn btn-sm btn-success">Добавить модальное окно</a>
        <script>
            $(document).ready(function () {
                $('.pop_text').magnificPopup({
                    removalDelay: 500,
                    callbacks: {
                        beforeOpen: function () {
                            this.st.mainClass = this.st.el.attr('data-effect');
                        }
                    },
                    midClick: true
                });
                $('.pop_up').magnificPopup({
                    type: 'image',
                    removalDelay: 500,
                    callbacks: {
                        beforeOpen: function () {
                            this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                            this.st.mainClass = this.st.el.attr('data-effect');
                        },
                        open: function () {
                            var magnificPopup = $.magnificPopup.instance,
                                cur = magnificPopup.st.el;
                            if (cur.attr('url_redirect')) {
                                $(".mfp-img").wrap($('<a href=' + cur.attr('url_redirect') + '></a>'));
                            }
                        }
                    },
                    closeOnContentClick: true,
                    midClick: true
                });
                $('a.hingle').magnificPopup({
                    mainClass: 'mfp-with-fade',
                    removalDelay: 1000,
                    callbacks: {
                        beforeOpen: function () {
                            var magnificPopup = $.magnificPopup.instance,
                                cur = magnificPopup.st.el;
                            if (cur.attr('href').indexOf('#popup') !== 0) {
                                magnificPopup.st.type = "image";
                            }
                        },
                        beforeClose: function () {
                            this.content.addClass('hinge');
                        },
                        close: function () {
                            this.content.removeClass('hinge');
                        }
                    },
                    midClick: true
                });
            });
        </script>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Название</th>
                <th>Дата начала</th>
                <th>Дата окончания</th>
                <th>Демонстрация всплывающего окна</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($promotion_modals as $promotion): ?>
                <tr>
                    <td><?= $promotion['name'] ?></td>
                    <td><?= $promotion['data_start'] ?></td>
                    <td><?= $promotion['data_end'] ?></td>
                    <td>
                        <a class="waves-effect waves-light btn <?= isset($promotion['filename']) && !empty($promotion['filename']) && $promotion['pop_up_type'] != "hinge" ? "pop_up" : ($promotion['pop_up_type'] == "hinge" ? "hingle" : "pop_text") ?>"
                           href="<?= isset($promotion['filename']) && !empty($promotion['filename']) ? "../../media/images/" . $promotion['filename'] : "#popup_" . $promotion['vid'] ?>"
                           data-effect="<?= $promotion['pop_up_type'] ?>"<?= isset($promotion['url_redirect']) ? ' url_redirect="' . $promotion['url_redirect'] . '"' : '' ?>>Демонстрация</a>
                    </td>
                    <td>
                        <div id="popup_<?= $promotion['vid']?>" class="white-popup mfp-with-anim mfp-hide">
                            <?php if (isset($promotion['content']) && !empty($promotion['content'])): ?>
                                <?= $promotion['content'] ?>
                            <?php endif; ?>
                            <?php if (isset($promotion['title']) && !empty($promotion['title'])): ?>
                                <span class="promotion_title"><?= $promotion['title'] ?></span>
                            <?php endif; ?>
                            <?php if (isset($promotion['description']) && !empty($promotion['description'])): ?>
                                <span class="promotion_description"><?= $promotion['description'] ?></span>
                            <?php endif; ?>
                        </div>
                    </td>
                    <td>
                        <a class="btn btn-xs btn-primary"
                           href="/admin/?view=edit_promo_modal&promo_modal_id=<?= $promotion['vid'] ?>">редактировать</a>
                        <form method="POST" action="">
                            <input type="hidden" name="id" value="<?= $promotion['vid'] ?>">
                            <input type="hidden" name="delete_promo_modal" value="1">
                            <button class="btn btn-xs btn-danger" type="submit" name="delete_submit">удалить</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <p>Модальных окон пока нет</p>
    <a href="/admin/?view=add_promo_modal" class="btn btn-sm btn-success" style="margin-bottom: 20px;">Добавить модальное окно</a>
<?php endif; ?>
