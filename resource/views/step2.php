<?php echo $header; ?>
    <main>
        <div id="alertMsgBox" class="fancybox-content lightBox">錯誤訊息!</div>
        <form id="uploadMajor" method="post" action="step2.php">
            <div id="formErrorMsg" style="text-align: left;" class="fancybox-content lightBox"></div>
			<?= \Volnix\CSRF\CSRF::getHiddenInputString(); ?>
			<?php echo $section; ?>
            <section class="sectionUpload">
                <div class="sectionTitle">
                    <h3>您已選擇<label
                                class="shoppingBag"><?= \common\model\parameter\Clothes::ClothesType[$store["clothes_type"]] ?>
                            </label></h3>
                </div>
                <label class="sectionDesc noticeTxt">請上傳商品圖片(可傳多張)，系統會為您匹配圖片，並產出商品介紹；如果沒有附圖可直接按下一步。<br/>照片長或寬的解析度不可小於600
                    pixels
                    <p>
                        <i class="icon-alert"></i>上傳照片即表示您同意
                        <a class="txtBold txtRed btnTerms" href="#terms" data-fancybox>使用條款</a>及
                        <a class="txtBold txtRed btnPrivacy" href="#privacy" data-fancybox>隱私權政策</a>
                    </p>
                    <div id="terms" class="fancybox-content lightBox">
                        <h4>使用條款</h4>
                        <p>上架小幫手（網址為WWW.MINGLETEK.COM，以下稱「本網站」）為鼎洋智能科技股份有限公司（以下稱「本公司」）所經營之電子商務平台
                            (以下稱「本服務」），茲制定上架小幫手服務條款（以下稱「本條款」）及其他相關規範或公告，以提供本網站的使用者
                            (包含但不限於尚未註冊為會員之一般使用者，及已註冊為會員之品牌或行銷夥伴，以下稱「會員」、「您」)相關服務。<span class="txtBold">藉由使用此網站，將視為您已同意本使用條款之內容；如果您不同意，請勿使用此網站。</span>
                        </p>
                        <ol>
                            <li>一、同意條款
                                <ol>
                                    <li>1.
                                        請您於首次使用本網站、本服務前，詳細閱讀並同意本條款，再行填寫您的基本資料以完成註冊。完成註冊流程及開始使用本服務，即表示您已經閱讀、了解且同意接受本條款之全部內容與約定；若您不同意全部或部分者，請勿註冊會員或使用本服務。
                                    </li>
                                    <li>2.
                                        您同意本公司有權因應營運之需求，隨時調整本條款，除對您的權益有重大影響外，本公司將不會個別通知。本條款之最新內容，將公佈於本網站首頁連結，您每次使用本網站、本服務前，均可詳細閱讀，以維護您的權益。
                                    </li>
                                    <li>3.
                                        若您於本條款進行任何修改或變更之後，仍繼續使用本網站、本服務，將視為您已經閱讀、瞭解且同意接受相關修改及變更。若您不同意全部或部分本條款內容，則請勿使用本網站、本服務。
                                    </li>
                                    <li>4. 若您尚未滿十八
                                        (18)歲，除應符合上述規定外，並應於您的家長（或監護人）閱讀、瞭解並同意本條款之所有內容及其後修改變更後，方得使用或繼續使用本網站、本服務。當您使用或繼續使用本網站、本服務時，即推定您的家長（或監護人）已閱讀、瞭解並同意接受本條款之所有內容及其後修改變更。
                                    </li>
                                </ol>
                            </li>
                            <li>二、會員帳號、密碼及安全
                                <ol>
                                    <li>1.
                                        本網站、本服務為保障服務及交易安全，您的會員帳號和密碼由您自行設定。於申請註冊成為會員時，您應當填寫正確的會員資料，並請隨時進行必要之更新。建議您勿使用與其他網站相同之密碼，並經常變更您的個人密碼，以維護您帳號的安全。
                                    </li>
                                    <li>2.
                                        申請註冊完畢後，您同意將您的帳號及密碼善盡妥善保管及保密之責任，包含但不限於：不洩漏帳號、密碼予第三人；不與他人共用帳號、密碼；適時登出本網站等。本公司將以您所設定的會員帳號和密碼來認證您的身份，您必須為經由這個會員帳號和密碼所進行的所有行為負責。為維護您的權益，請勿將帳號提供予他人使用。
                                    </li>
                                    <li>3. 除經證明係第三人違法使用之情形，您須為您所設定之帳號、密碼以及使用此帳號所生之相關行為負全部責任，不得任意否認於本平台上所提供之任何資訊或交易。</li>
                                    <li>4. 您聲明並保證您所填寫之基本資料為正確且完整，不得使用他人資料、如有違反前開保證，本公司有權暫停或終止您的帳號，並拒絕您使用本網站的服務。</li>
                                    <li>5.
                                        您的帳號若有被冒用、盜用之情形，應立即通知本公司，以避免損害擴大。本公司將協助暫停該帳號之使用，並於釐清帳號使用問題後，依您的請求重新設定密碼開通使用。
                                    </li>
                                    <li>6. 若有需要由本公司協助處理會員服務事宜時，本公司可能會核對您的個人或公司資料，若與註冊時所登錄之資料不符合者，本平台將無法對您提供相關的服務。</li>
                                    <li>7. 您有查閱、修正您的會資料的相關權利。</li>
                                    <li>8. 您可以請求刪除您的會員資料，但請知悉與會員資料連動的服務將無法順利提供。</li>
                                </ol>
                            </li>
                            <li>三、個人資料保護
                                <ol>
                                    <li>1.
                                        本公司於您每次使用本網站、本服務時，為提供本公司相關服務及行銷之目的，將蒐集、處理及運用您的個人資料。有關個人資料相關注意事項，請參閱本網站「隱私權條款」。
                                    </li>
                                    <li>2.
                                        本公司將遵循個人資料保護相關法令的規定，除依本條款、隱私權政策或法律規定外，不會違法利用您的個人資料。在下列的情況，本公司有可能會提供您的個人資料給相關機構，或主張其權利受侵害並提示司法機關正式文件之第三人：
                                        <ol>
                                            <li>a. 依法令或檢警調、司法機構或其他有權機關基於法定程序之要求；</li>
                                            <li>b. 在緊急情況下為維護其他客戶或第三人之合作權益；</li>
                                            <li>c. 為維護本網站、本服務的正常運作；</li>
                                            <li>d. 為提供本公司相關服務產生的金流、物流、其他協力或合作廠商必要資訊；</li>
                                            <li>e. 使用者有任何違反政府法令或本網站使用條款之情形。</li>
                                        </ol>
                                    </li>
                                    <li>3.
                                        本網站、本服務可能因廣告或其他合作促銷活動而包含其他網站之連結，您點選該連結至其他網站，即不適用本條款及隱私權政策之規範。您須自行判斷各該網站相關條款對您的權益保障是否足夠，再決定是否使用該網站服務。
                                    </li>
                                </ol>
                            </li>
                            <li>四、服務說明
                                <ol>
                                    <li>1. 本網站為提供產生大量上架用文件之服務，會員於完成線上註冊程序、並通過本公司審核後，得使用本平台的完整服務。</li>
                                    <li>2. 會員就本服務取得有限制範圍的使用授權，我們保留依據權利人指示將您的個人資料刪除之權利。</li>
                                    <li>3. 本公司有權增加、變更或取消本平台、本服務中相關系統或功能之全部或一部之權利且無須通知您；且有關現有或將來之各項服務均受本協議之規範。</li>
                                    <li>4. 您同意本公司可以向您註冊時所使用的電子信箱發送本平台、本服務之公告或商業訊息。</li>
                                </ol>
                            </li>
                            <li>五、會員上傳資料分享
                                <ol>
                                    <li>
                                        您同意於本網站、本服務上傳發佈之內容為供本公司本網站使用之，並同意本公司得分享於本服務的相關系統網路上，包括但不限於本網站的搜尋服務，或本公司所舉辦的行銷活動上。相關內容並得被公開張貼及與他人分享。
                                    </li>
                                </ol>
                            </li>
                            <li>六、智慧財產權
                                <ol>
                                    <li>1. 會員透過本網站、本服務所上傳之圖檔、照片、影片、音樂、和其他素材等
                                        (以下簡稱內容)，您應保證未違反第三方版權、專利權、商標權、營業秘密等智慧財產權權益，以免涉及侵權或違法之責任。您務必先取得相關使用權或法律授權，授權您有權發佈該內容並授予本網站、使用本服務。
                                    </li>
                                    <li>2.
                                        若本公司在得到有關會員所上傳的內容侵犯他人的版權或智慧財產權之相關通知後，本公司將刪除所有相關內容。本公司保留未事先通知而刪除內容的權利。若經本公司告知相關侵權行為，而您未加以理會，本公司
                                        有權終止您使用本網站全部或一部份服務之權利。
                                    </li>
                                    <li>3.
                                        本網站、本服務所提供之各項功能，並不代表使用本平台、本服務所為之各種行為皆屬合法授權範圍內，會員及一般使用者仍須依本協議之規範，在本網站、本服務之合法授權範圍內使用。任何非依本協議之規範而使用本網站、本服務之行為，均應由會員及一般使用者自行負擔相關責任。
                                    </li>
                                </ol>
                            </li>
                            <li>七、服務宗旨及免責聲明
                                <ol>
                                    <li>1.
                                        本公司將以符合目前一般可合理期待安全性之方式及技術，維護本網站的正常運作。下列情形本公司有權暫停提供本網站服務的全部或部分，且不負事先通知您的義務，本公司對因而產生任何直接或間接的損害，均不負任何賠償或補償的義務：
                                        <ol>
                                            <li>a. 對本網站相關軟硬體設備進行搬遷、更換、升級、保養或維修；</li>
                                            <li>b. 天災或其他不可抗力因素所導致的服務停止或中斷；</li>
                                            <li>c. 因電信或網站公司服務中斷或其他不可歸責於本公司事由所致的服務停止或 中斷；</li>
                                            <li>d. 本網站遭外力影響致資訊選是不正確、或遭偽造、竄改、刪除或擷取，獲致系統中 斷或不能正常運作；</li>
                                            <li>e. 使用者有違反本條款或法令之情形而對該使用者暫停或終止服務；</li>
                                            <li>f. 其他本公司認為有需要暫停或終止服務之情形。</li>
                                        </ol>
                                    </li>
                                    <li>2. 本公司針對可預知的軟硬體維護計畫，有可能導致網站暫停或終止服務時，將盡可能地於該狀況發生前，以適當方式於本網站公告。</li>
                                </ol>
                            </li>
                            <li>八、準據法與管轄法院
                                <ol>
                                    <li>1.
                                        本條款任何條款的全部或一部份無效時，並不影響其他約定的效力。您與本公司的權利義務關係，應依本條款及相關適用的本網站公告或規範定之。若有發生任何爭議，您可以向本網站所記載的客服聯絡方式提出申訴或反應，雙方均應秉持最大誠意，依誠實信用、平等互惠原則協商解決之。
                                    </li>
                                    <li>2. 本條款之解釋與適用，以及與本條款有關的爭議，均應依照中華民國法律予以處理，並以臺灣台北地方法院為第一審管轄法院。</li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                    <div id="privacy" class="fancybox-content lightBox">
                        <h4>隱私權政策</h4>
                        <p>「WWW.MINGLETEK.COM」是由「鼎洋智能科技股份有限公司」（下稱我們）所經營之網站(下稱本網站)各項服務與資訊。</p>
                        <p>以下是我們的隱私權保護政策，幫助您瞭解本網站所蒐集的個人資料之運用及保護方式。</p>
                        <ol>
                            <li>一、隱私權保護政策的適用範圍
                                <ol>
                                    <li>1. 請您在於使用本網站服務前，確認您已審閱並同意本隱私權政策所列全部條款，若您不同意全部或部份者，則請勿使用本網站服務。</li>
                                    <li>2. 隱私權保護政策內容，包括我們如何處理您在使用本網站服務時蒐集到的個人識別資料。</li>
                                    <li>3. 隱私權保護政策不適用於本網站以外的相關連結網站，亦不適用於非我們所委託或參與管理之人員。</li>
                                </ol>
                            </li>
                            <li>二、個人資料的蒐集及使用
                                <ol>
                                    <li>1. 在使用我們的服務時，我們可能會要求您向我們提供可用於聯繫或識別您的某些個人資料，包括：
                                        <ol>
                                            <li>• C001辨識個人者： 如姓名、地址、電話、電子郵件等資訊。</li>
                                        </ol>
                                    </li>
                                    <li>2. 本網站將蒐集的數據用於各種目的：
                                        <ol>
                                            <li>• 提供和維護系統所提供讀服務</li>
                                            <li>• 提供用戶支持</li>
                                            <li>• 提供分析或有價值訊息，以便我們改進服務</li>
                                            <li>• 監控服務的使用情況</li>
                                            <li>• 檢測，預防和解決技術問題</li>
                                        </ol>
                                    </li>
                                    <li>3. 本網站針對蒐集數據的利用期間、地區、對象及方式：
                                        <ol>
                                            <li>• 期間：當事人要求停止使用或本服務停止提供服務之日為止。</li>
                                            <li>• 地區：個人資料將用於台灣地區。</li>
                                            <li>• 利用對象及方式：所蒐集到的資料將利用於各項業務之執行，利用方式為因業務執行所必須進行之各項分析、聯繫及通知。</li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                            <li>三、資料的保護與安全
                                <ol>
                                    <li>1.
                                        本網站主機均設有防火牆、防毒系統等相關資訊安全設備及必要的安全防護措施，本網站及您的個人資料均受到嚴格的保護。只有經過授權的人員才能接觸您的個人資料，相關處理人員均有簽署保密合約，如有違反保密義務者，將會受到相關的法律處分。
                                    </li>
                                    <li>2. 如因業務需要有必要委託本網站相關單位提供服務時，我們會要求其遵守保密義務，並採取相當之檢查程序以確定其將確實遵守。</li>
                                    <li>3. 請您妥善保管您的密碼與個人資料，並提醒您使用完畢本網站相關服務後，務必關閉本網站，以免您的資料遭人盜用。</li>
                                    <li>4. 您同意在使用本網站服務時，所留存的資料與事實相符。另若嗣後您發現您的個人資料遭他人非法使用或有任何異常時，應即時通知我們。</li>
                                    <li>5.
                                        您同意於使用本網站服務時，所提供及使用之資料皆為合法，並無侵害第三人權利、違反第三方協議或涉及任何違法行為。如因使用本網站服務而致第三人損害，除因我們故意或重大過失所致外，我們並不負擔相關賠償責任。
                                    </li>
                                </ol>
                            </li>
                            <li>四、對外的相關連結
                                <ol>
                                    <li>本網站上有可能包含其他合作網站或網頁連結，該網站或網頁也有可能會蒐集您的個人資料，不論其內容或隱私權政策為何，皆與本網站
                                        無關，您應自行參考該連結網站中的隱私權保護政策，我們不負任何連帶責任。
                                    </li>
                                </ol>
                            </li>
                            <li>五、與第三人共用個人資料之政策
                                <ol>
                                    <li>1. 本網站絕不會提供、交換、出租或出售任何您的個人資料給其他個人、團體、私人企業或公務機關，但有法律依據或合約義務者，不在此限。</li>
                                    <li>2. 前項但書之情形包括但不限於：
                                        <ol>
                                            <li>• 經由您書面同意。</li>
                                            <li>• 法律明文規定。</li>
                                            <li>• 為維護國家安全或增進公共利益。</li>
                                            <li>• 為免除您生命、身體、自由或財產上之危險。</li>
                                            <li>• 與公務機關或學術研究機構合作，基於公共利益為統計或學術研究而有必要，且資料經過提供者處理或蒐集者依其揭露方式無從識別特定之當事人。</li>
                                            <li>•
                                                當您在網站的行為，違反服務條款或可能損害或妨礙網站與其他使用者權益或導致任何人遭受損害時，經網站管理單位研析揭露您的個人資料是為了辨識、聯絡或採取法律行動所必要者。
                                            </li>
                                            <li>• 有利於您的權益。</li>
                                        </ol>
                                    </li>
                                    <li>3. 本網站委託廠商協助蒐集、處理或利用您的個人資料時，將對委外廠商或個人善盡監督管理之責。</li>
                                </ol>
                            </li>
                            <li>六、Cookie之使用
                                <ol>
                                    <li>1.
                                        為了提供您最佳的服務，本網站會在您的電腦中放置並取用我們的Cookie，若您不願接受Cookie的寫入，您可在您使用的瀏覽器功能項中設定隱私權等級為高，即可拒絕Cookie的寫入，但可能會導致網站某些功能無法正常執行
                                        。<br/>以下是可能使用的Cookie範例:
                                        <ol>
                                            <li>• session cookies. 用來維護應用程式的狀態</li>
                                            <li>• Preference Cookies. 用來記錄您的喜好與設定</li>
                                            <li>• Security Cookies. 用來控制安全和檢查</li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                            <li>七、未成年人保護
                                <ol>
                                    <li>未成年人於註冊或使用本服務而同意本公司蒐集、利用其個人資訊時，應按其年齡由其法定代理人代為或在法定代理人之同意下為之。</li>
                                </ol>
                            </li>
                            <li>八、隱私權政策的修訂
                                <ol>
                                    <li>我們將因應需求擁有隨時修改本隱私權保護政策的權利，當我們做出修改時，會於本網站公告，且自公告日起生效，不再另行通知。</li>
                                </ol>
                            </li>
                        </ol>
                    </div>
                </label>
                <label class="uploadIcon">
                    <i class="icon-upload"></i>上傳商品主圖
                    <input id="fileupload" type="file" name="files[]" accept="image/*" multiple>
                </label>
            </section>
            <section class="sectionPreview">
                <div class="sectionTitle">
                    <h5><i class="icon-subTitle"></i>已上傳主圖如下，若您不想要某個商品主圖，則點選 x 刪除。</h5>
                </div>
                <div id="previewBox" class="sectionContent"></div>
            </section>
            <input id="next" type="button" onclick="step2Action.submit();">
        </form>
        <a id="goTop" class="icon-arrow-right" href="javascript:;"></a>
    </main>
<?php echo $footer; ?>