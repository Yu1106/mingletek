$(function () {

    var timer;

    $(window).scroll(function () {

        window.clearTimeout(timer)
        timer = window.setTimeout(function () {

            var scrollTop = $(window).scrollTop();

            //goTop
            if ((scrollTop >= 500)) {
                $("header.fixed").addClass("is_scroll");
                $("#goTop").stop().fadeIn();
            } else {
                $("header.fixed").removeClass("is_scroll");
                $("#goTop").fadeOut();
            }

        }, 100)

    });


    //Scroll To Top
    $("#goTop").click(function goTop() {
        $("html,body").stop().animate({scrollTop: 0}, 800);
    });

    //首頁
    $('.scrollTrigger').click(function () {
        var targetId = $(this).attr('data-target');
        var pos = $('#' + targetId).offset().top;
        $('html,body').stop().animate({scrollTop: (pos - 150)}, 1000);
    });


    if ($('#settingsForm').length > 0) {
        $('#settingsForm').validationEngine('attach', {
            promptPosition: 'inline',
            addPromptClass: 'errorMsg',
            scroll: false,
            maxErrorsPerField: 1,
            onValidationComplete: function (form, status) {
                if (!status) {
                    $.fancybox.open({
                        src: '#formErrorMsg',
                        afterClose: function () {
                            $('#formErrorMsg').empty();
                        }
                    });
                } else {
                    return true;
                }
            }
        });
    }


    $('.itemThumbnail').click(function () {
        $('.itemThumbnail').removeClass('current');
        $(this).addClass('current');
        var id = $(this).find("img").attr("data-id");
        if (step4Action.check(id)) {
            step4Action.checkImage(id);
            reload();
        }
    });


    $("#fileupload").change(function () {
        // $("#previewBox").html(""); // 清除預覽
        $('.sectionPreview').fadeIn();
        readURL(this, false);
    });


    $(".tabTrigger").click(function () {
        $(".tabs.active").toggleClass("active");
        $(this).addClass("active");

        var tabId = $(this).attr("data-tab");
        $(".tabContent.active").toggleClass("active");
        $("#" + tabId).addClass("active");
    });


    if ($('.swiper-container').length > 0) {
        var galleryThumbs = new Swiper('.gallery-thumbs', {
            spaceBetween: 10,
            slidesPerView: 'auto',
            freeMode: true,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
        });
        var galleryTop = new Swiper('.gallery-top', {
            thumbs: {
                swiper: galleryThumbs
            }
        });

        $('body').on("click", '.swiper-slide .icon-delete', function () {
            var i = $('.gallery-thumbs .swiper-slide').index($(this).closest(".swiper-slide"));
            var img = $(this).parent().attr("data-img");
            var id = $("#id").val();
            formData.delete(id, img);
            if (formData.getStatus()) {
                galleryThumbs.removeSlide(i);
                galleryTop.removeSlide(i);
            }
        });

        $("#swiperupload").change(function () {
            if ($("#swiperupload").val() == '')
                return false;
            showLoading();
            readURL(this, true);
            $.ajax({
                type: 'post',
                url: 'get_data.php',
                data: {action: 'check'},
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        step4Action.upload();
                        if (formData.getStatus()) {
                            reload();
                            clearLoading();
                        }
                    }
                },
                error: function () {
                    clearLoading();
                    alert("Upload Error");
                }
            });
        });
    }

    if ($('#editForm').length > 0) {
        $('#editForm').validationEngine('attach', {
            promptPosition: 'inline',
            addPromptClass: 'errorMsg',
            scroll: false,
            maxErrorsPerField: 1,
            onValidationComplete: function (form, status) {
                if (!status) {
                    showAlertMsg('#formErrorMsg', true);
                } else {
                    var check = true;
                    if (!step4Action.checkStock())
                        check = false;
                    if (!step4Action.checkPrice())
                        check = false;
                    if (!step4Action.checkColor())
                        check = false;
                    if (check) {
                        return true;
                    } else {
                        showAlertMsg('#formErrorMsg', true);
                    }
                }
            }
        });
    }

    function reload() {
        galleryThumbs.removeAllSlides();
        galleryTop.removeAllSlides();
        galleryTop.appendSlide('<div class="swiper-slide" style="background-image: url(' + step4Action.getPicture() + ');"></div>');
        galleryThumbs.appendSlide('<div class="swiper-slide" style="background-image: url(' + step4Action.getPicture() + ');"></div>');
        $.each(step4Action.getSubPicture(), function (k, v) {
            galleryTop.appendSlide('<div data-img=' + k + ' class="swiper-slide" style="background-image: url(' + v + ');"></div>');
            galleryThumbs.appendSlide('<div data-img=' + k + ' class="swiper-slide" style="background-image: url(' + v + ');"><i class="icon-delete"></i></div>');
        });
    }

    function readURL(input, swiperUpload) {
        if (input.files && input.files.length >= 0) {
            var sizeCheck = true;
            for (var i = 0; i < input.files.length; i++) {
                if ($.inArray(input.files[i].name, formData.getValidate()) < 0) {
                    if (formData.sizeCheck(input.files[i].name, input.files[i].size)) {
                        if (formData.extCheck(input.files[i].name)) {
                            var reader = new FileReader();
                            reader.fileName = input.files[i].name;
                            formData.setValidate(input.files[i].name);
                            reader.onload = function (e) {
                                if (!swiperUpload) {
                                    var img = $("<img class='previewImg'>").attr('src', e.target.result);
                                    var thumbnail = $('<div class="previewThumbnail"><a class="icon-x-square" href="javascript:void(0);" data-img="' + e.target.fileName + '" onclick="formData.empty(this);"></a></div>').append(img);
                                    $("#previewBox").prepend(thumbnail);
                                }
                            }
                            reader.readAsDataURL(input.files[i]);
                        }
                    } else {
                        sizeCheck = false;
                    }
                }
            }
            if (!swiperUpload)
                formData.setFile();
            if (!sizeCheck)
                showAlertMsg('#formErrorMsg', true);
        }
    }

    $("input[type='radio']").on('click', function () {
        var name = $(this).attr('name');
        var id = name + '_checked';
        var checkedString = $("#" + id).val();
        if (typeof (checkedString) != 'undefined') {
            if (checkedString == $(this).val()) {
                $("#" + id).val('');
                $(this).prop("checked", false);
            } else {
                $("#" + id).val($(this).val());
            }
        }
    });
});

