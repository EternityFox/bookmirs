<?php defined('IS_I_SITE') or die('Access denied'); clearstatcache(); ?>

<?php if($equipment): ?>    
    <div class="product-info row">
        <div class="col-xs-12 col-md-4 col-sm-4">
            <div class="image">
                <?php if ($equipment['image'] && file_exists($_SERVER['DOCUMENT_ROOT'].'/media/equipment/'.$equipment['id'].'.'.$equipment['image'])): ?>
                    <a href="/media/equipment/<?=$equipment['id'].'.'.$equipment['image']?>" data-toggle="lightbox" data-title="<?=$equipment['name']?>" data-footer="<?=$equipment['name']?>">
                        <img src="/media/equipment/<?=$equipment['id'].'.'.$equipment['image']?>" alt="<?=$equipment['name']?>" />
                    </a>
                <?php else: ?>
                    <img src="/media/no-image.jpg" alt="<?=$equipment['name']?>">
                <?php endif; ?>
            </div>
        </div>
        <div class="col-xs-12 col-md-8 col-sm-8">
            <h1 class="product-title"><?=$equipment['name']?></h1>
            <div class="description"><?=$equipment['description']?></div>
        </div>
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
    <div class="error">Такого товара нет</div>
<?php endif; ?>

    