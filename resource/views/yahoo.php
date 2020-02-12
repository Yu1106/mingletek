<!DOCTYPE html>
<html>
<head>
    <title>Yahoo奇摩拍賣 | <?= $data['product']['name'] ?></title>
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
    <header>
        <div class="header-top"></div>
        <div class="header-main"></div>
    </header>
    <main>
        <div class="breadcrumb">
            <label><?= \common\model\parameter\Yahoo::YahooType[$data['product']['yahoo_category']] ?></label>
        </div>
        <div class="sellerInfo">
            <section class="sellerInfoBox">
                <div class="infoBox">
                    <div class="storeLogoBox">
                        <figure class="storeLogo">
                            <!-- <img src="https://s.yimg.com/xd/api/res/1.2/2rT55QAa52KkNdw1qj_W9w--/YXBwaWQ9eXR3YXVjdGlvbnNlcnZpY2U7aD0xOTI7cT04NTtyb3RhdGU9YXV0bzt3PTE5Mg--/https://s.yimg.com/ma/bd59/storelogo/Y2382287839.jpg"> -->
                        </figure>
                    </div>
                    <div class="mainInfoBox">
                        <div class="sellerProfileBox">
                            <div class="sellerNameBox">
                                <label class="aTag sellerName"><?= $data['store']['name'] ?></label>
                            </div>
                            <div class="moreProfileBox">
                                <span>Y1234567890</span>
                                <abbr titel="2019年12月25日 上午5:12">** 分鐘前上線</abbr>
                                <span>粉絲 ****</span>
                            </div>
                        </div>
                        <div class="followSellerBox">
                            <label class="btn btnGreen">追蹤</label>
                        </div>
                    </div>
                </div>
                <div class="dashboardBox"></div>
            </section>
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
                <div class="item-share"></div>
            </div>
            <div class="intro-section-right">
                <div class="item-desc">
                    <h1 class="itemTitle"><?= $data['product']['name'] ?></h1>
                    <div class="watchlist">
                        <label class="watchWrap aTag"></label>
                        <lable class="likeCount">0</lable>
                    </div>
                    <p class="subtitle"></p>
                    <div class="item-purchase">
                        <div class="item-purchase-row">
                            <span class="item-purchase-title">原價</span>
                            <label class="item-purchase-value orig-price">$<?= $data['product']['price'] ?></label>
                        </div>
                        <div class="item-purchase-row">
                            <span class="item-purchase-title">促銷</span>
                            <label class="item-purchase-value price">$<?= $data['product']['sell_price'] ?></label>
                            <label class="item-purchase-value soldQty">/ 售出 0 件</label>
                        </div>
                        <div class="item-purchase-row">
                            <span class="item-purchase-title">尺寸</span>
							<?php if ($data['product']['size']) { ?><label for=""
                                                                           class="checkbox item-purchase-value"><?= $data['product']['size'] ?></label><?php } ?>
                        </div>
                        <div class="item-purchase-row">
                            <span class="item-purchase-title">顏色</span>
							<?php if ($data['product']['color']) { ?>
								<?php foreach (explode(",", $data['product']['color']) as $val): ?>
									<?php if ($val == 'custom') { ?>
                                        <label for=""
                                               class="checkbox item-purchase-value"><?= $data['product']['color_custom_field'] ?></label>
									<?php } else { ?>
                                        <label for=""
                                               class="checkbox item-purchase-value"><?= $val ?></label>
									<?php } ?>
								<?php endforeach; ?>
							<?php } ?>
                        </div>
                        <div class="item-purchase-row">
                            <span class="item-purchase-title">數量</span>
                            <label for="" class="qty-btn">-</label>
                            <label for="" class="input qty">0</label>
                            <label for="" class="qty-btn">+</label>
                        </div>
                        <div class="item-purchase-row">
                            <span class="item-purchase-title"></span>
                            <label for="" class="btn btnYellow">立即購買</label>
                            <label for="" class="btn">加入購物車</label>
                            <label for="" class="btn">
                                <span class="chat-icon">即時通</span>
                            </label>
                        </div>
                        <div class="item-purchase-row">
                            <span class="item-purchase-title">促銷活動</span>
                            <label class="item-purchase-value">****</label>
                        </div>
                        <div class="item-purchase-row">
                            <span class="item-purchase-title">付款方式</span>
                            <label class="item-purchase-value">****</label>
                        </div>
                        <div class="item-purchase-row">
                            <span class="item-purchase-title">運費</span>
                            <label class="item-purchase-value">****</label>
                        </div>
                    </div>
                    <div class="item-info">
                        <div class="item-info-detail">
                            <div class="row">
                                <div class="row-title">商品狀況</div>
                                <label for="" class="row-value"><?= $data['product']['is_new'] ?></label>
                            </div>
                            <div class="row">
                                <div class="row-title">預購出貨</div>
                                <label for="" class="row-value">*****</label>
                            </div>
                            <div class="row">
                                <div class="row-title">所在地區</div>
                                <label for="" class="row-value"><?= $data['product']['site'] ?></label>
                            </div>
                            <div class="row">
                                <div class="row-title">商品編號</div>
                                <label for="" class="row-value">************</label>
                            </div>
                        </div>
                        <div class="item-slogan-box"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-section">
            <div class="item-tab">
                <div class="tabs tab1">商品資訊</div>
                <div class="tabs tab2">問與答 (0)</div>
            </div>
            <div class="tab-container">
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
				<?php if ($data['store']['note'] != ''): ?>
                    <div class="item-description">
                        <p>注意事項</p>
						<?php foreach (explode("\n", $data['store']['note']) as $val): ?>
                            <p><?= $val ?></p>
						<?php endforeach; ?>
                    </div>
				<?php endif; ?>
				<?php if ($data['store']['return_notice'] != ''): ?>
                    <div class="item-description">
                        <p>退換貨政策</p>
						<?php foreach (explode("\n", $data['store']['return_notice']) as $val): ?>
                            <p><?= $val ?></p>
						<?php endforeach; ?>
                    </div>
				<?php endif; ?>
            </div>
        </div>
    </main>
    <footer></footer>
</div>
</body>
</html>
