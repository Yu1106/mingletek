<?php

use common\model\parameter\Category;
use common\model\parameter\Collar;
use common\model\parameter\Color;
use common\model\parameter\Fabric;
use common\model\parameter\Feature1;
use common\model\parameter\Feature2;
use common\model\parameter\Feature3;
use common\model\parameter\Feature4;
use common\model\parameter\Feature5;
use common\model\parameter\isNew;
use common\model\parameter\Keyword;
use common\model\parameter\Neckline;
use common\model\parameter\Pchome;
use common\model\parameter\Ruten;
use common\model\parameter\Site;
use common\model\parameter\Size;
use common\model\parameter\Sleeve;
use common\model\parameter\Store;
use common\model\parameter\SubCategory;
use common\model\parameter\Yahoo;

?>
<?php echo $header; ?>
<main>
    <div id="alertMsgBox" class="fancybox-content lightBox">分析錯誤!! 請砍掉重練</div>
    <form id="editForm" method="post" action="step4.php">
        <div id="formErrorMsg" class="fancybox-content lightBox"></div>
        <div id="submitConfirm" class="fancybox-content lightBox">
            <h4>請問確定要送出表單嗎?</h4>
            <label class="noticeTxt">請再次確認，每個尺寸都已經填寫對應的庫存數量!</label>
            <div class="flexBtnRow">
                <a class="btn" href="javascript:step4Action.setSubmitCheck();">確認</a>
                <a class="btn" href="javascript:;" data-fancybox-close>取消</a>
            </div>
        </div>
		<?= \Volnix\CSRF\CSRF::getHiddenInputString(); ?>
        <input type="hidden" id="id" name="id" value="<?= $data['first']['id'] ?>">
		<?php echo $section; ?>
        <section class="sectionItemList">
            <div class="sectionTitle">
                <h5><i class="icon-subTitle"></i>點選各商品主圖 (小圖) 即可編輯該筆商品內容，編輯完成並儲存後，商品主圖上會顯示 v 符號。</h5>
            </div>
            <div class="sectionContent">
				<?php foreach ($data['picture'] as $key => $val): ?>
                    <a class="itemThumbnail checked <?= ($data['first']['picture'] == $val['img']) ? "current" : "" ?>"
                       href="javascript:">
						<?php if ($val['is_edit']) { ?><i class="icon-check-square"></i><?php } ?>
                        <img src="<?= $val['path'] ?>" data-id="<?= $val['id'] ?>" alt="" class="itemImg">
                    </a>
				<?php endforeach; ?>
            </div>
        </section>
        <section class="sectionItemEdit">
            <div class="sectionTitle">
                <h5>
                    <i class="icon-subTitle"></i>以下為上架小幫手為您辨識出來的商品特徵, 請確認是否正確, 所有資訊都可以編輯喔
                </h5>
            </div>
            <div class="sectionContent flexbox">
                <div class="editLeft">
                    <div class="editPic">
                        <!-- Swiper -->
                        <div class="swiper-container gallery-top">
                            <div class="swiper-wrapper">
								<?php foreach ($data['swiper']['picture'] as $key => $val): ?>
                                    <div data-img="<?= $val["img"] ?>" class="swiper-slide"
                                         style="background-image: url('<?= $val["path"] ?>');"></div>
								<?php endforeach; ?>
								<?php foreach ($data['swiper']['subPicture'] as $key => $val): ?>
                                    <div data-img="<?= $val["img"] ?>" class="swiper-slide"
                                         style="background-image: url('<?= $val["path"] ?>');"></div>
								<?php endforeach; ?>
                            </div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
								<?php foreach ($data['swiper']['picture'] as $key => $val): ?>
                                    <div data-img="<?= $val["img"] ?>" class="swiper-slide"
                                         style="background-image: url('<?= $val["path"] ?>');"></div>
								<?php endforeach; ?>
								<?php foreach ($data['swiper']['subPicture'] as $key => $val): ?>
                                    <div data-img="<?= $val["img"] ?>" class="swiper-slide"
                                         style="background-image: url('<?= $val["path"] ?>');">
                                        <i class="icon-delete"></i>
                                    </div>
								<?php endforeach; ?>
                            </div>
                        </div>
                        <div class="btnRow">
                            <label class="btn">
                                上傳商品附圖
                                <input id="swiperupload" type="file" name="files[]" accept="image/*" multiple="">
                            </label>
                        </div>
                    </div>
                    <div class="editDesc formItem">
                        <label class="formLabel required" for="desc">商品說明</label>
                        <textarea id="product_description" class="validate[required]" name="product_description"
                                  rows="4"
                                  data-prompt-target="formErrorMsg"
                                  data-errormessage="* 請填寫商品說明"><?= ($data['first']['product_description'] != '') ? $data['first']['product_description'] : "" ?></textarea>
                    </div>
                </div>
                <div class="editRight">
                    <div class="tabHead">
                        <div class="tabs tabTrigger active" data-tab="tab-1">
                            <div class="tabTitle">基本資料</div>
                        </div>
                        <div class="tabs tabTrigger" data-tab="tab-2">
                            <div class="tabTitle">產品分類</div>
                        </div>
                        <div class="tabs tabTrigger" data-tab="tab-3">
                            <div class="tabTitle">特色分類</div>
                        </div>
                    </div>
                    <div id="tab-1" class="tabContent active">
						<?php if (in_array(Store::PCHOME, explode(",", $data['store']['upload_store_type']))): ?>
                            <div class="formItem">
                                <label class="formLabel">pchome 類別</label>
                                <div class="selectWrap icon-expand">
                                    <select id="pchome_category" name="pchome.category">
                                        <option value="">類別</option>
										<?php foreach (Pchome::PchomeType as $key => $val): ?>
                                            <option <?= ($data['first']['pchome_category'] == $key) ? "selected" : "" ?>
                                                    value="<?= $key ?>"><?= $val ?></option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if (in_array(Store::RUTEN, explode(",", $data['store']['upload_store_type']))): ?>
                            <div class="formItem">
                                <label class="formLabel">露天類別</label>
                                <div class="selectWrap icon-expand">
                                    <select id="ruten_category" name="ruten.category">
                                        <option value="">類別</option>
										<?php foreach (Ruten::RutenType as $key => $val): ?>
                                            <option <?= ($data['first']['ruten_category'] == $key) ? "selected" : "" ?>
                                                    value="<?= $key ?>"><?= $val ?></option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
						<?php endif; ?>
						<?php if (in_array(Store::YAHOO, explode(",", $data['store']['upload_store_type']))): ?>
                            <div class="formItem">
                                <label class="formLabel">yahoo 類別</label>
                                <div class="selectWrap icon-expand">
                                    <select id="yahoo_category" name="yahoo.category">
                                        <option value="">類別</option>
										<?php foreach (Yahoo::YahooType as $key => $val): ?>
                                            <option <?= ($data['first']['yahoo_category'] == $key) ? "selected" : "" ?>
                                                    value="<?= $key ?>"><?= $val ?></option>
										<?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
						<?php endif; ?>
                        <div class="formItem">
                            <label class="formLabel required">商品名稱</label>
                            <input class="validate[required]" type="text" id="name" name="name" placeholder="商品名稱"
                                   value="<?= $data['first']['name'] ?>"
                                   data-prompt-target="formErrorMsg" data-errormessage="* 請填寫商品名稱">
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">原價</label>
                            <input class="validate[required]" type="number" id="price" name="price" placeholder="原價"
                                   value="<?= $data['first']['price'] ?>" min="0" data-prompt-target="formErrorMsg"
                                   data-errormessage="* 請填寫原價">
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">商品售價/促銷</label>
                            <input class="validate[required]" type="number" id="sell_price" name="sell.price"
                                   placeholder="商品售價/促銷"
                                   value="<?= $data['first']['sell_price'] ?>" min="0" data-prompt-target="formErrorMsg"
                                   data-errormessage="* 請填寫商品售價/促銷">
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">尺寸 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Size::SizeType as $key => $val): ?>
                                    <input id="<?= $val ?>" class="size validate[minCheckbox[1]] checkbox"
                                           type="checkbox"
                                           name="size[]"
                                           value="<?= $val ?>" data-prompt-target="formErrorMsg"
                                           data-errormessage="* 請至少選擇一種尺寸"
										<?= in_array($val, explode(",", $data['first']['size'])) ? "checked" : "" ?>>
                                    <label for="<?= $val ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input id="sizeCustom" class="size customCheckbox validate[minCheckbox[1]] checkbox"
                                       type="checkbox" name="size[]" value="custom" data-prompt-target="formErrorMsg"
                                       data-errormessage="* 請至少選擇一種尺寸" <?= in_array('custom', explode(",", $data['first']['size'])) ? "checked" : "" ?>>
                                <label for="sizeCustom">
                                    <span class="checkboxIcon"></span>
                                    自填
                                </label>
                                <input id="size_custom_field" name="size.custom.field"
                                       class="customField validate[condRequired[sizeCustom]]" type="text"
                                       placeholder="填寫多個項目，請使用逗號區隔" data-prompt-target="formErrorMsg"
                                       data-errormessage="* 您已勾選自填尺寸，請至少填寫一項"
                                       value="<?= in_array('custom', explode(",", $data['first']['size'])) ? $data['first']['size_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">庫存</label>
                            <input class="validate[required]" type="text" id="stock" name="stock"
                                   value="<?= $data['first']['stock'] ?>" placeholder="請填寫尺寸對應的數量，並使用逗號區隔"
                                   data-prompt-target="formErrorMsg" data-errormessage="* 請填寫庫存">
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">物品新舊</label>
                            <div class="radioWrap">
								<?php foreach (isNew::isNewType as $key => $val): ?>
                                    <input <?= ($data['first']['is_new'] == $val) ? "checked" : "" ?> id="<?= $key ?>"
                                                                                                      class="is_new validate[required]"
                                                                                                      type="radio"
                                                                                                      name="is_new"
                                                                                                      value="<?= $val ?>"
                                                                                                      data-prompt-target="formErrorMsg"
                                                                                                      data-errormessage="* 請填寫物品新舊">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">物品所有地</label>
                            <div class="selectWrap icon-expand">
                                <select id="site" class="validate[required]" name="site" data-prompt-target="formErrorMsg" data-errormessage="* 請填寫物品所有地">
                                    <option value=""></option>
									<?php foreach (Site::SiteType as $key => $val): ?>
                                        <option <?= ($data['first']['site'] == $key) ? "selected" : "" ?>
                                                value="<?= $key ?>"><?= $val ?></option>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">刊登天數</label>
                            <input class="validate[required]" type="number" id="posting_days" name="posting.days"
                                   placeholder="刊登天數"
                                   value="<?= $data['first']['posting_days'] ?>"
                                   min="0" data-prompt-target="formErrorMsg" data-errormessage="* 請填寫刊登天數">
                        </div>
                    </div>
                    <div id="tab-2" class="tabContent">
                        <div class="formItem">
                            <label class="formLabel">次分類</label>
                            <div class="radioWrap">
								<?php foreach (SubCategory::SubCategoryType as $key => $val): ?>
                                    <input <?= ($data['first']['sub_category'] == $val) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="radio" class="sub_category" name="sub_category"
                                            value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= ($data['first']['sub_category'] == 'custom') ? "checked" : "" ?>
                                        id="subCategoryCustom" class="sub_category customRadio" type="radio"
                                        name="sub_category"
                                        value="custom">
                                <label for="subCategoryCustom">
                                    <span class="radioIcon"></span>
                                    自填
                                </label>
                                <input id="sub_category_custom_field" class="customField" type="text"
                                       name="sub.category.custom.field"
                                       value="<?= ($data['first']['sub_category'] == 'custom') ? $data['first']['sub_category_custom_field'] : "" ?>"
                                       placeholder="請填寫一個項目">
                                <input id="sub_category_checked" name="sub_category_checked" type="hidden"
                                       value="<?= $data['first']['sub_category'] ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">主分類</label>
                            <div class="radioWrap">
								<?php foreach (Category::CategoryType as $key => $val): ?>
                                    <input <?= ($data['first']['category'] == $val) ? "checked" : "" ?> id="<?= $key ?>"
                                                                                                        class="category"
                                                                                                        type="radio"
                                                                                                        name="category"
                                                                                                        value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input id="category_checked" name="category_checked" type="hidden"
                                       value="<?= $data['first']['category'] ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">材質 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Fabric::FabricType as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['fabric'])) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="checkbox" class="fabric" name="fabric[]"
                                            value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="checkboxIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">顏色</label>
                            <div class="checkboxWrap">
								<?php foreach (Color::ColorType as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['color'])) ? "checked" : "" ?>
                                            id="<?= $key ?>"
                                            type="radio"
                                            class="color validate[required]"
                                            name="color"
                                            value="<?= $val ?>"
                                            data-prompt-target="formErrorMsg"
                                            data-errormessage="* 請填寫物品新舊">
                                    <label for="<?= $key ?>" class="tooltip lbColor <?= Color::ColorLBClass[$key] ?>">
                                        <span class="radioIcon"></span>
                                        <span class="tooltipTxt"><?= $val ?></span>
                                    </label>
								<?php endforeach; ?>
                                <input <?= in_array('custom', explode(",", $data['first']['color'])) ? "checked" : "" ?>
                                        id="colorCustom" class="color customCheckbox validate[required]" type="radio" name="color"
                                        value="custom"
                                        data-prompt-target="formErrorMsg"
                                        data-errormessage="* 請填寫顏色">
                                <label for="colorCustom">
                                    <span class="radioIcon"></span>
                                    自填
                                </label>
                                <input id="color_custom_field" class="customField" type="text" name="color.custom.field"
                                       placeholder="請填寫一個項目"
                                       value="<?= in_array('custom', explode(",", $data['first']['color'])) ? $data['first']['color_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">衣領</label>
                            <div class="radioWrap">
								<?php foreach (Collar::CollarRadio as $key => $val): ?>
                                    <input <?= ($data['first']['collar'] == $val) ? "checked" : "" ?> id="<?= $key ?>"
                                                                                                      type="radio"
                                                                                                      class="collar"
                                                                                                      name="collar"
                                                                                                      value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= ($data['first']['collar'] == 'custom') ? "checked" : "" ?> id="collarCustom"
                                                                                                      class="collar customRadio"
                                                                                                      type="radio"
                                                                                                      name="collar"
                                                                                                      value="custom">
                                <label for="collarCustom">
                                    <span class="radioIcon"></span>
                                    自填
                                </label>
                                <input id="collar_custom_field" class="customField" type="text"
                                       name="collar.custom.field" placeholder="請填寫一個項目"
                                       value="<?= ($data['first']['collar'] == 'custom') ? $data['first']['collar_custom_field'] : "" ?>">
                                <input id="collar_checked" name="collar_checked" type="hidden"
                                       value="<?= $data['first']['collar'] ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">領口</label>
                            <div class="radioWrap">
								<?php foreach (Neckline::NecklineRadio as $key => $val): ?>
                                    <input <?= ($data['first']['neckline'] == $val) ? "checked" : "" ?> id="<?= $key ?>"
                                                                                                        type="radio"
                                                                                                        class="neckline"
                                                                                                        name="neckline"
                                                                                                        value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= ($data['first']['neckline'] == 'custom') ? "checked" : "" ?>
                                        id="necklineCustom" class="neckline customRadio" type="radio" name="neckline"
                                        value="custom">
                                <label for="necklineCustom">
                                    <span class="radioIcon"></span>
                                    自填
                                </label>
                                <input id="neckline_custom_field" class="customField" type="text"
                                       name="neckline.custom.field" placeholder="請填寫一個項目"
                                       value="<?= ($data['first']['neckline'] == 'custom') ? $data['first']['neckline_custom_field'] : "" ?>">
                                <input id="neckline_checked" name="neckline_checked" type="hidden"
                                       value="<?= $data['first']['neckline'] ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">袖長</label>
                            <div class="radioWrap">
								<?php foreach (Sleeve::SleeveType as $key => $val): ?>
                                    <input <?= ($data['first']['sleeve'] == $val) ? "checked" : "" ?> id="<?= $key ?>"
                                                                                                      type="radio"
                                                                                                      class="sleeve validate[required]"
                                                                                                      name="sleeve"
                                                                                                      value="<?= $val ?>"
                                                                                                      data-prompt-target="formErrorMsg"
                                                                                                      data-errormessage="* 請填寫袖長">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= ($data['first']['sleeve'] == 'custom') ? "checked" : "" ?> id="sleeveCustom"
                                                                                                      class="sleeve customRadio validate[required]"
                                                                                                      type="radio"
                                                                                                      name="sleeve"
                                                                                                      value="custom"
                                                                                                      data-prompt-target="formErrorMsg"
                                                                                                      data-errormessage="* 請填寫袖長">
                                <label for="sleeveCustom">
                                    <span class="radioIcon"></span>
                                    自填
                                </label>
                                <input id="sleeve_custom_field" class="customField" type="text"
                                       name="sleeve.custom.field" placeholder="請填寫一個項目"
                                       value="<?= ($data['first']['sleeve'] == 'custom') ? $data['first']['sleeve_custom_field'] : "" ?>">
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tabContent">
                        <div class="formItem">
                            <label class="formLabel">特色一 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Feature1::Feature1Type as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['feature_1'])) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="checkbox" class="feature1" name="feature1[]"
                                            value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="checkboxIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= in_array('custom', explode(",", $data['first']['feature_1'])) ? "checked" : "" ?>
                                        id="feature1Custom" class="feature1 customCheckbox" type="checkbox"
                                        name="feature1[]"
                                        value="custom">
                                <label for="feature1Custom">
                                    <span class="checkboxIcon"></span>
                                    自填
                                </label>
                                <input id="feature1_custom_field" class="customField" type="text"
                                       name="feature1.custom.field" placeholder="填寫多個項目，請使用逗號區隔"
                                       value="<?= in_array('custom', explode(",", $data['first']['feature_1'])) ? $data['first']['feature_1_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">特色二 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Feature2::Feature2Type as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['feature_2'])) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="checkbox" class="feature2" name="feature2[]"
                                            value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="checkboxIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= in_array('custom', explode(",", $data['first']['feature_2'])) ? "checked" : "" ?>
                                        id="feature2Custom" class="feature2 customCheckbox" type="checkbox"
                                        name="feature2[]"
                                        value="custom">
                                <label for="feature2Custom">
                                    <span class="checkboxIcon"></span>
                                    自填
                                </label>
                                <input id="feature2_custom_field" class="customField" type="text"
                                       name="feature2.custom.field" placeholder="填寫多個項目，請使用逗號區隔"
                                       value="<?= in_array('custom', explode(",", $data['first']['feature_2'])) ? $data['first']['feature_2_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">特色三 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Feature3::Feature3Type as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['feature_3'])) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="checkbox" class="feature3" name="feature3[]"
                                            value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="checkboxIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= in_array('custom', explode(",", $data['first']['feature_3'])) ? "checked" : "" ?>
                                        id="feature3Custom" class="feature3 customCheckbox" type="checkbox"
                                        name="feature3[]"
                                        value="custom">
                                <label for="feature3Custom">
                                    <span class="checkboxIcon"></span>
                                    自填
                                </label>
                                <input id="feature3_custom_field" class="customField" type="text"
                                       name="feature3.custom.field" placeholder="填寫多個項目，請使用逗號區隔"
                                       value="<?= in_array('custom', explode(",", $data['first']['feature_3'])) ? $data['first']['feature_3_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">特色四</label>
                            <div class="radioWrap">
								<?php foreach (Feature4::Feature4Type as $key => $val): ?>
                                    <input <?= ($data['first']['feature_4'] == $val) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="radio" class="feature4" name="feature4"
                                            value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= ($data['first']['feature_4'] == 'custom') ? "checked" : "" ?>
                                        id="feature4Custom" class="feature4 customRadio" type="radio"
                                        name="feature4"
                                        value="custom">
                                <label for="feature4Custom">
                                    <span class="radioIcon"></span>
                                    自填
                                </label>
                                <input id="feature4_custom_field" class="customField" type="text"
                                       name="feature4.custom.field" placeholder="請填寫一項"
                                       value="<?= ($data['first']['feature_4'] == 'custom') ? $data['first']['feature_4_custom_field'] : "" ?>">
                                <input id="feature4_checked" name="feature4_checked" type="hidden"
                                       value="<?= $data['first']['feature_4'] ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">特色五 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Feature5::Feature5Type as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['feature_5'])) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="checkbox" class="feature5" name="feature5[]"
                                            value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="checkboxIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= in_array('custom', explode(",", $data['first']['feature_5'])) ? "checked" : "" ?>
                                        id="feature5Custom" class="feature5 customCheckbox" type="checkbox"
                                        name="feature5[]"
                                        value="custom">
                                <label for="feature5Custom">
                                    <span class="checkboxIcon"></span>
                                    自填
                                </label>
                                <input id="feature5_custom_field" class="customField" type="text"
                                       name="feature5.custom.field" placeholder="填寫多個項目，請使用逗號區隔"
                                       value="<?= in_array('custom', explode(",", $data['first']['feature_5'])) ? $data['first']['feature_5_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">關鍵字 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Keyword::KeywordType as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['keyword'])) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="checkbox" class="keyword" name="keyword[]"
                                            value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="checkboxIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= in_array('custom', explode(",", $data['first']['keyword'])) ? "checked" : "" ?>
                                        id="keywordCustom" class="keyword customCheckbox" type="checkbox"
                                        name="keyword[]"
                                        value="custom">
                                <label for="keywordCustom">
                                    <span class="checkboxIcon"></span>
                                    自填
                                </label>
                                <input id="keyword_custom_field" class="customField" type="text"
                                       name="keyword.custom.field" placeholder="填寫多個項目，請使用逗號區隔"
                                       value="<?= in_array('custom', explode(",", $data['first']['keyword'])) ? $data['first']['keyword_custom_field'] : "" ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sectionContent flexBtnRow">
                <a class="btn" href="javascript:step4Action.buildProductDescription();">產生商品特色說明</a>
                <input class="btn" type="submit" value="儲存商品規格"/>
                <a id="preview" style="visibility:<?= (!$data['first']['is_edit']) ? "hidden;" : "visible;" ?>"
                   class="btn"
                   href="javascript:step4Action.previewProductPage('<?= $data['store']['upload_store_type'] ?>');">預覽商品頁</a>
                <a style="visibility:<?= (!$data['isUpload']) ? "hidden;" : "visible" ?>" class="btn btnYellow"
                   href="javascript:step4Action.download();">產生下載檔案</a>
            </div>
        </section>
    </form>
    <a id="goTop" class="icon-arrow-right" href="javascript:;"></a>
</main>
<?php echo $footer; ?>
