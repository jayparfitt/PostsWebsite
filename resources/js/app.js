document.addEventListener("DOMContentLoaded", () => {
    const enlargeButton = document.getElementById("text-enlarge");
    const minimizeButton = document.getElementById("text-minimize");
    const resetButton = document.getElementById("text-reset");
    const root = document.documentElement; // Target the root element (html)

    let baseFontSize =
        parseInt(window.getComputedStyle(root).fontSize, 10) || 16; // Default base font size

    // Load saved font size from localStorage
    const savedFontSize = parseInt(localStorage.getItem("fontSize"));
    if (savedFontSize) {
        root.style.fontSize = `${savedFontSize}px`;
        baseFontSize = savedFontSize;
    }

    // Enlarge Text
    enlargeButton?.addEventListener("click", () => {
        baseFontSize += 2;
        root.style.fontSize = `${baseFontSize}px`;
        localStorage.setItem("fontSize", baseFontSize); // Save preference
    });

    // Minimize Text
    minimizeButton?.addEventListener("click", () => {
        if (baseFontSize > 10) {
            baseFontSize -= 2;
            root.style.fontSize = `${baseFontSize}px`;
            localStorage.setItem("fontSize", baseFontSize); // Save preference
        }
    });

    // Reset Text
    resetButton?.addEventListener("click", () => {
        baseFontSize = 16; // Default size
        root.style.fontSize = `${baseFontSize}px`;
        localStorage.removeItem("fontSize"); // Clear preference
    });
});
