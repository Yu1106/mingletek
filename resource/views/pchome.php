<!DOCTYPE html>
<html>
<head>
    <title>PChome 商店街-個人賣場-網紅必買側開叉長款毛衣連身裙 坑條紋綁帶收腰洋裝 過膝小香風長袖打底內搭針織連身裙</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">

    <link rel="Shortcut Icon" type="image/x-icon" href="<?php echo RESOURCE_IMAGES_DIR ?>/favicon.ico">

    <!-- CSS -->
	<?= $css ?>
    <!-- Script -->
	<?= $js ?>
</head>
<body>
<div class="wrapper">
    <header></header>
    <main>
        <div class="breadcrumb">
            <label><?= \common\model\parameter\Pchome::PchomeType[$data['product']['pchome_category']] ?></label>
        </div>
        <div class="seller-board">
            <div class="seller-board-title"><?= $data['store']['name'] ?></div>
            <div class="seller-board-content"></div>
        </div>
        <div class="intro-section">
            <div class="intro-section-left">
                <div class="item-gallery">
                    <!-- Swiper -->
                    <div class="swiper-container gallery-top">
                        <div class="swiper-wrapper">
							<?php foreach ($data['swiper']['picture'] as $val): ?>
                                <div class="swiper-slide"
                                     style="background-image: url('<?= $val['path'] ?>');"></div>
							<?php endforeach; ?>
							<?php foreach ($data['swiper']['subPicture'] as $val): ?>
                                <div class="swiper-slide"
                                     style="background-image: url('<?= $val['path'] ?>');"></div>
							<?php endforeach; ?>
                        </div>
                    </div>
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
							<?php foreach ($data['swiper']['picture'] as $val): ?>
                                <div class="swiper-slide"
                                     style="background-image: url('<?= $val['path'] ?>');"></div>
							<?php endforeach; ?>
							<?php foreach ($data['swiper']['subPicture'] as $val): ?>
                                <div class="swiper-slide"
                                     style="background-image: url('<?= $val['path'] ?>');"></div>
							<?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="item-misc-info">
                    <div class="item-number clearfix">
                        <label>(商品編號： **********)</label>
                        <label class="view right">瀏覽數：0</label>
                    </div>
                    <div class="item-info-seller">
                        <div class="item-seller-title">
                            <label><?= $data['store']['name'] ?></label>
                        </div>
                        <div class="seller-row">
                            <span>賣家評價</span>
                            <label for="" class="number">0</label>
                            <label for="" class="more right">查看</label>
                        </div>
                        <div class="seller-row">
                            <span>友站評價</span>
                            <label for="" class="number">0</label>
                            <label for="" class="more right">查看</label>
                        </div>
                        <div class="seller-row">
                            <span>留言板</span>
                            <label for="" class="number">0</label>
                            <label for="" class="more right">查看</label>
                        </div>
                        <div class="seller-row clearfix">
                            <span>全部商品</span>
                            <label for="" class="number">0</label>
                            <label for="" class="more right">查看</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="intro-section-right">
                <h1 class="itemTitle"><?= $data['product']['name'] ?></h1>
                <div class="item-desc">
                    <div class="item-description">
						<?php foreach (explode("\n", $data['product']['product_description']) as $val): ?>
                            <p><?= $val ?></p>
						<?php endforeach; ?>
                    </div>
                    <div class="row">
                        <span class="row-title">一次付清特價</span>
                        <label class="row-value price">$<?= number_format($data['product']['sell_price']) ?></label>
                        <label class="row-value">元</label>
                    </div>
                    <div class="row">
                        <span class="row-title">優惠活動</span>
                        <label class="row-value"></label>
                    </div>
                    <div class="row">
                        <span class="row-title">付款方式</span>
                        <label class="row-value"></label>
                    </div>
                    <div class="row">
                        <span class="row-title">運費</span>
                        <label class="row-value"></label>
                    </div>
                    <div class="row">
                        <span class="row-title">商品狀態</span>
                        <label class="row-value"><?= $data['product']['is_new'] ?></label>
                    </div>
                    <div class="item-purchase">
                        <div class="item-purchase-row">
                            <span class="item-purchase-title">規格一</span>
							<?php if ($data['product']['size']) { ?><label for=""
                                                                           class="checkbox item-purchase-value"><?= $data['product']['size'] ?></label><?php } ?>
                        </div>
                        <div class="item-purchase-row">
                            <label for="" class="btn btnOrange">
                                <span class="shopping-cart-icon">加入購物車</span>
                            </label>
                            <label for="" class="btn btnGreen">
                                <span class="chat-icon">私訊</span>
                            </label>
                        </div>
                        <div class="item-purchase-row">
                            <label for="" class="aTag mr-15">
                                <img src="<?php echo RESOURCE_IMAGES_DIR ?>/pchome/heart-icon.gif" alt="">
                                加入追蹤
                            </label>
                            <label for="" class="aTag mr-15">
                                <img src="<?php echo RESOURCE_IMAGES_DIR ?>/pchome/chat-icon.gif" alt="">
                                留言板(0)
                            </label>
                        </div>
                    </div>
                    <div class="item-share"></div>
                </div>
            </div>
        </div>
        <div class="tab-section">
            <div class="item-tab tab1"></div>
            <div class="tab-container">
                <div class="notice">商店街提醒您：請勿與賣家「以LINE帳號私下聯絡或轉帳匯款」，此為常見詐騙手法。</div>
                <div class="item-description">
					<?php foreach (explode("\n", $data['product']['product_description']) as $val): ?>
                        <p><?= $val ?></p>
					<?php endforeach; ?>
                </div>
				<?php foreach ($data['swiper']['picture'] as $val): ?>
                    <div class="item-image-wrap">
                        <img src="<?= $val['path'] ?>" alt="">
                    </div>
				<?php endforeach; ?>
				<?php foreach ($data['swiper']['subPicture'] as $val): ?>
                    <div class="item-image-wrap">
                        <img src="<?= $val['path'] ?>" alt="">
                    </div>
				<?php endforeach; ?>
            </div>
            <div class="btnRow">
                <label for="" class="btn btnOrange">
                    <span class="shopping-cart-icon">加入購物車</span>
                </label>
            </div>
            <div class="item-tab tab2">
                <label for="">詳情請見</label>
                <label for="" class="aTag">MINGLETEK 購物說明</label>
            </div>
        </div>
    </main>
    <footer>
        © 商店街市集國際資訊股份有限公司版權所有，轉載必究。<br/>
        電話(不含例假日)：02-2700-8155
    </footer>
</div>
</body>
</html>
