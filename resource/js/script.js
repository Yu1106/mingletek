$(function(){

	var timer

	$(window).scroll(function() {
		
		window.clearTimeout(timer)
		timer = window.setTimeout(function(){

			var scrollTop = $(window).scrollTop();

			//goTop
			if ((scrollTop >= 500)){
				$("header.fixed").addClass("is_scroll");
				$("#goTop").stop().fadeIn();
			}else{
				$("header.fixed").removeClass("is_scroll");
				$("#goTop").fadeOut();
			}

		},100)

	});

	
	//Scroll To Top
	$("#goTop").click(function goTop(){
		$("html,body").animate({scrollTop:0},800);
	});


	if($('#settingsForm').length > 0){
		$('#settingsForm').validationEngine('attach', {
			promptPosition: 'inline',
			addPromptClass: 'errorMsg',
			scroll: false,
			maxErrorsPerField: 1,
			onValidationComplete: function(form, status){
				if(!status){
					$.fancybox.open({
						src: '#formErrorMsg',
						afterClose : function() {
							$('#formErrorMsg').empty();
						}
					});
				}
			}
		});
	}


	$('.itemThumbnail').click(function(){
		$('.itemThumbnail').removeClass('current');
		$(this).addClass('current');
	});


	$("#fileupload").change(function(){
		// $("#previewBox").html(""); // 清除預覽
		$('.sectionPreview').fadeIn();
		readURL(this,false);
	});


	$(".tabTrigger").click(function(){
        $(".tabs.active").toggleClass("active");
        $(this).addClass("active");

        var tabId = $(this).attr("data-tab");
        $(".tabContent.active").toggleClass("active");
        $("#"+ tabId).addClass("active");
    });


	if ($('.swiper-container').length > 0){
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

		$("#swiperupload").change(function(){
			readURL(this,true);
		});
	}

	if ($('#editForm').length > 0){
		$('#editForm').validationEngine('attach', {
			promptPosition: 'inline',
			addPromptClass: 'errorMsg',
			scroll: false,
			maxErrorsPerField: 1,
			onValidationComplete: function(form, status){
				if(!status){
					$.fancybox.open({
						src: '#formErrorMsg',
						afterClose : function() {
							$('#formErrorMsg').empty();
						}
					});
				}
			}
		});
	}


	function readURL(input,swiperUpload){
		if (input.files && input.files.length >= 0) {
			for(var i = 0; i < input.files.length; i ++){
				var reader = new FileReader();
				reader.onload = function (e) {
					if(swiperUpload) {
						galleryThumbs.appendSlide('<div class="swiper-slide" style="background-image: url(' + e.target.result + ');"><i class="icon-delete"></i></div>');
						galleryTop.appendSlide('<div class="swiper-slide" style="background-image: url(' + e.target.result + ');"></div>');
					}else{
						var img = $("<img class='previewImg'>").attr('src', e.target.result);
						// console.log(e.target.result);
						var thumbnail = $('<div class="previewThumbnail"><a class="icon-x-square" href="javascript:;"></a></div>').append(img);
						$("#previewBox").prepend(thumbnail);
					}
				}
				reader.readAsDataURL(input.files[i]);
			}
		}
	}
	
});

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
		afterClose : function() {
			$('#alertMsgBox').empty();
		}
	});
}
