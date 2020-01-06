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
use common\model\parameter\Keyword;
use common\model\parameter\Neckline;
use common\model\parameter\Pchome;
use common\model\parameter\Ruten;
use common\model\parameter\Size;
use common\model\parameter\Sleeve;
use common\model\parameter\SubCategory;
use common\model\parameter\Yahoo;

?>
<?php echo $header; ?>
<main>
    <div id="alertMsgBox" class="fancybox-content lightBox">分析錯誤!! 請砍掉重練</div>
    <form id="editForm" method="post" action="step4.php">
        <div id="formErrorMsg" class="fancybox-content lightBox"></div>
		<?= \Volnix\CSRF\CSRF::getHiddenInputString(); ?>
        <input type="hidden" name="id" value="<?= $data['first']['id'] ?>">
		<?php echo $section; ?>
        <section class="sectionItemList">
            <div class="sectionTitle">
                <h5><i class="icon-subTitle"></i>點選各商品主圖 (小圖) 即可編輯該筆商品內容，編輯完成並儲存後，商品主圖上會顯示 v 符號。</h5>
            </div>
            <div class="sectionContent">
				<?php foreach ($data['picture'] as $key => $val): ?>
                    <a class="itemThumbnail checked <?= ($data['first']['picture'] == $val['img']) ? "current" : "" ?>"
                       href="javascript:;">
                        <i class="icon-check-square"></i>
                        <img src="<?= $val['path'] ?>" data-id="<?= $val['id'] ?>" alt="" class="itemImg">
                    </a>
				<?php endforeach; ?>
				<?php foreach ($data['subPicture'] as $key => $val): ?>
                    <a class="itemThumbnail" href="javascript:;">
                        <i class="icon-check-square"></i>
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
                                    <div class="swiper-slide"
                                         style="background-image: url('<?= $val["path"] ?>');"></div>
								<?php endforeach; ?>
								<?php foreach ($data['swiper']['subPicture'] as $key => $val): ?>
                                    <div class="swiper-slide"
                                         style="background-image: url('<?= $val["path"] ?>');"></div>
								<?php endforeach; ?>
                            </div>
                        </div>
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
								<?php foreach ($data['swiper']['picture'] as $key => $val): ?>
                                    <div class="swiper-slide"
                                         style="background-image: url('<?= $val["path"] ?>');"></div>
								<?php endforeach; ?>
								<?php foreach ($data['swiper']['subPicture'] as $key => $val): ?>
                                    <div class="swiper-slide"
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
                        <div class="formItem">
                            <label class="formLabel">pchome 類別</label>
                            <div class="selectWrap icon-expand">
                                <select name="pchome.category">
                                    <option value="">類別</option>
									<?php foreach (Pchome::PchomeType as $key => $val): ?>
                                        <option <?= ($data['first']['pchome_category'] == $key) ? "selected" : "" ?>
                                                value="<?= $key ?>"><?= $val ?></option>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">露天類別</label>
                            <div class="selectWrap icon-expand">
                                <select name="ruten.category">
                                    <option value="">類別</option>
									<?php foreach (Ruten::RutenType as $key => $val): ?>
                                        <option <?= ($data['first']['ruten_category'] == $key) ? "selected" : "" ?>
                                                value="<?= $key ?>"><?= $val ?></option>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">yahoo 類別</label>
                            <div class="selectWrap icon-expand">
                                <select name="yahoo.category">
                                    <option value="">類別</option>
									<?php foreach (Yahoo::YahooType as $key => $val): ?>
                                        <option <?= ($data['first']['yahoo_category'] == $key) ? "selected" : "" ?>
                                                value="<?= $key ?>"><?= $val ?></option>
									<?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">商品名稱</label>
                            <input class="validate[required]" type="text" name="name" placeholder="商品名稱"
                                   value="<?= $data['first']['name'] ?>"
                                   data-prompt-target="formErrorMsg" data-errormessage="* 請填寫商品名稱">
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">原價</label>
                            <input class="validate[required]" type="number" name="price" placeholder="原價"
                                   value="<?= $data['first']['price'] ?>" min="0" data-prompt-target="formErrorMsg"
                                   data-errormessage="* 請填寫原價">
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">商品售價/促銷</label>
                            <input class="validate[required]" type="number" name="sell.price" placeholder="商品售價/促銷"
                                   value="<?= $data['first']['sell_price'] ?>" min="0" data-prompt-target="formErrorMsg"
                                   data-errormessage="* 請填寫商品售價/促銷">
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">庫存</label>
                            <input class="validate[required]" type="number" name="stock" placeholder="庫存"
                                   value="<?= $data['first']['stock'] ?>" min="0" data-prompt-target="formErrorMsg"
                                   data-errormessage="* 請填寫庫存">
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">物品新舊</label>
                            <input class="validate[required]" type="text" name="is.new" placeholder="物品新舊"
                                   value="<?= $data['first']['is_new'] ?>"
                                   data-prompt-target="formErrorMsg" data-errormessage="* 請填寫物品新舊">
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">物品所有地</label>
                            <input class="validate[required]" type="text" name="site" placeholder="物品所有地"
                                   value="<?= $data['first']['site'] ?>"
                                   data-prompt-target="formErrorMsg" data-errormessage="* 請填寫物品所有地">
                        </div>
                        <div class="formItem">
                            <label class="formLabel required">刊登天數</label>
                            <input class="validate[required]" type="number" name="posting.days" placeholder="刊登天數"
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
                                            id="<?= $key ?>" type="radio" name="sub.category" value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= ($data['first']['sub_category'] == 'custom') ? "checked" : "" ?>
                                        id="subCategoryCustom" class="customRadio" type="radio" name="sub.category"
                                        value="custom">
                                <label for="subCategoryCustom">
                                    <span class="radioIcon"></span>
                                    自填
                                </label>
                                <input id="sub.category.custom.field" class="customField" type="text"
                                       name="sub.category.custom.field"
                                       value="<?= ($data['first']['sub_category'] == 'custom') ? $data['first']['sub_category_custom_field'] : "" ?>"
                                       placeholder="請填寫一個項目">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">主分類</label>
                            <div class="radioWrap">
								<?php foreach (Category::CategoryType as $key => $val): ?>
                                    <input <?= ($data['first']['category'] == $val) ? "checked" : "" ?> id="<?= $key ?>"
                                                                                                        type="radio"
                                                                                                        name="category"
                                                                                                        value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">材質 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Fabric::FabricType as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['fabric'])) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="checkbox" name="fabric[]" value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="checkboxIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">顏色 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Color::ColorType as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['color'])) ? "checked" : "" ?>
                                            id="<?= $key ?>"
                                            type="checkbox"
                                            name="color[]"
                                            value="<?= $val ?>">
                                    <label for="<?= $key ?>" class="tooltip lbColor <?= Color::ColorLBClass[$key] ?>">
                                        <span class="checkboxIcon"></span>
                                        <span class="tooltipTxt"><?= $val ?></span>
                                    </label>
								<?php endforeach; ?>
                                <input <?= in_array('custom', explode(",", $data['first']['color'])) ? "checked" : "" ?>
                                        id="colorCustom" class="customCheckbox" type="checkbox" name="color[]"
                                        value="custom">
                                <label for="colorCustom">
                                    <span class="checkboxIcon"></span>
                                    自填
                                </label>
                                <input id="color.custom.field" class="customField" type="text" name="color.custom.field"
                                       placeholder="填寫多個項目，請使用逗號區隔"
                                       value="<?= in_array('custom', explode(",", $data['first']['color'])) ? $data['first']['color_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">尺寸</label>
                            <div class="radioWrap">
								<?php foreach (Size::SizeType as $key => $val): ?>
                                    <input <?= ($data['first']['size'] == $val) ? "checked" : "" ?> id="<?= $key ?>"
                                                                                                    type="radio"
                                                                                                    name="size"
                                                                                                    value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">衣領</label>
                            <div class="radioWrap">
								<?php foreach (Collar::CollarRadio as $key => $val): ?>
                                    <input <?= ($data['first']['collar'] == $val) ? "checked" : "" ?> id="<?= $key ?>"
                                                                                                      type="radio"
                                                                                                      name="collar"
                                                                                                      value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= ($data['first']['collar'] == 'custom') ? "checked" : "" ?> id="collarCustom"
                                                                                                      class="customRadio"
                                                                                                      type="radio"
                                                                                                      name="collar"
                                                                                                      value="custom">
                                <label for="collarCustom">
                                    <span class="radioIcon"></span>
                                    自填
                                </label>
                                <input id="collar.custom.field" class="customField" type="text"
                                       name="collar.custom.field" placeholder="請填寫一個項目"
                                       value="<?= ($data['first']['collar'] == 'custom') ? $data['first']['collar_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">領口</label>
                            <div class="radioWrap">
								<?php foreach (Neckline::NecklineRadio as $key => $val): ?>
                                    <input <?= ($data['first']['neckline'] == $val) ? "checked" : "" ?> id="<?= $key ?>"
                                                                                                        type="radio"
                                                                                                        name="neckline"
                                                                                                        value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= ($data['first']['neckline'] == 'custom') ? "checked" : "" ?>
                                        id="necklineCustom" class="customRadio" type="radio" name="neckline"
                                        value="custom">
                                <label for="necklineCustom">
                                    <span class="radioIcon"></span>
                                    自填
                                </label>
                                <input id="neckline.custom.field" class="customField" type="text"
                                       name="neckline.custom.field" placeholder="請填寫一個項目"
                                       value="<?= ($data['first']['neckline'] == 'custom') ? $data['first']['neckline_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">袖長</label>
                            <div class="radioWrap">
								<?php foreach (Sleeve::SleeveType as $key => $val): ?>
                                    <input <?= ($data['first']['sleeve'] == $val) ? "checked" : "" ?> id="<?= $key ?>"
                                                                                                      type="radio"
                                                                                                      name="sleeve"
                                                                                                      value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= ($data['first']['sleeve'] == 'custom') ? "checked" : "" ?> id="sleeveCustom"
                                                                                                      class="customRadio"
                                                                                                      type="radio"
                                                                                                      name="sleeve"
                                                                                                      value="custom">
                                <label for="sleeveCustom">
                                    <span class="radioIcon"></span>
                                    自填
                                </label>
                                <input id="sleeve.custom.field" class="customField" type="text"
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
                                            id="<?= $key ?>" type="checkbox" name="feature1[]" value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="checkboxIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= in_array('custom', explode(",", $data['first']['feature_1'])) ? "checked" : "" ?>
                                        id="feature1Custom" class="customCheckbox" type="checkbox"
                                        name="feature1[]"
                                        value="custom">
                                <label for="feature1Custom">
                                    <span class="checkboxIcon"></span>
                                    自填
                                </label>
                                <input id="feature1.custom.field" class="customField" type="text"
                                       name="feature1.custom.field" placeholder="填寫多個項目，請使用逗號區隔"
                                       value="<?= in_array('custom', explode(",", $data['first']['feature_1'])) ? $data['first']['feature_1_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">特色二 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Feature2::Feature2Type as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['feature_2'])) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="checkbox" name="feature2[]"
                                            value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="checkboxIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= in_array('custom', explode(",", $data['first']['feature_2'])) ? "checked" : "" ?>
                                        id="feature2Custom" class="customCheckbox" type="checkbox"
                                        name="feature2[]"
                                        value="custom">
                                <label for="feature2Custom">
                                    <span class="checkboxIcon"></span>
                                    自填
                                </label>
                                <input id="feature2.custom.field" class="customField" type="text"
                                       name="feature2.custom.field" placeholder="填寫多個項目，請使用逗號區隔"
                                       value="<?= in_array('custom', explode(",", $data['first']['feature_2'])) ? $data['first']['feature_2_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">特色三 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Feature3::Feature3Type as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['feature_3'])) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="checkbox" name="feature3[]" value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="checkboxIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= in_array('custom', explode(",", $data['first']['feature_3'])) ? "checked" : "" ?>
                                        id="feature3Custom" class="customCheckbox" type="checkbox"
                                        name="feature3[]"
                                        value="custom">
                                <label for="feature3Custom">
                                    <span class="checkboxIcon"></span>
                                    自填
                                </label>
                                <input id="feature3.custom.field" class="customField" type="text"
                                       name="feature3.custom.field" placeholder="填寫多個項目，請使用逗號區隔"
                                       value="<?= in_array('custom', explode(",", $data['first']['feature_3'])) ? $data['first']['feature_3_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">特色四</label>
                            <div class="radioWrap">
								<?php foreach (Feature4::Feature4Type as $key => $val): ?>
                                    <input <?= ($data['first']['feature_4'] == $val) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="radio" name="feature4" value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="radioIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= ($data['first']['feature_4'] == 'custom') ? "checked" : "" ?>
                                        id="feature4Custom" class="customRadio" type="radio"
                                        name="feature4"
                                        value="custom">
                                <label for="feature4Custom">
                                    <span class="radioIcon"></span>
                                    自填
                                </label>
                                <input id="feature4.custom.field" class="customField" type="text"
                                       name="feature4.custom.field" placeholder="請填寫一項"
                                       value="<?= ($data['first']['feature_4'] == 'custom') ? $data['first']['feature_4_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">特色五 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Feature5::Feature5Type as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['feature_5'])) ? "checked" : "" ?>
                                            id="<?= $key ?>" type="checkbox" name="feature5[]" value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="checkboxIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= in_array('custom', explode(",", $data['first']['feature_5'])) ? "checked" : "" ?>
                                        id="feature5Custom" class="customCheckbox" type="checkbox"
                                        name="feature5[]"
                                        value="custom">
                                <label for="feature5Custom">
                                    <span class="checkboxIcon"></span>
                                    自填
                                </label>
                                <input id="feature5.custom.field" class="customField" type="text"
                                       name="feature5.custom.field" placeholder="填寫多個項目，請使用逗號區隔"
                                       value="<?= in_array('custom', explode(",", $data['first']['feature_5'])) ? $data['first']['feature_5_custom_field'] : "" ?>">
                            </div>
                        </div>
                        <div class="formItem">
                            <label class="formLabel">關鍵字 [複選]</label>
                            <div class="checkboxWrap">
								<?php foreach (Keyword::KeywordType as $key => $val): ?>
                                    <input <?= in_array($val, explode(",", $data['first']['keyword'])) ? "checked" : "" ?> id="<?= $key ?>" type="checkbox" name="keyword[]" value="<?= $val ?>">
                                    <label for="<?= $key ?>">
                                        <span class="checkboxIcon"></span>
										<?= $val ?>
                                    </label>
								<?php endforeach; ?>
                                <input <?= in_array('custom', explode(",", $data['first']['keyword'])) ? "checked" : "" ?> id="keywordCustom" class="customCheckbox" type="checkbox" name="keyword[]"
                                       value="custom">
                                <label for="keywordCustom">
                                    <span class="checkboxIcon"></span>
                                    自填
                                </label>
                                <input id="keyword.custom.field" class="customField" type="text"
                                       name="keyword.custom.field" placeholder="填寫多個項目，請使用逗號區隔" value="<?= in_array('custom', explode(",", $data['first']['keyword'])) ? $data['first']['keyword_custom_field'] : "" ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="sectionContent flexBtnRow">
                <a class="btn" href="javascript:;">產生商品特色說明</a>
                <input class="btn" type="submit" value="儲存商品規格"/>
                <a class="btn" href="javascript:;">預覽商品頁</a>
                <a class="btn btnYellow" href="javascript:;">產生下載檔案</a>
            </div>
        </section>
    </form>
    <a id="goTop" class="icon-arrow-right" href="javascript:;"></a>
</main>
<?php echo $footer; ?>
