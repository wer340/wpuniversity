import $ from "jquery";

class MyNote {
    constructor(){

this.events();
    }

    events(){
 $('.delete-note').on('click',this.deleteItem);
 $('.edit-note').on('click',this.editItem);
    }


    //all method accomplish for events
    editItem(e){
        var nodeSelected=$(e.target).parent("li");
        nodeSelected.find(".note-title-field,.note-body-field").removeAttr("readonly").addClass("note-active-field");
        nodeSelected.find(".update-note").addClass("update-note--visible");
    }
deleteItem(e){
var nodeSelected=$(e.target).parent("li");
     $.ajax({
         beforeSend:(xhr)=>{
             xhr.setRequestHeader('X-WP-Nonce',main_var.nonce)
         },
         url: main_var.root_site+'/wp-json/wp/v2/note/'+nodeSelected.data("id"),
         type:'DELETE',
         success:(response)=>{console.log('Congrat');console.log(response);
             nodeSelected.slideUp();
         },
         error:(response)=>{console.log('sorry');console.log(response);
         }
     });
}


}

export default MyNote;