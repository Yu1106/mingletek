$(function () {

    var timer

    $(window).scroll(function () {

        window.clearTimeout(timer)
        timer = window.setTimeout(function () {

            var scrollTop = $(window).scrollTop();

            //goTop
            if ((scrollTop >= 100)) {
                $("#goTop").stop().fadeIn();
            } else {
                $("#goTop").fadeOut();
            }

        }, 100)

    });


    //Scroll To Top
    $("#goTop").click(function goTop() {
        $("html,body").animate({scrollTop: 0}, 800);
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
    });


    $("#fileupload").change(function () {
        $("#previewBox").html(""); // 清除預覽
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
            galleryThumbs.removeSlide(i);
            galleryTop.removeSlide(i);
        });

        $("#swiperupload").change(function () {
            readURL(this, true);
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
                    $.fancybox.open({
                        src: '#formErrorMsg',
                        afterClose: function () {
                            $('#formErrorMsg').empty();
                        }
                    });
                }
            }
        });
    }

    function readURL(input, swiperUpload) {
        if (input.files && input.files.length >= 0) {
            for (var i = 0; i < input.files.length; i++) {
                var reader = new FileReader();
                reader.fileName = input.files[i].name;
                fileFormData.setValidate(input.files[i].name);
                reader.onload = function (e) {
                    if (swiperUpload) {
                        galleryThumbs.appendSlide('<div class="swiper-slide" style="background-image: url(' + e.target.result + ');"><i class="icon-delete"></i></div>');
                        galleryTop.appendSlide('<div class="swiper-slide" style="background-image: url(' + e.target.result + ');"></div>');
                    } else {
                        var img = $("<img class='previewImg'>").attr('src', e.target.result);
                        var thumbnail = $('<div class="previewThumbnail"><a class="icon-x-square" href="javascript:void(0);" data-img="' + e.target.fileName + '" onclick="fileFormData.empty(this);"></a></div>').append(img);
                        $("#previewBox").prepend(thumbnail);
                    }
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }
});

var fileFormData = function () {

    var form_data; //建構new FormData()
    var status = true;
    var msg = '';
    var validateData = [];

    var showErrorAlert = function () {
        $("#alertMsgBox").html(msg);
        showAlertMsg();
    };
    var reset = function () {
        status = true;
        msg = '';
    };
    var setFile = function () {
        form_data = new FormData(); //建構new FormData()
        var file_data = $("#fileupload").prop('files');  //取得上傳檔案屬性
        if (file_data.length == 0 || validateData.length == 0)
            return false;
        for (var i = 0; i < file_data.length; i++) {
            if ($.inArray(file_data[i].name, validateData) >= 0) {
                form_data.append('file[]', file_data[i]);
            }
        }
        form_data.append('action', '');
        form_data.append('sub', '');
        return true;
    };
    return {
        validate: function (sub = false) {

            if (!setFile())
                return false;
            form_data.set('action', 'validate');
            if (sub) form_data.set('sub', 'sub');
            reset();
            showLoading();

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
                            $.each($(".icon-x-square"), function (k2, v2) {
                                if ($(v2).attr("data-img") == v.name)
                                    fileFormData.empty(v2);
                            });
                        } else {
                            if ($.inArray(v.name, validateData) < 0) {
                                validateData.push(v.name);
                            }
                        }
                    });
                    if (!status) {
                        clearLoading();
                        showErrorAlert();
                    } else {
                        fileFormData.upload(sub);
                    }
                    return false;
                }
            });
            clearLoading();
        },
        upload: function (sub = false) {

            form_data.set('action', 'upload');
            if (sub) form_data.set('sub', 'sub');

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
                    } else {
                        // $("#uploadMajor").submit();
                    }
                }
            });
        },
        empty: function (e) {
            var img = $(e).attr('data-img');
            if (validateData.length > 0) {
                validateData = validateData.filter(function (element) {
                    return element != img;
                });
            }
            var el = $(e).parent(".previewThumbnail");
            el.remove();
        },
        setValidate: function (e) {
            validateData.push(e);
        },
        startProcess: function(){
            $.ajax({
                url: 'api.php',
                cache: false,
                contentType: false,
                processData: false,
                data: 'StartProcess',  //data只能指定單一物件
                type: 'post',
                async: false,
                dataType: 'html',
                success: function (data) {
                    console.log(data);
                }
            });
        }
    }
}();

//hide loading spinner
function clearLoading() {
    $('.loading').fadeOut();
}

//show loading spinner
function showLoading() {
    $('.loading').fadeIn();
}

//show alertMsgBox
function showAlertMsg() {
    $.fancybox.open({
        src: '#alertMsgBox',
        afterClose: function () {
            $('#alertMsgBox').empty();
        }
    });
}