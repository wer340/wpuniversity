import $ from 'jquery';

class MyNote {
  constructor() {
     
    this.events();
  }

  events() {
    $("#my-note").on("click",".delete-note" ,this.deleteItem);
    $("#my-note").on("click",".edit-note", this.editItem.bind(this));
    $("#my-note").on("click",".update-note" ,this.updateItem.bind(this));
    $(".submit-note").on("click", this.createItem.bind(this));
  }



  //all method accomplish for events




  editItem(e) {
    var nodeSelected = $(e.target).parent("li");
  if(nodeSelected.data("state")=='editable'){
    this.readOnly(nodeSelected);

  }else{
this.editable(nodeSelected);

  }
  }
editable(nodeSelected){
    
    nodeSelected.find(".edit-note").html('<i class="fa fa-times" aria-hidden="true"></i>cansel');
    nodeSelected
    .find(".note-title-field,.note-body-field")
    .removeAttr("readonly")
    .addClass("note-active-field");
  nodeSelected.find(".update-note").addClass("update-note--visible");
  nodeSelected.data("state","editable");
}
readOnly(nodeSelected)
{
    
    nodeSelected.find(".edit-note").html('<i class="fa fa-pencil" aria-hidden="true"></i>edit');
    nodeSelected
    .find(".note-title-field,.note-body-field")
    .attr("readonly","readonly")
    .removeClass("note-active-field");
  nodeSelected.find(".update-note").removeClass("update-note--visible");
  nodeSelected.data("state","cansel");
}



  deleteItem(e) {
    var nodeSelected = $(e.target).parent("li");
    $.ajax({
      beforeSend: xhr => {
        xhr.setRequestHeader("X-WP-Nonce", main_var.nonce);
      },
      url:
        main_var.root_site + "/wp-json/wp/v2/note/" + nodeSelected.data("id"),
      type: "DELETE",
      success: response => {
        if(response.count<5){
          $(".note-limit-message").removeClass("active")
        }
        console.log("Congrat delete");
        console.log(response);
        nodeSelected.slideUp();
      },
      error: response => {
        console.log("sorry delete");
        console.log(response);
      }
    });
  }


  updateItem(e){
    var nodeSelected = $(e.target).parent("li");
var supporData={
    title:nodeSelected.find(".note-title-field").val(),
    content:nodeSelected.find(".note-body-field").val()
};
   
    $.ajax({
      beforeSend: xhr => {
        xhr.setRequestHeader("X-WP-Nonce", main_var.nonce);
      },
      url:
        main_var.root_site + "/wp-json/wp/v2/note/" + nodeSelected.data("id"),
      type: "POST",
      data:supporData,
      success: response => {
          this.readOnly(nodeSelected);
        console.log("Congrat update");
        console.log(response);
        
      },
      error: response => {
        console.log("sorry update");
        console.log(response);
      }
    });
    
}

//create new post
createItem(){
    
var supporData={
    title:$(".new-note-title").val(),
    content:$(".new-note-body").val(),
    status:"publish"
};
   
    $.ajax({
      beforeSend: xhr => {
        xhr.setRequestHeader("X-WP-Nonce", main_var.nonce);
      },
      url:
        main_var.root_site + "/wp-json/wp/v2/note/" ,
      type: "POST",
      data:supporData,
      success: (response) => {
        $(".new-note-title, .new-note-body").val('');
        $(`
        <li data-id="${response.id}">
        <input readonly class="note-title-field" value="${response.title.raw}">
        <span class="edit-note"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</span>
        <span class="delete-note"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</span>
        <textarea readonly class="note-body-field">${response.content.raw}</textarea>
        <span class="update-note btn btn--blue btn--small"><i class="fa fa-arrow-right" aria-hidden="true"></i> Save</span>
      </li>
        
        `).prependTo("#my-note").hide().slideDown();

        console.log("Congrats create");
        console.log(response);
      },
      error: response => {
        if(response.responseText=='you have reached your note limited'){
          $(".note-limit-message").addClass("active")
        }
        console.log("sorry create");
        console.log(response);
      }
    });
    
}






}

export default MyNote;
