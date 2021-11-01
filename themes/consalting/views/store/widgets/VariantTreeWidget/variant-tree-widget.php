<div class="variants">
    <div class="variant-wrap">
        <?php foreach ($tree as $attributeName => $data) : ?>
            <div class="variant-item line-bottom">
                <div class="variant-item__title"><label><?= $attributeName ?>:</label></div>
                <?php if (isset(current($data)['id'])) : ?>
                <div class="variant-item__list hide">
                    <?php foreach ($data as $item) : ?>
                        <button
                            class="variant-button btn-variant js-variant-btn"
                            data-target="#varint-<?=$item['id'] ?>"
                            data-id="<?=$item['id'] ?>"
                        ><?= $item['attribute_value'] ?></button>
                    <?php endforeach ?>
                </div>
                <?php else : ?>
                    <?php foreach ($data as $d) : ?>
                        <div class="variant-item__list hide" id="varint-<?=current($d)['parent_id'] ?>">
                            <?php foreach ($d as $i) : ?>
                                <button
                                    class="variant-button btn-variant js-variant-btn"
                                    data-target="#varint-<?=$i['id'] ?>"
                                    data-id="<?=$i['id'] ?>"
                                ><?= $i['attribute_value'] ?></button>
                            <?php endforeach ?>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        <?php endforeach ?>
    </div>
</div>