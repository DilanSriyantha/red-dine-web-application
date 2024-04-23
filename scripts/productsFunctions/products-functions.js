let productsList = [];

window.onload = () => {
    populateProductsList();
};

const params = new URLSearchParams(window.location.search);

const bitesList = [
    {
        id: Math.random(),
        name: "Bite item 01",
        image: "",
        category: "Bites",
        price: 9.99,
    }
];

function populateProductsList() {
    const productsListElement = document.getElementById("products-list");

    const category = params.get("category");

    for(let i = 0; i < 100; i++){
        productsList.push(new Product(
            Math.round(Math.random() * Math.pow(10, 10)),
            `${category.replace(category[0], category[0].toUpperCase())} item ${i}`,
            category.replace(category[0], category[0].toUpperCase()),
            9.99,
            "https://www.checkvenlo.nl/imager/data/images/6799/trattoria-antonia4_d00c8fba43f8c7c2997367b310d37b0d.jpg",
            productsListElement
        ));
    }
};