class Popup {
    triggerBtn = undefined;
    popupElement = undefined;
    backdrop = undefined;

    constructor(triggerBtn, popupElement, backdrop){
        this.triggerBtn = triggerBtn;
        this.popupElement = popupElement;
        this.backdrop = backdrop;
    }

    initTriggers(){
        this.triggerBtn.addEventListener("click", (e) => {
            this.open();
        }); 

        const btns = this.popupElement.getElementsByTagName("button");
        for(var i = 0; i < btns.length; i++){
            if(btns.item(i).className === "close-btn"){
                btns.item(i).addEventListener("click", (e) => {
                    e.preventDefault();
                    this.close();
                }); 
            }
        }
    }

    open() {
        this.backdrop.style.display = "unset";
        this.popupElement.style.display = "unset";

        this.backdrop.className = "backdrop reveal-backdrop";
        this.popupElement.className = "popup-container-add-category popup-container reveal-popup";
    }

    close() {
        this.backdrop.style.animation = "none";
        this.popupElement.style.animation = "none";
        this.backdrop.style.animation = "backdrop-anim-rev forwards .5s";
        this.popupElement.style.animation = "popup-anim-rev forwards .5s";


        setTimeout(() => {
            this.backdrop.style.display = "none";
            this.popupElement.style.display = "none";

            this.backdrop.style.animation = "backdrop-anim forwards .5s";
            this.popupElement.style.animation = "popup-anim forwards .5s";
        }, 500);
    }
}