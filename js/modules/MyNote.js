import $ from "jquery";

class MyNote {
    constructor(){
this.deleteButton=$('.delete-note');
this.events();
    }

    events(){
this.deleteButton.on('click',this.deleteItem)
    }


    //all method accomplish for events
deleteItem(){

     $.ajax({
         beforeSend:(xhr)=>{
             xhr.setRequestHeader('X-WP-Nonce',main_var.nonce)
         },
         url: main_var.root_site+'/wp-json/wp/v2/note/109',
         type:'DELETE',
         success:(response)=>{console.log('Congrat');console.log(response);},
         error:(response)=>{console.log('sorry');console.log(response);}
     });
}


}

export default MyNote;