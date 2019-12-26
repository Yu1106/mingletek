<?php echo $header; ?>
    <main>
        <div id="alertMsgBox" class="fancybox-content lightBox">錯誤訊息!</div>
        <section id="slogan">
            <img id="sloganImg" src="<?php echo RESOURCE_IMAGES_DIR ?>/slogan.png" alt="slogan">
        </section>
        <section id="sectionStep">
            <div id="anchorSectionStep" class="sectionTitle">
                <h2>輕鬆上架五步驟</h2>
                <hr class="hr-text hr-pink" data="STEP 5">
            </div>
            <a class="uploadIcon"
               href="<?= (\common\login\Login::auth()) ? "step1.php" : "#loginBox" ?>" <?= (\common\login\Login::auth()) ? "" : "data-fancybox" ?>>
                <i class="icon-upload"></i>上傳商品主圖
            </a>
            <div class="stepWrap">
                <div class="steps step1">
                    <div class="stepIcon">
                        <span class="stepTxt">01</span>
                    </div>
                    <div class="stepImg"></div>
                    <div class="stepDesc">
                        <h3 class="stepTitle">上傳衣服主圖</h3>
                        <hr>
                        <p>上傳表達衣服特色的照片</p>
                    </div>
                </div>
                <div class="steps step2">
                    <div class="stepIcon">
                        <i class="icon-arrow-right"></i>
                        <span class="stepTxt">02</span>
                    </div>
                    <div class="stepImg"></div>
                    <div class="stepDesc">
                        <h3 class="stepTitle">上傳衣服附圖</h3>
                        <hr>
                        <p>上傳衣服各角度的照片</p>
                    </div>
                </div>
                <div class="steps step3">
                    <div class="stepIcon">
                        <i class="icon-arrow-right"></i>
                        <span class="stepTxt">03</span>
                    </div>
                    <div class="stepImg"></div>
                    <div class="stepDesc">
                        <h3 class="stepTitle">輕鬆檢查</h3>
                        <hr>
                        <p>檢查上架衣服的款式</p>
                    </div>
                </div>
                <div class="steps step4">
                    <div class="stepIcon">
                        <i class="icon-arrow-right"></i>
                        <span class="stepTxt">04</span>
                    </div>
                    <div class="stepImg"></div>
                    <div class="stepDesc">
                        <h3 class="stepTitle">安心預覽</h3>
                        <hr>
                        <p>預覽上架後效果</p>
                    </div>
                </div>
                <div class="steps step5">
                    <div class="stepIcon">
                        <i class="icon-arrow-right"></i>
                        <span class="stepTxt">05</span>
                    </div>
                    <div class="stepImg"></div>
                    <div class="stepDesc">
                        <h3 class="stepTitle">快樂上架</h3>
                        <hr>
                        <p>完成</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="serviceIntroduction">
            <div id="anchorServiceIntro" class="sectionTitle">
                <h2>服務介紹</h2>
                <hr class="hr-text" data="Service introduction">
            </div>
            <label class="sectionDesc pink txtBold">如果您有下列衣服上架的困擾, 就讓上架小幫手幫您解決</label>
            <div class="sectionContent flexbox">
                <div class="contentBox">
                    <label>上架占用太多時間, 沒空開發新客戶, 經營粉絲團</label>
                    <label>衣服款式, 特色要一個字一個字敲好浪費時間</label>
                    <label>每次進貨都要重新上架, 好麻煩</label>
                </div>
                <div class="serviceIntroductionImg"></div>
                <div class="contentBox">
                    <label>缺乏關鍵字使買家無法透過搜尋功能找到理想的衣服</label>
                    <label>請人上架成本划不來, 而且品質良莠不齊</label>
                    <label>熱門商品需要趕快上架, 最好是當天批貨當天賣</label>
                </div>
            </div>
        </section>
        <section id="assistUploading">
            <div id="anchorAssistUploading" class="sectionTitle">
                <h2>上架小幫手</h2>
                <hr class="hr-text hr-pink" data="Assist uploading">
            </div>
            <label class="sectionDesc">我們了解傳統上架方式所帶來的不方便, 因此我們開發了<br/>台灣第一個利用人工智慧以及電腦視覺幫助賣家快速上架的工具 --- <span
                    class="txtBold">上架小幫手</span></label>
            <div class="sectionContent flexbox">
                <div class="contentBox">
                    <label>
                        <h4 class="txtOrange">
                            <img id="hanger" src="<?php echo RESOURCE_IMAGES_DIR ?>/icon_hanger.png" alt="hanger">上架小幫手可以幫你做到:
                        </h4>
                    </label>
                    <label>透過一張照片, 快速辨認出衣服的特徵, 款式, 顏色, 讓上架從此更方便, 更快速</label>
                    <label>根據衣服特徵產生完整的商品特色描述文字, 讓商品的版面呈現更有質感</label>
                    <label>自動產生關鍵字, 讓買家更容易找到您的商品</label>
                    <label>根據特徵, 自動建立主圖與相關照片的聯結, 解決找尋相關照片的麻煩</label>
                </div>
                <div class="assistUploadingImg"></div>
                <div class="contentBox">
                    <label>擬真商品預覽功能更有fu</label>
                    <label>能夠自由修改上架小幫手產生出來的內容, 讓商品描述更符合您的需要</label>
                    <label>一次產生多個電商平台的批次excel檔, 讓商品在最短時間內同步曝光</label>
                    <label>利用 excel上架是各大平台廣泛使用方式, 您不需要再學習新的操作方式或上架流程</label>
                    <label>商品上架共用資料只需填寫一次, 之後上架小幫手會自動帶入資訊, 省去重複編輯的困擾</label>
                </div>
            </div>
        </section>
        <a id="goTop" class="icon-arrow-right" href="javascript:;"></a>
    </main>
<?php echo $footer; ?>