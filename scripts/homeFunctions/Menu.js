class Menu {
    _document = undefined;
    menu_button = undefined;
    menu = undefined;
    menu_options = [];
    tabs = [];
    menu_opened = false;

    constructor(_document, menu_button_id, menu_id, menu_option_classname, tab_ids){
        this._document = _document;

        tab_ids.forEach((ti) => {
            this.tabs.push(new Tab(this._document, ti));
        });

        this.menu_button = _document.getElementById(menu_button_id);
        this.menu = _document.getElementById(menu_id);

        let options = _document.getElementsByClassName(menu_option_classname);
        for(var i = 0; i < options.length; i++){
            this.menu_options.push(new MenuOption(Math.round(Math.random() * Math.pow(10, 10)), options.item(i), this.tabs[i]));
        }

        // activate 1st tab by default
        this.menu_options[0].setActive(true);
    }

    init() {
        this.addClickListener();

        this.menu_options.forEach((mo) => {
            mo.addClickListener(() => {
                this.menu_options.forEach((_mo) => {
                    if(_mo.active){
                        _mo.setActive(false);
                    }
                });

                mo.setActive(true);
                this.setMenuActive(false);
            }, this);
        });
    }

    addClickListener() {
        this.menu_button.addEventListener("click", (e) => {
            if(!this.menu_opened)
                this.setMenuActive(true);
            else
                this.setMenuActive(false);
        });
    }

    setMenuActive(status){
        const small_screen = window.matchMedia("(max-width: 1300px)").matches;

        // console.log(small_screen);
        // console.log("style.width = " + this.menu.style.width, "scrollWidth = " + this.menu.scrollWidth);

        if(status){
            this.menu.classList.add("menu-active");
            if(small_screen){
                this.menu.style.width = 0;
                this.menu.style.width = this.menu.scrollWidth + 50 + "px";
            }else{
                this.menu.style.width = "max-content";
                this.menu.style.height = this.menu.scrollHeight + "px";
            }
            this.menu_opened = true;
        }else{
            if(small_screen){
                this.menu.style.width = 0;
            }else{
                this.menu.style.height = 0;
            }
            setTimeout(() => {
                this.menu.classList.remove("menu-active");
                this.menu_opened = false;
            }, 500);
        }

        // console.log("style.width = " + this.menu.style.width, "scrollWidth = " + this.menu.scrollWidth);
        // console.log("style.height = " + this.menu.style.height, "scrollHeight = " + this.menu.scrollHeight);
    }
}