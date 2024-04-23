class MenuOption {
    id = null;
    menu_option = null;
    tab = null;
    active = false;
    
    constructor(id, menu_option, tab){
        this.id = id;
        this.menu_option = menu_option;
        this.tab = tab;
    }

    getId() {
        return this.id;
    }

    setActive(active) {
        if(active){
            this.menu_option.classList.add("floating-menu-button-active");
        }else{
            this.menu_option.classList.remove("floating-menu-button-active");
        }
        this.active = active;
        this.tab.setActive(active);
    }

    addClickListener(handleClick, context) {
        this.menu_option.addEventListener("click", (e) => {
            if(this.active) return;
            handleClick.call(context);
        });
    }
}