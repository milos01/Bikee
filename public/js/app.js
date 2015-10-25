
$(document).ready(function(){
	
	$(".alertDiv").delay(2300).fadeOut();

	$("#AddBike").click(function(){
		$("#target_form1").submit();
	});
	$("form.postCreate").on('submit',function(){
            var that = $(this),
            url = that.attr('action'),
            method = that.attr('method'),
            data = {};
        that.find('[name]').each(function(index, value){
        	var that = $(this),
        	name = that.attr('name'),
        	value = that.val();

        data[name] = value;
        });
        
      	$.ajax({
          	type: method,
            url: url,
            data: data,
            success: function(response) {
            	if (response == "Wrong inputs") {
            		$(".alertDiv11").show();
            	 	$(".alertDiv11").delay(1000).fadeOut();
            	}else if(response == "Success"){
            		$(".alertDiv22").show();
            	 	$(".alertDiv22").text(response);
            	 	$(".alertDiv22").delay(1000).fadeOut();
            	};
            	 

            }
        });
		// console.log(data);
        return false;
    });
    $("form.postLogin").on('submit',function(){
            var that = $(this),
            url = that.attr('action'),
            method = that.attr('method'),
            data = {};
        that.find('[name]').each(function(index, value){
        	var that = $(this),
        	name = that.attr('name'),
        	value = that.val();

        data[name] = value;
        });
        
      	$.ajax({
          	type: method,
            url: url,
            data: data,
            success: function(response) {
            	if (response == "Wrong inputs" || response == "User does not exists") {
                    $(".alertDiv11").show();
                    // $(".alertDiv11").text(response);
                    $(".alertDiv11").delay(1000).fadeOut();
            	}else{
                    $("body").html(response); 
            	};
            	 

            }
        });
		// console.log(data);
        return false;
    });
    $("form.commentCreate").on('submit',function(){
            var that = $(this),
            url = that.attr('action'),
            method = that.attr('method'),
            data = {};
        that.find('[name]').each(function(index, value){
            var that = $(this),
            name = that.attr('name'),
            value = that.val();

        data[name] = value;
        });
        
        $.ajax({
            type: method,
            url: url,
            data: data,
            success: function(response) {
                if (response == "Wrong inputs") {
                    $(".alertDiv1").show();
                    $(".text").html('<b>Not enough arguments</b>');
                    $(".alertDiv1").delay(1000).fadeOut();
                    



                }else if(response == "Comment added"){
                    $(".alertDiv2").show();
                    $(".text2").html('<b>Comment added</b>');
                    $(".alertDiv2").delay(1000).fadeOut();
                    $('html, body').animate({
                         scrollTop: $("#conti").offset().top
                    }, 2000);
                    $('#conti').load(document.URL +  ' #conti');
                    $('#notification_count').load(document.URL +  ' #notification_count');
                    document.getElementById("bodyYo").value = '';

                };
                
            },
            error: function(ad,asd){
                alert("error");
            }
        });
        // console.log(data);
        return false;
    });
    $("li.available").on("click",function(e){
        e.preventDefault();
        $.ajax({
            type: "get",
            url: "user/search/1/10",
            success:function(data){
                alert(data);
                  // the HTML content your controller has produced 
                  
                window.location.reload();
            }
            
        });
    });
	$("#searchBike").click(function(){
		$("#srcBike").submit();
	});
	$("#rentBike").click(function(){
		$("#rntBike").submit();
	});
	$("#catSub").click(function(){
		$("#category_form").submit();
	});
	$("#hideShow").click(function(){
		$(".HideShowDiv1").toggle(100);
		$(".HideShowDiv2").toggle(100);
	});
	var myDiv = $('.threadBody');
	myDiv.text(myDiv.text().substring(0,30));
	$(".new_category").click(function(){
		var id = event.target.id;
		var pieces = id.split("-");
		console.log(pieces);
		$("#category_form").prop('action','/forum/category/'+pieces[2]+'/new');
	});
	$(".delete_group").click(function(event){
		$(".delete_group").prop('href','/forum/group/'+event.target.id+'/delete');
	});
 
 $("#notButt").on('click',function(e){
    e.preventDefault();
    var root_url = "<?php URL::route('viewBikes') ?>";


    $.ajax({
            type: "post",
            url: "../view",
            
        });

});
 $("#notButt1").on('click',function(e){
    e.preventDefault();
    var root_url = "<?php URL::route('viewBikes') ?>";


    $.ajax({
            type: "post",
            url: "../user/view",
            
        });

});

});


$("#notButt").mousedown(function(){
		$("#notificationDiv").toggle();
        var visible = $("#notifications").is(":visible");
        if (!visible) {
            // $("#notButt").css("color","blue");

        }else{
            $("#notButt").css("color","black");
            // document.getElementById("notifications").style.visibility='hidden';
            
        };
});

$("#notButt").click(function(){
    document.getElementById("notification_count").style.visibility='hidden';
});
$("#notButt1").mousedown(function(){
        $("#notificationDiv").toggle();
        var visible = $("#notifications").is(":visible");
        if (!visible) {
            // $("#notButt").css("color","blue");

        }else{
            $("#notButt1").css("color","black");
            // document.getElementById("notifications").style.visibility='hidden';
            
        };
});

$("#notButt1").click(function(){
    document.getElementById("notification_count").style.visibility='hidden';
});
