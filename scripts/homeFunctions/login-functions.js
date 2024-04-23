const loginForm = document.getElementById("login-form");

loginForm.addEventListener("submit", (e) => {
    handleLogin(e);
});

const handleLogin = (e) => {
    e.preventDefault();

    const link = document.createElement("a");
    link.href = "../pages/home.html";
    link.click();
};  