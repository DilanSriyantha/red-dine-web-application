class Product {
    id = undefined;
    name = undefined;
    category = undefined;
    price = undefined;
    image = undefined;
    parentElement = undefined;
    element = undefined;

    constructor(id, name, category, price, image, parentElement){
        this.id = id;
        this.name = name;
        this.category = category;
        this.price = price;
        this.image = image;
        this.parentElement = parentElement;

        this.init();
    }

    init() {
        const element = 
        `
        <div class="product-item">
            <div class="product-item-thumbnail">
                <img loading="lazy" src="${this.image}">
            </div>
            <div class="product-item-details-container">
                <h4 class="p-0 m-0">${this.name}</h4>
                <small>${this.category}</small>
                <h2>${this.price}</h2>
            </div>
        </div>
            <a class="col col-lg product-item-container" href="../pages/item-details.php">
            </a>
        `;

        const product_item_container = document.createElement("a");
        product_item_container.className = "col col-lg product-item-container";
        product_item_container.href = `../pages/item-details.php?item_id=${this.id}`;
        product_item_container.id = this.id;
        product_item_container.innerHTML = element;

        this.element = product_item_container;
        this.parentElement.append(product_item_container);
    }
}