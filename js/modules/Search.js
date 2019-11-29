import $ from 'jquery';
class Search {

    constructor(){
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
        this.SetTime.on('keydown',this.timeLogic.bind(this));
    }
    timeLogic(){
        clearTimeout( this.timeVar);
        this.timeVar=setTimeout(function () {
            console.log('this type in search box');
        },4000)//arg 1-func arg2 delay
    }
    getResults(){
        this.resultDiv.html("welcome to type succesfull");
    }
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
    }
    closeOverlay(){
        this.overlay.removeClass("search-overlay--active");
    }
}
export default Search; //for import within script.js or other place this code has necessary