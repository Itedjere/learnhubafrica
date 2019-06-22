// JavaScript Document

$(document).ready(function(){
	
	//function to delete Orders
	$("#delete_orders").click(function(e) {
		e.preventDefault();
		var checkedOrderIdString = "";
		var checkedCount = 0;
		var orderIdArray = document.orders.orderId;
		
		if (typeof orderIdArray.length === "number") {
			for(var i = 0; i < orderIdArray.length; i++) {
				if (orderIdArray[i].checked) {
					checkedOrderIdString += orderIdArray[i].value + "|";
					checkedCount++;
				}
			}
			
			if (checkedCount > 0) {
				$("#hidden_order_ids").val(checkedOrderIdString);
				$('#bs-example-modal-sm').modal();
			}
		}
		
		if (typeof orderIdArray.length === "undefined") {
			if (orderIdArray.checked) {
				$("#hidden_order_ids").val(orderIdArray.value);
				$('#bs-example-modal-sm').modal();
				//console.log(orderIdArray.value);
			}
		}
		
		
	});
	
	//fetch customised menu and vendor result
	$(".edit_tags").click(function(e) {
		e.preventDefault();
		
		var tag_id = $(this).siblings("input[type=hidden]").val();
		var tag_name = $(this).html();
		
		$("#edit_tag_name").val(tag_name);
		$("#edit_hidden_tag_id").val(tag_id);
		
		
		$('#bs-example-modal-sm').modal();
		
	});	
	
	
	$(".delete_tags").click(function(e) {
		e.preventDefault();
		
		var tag_id = $(this).siblings("input[type=hidden]").val();
		
		$("#hidden_tag_id").val(tag_id);
		
		
		$('#bs-example-modal-sm2').modal();
	});	
	
	$("td form").submit(function() {
		//get the property id and the table name for the property to be deleted
		var id = $(this).find('input[name=property_id]').val();
		var qty = $(this).find('input[name=table_name]').val();
		
		
		//now insert the id and qty into the value property of the modal
		var parentDiv = $("div.modal-body");
		parentDiv.find("input[name='delete-property-id']").val(id);
		parentDiv.find("input[name='table']").val(qty);
		
		return false;
	});
	
	
});

var loadingDiv = document.getElementById("showloadingicon");
//prepare a working url depending on the environment
var siteHostName = window.location.hostname;
var localHostOrNot, ajaxLocalhostOrNot;

if (siteHostName == "localhost") {
	ajaxLocalhostOrNot = "/learnhub";
}else {
	ajaxLocalhostOrNot = "";
}

function featureBlogOrNot($this) {
	
	//show the loading icon and the container div
	loadingDiv.style.display = "block";
	
	var dbUpdateValue;
	var dbDestination = $this.value;
	
	if ($this.checked) {
		dbUpdateValue = "yes";
		updateProductCategoryTable(dbDestination, dbUpdateValue);
		
	}else {
		dbUpdateValue = "no";
		updateProductCategoryTable(dbDestination, dbUpdateValue);
	}
}

function popupimage($this){
	// Get the modal
	var modal = document.getElementById('myModal');
	
	// Get the image and insert it inside the modal - use its "alt" text as a caption
	var modalImg = document.getElementById("img01");
	var captionText = document.getElementById("caption");

	modal.style.display = "block";
	modalImg.src = $this.src;
	captionText.innerHTML = $this.alt;

	
	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	
	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	  modal.style.display = "none";
	} 
	//console.log($this.nextElementSibling.value + " " + $this.previousElementSibling.value);
}

function updateProductCategoryTable(dbDestination, dbUpdateValue) {
	//seprate the various values in destination
	var tableName = dbDestination.split("|")[0];
	var columnName = dbDestination.split("|")[1];
	var productId = dbDestination.split("|")[2];
	
	var dataArray = "tableName=" + tableName + "&columnName=" + columnName + "&productId=" + productId + "&columnValue=" + dbUpdateValue;
	
	//we will use XMLHttpRequest To Send and Fetch the vendor List
	var xmlhttp = new XMLHttpRequest();
	var url = ajaxLocalhostOrNot + "/admin/add_remove_food_home";
	
	xmlhttp.onreadystatechange=function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			
			loadingDiv.style.display = "none";
		}
	}
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(dataArray);
	//console.log(tableName + " " + columnName + " " + productId);
}

