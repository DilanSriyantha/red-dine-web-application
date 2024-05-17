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
    "loading-spinner",
];

const menu = new Menu(document, "floating-menu", "floating-menu-container", "floating-menu-button", tab_ids);
menu.init();

const forms = document.querySelectorAll("#order-state-form");
const ordersList = document.getElementById("orders-list-wrapper");
if(ordersList){
    ordersList.addEventListener("scroll", (e) => {
        forms.forEach(form => {
            action = form.getAttribute("action");
            action_base = action.includes("&") ? action.substring(action.indexOf("&"), -action.length) : action;
            form.setAttribute("action", `${action_base}&scrollTop=${ordersList.scrollTop}`);
        });
        
    });
}

const saveState = () => {
    const fragment = `#${menu.getActiveTab().id}%${ordersList.scrollTop}`;
    history.replaceState(null, null, fragment);
};

const restoreState = () => {
    const fragment = window.location.hash;
    if(fragment){
        const [tabId, scrollTop] = fragment.substring(1).split("&");
        menu.selectMenuOption(tab_ids.indexOf(tabId));

        if(!scrollTop) return;
        ordersList.scrollTo(0, scrollTop);
    }else{
        menu.selectMenuOption(0);
        window.location.href = "#" + tab_ids[0];
    }
};

window.onload = restoreState();