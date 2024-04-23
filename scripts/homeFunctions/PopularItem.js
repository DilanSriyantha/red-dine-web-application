class PopularItem {
    id = undefined;
    parentElement = undefined;
    itemObject = undefined;
    element = undefined;

    constructor(id, itemObject, parentElement){
        this.id = id;
        this.itemObject = itemObject;
        this.parentElement = parentElement;

        this.init();
    }

    init(){
        const element = 
        `<div class="popular-item">
            <div class="popular-item-content">
                <div class="popular-item-thumbnail">
                    <img loading="lazy" src="${this.itemObject.image}">
                </div>
                <div class="details-container">
                    <div class="details-content">
                        <h4 class="p-0 m-0">${this.itemObject.details}</h4>
                        <small>${this.itemObject.category}</small>
                        <h4>$ ${this.itemObject.price}</h4>
                    </div>
                </div>
            </div>
        </div>`;

        const popular_item_container = document.createElement("div");
        popular_item_container.className = "popular-item-container";
        popular_item_container.id = this.id;
        popular_item_container.innerHTML = element;

        popular_item_container.addEventListener("click", (e) => {
            console.log(this.itemObject);
        });

        this.element = popular_item_container;
        this.parentElement.prepend(popular_item_container);
    }
    
    delete() {
        this.element.remove();
    }
}