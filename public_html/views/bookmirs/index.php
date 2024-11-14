<?php require_once 'inc/header.php' ?>
<?php if ($view == 'promotion'): ?>
    <?php include 'promotion.php' ?>
<?php else: ?>
    <main>
        <div class="container mt-minus" id="mainbody">
            <?php if (isset($promotion_modal) && $promotion_modal): ?>
                <div class="label_promotions opened" <?php echo $promotion_modal['action'] ? '' : 'style="display: none"'; ?>>
                    <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    </svg>
                    <a class="<?php echo isset($promotion_modal['filename']) && !empty($promotion_modal['filename']) && $promotion_modal['pop_up_type'] != "hinge" ? "pop_up" : ($promotion_modal['pop_up_type'] == "hinge" ? "hingle" : "pop_text"); ?>"
                       href="<?php echo isset($promotion_modal['filename']) && !empty($promotion_modal['filename']) ? "../../media/images/" . $promotion_modal['filename'] : "#popup_" . $promotion_modal['id']; ?>"
                       data-effect="<?php echo $promotion_modal['pop_up_type']; ?>" <?php echo isset($promotion_modal['url_redirect']) ? "url_redirect=" . $promotion_modal['url_redirect'] : ''; ?>>Акция</a>
                </div>
                <div id="popup_<?php echo $promotion_modal['id']; ?>" class="white-popup mfp-with-anim mfp-hide">
                    <?php if (isset($promotion_modal['content']) && !empty($promotion_modal['content'])): ?>
                        <?php echo $promotion_modal['content']; ?>
                    <?php endif; ?>
                    <?php if (isset($promotion_modal['title']) && !empty($promotion_modal['title'])): ?>
                        <span class="promotion_title"><?php echo $promotion_modal['title']; ?></span>
                    <?php endif; ?>
                    <?php if (isset($promotion_modal['description']) && !empty($promotion_modal['description'])): ?>
                        <span class="promotion_description"><?php echo $promotion_modal['description']; ?></span>
                    <?php endif; ?>
                </div>
                <script>
                    $(document).ready(function () {
                        $('.label_promotions .pop_text').magnificPopup({
                            removalDelay: 500,
                            callbacks: {
                                beforeOpen: function () {
                                    this.st.mainClass = this.st.el.attr('data-effect');
                                }
                            },
                            midClick: true
                        });
                        $('.label_promotions .pop_up').magnificPopup({
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
                        $('.label_promotions a.hingle').magnificPopup({
                            mainClass: 'mfp-with-fade',
                            removalDelay: 1000,
                            callbacks: {
                                beforeOpen: function () {
                                    var magnificPopup = $.magnificPopup.instance,
                                        cur = magnificPopup.st.el;
                                    if (!cur.attr('href').startsWith('#popup')) {
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
                        $('.label_promotions').click(function (e) {
                            if (e.clientX <= $(this).offset().left) {
                                $('.label_promotions').toggleClass('opened');
                            }
                        });
                    });
                </script>
                <?php if ($_SESSION['promotion']): ?>
                    <script>
                        $(document).ready(function () {
                            $('.label_promotions a').trigger('click');
                        });
                    </script>
                <?php endif; ?>
            <?php endif; ?>
            <?php include 'facts.php' ?>
            <?php include 'cart_product.php' ?>
            <?php include 'shops.php' ?>
            <?php include 'main.php' ?>
        </div>
        <?php include 'vacancies.php' ?>
    </main>
<?php endif; ?>
<footer>
    <?php require_once 'inc/footer.php' ?>
</footer>
</body>
</html>
