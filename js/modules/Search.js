import $ from "jquery";
class Search {
  constructor() {
    this.htmlTemplateSearch();
    this.preSetTime;
    this.spinnerVisible = false;
    this.resultDiv = $("#search-overlay__results");
    this.openButton = $(".js-search-trigger");
    this.overlay = $(".search-overlay");
    this.closeButton = $(".search-overlay__close");
    this.checkOpen = false;
    this.SetTime = $("#search-term");
    this.timeVar;
    this.events(); //after last property
  }
  events() {
    this.openButton.on("click", this.openOverlay.bind(this));
    this.closeButton.on("click", this.closeOverlay.bind(this));
    $(document).on("keydown", this.keyOverlay.bind(this)); //'keyup' without lag and press leave a time run
    this.SetTime.on("keyup", this.timeLogic.bind(this));
  }

  timeLogic() {
    if (this.SetTime.val() != this.preSetTime) {
      //identify difference add remove char with move cursor
      clearTimeout(this.timeVar);
      if (this.SetTime.val()) {
        if (!this.spinnerVisible) {
          //no run more this line
          this.resultDiv.html('<div class="spinner-loader"></div>');
          this.spinnerVisible = true;
        }
        this.timeVar = setTimeout(this.getResults.bind(this), 750); //arg 1-func arg2 delay
      } else {
        this.resultDiv.html("");
        this.spinnerVisible = false;
      }
    }
    this.preSetTime = this.SetTime.val();
  }
  //custom url restAPI
  getResults() {
    $.getJSON(
      main_var.root_site +
        "/wp-json/universityREST/v1/search?term=" +
        this.SetTime.val(),
      result => {
        console.log(result); //result and page every 3 array   array[0] is data console log show other cell
        this.resultDiv.html(
          `
                     <div class="row">
                     <div class="one-third">
                     <h2 class="search-overlay__section-title">Genral Information</h2>
                      ${
                        result.general_inf.length
                          ? ` <ul  class="link-list min-list">`
                          : `there isnt any search for this word`
                      }
       
                      ${result.general_inf
                        .map(
                          item =>
                            `<li><a href="${item.permalink}">${item.title}</a>${
                              item.type == "post" ? `by ${item.authorName}` : ""
                            }</li>`
                        )
                        .join("")}
                      ${result.general_inf.length ? `</ul>` : ""}
                                </div>
                                
                     <div class="one-third">
                     <h2 class="search-overlay__section-title">campuses</h2>
                      ${
                        result.campuses.length
                          ? ` <ul  class="link-list min-list">`
                          : `no program match <a href="${main_var.root_site}/campuses">view all campuses</a>`
                      }
       
                      ${result.campuses
                        .map(
                          item =>
                            `<li><a href="${item.permalink}">${item.title}</a></li>`
                        )
                        .join("")}
                      ${result.campuses.length ? `</ul>` : ""}
                                </div>





                                
                     <div class="one-third">
                     <h2 class="search-overlay__section-title">events</h2>
                      ${
                        result.events.length
                          ? ""
                          : `no program match <a href="${main_var.root_site}/events">view all events</a>`
                      }
       
                      ${result.events
                        .map(
                          item =>
                            `<div class="event-summary">
    <a class="event-summary__date t-center" href="${item.permalink}">
                            <span class="event-summary__month">${item.month}</span>
                            
        <span class="event-summary__day">${item.day}</span>
    </a>
    <div class="event-summary__content">
        <h5 class="event-summary__title headline headline--tiny"><a href="${item.permalink}">${item.title}</a></h5>
      <p>${item.description}<a href="${item.permalink}" class="nu gray">Learn more</a></p>
    </div>
</div>`
                        )
                        .join("")}
                     
                                </div>
                                
                                





                     <div class="one-third">
                     <h2 class="search-overlay__section-title">programs</h2>
                      ${
                        result.programs.length
                          ? ` <ul  class="link-list min-list">`
                          : `no program match <a href="${main_var.root_site}/programs">view all program</a>`
                      }
       
                      ${result.programs
                        .map(
                          item =>
                            `<li><a href="${item.permalink}">${item.title}</a></li>`
                        )
                        .join("")}
                      ${result.programs.length ? `</ul>` : ""}
                                </div>
                                
                                
                     <div class="one-third">
                     <h2 class="search-overlay__section-title">professors</h2>
                      ${
                        result.professors.length
                          ? ` <ul  class="professor-cards">`
                          : `there isnt any search for this word`
                      }
       
                      ${result.professors
                        .map(
                          item =>
                            ` <li class="professor-card__list-item">
             <a class="professor-card" href="${item.permalink}">
                 <img class="professor-card__image" src="${item.img}" alt="">
                 <span class="professor-card__name">${item.title}</span>
             </a>
         </li>`
                        )
                        .join("")}
                    
                      ${result.professors.length ? `</ul>` : ""}
                                </div>
                             
                                </div>
`
        );
        this.spinnerVisible = false;
      }
    );
  }

  // if not work to within back tick `  use ternary operator
  //             }
  //we are putting func(){}.bind(this) for annoymos func can this property within ES6  combine=>{}  no need bind
  // )
  // }
  keyOverlay(e) {
    // console.log(e.keyCode);
    if (
      e.keyCode == 83 &&
      !this.checkOpen &&
      !$("input,textarea").is(":focus")
    ) {
      this.openOverlay();
      // console.log(e.keyCode);
      this.checkOpen = true;
    }
    if (e.keyCode == 27 && this.checkOpen) {
      this.closeOverlay();
      // console.log(e.keyCode);
      this.checkOpen = false;
    }
  }
  openOverlay() {
    this.overlay.addClass("search-overlay--active");
    this.SetTime.val("");
    setTimeout(() => this.SetTime.focus(), 301);
    this.checkOpen = true;
    $("body").addClass("body-no-scroll");
  }
  closeOverlay() {
    this.overlay.removeClass("search-overlay--active");
    this.checkOpen = false;
      $("body").removeClass("body-no-scroll");
  }
  htmlTemplateSearch() {
    $("body").append(`
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

        `);
  }
}
export default Search; //for import within script.js or other place this code has necessary
