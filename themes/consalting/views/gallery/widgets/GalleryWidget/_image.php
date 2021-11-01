<div class="gallery-block__item">    
    <a data-fancybox="gallery" href="<?= $data->image->getImageUrl(); ?>">
        <picture class="absolute-img-picture">
            <source media="(min-width: 401px)" srcset="<?= $data->image->getImageUrlWebp(0, 0, true, null,'file'); ?>" type="image/webp">
            <source media="(min-width: 401px)" srcset="<?= $data->image->getImageNewUrl(0, 0, true, null,'file'); ?>">

            <source media="(min-width: 1px)" srcset="<?= $data->image->getImageUrlWebp(360, 270, true, null,'file'); ?>" type="image/webp">
            <source media="(min-width: 1px)" srcset="<?= $data->image->getImageNewUrl(360, 270, true, null,'file'); ?>">

            <img src="<?= $data->image->getImageNewUrl(0, 0, true, null,'file'); ?>" alt="<?= $data->image->alt; ?>">
        </picture>
        <div class="shadow fl fl-ai-c fl-jc-c"><i class="fa fa-search-plus" aria-hidden="true"></i></div>
    </a>
</div>