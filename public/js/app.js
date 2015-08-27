
$(document).ready(function(){
	
	
	$(".alertDiv1").delay(2300).fadeOut();

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
            		$(".alertDiv1").show();
            	 	$(".alertDiv1").text(response);
            	 	$(".alertDiv1").delay(2300).fadeOut();
            	}else if(response == "Success"){
            		$(".alertDiv2").show();
            	 	$(".alertDiv2").text(response);
            	 	$(".alertDiv2").delay(2300).fadeOut();
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
            	if (response == "Wrong inputs") {
            		$(".alertDiv1").show();
            	 	$(".alertDiv1").text(response);
            	 	$(".alertDiv1").delay(2300).fadeOut();
            	}else if(response == "Success"){
            		$(".alertDiv2").show();
            	 	$(".alertDiv2").text(response);
            	 	$(".alertDiv2").delay(2300).fadeOut();
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
                    $(".alertDiv1").delay(2300).fadeOut();


                }else if(response == "Comment added"){
                    $(".alertDiv2").show();
                    $(".text").text(response);
                    $(".alertDiv2").delay(2300).fadeOut();
                    $('#cont').load(document.URL +  ' #cont');
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
            url: "user/bike/view",
            
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

