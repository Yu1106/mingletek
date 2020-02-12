<?php echo $header; ?>
    <main>
        <!-- <section id="slogan">
			<img id="sloganImg" src="../resource/images/slogan.png" alt="slogan">
		</section> -->
        <div id="alertMsgBox" class="fancybox-content lightBox">錯誤訊息!</div>
        <form id="settingsForm" method="post" action="step1.php">
            <div id="formErrorMsg" style="text-align: left;" class="fancybox-content lightBox"></div>
			<?= \Volnix\CSRF\CSRF::getHiddenInputString(); ?>
			<?php echo $section; ?>
            <section id="sectionSettings">
                <div class="sectionTitle">
                    <h3>1. 請先設定上架模板之共用資料</h3>
                    <!-- <hr class="hr-text hr-pink" data="STEP 5"> -->
                </div>
                <div class="sectionContent">
                    <div class="formItem">
                        <label class="formLabel required" for="name">賣場名稱</label>
                        <input id="name" class="validate[required]" type="text" name="settings.shop" placeholder=""
                               value="<?= $data['store']['name'] ?>" data-prompt-target="formErrorMsg" data-errormessage="* 請填寫賣場名稱">
                    </div>
                    <div class="formItem">
                        <label class="formLabel" for="qcontent">注意事項</label>
                        <textarea class="" name="settings.notice" rows="8"
                                  placeholder="貼心小叮嚀&#13;&#10; - 請水水注意, 下單後請勿任意取消訂單, 以維護其他買加權益喔!&#13;&#10; - 賣場商品均以實際銷售商品拍攝, 不是用樣版欺騙買家, 水水可以放心下標&#13;&#10;- 商品顏色因電腦螢幕設定會略有差異, 我們已經努力將色差降到最小, 寄貨以實際商品顏色為準. 對色差很敏感的水水要考慮清楚在下標喔….."><?= $data['store']['note'] ?></textarea>
                    </div>
                    <div class="formItem">
                        <label class="formLabel" for="qcontent">退換貨政策</label>
                        <textarea class="" name="settings.refund" rows="8"
                                  placeholder="退換貨須知：&#13;&#10;※ 七日鑑賞期&#13;&#10;根據消費者保護法第19條規定，XXX提供您商品貨到的七日鑑賞期(※非試用期)，&#13;&#10;是由消費者完成簽收取件起的隔日開始計算至第七天為止；如是以管理員代收，&#13;&#10;則以代收起隔日計算。EX: 完成簽收的時間是2/10，其七天鑑賞期起訖日即為2/11~2/17。&#13;&#10;"><?= $data['store']['return_notice'] ?></textarea>
                    </div>
                </div>
            </section>
            <section id="sectionCategory">
                <div class="sectionContent">
                    <div class="category radioWrap hoverRadio">
                        <input id="dress" class="validate[required] radio" type="radio" name="settings.category"
                               value="0" data-prompt-target="formErrorMsg" data-errormessage="* 請選擇衣服種類">
                        <label for="dress">
                            <span class="radioIcon"></span>
                            <span class="radioLabelTxt">洋裝</span>
                        </label>
                    </div>
                    <div class="category radioWrap hoverRadio">
                        <input disabled id="clothes" class="validate[required] radio" type="radio" name="settings.category"
                               value="1" data-prompt-target="formErrorMsg" data-errormessage="* 請選擇衣服種類">
                        <label for="clothes">
                            <span class="radioIcon"></span>
                            <span class="radioLabelTxt">衣服</span>
                        </label>
                    </div>
                </div>
                <div class="sectionTitle">
                    <h3>2. 請選擇您要上架的衣服種類</h3>
                    <!-- <hr class="hr-text hr-pink" data="STEP 5"> -->
                </div>
                <div class="sectionContent">
                    <div class="category radioWrap hoverRadio">
                        <input disabled id="pants" class="validate[required] radio" type="radio" name="settings.category"
                               value="2" data-prompt-target="formErrorMsg" data-errormessage="* 請選擇衣服種類">
                        <label for="pants">
                            <span class="radioIcon"></span>
                            <span class="radioLabelTxt">褲子</span>
                        </label>
                    </div>
                    <div class="category radioWrap hoverRadio">
                        <input disabled id="skirt" class="validate[required] radio" type="radio" name="settings.category"
                               value="3" data-prompt-target="formErrorMsg" data-errormessage="* 請選擇衣服種類">
                        <label for="skirt">
                            <span class="radioIcon"></span>
                            <span class="radioLabelTxt">裙子</span>
                        </label>
                    </div>
                </div>
            </section>
            <section id="sectionOnlineStore">
                <div class="sectionTitle">
                    <h3>3. 請選擇您要產生批次上傳檔案的商城</h3>
                </div>
                <div class="sectionContentWrap">
                    <div class="sectionContent">
                        <div class="onlineStore checkboxWrap hoverCheckbox">
                            <input id="ruten" class="validate[required] checkbox" type="checkbox"
                                   name="settings.onlineStore[]" value="0" data-prompt-target="formErrorMsg"
                                   data-errormessage="* 請至少選一項商城">
                            <label for="ruten">
                                <span class="checkboxIcon"></span>
                                <span class="checkboxLabelTxt">RUTEN露天拍賣</span>
                            </label>
                        </div>
                        <div class="onlineStore checkboxWrap hoverCheckbox">
                            <input id="yahoo" class="validate[required] checkbox" type="checkbox"
                                   name="settings.onlineStore[]" value="1" data-prompt-target="formErrorMsg"
                                   data-errormessage="* 請至少選一項商城">
                            <label for="yahoo">
                                <span class="checkboxIcon"></span>
                                <span class="checkboxLabelTxt">YAHOO超級商城</span>
                            </label>
                        </div>
                        <div class="onlineStore checkboxWrap hoverCheckbox">
                            <input id="pchome" class="validate[required] checkbox" type="checkbox"
                                   name="settings.onlineStore[]" value="2" data-prompt-target="formErrorMsg"
                                   data-errormessage="* 請至少選一項商城">
                            <label for="pchome">
                                <span class="checkboxIcon"></span>
                                <span class="checkboxLabelTxt">PCHOME商店街</span>
                            </label>
                        </div>
                    </div>
                </div>
            </section>
            <section id="sectionNotice">
                <div class="sectionContent">
                    <label class="noticeTxt">
                        <span class="txtRed">! 請注意：</span>資料匯出成CSV或EXCEL後, 系統將刪除您所上傳的照片<br/>如果要修改商品內容, 請重新上傳商品照片
                    </label>
                </div>
            </section>
            <input id="next" type="submit" value="">
        </form>
        <a id="goTop" class="icon-arrow-right" href="javascript:;"></a>
    </main>
<?php echo $footer; ?>