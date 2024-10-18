<?php defined('IS_I_SITE') or die('Access denied'); ?>
<?php if($newsDetail): // если есть вакансия ?>
<div class="item-page clearfix">
	<article itemscope="" itemtype="http://schema.org/Article">
		<meta itemprop="inLanguage" content="ru-RU"/>
		<meta itemprop="url" content="<?=PATH?>?view=news_detail&news_id=<?=$newsDetail['news_id']?>"/>
		<header class="article-header clearfix">
			<h1 class="article-title" itemprop="name">
				<a href="?view=news_detail&news_id=<?=$newsDetail['news_id']?>" itemprop="url" title="<?=$newsDetail['title']?>"> <?=$newsDetail['title']?></a>
			</h1>
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
			</dl>
		</aside>
		<div class="pull-left item-image article-image article-image-full">
			<a href="<?=PRODUCTIMG?>images/<?=$newsDetail['img']?>" data-toggle="lightbox" data-title="<?=$newsDetail['title']?>" data-footer="<?=$newsDetail['short_desc']?>">
				<img src="<?=PRODUCTIMG?>images/300_<?=$newsDetail['img']?>" alt="" itemprop="image"/>
			</a>
		</div>
		<section class="article-content clearfix">
			<?=$newsDetail['full_desc']?>
		</section>
	</article>
	<section id="other-news">
		<?php foreach($otherNews as $item): ?>
			<article>
				<div class="box-content">
					<table width="100%"><tr>
						<td id="imgtd">
							<div class="image">
								<a href="?view=news_detail&news_id=<?=$item['news_id']?>" itemprop="url" title="<?=$item['title']?>">
									<img src="<?=PRODUCTIMG?>images/100_<?=$item['img']?>" alt="" itemprop="thumbnailUrl"/>
								</a>
							</div>
						</td>
						<td id="desctd">
							<div class="name">
								<a href="?view=news_detail&news_id=<?=$item['news_id']?>" itemprop="url" title="<?=$item['title']?>"><?=$item['title']?></a>
							</div>
							<div class="desc">
								<?=$item['short_desc']?>
							</div>
						</td>
					</tr></table>


				</div>
			</article>
		<?php endforeach; ?>
	</section>
</div>
<script type="text/javascript">
	$(document).ready(function ($) {

		// delegate calls to data-toggle="lightbox"
		$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
			event.preventDefault();
			return $(this).ekkoLightbox({
				onShown: function() {
					if (window.console) {
						return console.log('Checking our the events huh?');
					}
				}
			});
		});
	});
</script>
<?php else: ?>
    <div class="error">Извините, но данная новость уже не актуальна</div>
<?php endif; ?>