var formData = function () {

    var form_id = '#fileupload';
    var product_id = 0;
    var form_data;
    var file_data = {};
    var status = false;
    var msg = '';
    var validateData = [];
    var emptyData = [];
    var showErrorAlert = function () {
        $("#alertMsgBox").html(msg);
        showAlertMsg('#formErrorMsg', true);
    };
    var reset = function () {
        status = false;
        msg = '';
    };
    var setFormData = function () {
        form_data = new FormData();
        if (file_data.length == 0 || validateData.length == 0)
            return false;
        $.each(file_data, function (i, v) {
            if ($.inArray(i, validateData) >= 0) {
                form_data.append('file[' + i + ']', v);
            }
        });
        return true;
    };
    return {
        validate: function (step) {

            reset();
            if (!setFormData()) {
                clearLoading();
                return false;
            }
            form_data.append('action', 'validate');
            if (step != '')
                form_data.append('step', step);
            if (product_id > 0)
                form_data.append('product_id', product_id);
            $.ajax({
                url: 'upload.php',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,  //data只能指定單一物件
                type: 'post',
                async: false,
                dataType: 'json',
                success: function (data) {
                    $.each(data, function (k, v) {
                        if (v.status == 0) {
                            emptyData.push(v.name);
                            msg += v.name + ":" + v.msg + "<br>";
                        } else {
                            if ($.inArray(v.name, validateData) < 0) {
                                validateData.push(v.name);
                            }
                        }
                    });
                    if (msg == '')
                        status = true;
                    if (!status) {
                        clearLoading();
                        showErrorAlert();
                    } else {
                        formData.upload(step);
                    }
                    return false;
                }
            });
        },
        upload: function (step) {

            if (!setFormData()) {
                clearLoading();
                return false;
            }
            form_data.append('action', 'upload');
            if (step != '')
                form_data.append('step', step);
            if (product_id > 0)
                form_data.append('product_id', product_id);

            $.ajax({
                url: 'upload.php',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,  //data只能指定單一物件
                type: 'post',
                async: false,
                dataType: 'json',
                success: function (data) {
                    $.each(data, function (k, v) {
                        if (v.status == 0) {
                            status = false;
                            msg += v.name + ":" + v.msg + "<br>";
                        }
                    });
                    if (!status) {
                        clearLoading();
                        showErrorAlert();
                    }
                }
            });
        },
        delete: function (id, img) {
            reset();
            $.ajax({
                url: 'upload.php',
                data: {action: 'delete', step: 'step4', product_id: id, image: img},  //data只能指定單一物件
                type: 'post',
                dataType: 'json',
                async: false,
                success: function (data) {
                    if (data.status == 0) {
                        status = false;
                        msg = data.msg;
                        showErrorAlert();
                    } else {
                        status = true;
                    }
                }
            });
            return false;
        },
        getStatus: function () {
            return status;
        },
        getEmptyData: function () {
            return emptyData;
        },
        setValidate: function (e) {
            validateData.push(e);
        },
        getValidate: function () {
            return validateData;
        },
        empty: function (e) {
            var img = $(e).attr('data-img');
            if (validateData.length > 0) {
                validateData = validateData.filter(function (element) {
                    return element != img;
                });
            }
            if (typeof (file_data[img]) != 'undefined')
                delete file_data[img];
            var el = $(e).parent(".previewThumbnail");
            el.remove();
        },
        setFile: function () {
            var files = $(form_id).prop('files');  //取得上傳檔案屬性
            if (files.length == 0 || validateData.length == 0)
                return false;
            for (var i = 0; i < files.length; i++) {
                if ($.inArray(files[i].name, validateData) >= 0) {
                    file_data[files[i].name] = files[i];
                }
            }
        },
        emptyFileData: function () {
            file_data = {};
        },
        emptyValidate: function () {
            validateData = [];
        },
        setFormData: function (new_form_id, new_product_id) {
            form_id = new_form_id;
            product_id = new_product_id;
        },
        extCheck: function (filePath) {
            var extStart = filePath.lastIndexOf(".");
            var ext = filePath.substring(extStart, filePath.length).toUpperCase();
            if (ext == ".PNG" || ext == ".GIF" || ext == ".JPG" || ext == ".JPEG")
                return true;
            else
                return false;
        },
        sizeCheck: function (fileName, fileSize) {
            if (parseInt(fileSize) > 512000) {
                $("#formErrorMsg").append("* " + fileName + "超過500Kb<br>");
                return false;
            } else
                return true;
        }
    }
}();

