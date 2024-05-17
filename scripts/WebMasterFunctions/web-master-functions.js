class Popup {
    triggerBtn = undefined;
    popupElement = undefined;
    backdrop = undefined;
    imageOption = 0;

    constructor(triggerBtn, popupElement, backdrop){
        this.triggerBtn = triggerBtn;
        this.popupElement = popupElement;
        this.backdrop = backdrop;
    }

    initTriggers(){
        this.triggerBtn.addEventListener("click", (e) => {
            e.preventDefault();
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

        const imageOptionButtons = this.popupElement.getElementsByClassName("image-option-button");
        for(var i = 0; i < imageOptionButtons.length; i++){
            imageOptionButtons.item(i).addEventListener("click", (e) => {
                const selectedImageOptions = this.popupElement.getElementsByClassName("image-option-button-selected");
                for(var i = 0; i < selectedImageOptions.length; i++){
                    selectedImageOptions.item(i).classList.remove("image-option-button-selected");
                }
                e.target.classList.add("image-option-button-selected");
                this.imageOption === 0 ? this.imageOption = 1 : this.imageOption = 0;

                this.updateItemPopup();
            });
        }

        const itemImagePreview = this.getElementById("item-image-preview");
        itemImagePreview.addEventListener("click", (e) => {
            this.getElementById("item-image-input").click();
        });

        this.getElementById("item-image-input").addEventListener("input", async (e) => {
            try{   
                const base64 = await Utils.compressImage(e.target.files[0]);
                if(base64){
                    itemImagePreview.src = base64;
                    this.getElementById("item-image-url").value = base64;
                }
            }catch(err){
                console.log(err);
            }
        });

        this.getElementById("item-image-url").addEventListener("input", (e) => {
            itemImagePreview.src = e.target.value;
        });
    }

    updateItemPopup() {
        if(this.imageOption === 0){
            this.getElementById("item-image-url").setAttribute("hidden", true);
        }else{
            this.getElementById("item-image-url").removeAttribute("hidden");
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

    getElementById(id) {
        return this.popupElement.querySelector(`#${id}`);
    }
}