/*function addRemoveFoodFromHome($this) {
	//we will be using the selected(ndex Property from the select to determine if an order should be open or closed
	//selectedIndex Of "0" Means Open
	//selectedIndex of "1" Means Closed
	
	if ($this.selectedIndex == 1) {
		
		//show the loading icon and the container div
		loadingDiv.style.display = "block";
		
		//get the id of this order from the hidden input field next to the select dropdown
		var food_details = $this.options[$this.selectedIndex].value;
		
		//we will use XMLHttpRequest To Send and Fetch the vendor List
		var xmlhttp = new XMLHttpRequest();
		var url = ajaxLocalhostOrNot + "/admin/add_remove_food_home";
		
		xmlhttp.onreadystatechange=function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				
				displayFoodTable(xmlhttp.responseText);
				//hide the loading icon and the container div
				loadingDiv.style.display = "none";
			}
		}
		xmlhttp.open("POST", url, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xmlhttp.send("food_details=" + food_details);
	}
}*/

/*function displayFoodTable(arr) {
	
	var arr = JSON.parse(arr);
	var tableDisplay = "";
	
	var incrementor = 1;
	
	if (arr.length > 0) {
		for(i = 0; i < arr.length; i++) {
			tableDisplay += "<tr>"
			tableDisplay += "<td>" + incrementor + "</td>";
			tableDisplay += "<td>" + arr[i]["food_name"] + "</td>";
			tableDisplay += "<td>" + arr[i]["food_price"] + "</td>";
			tableDisplay += "<td>" + arr[i]["vendor_name"] + "</td>";
			tableDisplay += "<td>" + arr[i]["category_name"] + "</td>";
			tableDisplay += "<td>";
			if (arr[i]["add_home"] == "yes") {
				tableDisplay += '<button type="button" class="btn btn-success btn-xs"><i class="fa fa-check" aria-hidden="true"></i> Yes</button>';
			}else {
				tableDisplay += '<button type="button" class="btn btn-warning btn-xs"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No&nbsp;</button>';
			}
			tableDisplay += "</td>";
			tableDisplay += "<td>";
			tableDisplay += '<select onChange="addRemoveFoodFromHome(this)">';
			tableDisplay += '<option value="">Change Status</option>';
			if (arr[i]["add_home"] == "yes") {
				tableDisplay += '<option value="no|' + arr[i]["food_id"] + '" >Remove</option>';
			}else {
				tableDisplay += '<option value="yes|' + arr[i]["food_id"] + '" >Add To Home</option>';
			}
			tableDisplay += '</select>';
			tableDisplay += "</td></tr>";
			
			//increase the incrementor
			incrementor++;
		}
		
		//now insert the details into the page
		display_food_details.innerHTML = tableDisplay;
		
	}
}*/

/*function activateInactivateVendor($this) {
	//we will be using the selected(ndex Property from the select to determine if an order should be open or closed
	//selectedIndex Of "0" Means Change which has a value of empty was selected
	//selectedIndex of "1" Means An Option of Active Or Inactive
	
	if ($this.selectedIndex == 1) {
		//get the status text and the status value
		var statusText = $this.options[$this.options.selectedIndex].text;
		var statusValue = $this.options[$this.options.selectedIndex].value;
		
		//next split the status value so as to get the vendor id and the status value
		var vendorId = statusValue.split("|")[1];
		var statusOption = statusValue.split("|")[0];
		
		//next insert the vendorId, statusOption and the statusText into the popup
		$("span.vendorStatus").text(statusText);
		$("#hidden_vendor_status").val(statusOption);
		$("#hidden_vendor_id").val(vendorId);
		
		//now pop up the pop up div
		$('#bs-example-modal-sm2').modal();
	}
	
	
}*/


