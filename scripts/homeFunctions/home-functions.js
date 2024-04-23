// let popularItems = [];

// window.onload = () => {
//     populatePopularList();
// }

// function populatePopularList() {
//     const popularListElement = document.getElementById("popular-container");
//     const popularList = [
//         {
//             id: Math.random(),
//             name: "Pizza",
//             image: "https://i.ibb.co/p1k19jZ/Pizza.png",
//             details: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis modi, at maiores quae error repellat dignissimos sit earum. Blanditiis.",
//             category: "Pizza",
//             price: 10.00,
//         },
//         {
//             id: Math.random(),
//             name: "Pizza",
//             image: "https://i.ibb.co/p1k19jZ/Pizza.png",
//             details: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis modi, at maiores quae error repellat dignissimos sit earum. Blanditiis.",
//             category: "Pizza",
//             price: 10.00,
//         },
//         {
//             id: Math.random(),
//             name: "Pizza",
//             image: "https://i.ibb.co/p1k19jZ/Pizza.png",
//             details: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis modi, at maiores quae error repellat dignissimos sit earum. Blanditiis.",
//             category: "Pizza",
//             price: 10.00,
//         },
//         {
//             id: Math.random(),
//             name: "Pizza",
//             image: "https://i.ibb.co/p1k19jZ/Pizza.png",
//             details: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis modi, at maiores quae error repellat dignissimos sit earum. Blanditiis.",
//             category: "Pizza",
//             price: 10.00,
//         },
//         {
//             id: Math.random(),
//             name: "Pizza",
//             image: "https://i.ibb.co/p1k19jZ/Pizza.png",
//             details: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis modi, at maiores quae error repellat dignissimos sit earum. Blanditiis.",
//             category: "Pizza",
//             price: 10.00,
//         },
//         {
//             id: Math.random(),
//             name: "Pizza",
//             image: "https://i.ibb.co/p1k19jZ/Pizza.png",
//             details: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis modi, at maiores quae error repellat dignissimos sit earum. Blanditiis.",
//             category: "Pizza",
//             price: 10.00,
//         },
//         {
//             id: Math.random(),
//             name: "Pizza",
//             image: "https://i.ibb.co/p1k19jZ/Pizza.png",
//             details: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis modi, at maiores quae error repellat dignissimos sit earum. Blanditiis.",
//             category: "Pizza",
//             price: 10.00,
//         },
//         {
//             id: Math.random(),
//             name: "Pizza",
//             image: "https://i.ibb.co/p1k19jZ/Pizza.png",
//             details: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis modi, at maiores quae error repellat dignissimos sit earum. Blanditiis.",
//             category: "Pizza",
//             price: 10.00,
//         },
//         {
//             id: Math.random(),
//             name: "Pizza",
//             image: "https://i.ibb.co/p1k19jZ/Pizza.png",
//             details: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis modi, at maiores quae error repellat dignissimos sit earum. Blanditiis.",
//             category: "Pizza",
//             price: 10.00,
//         },
//         {
//             id: Math.random(),
//             name: "Pizza",
//             image: "https://i.ibb.co/p1k19jZ/Pizza.png",
//             details: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis modi, at maiores quae error repellat dignissimos sit earum. Blanditiis.",
//             category: "Pizza",
//             price: 10.00,
//         },
//         {
//             id: Math.random(),
//             name: "Pizza",
//             image: "https://i.ibb.co/p1k19jZ/Pizza.png",
//             details: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis modi, at maiores quae error repellat dignissimos sit earum. Blanditiis.",
//             category: "Pizza",
//             price: 10.00,
//         },
//         {
//             id: Math.random(),
//             name: "Pizza",
//             image: "https://i.ibb.co/p1k19jZ/Pizza.png",
//             details: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid corporis modi, at maiores quae error repellat dignissimos sit earum. Blanditiis.",
//             category: "Pizza",
//             price: 10.00,
//         },
//     ];

//     popularList.forEach((item) => {
//         popularItems.push(new PopularItem(item.id, item, popularListElement));
//     });
// }

const tab_ids = [
    "tab-dashboard",
    "tab-orders",
    "tab-about",
    "tab-user",
    "tab-preferences",
];

const menu = new Menu(document, "floating-menu", "floating-menu-container", "floating-menu-button", tab_ids);
menu.init();