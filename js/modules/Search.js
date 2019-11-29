import $ from 'jquery';
class Search {

    constructor(){
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
                this.timeVar=setTimeout(this.getResults.bind(this),2000)//arg 1-func arg2 delay

            }else{
                this.resultDiv.html('');
                this.spinnerVisible=false;
            }

        }
        this.preSetTime=this.SetTime.val();

    }


    getResults(){
        this.resultDiv.html("welcome to type succesfull");
        this.spinnerVisible=false;
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