import $ from 'jquery';
class Search {

    constructor(){
        this.htmlTemplateSearch();
        this.preSetTime;
        this.spinnerVisible=false ;
        this.resultDiv=$('#search-overlay__results');
        this.openButton=$('.js-search-trigger');
        this.overlay=$('.search-overlay');
        this.closeButton=$('.search-overlay__close');
        this.checkOpen=false;
        this.SetTime=$('#search-term');
        this.timeVar;
        this.events();//after last property
    }
    events(){
        this.openButton.on('click',this.openOverlay.bind(this));
        this.closeButton.on('click',this.closeOverlay.bind(this));
        $(document).on("keydown",this.keyOverlay.bind(this));//'keyup' without lag and press leave a time run
        this.SetTime.on('keyup',this.timeLogic.bind(this));
    }


    timeLogic(){

        if (this.SetTime.val()!= this.preSetTime){//identify difference add remove char with move cursor
            clearTimeout( this.timeVar);
            if(this.SetTime.val()){
                if(!this.spinnerVisible){//no run more this line
                    this.resultDiv.html('<div class="spinner-loader"></div>');
                    this.spinnerVisible=true;
                }
                this.timeVar=setTimeout(this.getResults.bind(this),750)//arg 1-func arg2 delay

            }else{
                this.resultDiv.html('');
                this.spinnerVisible=false;
            }

        }
        this.preSetTime=this.SetTime.val();

    }

//Async
    getResults() {
        $.when(
            $.getJSON(main_var.root_site + '/wp-json/wp/v2/posts?search=' + this.SetTime.val()),
            $.getJSON(main_var.root_site + '/wp-json/wp/v2/pages?search=' + this.SetTime.val())
        ).then((result, pages) => {
                var combine = result[0].concat(pages[0]);
                // console.log(result);//result and page every 3 array   array[0] is data console log show other cell
                this.resultDiv.html(
                    `
                    <h2 class="search-overlay__section-title">General Information</h2>
                   ${combine.length ? `<ul  class="link-list min-list">` : `there isnt any search for this word`}
                    ${combine.map(item => `<li><a href="${item.link}">${item.title.rendered}</a>${item.type=='post'?`by ${item.authorName}`:''}</li>`).join('')}
                    ${combine.length ? `</ul>` : ``}
                    `
                );
                this.spinnerVisible = false;
            }
        );
    }
    //Syn wait for after command
     //arg1=requestUrl arg2=callback result arg1 to arg 2
     //    $.getJSON(main_var.root_site+'/wp-json/wp/v2/posts?search='+this.SetTime.val(),
     //     result=>{
     //           $.getJSON(main_var.root_site+'/wp-json/wp/v2/pages?search='+this.SetTime.val(),
     //               pages=>{
     //               var combine=result.concat(pages);
     //               console.log(combine);
     //                   this.resultDiv.html(
     //                       `
     //                <h2 class="search-overlay__section-title">General Information</h2>
     //               ${combine.length ? `<ul  class="link-list min-list">`:`there isnt any search for this word`}
     //                ${combine.map(item=>`<li><a href="${item.link}">${item.title.rendered}</a></li>`).join('')}
     //                ${combine.length ? `</ul>` : ``}
     //                `
     //
     //                   ); this.spinnerVisible=false;
     //               }
     //               )
// if not work to within back tick `  use ternary operator
//             }
            //we are putting func(){}.bind(this) for annoymos func can this property within ES6  combine=>{}  no need bind
            // )
    // }
    keyOverlay(e){
    // console.log(e.keyCode);
        if(e.keyCode==83 &&  !this.checkOpen && !$("input,textarea").is(':focus')){
            this.openOverlay();
            // console.log(e.keyCode);
            this.checkOpen=true;
        }
        if (e.keyCode==27 &&  this.checkOpen) {
            this.closeOverlay();
            // console.log(e.keyCode);
            this.checkOpen=false;
        }
    }
    openOverlay(){
        this.overlay.addClass("search-overlay--active");
        this.SetTime.val('');
        setTimeout(()=>this.SetTime.focus(),301);
        this.checkOpen=true;
    }
    closeOverlay(){
        this.overlay.removeClass("search-overlay--active");
        this.checkOpen=false;
    }
    htmlTemplateSearch(){
        $('body').append(`
        <div class="search-overlay ">
    <div class="search-overlay__top">
        <div class="container">
            <i class="fa fa-search search-overlay__icon" aria-hidden="true"></i>
            <input type="text" class="search-term" placeholder="what are you looking for?" id="search-term">
            <i class="fa fa-window-close search-overlay__close" aria-hidden="true"></i>
        </div>
    </div>
    <div class="container">
        <div id="search-overlay__results"></div>
    </div>
</div>

        `)
    }
}
export default Search; //for import within script.js or other place this code has necessary