export default function addDarkModeToggle()
{
    let storedTheme = localStorage.getItem('theme') || (window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light");
    if (storedTheme) {
        document.documentElement.setAttribute('data-theme', storedTheme)
    }

    let toggle = document.getElementById("theme-toggle");
    toggle.onclick = function () {
        let currentTheme = document.documentElement.getAttribute("data-theme");
        let targetTheme = currentTheme === "light" ? "dark" : "light";
        document.documentElement.setAttribute('data-theme', targetTheme)
        localStorage.setItem('theme', targetTheme);
    };
}
