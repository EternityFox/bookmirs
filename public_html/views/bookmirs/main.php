<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if ($news): ?>
    <span class="head-text d-flex justify-content-center mt-5" id="scrollspyNews">Новости</span>
    <div class="modal fade" id="modalNews" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h3 class="modal-title text-center w-100" id="news-title"></h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="regular-14 mb-4" id="short_desc">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mt-3" id="news-block-img">
                                <a href="" data-toggle="lightbox"
                                   data-title="" data-footer="">
                                    <img src="" alt="Картинка новостей"
                                         itemprop="image"/>
                                </a>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <div class="regular-14 mb-4" id="full_desc">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-3 justify-content-center">
        <?php foreach ($news as $newsDetail): ?>
            <div class="col-12 col-md-6 col-lg-4" itemprop="blogPost" itemscope=""
                 itemtype="http://schema.org/BlogPosting">
                <div class="card h-100 p-2 hews-card">
                    <h5 class="text-center">
                        <span class="text-black text-decoration-none text-news-card"><?= $newsDetail['title'] ?></span>
                        <!--<a class="text-black text-decoration-none text-news-card"
                           href="?view=news_detail&news_id=<?= $newsDetail['news_id'] ?>" itemprop="url"
                           title="<?= $newsDetail['title'] ?>"><?= $newsDetail['title'] ?></a> -->

                    </h5>
                    <img class="card-img-top" src="<?= PRODUCTIMG ?>images/260_<?= $newsDetail['img'] ?>" alt=""
                         itemprop="thumbnailUrl"/>
                    <!--
                    <a href="?view=news_detail&news_id=<?= $newsDetail['news_id'] ?>" itemprop="url"
                       title="<?= $newsDetail['title'] ?>">

                    </a>
                    -->
                    <div class="card-body p-0 mt-2 d-flex flex-column">
                        <p class="card-title news-card-body-text"><?= $newsDetail['short_desc'] ?></p>
                        <div class="mt-auto">
                            <form method="post">
                                <button class="btn btn-lg btn-outline-dark mx-auto d-block regular-14"
                                        data-bs-toggle="modal" data-bs-target="#modalNews"
                                        name="newsBtn" id="newsBtn" value="<?= $newsDetail['news_id'] ?>"
                                        type="submit">Подробнее...
                                </button>
                            </form>
                        </div>
                        <aside class="news-card-body-article-aside mt-2">
                            <dl class="d-flex flex-row g-1 news-card-aside-dl-text justify-content-start m-0 text-center">
                                <dd class="" itemprop="author" itemscope=""
                                    itemtype="http://schema.org/Person" title="" data-original-title="Written by ">
                                    <span itemprop="name"><?= $newsDetail['user'] ?></span>
                                </dd>
                                <dd class="news-card-body-article-createdby m-0 py-2 col" title=""
                                    data-original-title="Опубликовано: ">
                                    <time datetime="<?= $newsDetail['event_date'] ?>+00:00"
                                          itemprop="datePublished">
                                        <?= dateFormat($newsDetail['event_date']) ?>
                                    </time>
                                </dd>
                                <dd class="m-0 py-2 news-card-body-article-hits col">
                                    <meta itemprop="interactionCount"
                                          content="UserPageVisits:<?= $newsDetail['hits'] ?>"/>
                                    Просмотрено:
                                    <?= $newsDetail['hits'] ?>
                                </dd>
                            </dl>
                        </aside>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        $('.btn-outline-dark').click(function () {
            $.ajax({
                url: '/functions/ajax_news_detail.php',
                method: 'POST',
                data: {news_id: this.value},
                success: function (data) {
                    let news_detail = JSON.parse(data);
                    $('#news-title').html(news_detail.title);
                    $('#short_desc').html(news_detail.short_desc);
                    $('#full_desc').html(news_detail.full_desc);
                    $('#news-block-img a').attr('href', 'http://bookmirs.ru/media/images/' + news_detail.img);
                    $('#news-block-img a').attr('data-title', news_detail.title);
                    $('#news-block-img a').attr('data-footer', news_detail.short_desc);
                    $('#news-block-img img').attr('src', 'http://bookmirs.ru/media/images/300_' + news_detail.img);
                }
            });
        })
    </script>
<?php endif; ?>