<?php defined('IS_I_SITE') or die('Access denied'); ?>

	<div class="last-news">
		<?php if($news):?>
			<div class="box-heading"><h1>Новости</h1></div>
				<div id="newscontainer">
					<?php foreach($news as $newsDetail): ?>
						<article class="item">
							<div class="item-image">
								<a href="?view=news_detail&news_id=<?=$newsDetail['news_id']?>" itemprop="url" title="<?=$newsDetail['title']?>">
									<img src="<?=PRODUCTIMG?>images/260_<?=$newsDetail['img']?>" alt="" itemprop="thumbnailUrl"/>
								</a>
								<section class="readmore">
									<a class="btn btn-primary" href="?view=news_detail&news_id=<?=$newsDetail['news_id']?>" itemprop="url">Подробнее</a>
								</section>
							</div>
							<header class="article-header clearfix">
								<h2 class="article-title" itemprop="name">
									<a href="?view=news_detail&news_id=<?=$newsDetail['news_id']?>" itemprop="url" title="<?=$newsDetail['title']?>"><?=$newsDetail['title']?></a>
								</h2>
							</header>
							<aside class="article-aside clearfix">
								<dl class="article-info pull-left muted">
									<dd class="createdby hasTooltip" itemprop="author" itemscope="" itemtype="http://schema.org/Person" title="" data-original-title="Written by ">
										<strong>
											<span itemprop="name"><?=$newsDetail['user']?></span>
										</strong>
									</dd>
									<dd class="published hasTooltip" title="" data-original-title="Опубликовано: ">
										<time datetime="<?=$newsDetail['event_date']?>+00:00" itemprop="datePublished">
											<strong><?=dateFormat($newsDetail['event_date'])?></strong>
										</time>
									</dd>
									<dd class="hits">
										<meta itemprop="interactionCount" content="UserPageVisits:<?=$newsDetail['hits']?>"/>
										 Просмотрено:
										<strong><?=$newsDetail['hits']?></strong>
									</dd>
								</dl>
							</aside>
							<section class="article-intro clearfix">
								<?=$newsDetail['short_desc']?>
							</section>
							<div class="tags">
								<?=$newsDetail['tags']?>
							</div>
						</article>
				<?php endforeach; ?>
			</div>
		<?php else:?>
			<p>Извините, на данный момент новостей нет</p>
		<?php endif;?>
	</div>

	<script type="text/javascript">
	 $(document).ready(function () {
		$("#newscontainer").gridalicious({
		  width: 250
			});
		});
	</script>