var step2Action = function () {
    return {
        submit: function () {
            showLoading();
            $.ajax({
                type: 'POST',
                url: 'get_data.php',
                data: {action: 'check'},
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        formData.validate('step2');
                        if (formData.getStatus()) {
                            $("#uploadMajor").submit();
                        } else {
                            $.each($(".icon-x-square"), function (k, v) {
                                if ($.inArray($(v).attr("data-img"), formData.getEmptyData()) >= 0)
                                    formData.empty(v);
                            });
                        }
                    }
                }
            });
        }
    }
}();

var step3Action = function () {
    var startProcessData = [];
    var setStartProcessData = function () {
        $.ajax({
            url: 'get_data.php',
            data: {'action': 'startProcessData'},
            type: 'post',
            async: false,
            dataType: 'json',
            success: function (data) {
                if (data.status) {
                    startProcessData = data.data;
                }
            }
        });
    };
    var startProcess = function () {

        setStartProcessData();
        if (startProcessData.length == 0) {
            clearLoading();
            return false;
        }
        var data = [startProcessData];
        $.ajax({
            type: 'post',
            url: '/longtask',
            data: JSON.stringify(data),
            contentType: "application/json",
            dataType: 'json',
            async: false,
            success: function (data, status, request) {
                var statusUrl = request.getResponseHeader('Location');
                updateProgress(statusUrl);
            },
            error: function () {
                alert('startProcess error');
                clearLoading();
            }
        });
    };
    var updateProgress = function (statusUrl) {
        // send GET request to status URL
        $.getJSON(statusUrl + "?_=" + (new Date().getTime()), function (data) {
            var percent = parseInt("" + data['current'] * 100 / data['total'] + "");
            $(".percent").text(percent + "%");
            // update UI
            if (data['state'] != 'PENDING' && data['state'] != 'PROGRESS') {
                $("#uploadMajor").submit();
            } else {
                // return in 2 seconds
                setTimeout(function () {
                    updateProgress(statusUrl);
                }, 2000);
            }
        });
    };
    return {
        submit: function () {
            showLoading();
            $.ajax({
                type: 'POST',
                url: 'get_data.php',
                data: {action: 'check'},
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        var validate = formData.getValidate();
                        if (validate.length != 0) {
                            formData.validate('step3');
                            if (formData.getStatus()) {
                                startProcess();
                            } else {
                                $.each($(".icon-x-square"), function (k, v) {
                                    if ($.inArray($(v).attr("data-img"), formData.getEmptyData()) >= 0)
                                        formData.empty(v);
                                });
                            }
                        } else {
                            startProcess();
                        }
                    }
                }
            });
        },
    }
}();

