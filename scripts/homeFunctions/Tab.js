class Tab {
    _document = undefined;
    id = null;
    tab = null;
    active = false;

    constructor(_document, id){
        this._document = _document;
        this.id = id;
        this.tab = this._document.getElementById(id);
    }

    getId(){
        return this.id;
    }

    setActive(active){
        if(active){
            const activeTabs = document.getElementsByClassName("active-tab");
            for(var i = 0; i < activeTabs.length; i++){
                activeTabs.item(i).classList.remove("active-tab");
            }
            this.tab.classList.add("active-tab");
            this.active = true;
            this._document.location.href = "#" + this.id;
        }else{
            this.tab.classList.remove("active-tab");
            this.active = false;
        }
    }
};