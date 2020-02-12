<!DOCTYPE html>
<html>
<head>
    <title>露天拍賣 - <?= $data['product']['name'] ?></title>
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
            <label><?= \common\model\parameter\Ruten::RutenType[$data['product']['ruten_category']] ?></label>
        </div>
        <h1 class="itemTitle"><?= $data['product']['name'] ?></h1>
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
                <div class="item-quick-fact"></div>
                <div class="item-misc-info">
                    <div class="item-number clearfix">
                        <label>商品編號： **********</label>
                        <label class="aTag right">檢舉</label>
                    </div>
                    <div class="item-memo">
                        <h3 class="item-memo-title">商品備註</h3>
                        <ul class="item-memo-list">
                            <li class="status">物品狀況：&nbsp;<?= $data['product']['is_new'] ?></li>
                            <li class="location">物品所在地：&nbsp;<?= $data['product']['site'] ?></li>
                            <li class="upload-time">上架時間：&nbsp;<?= date("Y-m-d H:i:s") ?></li>
                            <!-- <li class="seven-eleven-limit">
								<label class="title">超商取付、郵局到付與宅急便「黑貓PAY貨到付款」買家結帳條件：</label>cv
								<span class="content">交易未完成次數必須 ≦ 2次</span>
								<span>，</span>
								<span class="content">評價總分必須 ≧ 0分</span>
								<span>，</span>
								<span class="content">近半年棄標次數 ≦ 2次</span>
							</li> -->
                            <li class="initiation">物品開始價格：&nbsp;
                                <span>$<?= $data['product']['sell_price'] ?>元</span>
                            </li>
                            <li class="putforward">可能會提前結束販售</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="intro-section-right">
                <div class="item-desc">
                    <div class="item-purchase">
                        <div class="item-purchase-row">
                            <span class="item-purchase-title">直購價：</span>
                            <label class="item-purchase-value price">$<?= $data['product']['sell_price'] ?></label>
                        </div>
                        <div class="item-purchase-row">
                            <span class="item-purchase-title">規格：</span>
							<?php if ($data['product']['size']) { ?><label for=""
                                                                           class="checkbox item-purchase-value"><?= $data['product']['size'] ?></label><?php } ?>
                        </div>
                        <div class="item-purchase-row">
                            <span class="item-purchase-title">項目：</span>
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
                            <span class="item-purchase-title">數量：</span>
                            <label for="" class="qty-btn">-</label>
                            <label for="" class="input qty">0</label>
                            <label for="" class="qty-btn">+</label>
                            <label for=""
                                   class="item-purchase-value stock">庫存大於<span><?= $data['product']['stock'] ?></span>件</label>
                        </div>
                        <div class="item-purchase-row">
                            <span class="item-purchase-title"></span>
                            <label for="" class="btn btnOrange">
                                <span class="shopping-cart-icon">加入購物車</span>
                            </label>
                            <label for="" class="btn btnRed">直接購買</label>
                        </div>
                        <div class="item-tracking item-purchase-row">
                            <label for="" class="aTag">加入追蹤</label>
                        </div>
                    </div>
                    <div class="row">
                        <span class="row-title">優惠活動：</span>
                        <label class="row-value aTag">******</label>
                    </div>
                    <div class="item-info">
                        <div class="item-info-detail">
                            <div class="row">
                                <div class="row-title">已賣數量：</div>
                                <label for="" class="row-value numberLarge">0</label>
                            </div>
                            <div class="row">
                                <div class="row-title">付款方式：</div>
                                <label for="" class="row-value"></label>
                            </div>
                            <div class="row">
                                <div class="row-title">運送方式：</div>
                                <label for="" class="row-value"></label>
                            </div>
                        </div>
                        <div class="item-info-seller">
                            <div class="item-seller-title clearfix">
                                <h3>賣家資訊</h3>
                                <label for="" class="aTag right">加入最愛</label>
                            </div>
                            <div class="seller-row">
                                <label for="" class="aTag">******</label>
                                <label for="" class="aTag">(***)</label>
                                <span class="chat-icon"></span>
                            </div>
                            <div class="seller-row">
                                <label for="" class="aTag">賣場首頁</label>
                            </div>
                            <div class="seller-row seller-icons"></div>
                            <div class="seller-row">
                                <span>全部商品：</span>
                                <label for="" class="aTag numberLarge">******</label>
                            </div>
                            <div class="seller-row">
                                <span>評價分數：</span>
                                <label for="" class="aTag numberLarge">****</label>
                                <label for="" class="aTag">查看</label>
                            </div>
                            <div class="seller-row">
                                <label for="" class="aTag">關於我</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-share"></div>
            </div>
        </div>
        <div class="tab-section">
            <div class="item-tab"></div>
            <div class="tab-container">
                <div class="seller-board">
                    <h3 class="seller-board-title"><?= $data['store']['name'] ?></h3>
                    <div class="seller-board-content"></div>
                </div>
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