var step4Action = function () {
    var status = true;
    var picture;
    var sub_picture = {};
    var product = {};
    var checkedData = [];
    var productDescription = [];
    var reset = function () {
        picture = '';
        sub_picture = {};
        product = {};
        checkedData = [];
        productDescription = [];
    };
    var empty = function () {
        reset();
        if (typeof ($("#id")) != 'undefined')
            $("#id").val('');
        if (typeof ($("#pchome_category")) != 'undefined')
            $("#pchome_category").val('');
        if (typeof ($("#ruten_category")) != 'undefined')
            $("#ruten_category").val('');
        if (typeof ($("#yahoo_category")) != 'undefined')
            $("#yahoo_category").val('');
        if (typeof ($("#name")) != 'undefined')
            $("#name").val('');
        if (typeof ($("#price")) != 'undefined')
            $("#price").val('');
        if (typeof ($("#sell_price")) != 'undefined')
            $("#sell_price").val('');
        if (typeof ($("#stock")) != 'undefined')
            $("#stock").val('');
        if (typeof ($("#is_new")) != 'undefined')
            $(".is_new").prop("checked", false);
        if (typeof ($("#site")) != 'undefined')
            $("#site").val('');
        if (typeof ($("#posting_days")) != 'undefined')
            $("#posting_days").val('');
        if (typeof ($(".sub_category")) != 'undefined')
            $(".sub_category").prop("checked", false);
        if (typeof ($("#sub_category_custom_field")) != 'undefined')
            $("#sub_category_custom_field").val('');
        if (typeof ($(".category")) != 'undefined')
            $(".category").prop("checked", false);
        if (typeof ($(".fabric")) != 'undefined')
            $(".fabric").prop("checked", false);
        if (typeof ($(".color")) != 'undefined')
            $(".color").prop("checked", false);
        if (typeof ($("#color_custom_field")) != 'undefined')
            $("#color_custom_field").val('');
        if (typeof ($(".size")) != 'undefined')
            $(".size").prop("checked", false);
        if (typeof ($("#size_custom_field")) != 'undefined')
            $("#size_custom_field").val('');
        if (typeof ($(".collar")) != 'undefined')
            $(".collar").prop("checked", false);
        if (typeof ($("#collar_custom_field")) != 'undefined')
            $("#collar_custom_field").val('');
        if (typeof ($(".neckline")) != 'undefined')
            $(".neckline").prop("checked", false);
        if (typeof ($("#neckline_custom_field")) != 'undefined')
            $("#neckline_custom_field").val('');
        if (typeof ($(".sleeve")) != 'undefined')
            $(".sleeve").prop("checked", false);
        if (typeof ($("#sleeve_custom_field")) != 'undefined')
            $("#sleeve_custom_field").val('');
        if (typeof ($(".feature1")) != 'undefined')
            $(".feature1").prop("checked", false);
        if (typeof ($("#feature1_custom_field")) != 'undefined')
            $("#feature1_custom_field").val('');
        if (typeof ($(".feature2")) != 'undefined')
            $(".feature2").prop("checked", false);
        if (typeof ($("#feature2_custom_field")) != 'undefined')
            $("#feature2_custom_field").val('');
        if (typeof ($(".feature3")) != 'undefined')
            $(".feature3").prop("checked", false);
        if (typeof ($("#feature3_custom_field")) != 'undefined')
            $("#feature3_custom_field").val('');
        if (typeof ($(".feature4")) != 'undefined')
            $(".feature4").prop("checked", false);
        if (typeof ($("#feature4_custom_field")) != 'undefined')
            $("#feature4_custom_field").val('');
        if (typeof ($(".feature5")) != 'undefined')
            $(".feature5").prop("checked", false);
        if (typeof ($("#feature5_custom_field")) != 'undefined')
            $("#feature5_custom_field").val('');
        if (typeof ($(".keyword")) != 'undefined')
            $(".keyword").prop("checked", false);
        if (typeof ($("#keyword_custom_field")) != 'undefined')
            $("#keyword_custom_field").val('');
        if (typeof ($("#product_description")) != 'undefined')
            $("#product_description").val('');
    };
    var getData = function (id) {
        $.ajax({
            url: 'get_data.php',
            data: {action: 'getProductData', id: id},
            type: 'post',
            async: false,
            dataType: 'json',
            success: function (data) {
                if (!data.status) {
                    status = false;
                    clearLoading();
                } else {
                    picture = data.data.picture;
                    $.each(data.data.sub_picture, function (k, v) {
                        sub_picture[k] = v;
                    });
                    $.each(data.data.product, function (k, v) {
                        product[k] = v;
                    });
                }
            },
            error: function () {
                alert('getProductData error');
                clearLoading();
            }
        });
    };
    var setData = function () {
        $.each(product, function (k, v) {
            if (v != "" && v != null) {
                if (k == 'id')
                    $("#id").val(v);
                if (k == 'pchome_category')
                    $("#pchome_category").val(v);
                if (k == 'ruten_category')
                    $("#ruten_category").val(v);
                if (k == 'yahoo_category')
                    $("#yahoo_category").val(v);
                if (k == 'name')
                    $("#name").val(v);
                if (k == 'price')
                    $("#price").val(v);
                if (k == 'sell_price')
                    $("#sell_price").val(v);
                if (k == 'stock')
                    $("#stock").val(v);
                if (k == 'is_new')
                    checked('is_new', v);
                if (k == 'site')
                    $("#site").val(v);
                if (k == 'posting_days')
                    $("#posting_days").val(v);
                if (k == 'sub_category')
                    checked('sub_category', v);
                if (k == 'sub_category_custom_field')
                    $("#sub_category_custom_field").val(v);
                if (k == 'category')
                    checked('category', v);
                if (k == 'fabric')
                    checked('fabric', v);
                if (k == 'color')
                    checked('color', v);
                if (k == 'color_custom_field')
                    $("#color_custom_field").val(v);
                if (k == 'size')
                    checked('size', v);
                if (k == 'size_custom_field')
                    $("#size_custom_field").val(v);
                if (k == 'collar')
                    checked('collar', v);
                if (k == 'collar_custom_field')
                    $("#collar_custom_field").val(v);
                if (k == 'neckline')
                    checked('neckline', v);
                if (k == 'neckline_custom_field')
                    $("#neckline_custom_field").val(v);
                if (k == 'sleeve')
                    checked('sleeve', v);
                if (k == 'sleeve_custom_field')
                    $("#sleeve_custom_field").val(v);
                if (k == 'feature_1')
                    checked('feature1', v);
                if (k == 'feature_1_custom_field')
                    $("#feature1_custom_field").val(v);
                if (k == 'feature_2')
                    checked('feature2', v);
                if (k == 'feature_2_custom_field')
                    $("#feature2_custom_field").val(v);
                if (k == 'feature_3')
                    checked('feature3', v);
                if (k == 'feature_3_custom_field')
                    $("#feature3_custom_field").val(v);
                if (k == 'feature_4')
                    checked('feature4', v);
                if (k == 'feature_4_custom_field')
                    $("#feature4_custom_field").val(v);
                if (k == 'feature_5')
                    checked('feature5', v);
                if (k == 'feature_5_custom_field')
                    $("#feature5_custom_field").val(v);
                if (k == 'keyword')
                    checked('keyword', v);
                if (k == 'keyword_custom_field')
                    $("#keyword_custom_field").val(v);
                if (k == 'product_description')
                    $("#product_description").val(v);
                if (k == 'is_edit') {
                    (v == 1) ? $("#preview").css("visibility", "visible") : $("#preview").css("visibility", "hidden");
                }
            }
        });
    };
    var checked = function (name, str) {
        var array = str.split(",");
        var className = "." + name;
        $.each($(className), function (k, v) {
            if (array.indexOf($(v).val()) != -1)
                $(v).prop("checked", true);
        });
    };
    var getCheckedData = function () {
        if (typeof ($(".collar")) != 'undefined')
            buildCheckedData("collar");
        if (typeof ($(".neckline")) != 'undefined')
            buildCheckedData("neckline");
        if (typeof ($(".sleeve")) != 'undefined')
            buildCheckedData("sleeve");
        if (typeof ($(".feature1")) != 'undefined')
            buildCheckedData("feature1");
        if (typeof ($(".feature2")) != 'undefined')
            buildCheckedData("feature2");
        if (typeof ($(".feature3")) != 'undefined')
            buildCheckedData("feature3");
        if (typeof ($(".feature4")) != 'undefined')
            buildCheckedData("feature4");
        if (typeof ($(".feature5")) != 'undefined')
            buildCheckedData("feature5");
    };
    var buildCheckedData = function (id) {
        var className = "." + id;
        $.each($(className), function (k, v) {
            if ($(v).is(":checked")) {
                if ($(v).val() != 'custom') {
                    checkedData.push($(v).val());
                }
            }
        });
    };
    var renewSentence = function (strings) {
        var mydata = [
            {"strings": strings}
        ];
        $.ajax({
            type: 'post',
            url: '/renewsentence',
            data: JSON.stringify(mydata),
            contentType: "application/json",
            dataType: 'json',
            cache: false,
            success: function (data, status, request) {
                var status_url = request.getResponseHeader('Location');
                updateProgress(status_url);
            },
            error: function () {
                alert('RenewSentence error');
                clearLoading();
            }
        });
    };
    var updateProgress = function (statusUrl) {
        // send GET request to status URL
        $.getJSON(statusUrl + "?_=" + (new Date().getTime()), function (data) {
            var percent = parseInt("" + data['current'] * 100 / data['total'] + "");
            $(".percent").text(percent + "%");
            // update UI
            if (data['state'] != 'PENDING' && data['state'] != 'PROGRESS') {
                $.each(data['result'], function (k, v) {
                    productDescription.push(v);
                });
                replaceProductDescription();
                clearLoading();
            } else {
                // return in 2 seconds
                setTimeout(function () {
                    updateProgress(statusUrl);
                }, 2000);
            }
        });
    };
    var replaceProductDescription = function () {
        var string = "";
        var id = $("#id").val();

        $.each(productDescription, function (k, v) {
            if (string == "")
                string += v;
            else
                string += "\n" + v;
        });
        $.ajax({
            type: 'POST',
            url: 'get_data.php',
            data: {action: 'saveProductDescription', id: id, string: string},
            async: false,
            dataType: 'json',
            success: function (data) {
                if (data) {
                    if (!data.status) {
                        status = false;
                        clearLoading();
                    } else {
                        $("#product_description").val(string);
                    }
                }
            }
        });
    };
    var checkRate = function (nubmer) {
        var r = /^\d+$/;
        if (!r.test(nubmer)) {
            return false;
        } else {
            return true;
        }
    }
    return {
        getPicture: function () {
            return picture;
        },
        getSubPicture: function () {
            return sub_picture;
        },
        check: function (id) {
            if (typeof ($("#id")) == 'undefined' || $("#id").val() == id)
                return false;
            else
                return true;
        },
        checkImage: function (id) {
            showLoading();
            empty();
            getData(id);
            if (status) {
                setData();
            }
            clearLoading();
        },
        upload: function () {
            reset();
            var id = $("#id").val();
            formData.emptyFileData();
            formData.setFormData('#swiperupload', id);
            formData.setFile();
            formData.validate('step4');
            formData.emptyValidate();
            getData(id);
        },
        buildProductDescription: function () {
            showLoading();
            reset();
            var id = $("#id").val();
            getCheckedData();
            $.ajax({
                type: 'POST',
                url: 'get_data.php',
                data: {action: 'buildProductDescription', id: id, data: checkedData},
                dataType: 'json',
                success: function (data) {
                    if (data) {
                        if (!data.status) {
                            status = false;
                            clearLoading();
                        } else {
                            if (data.data.strings == '') {
                                $.each(data.data.data, function (k, v) {
                                    productDescription.push(v);
                                });
                                replaceProductDescription();
                                clearLoading();
                            } else {
                                $.each(data.data.data, function (k, v) {
                                    productDescription.push(v);
                                });
                                renewSentence(data.data.strings);
                            }
                        }
                    }
                }
            });
        },
        previewProductPage: function (type) {
            var id = $("#id").val();
            var typeArr = type.split(",");
            $.each(typeArr, function (k, v) {
                window.open('preview.php?type=' + v + '&product_id=' + id);
            });
        },
        download: function () {
            var id = $("#id").val();
            window.open('download.php');
        },
        checkStock: function () {
            var customChecked = $('#sizeCustom').prop('checked');
            var customLength = $('#sizeCustom').siblings('.customField').val().split(',').length;
            var checkedLength = $("input[name='size[]']:checked").length;
            var sizeLength;
            var stockArray = $('input[name="stock"]').val().split(',');
            var stockLength = stockArray.length;
            var intCheck = true;

            $.each(stockArray, function (i, v) {
                if (!checkRate(v.trim()))
                    intCheck = false;
            });

            if (!intCheck) {
                $("#formErrorMsg").append("* 庫存數量須為正整數或0!<br>");
            }

            if (customChecked) {
                sizeLength = checkedLength - 1 + customLength;
            } else {
                sizeLength = checkedLength;
            }
            if (sizeLength != stockLength) {
                if (sizeLength > stockLength) {
                    $("#formErrorMsg").append("* 再次檢查！您設定" + sizeLength + "個尺寸，只有" + stockLength + "個尺寸有填寫庫存數量<br>");
                } else {
                    $("#formErrorMsg").append("* 再次檢查！您設定" + sizeLength + "個尺寸，卻有" + stockLength + "個庫存數量<br>");
                }
            }

            if (sizeLength != stockLength || !intCheck) {
                return false;
            } else {
                return true;
            }
        },
        checkPrice: function () {
            var price = $("#price").val();
            var sellPrice = $("#sell_price").val();
            if (parseInt(price) <= parseInt(sellPrice)) {
                $("#formErrorMsg").append("* 商品售價/促銷 須小於 原價!<br>");
                return false;
            } else if (parseInt(price) == 0 || parseInt(sellPrice) == 0) {
                $("#formErrorMsg").append("* 商品售價/促銷和原價須大於0!<br>");
                return false;
            } else {
                return true;
            }
        },
        checkColor: function () {
            var color = $("input[name='color']:checked").val();
            var color_custom_field = $("#color_custom_field").val();
            if (typeof (color) == 'undefined' || color == '' || (color == 'custom' && color_custom_field == '')) {
                $("#formErrorMsg").append("* 請填寫顏色<br>");
                return false;
            } else {
                return true;
            }
        },
    }
}();


//hide loading spinner
function clearLoading() {
    $('.loading').fadeOut();
}

//show loading spinner
function showLoading() {
    $('.loading').show();
}

//show alertMsgBox
function showAlertMsg(id, clear) {
    if (clear) {
        $.fancybox.open({
            src: id,
            afterClose: function () {
                $(id).empty();
            }
        });
    } else {
        $.fancybox.open({
            src: id
        });
    }
}